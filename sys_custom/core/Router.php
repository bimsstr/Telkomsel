<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Router {

	var $config;

	var $routes			= array();

	var $error_routes	= array();

	var $class			= '';

	var $method			= 'index';

	var $directory		= '';

	var $default_controller;

	function __construct()
	{
		$this->config = load_class('Config', 'core');
		$this->uri = load_class('URI', 'core');
		log_message('debug', "Router Class Initialized");
	}

    function redirect($uri = '', $method = 'location', $http_response_code = 302)
    {
        if ( ! preg_match('#^https?://#i', $uri))
        {
            $uri = site_url($uri);
        }

        switch($method)
        {
            case 'refresh'	: header("Refresh:0;url=".$uri);
                break;
            default			: header("Location: ".$uri, TRUE, $http_response_code);
                break;
        }
        exit;
    }

	function _set_routing()
	{
		// Are query strings enabled in the config file?  Normally CI doesn't utilize query strings
		// since URI segments are more search-engine friendly, but they can optionally be used.
		// If this feature is enabled, we will gather the directory/class/method a little differently
		$segments = array();
		if ($this->config->item('enable_query_strings') === TRUE AND isset($_GET[$this->config->item('controller_trigger')]))
		{
			if (isset($_GET[$this->config->item('directory_trigger')]))
			{
				$this->set_directory(trim($this->uri->_filter_uri($_GET[$this->config->item('directory_trigger')])));
				$segments[] = $this->fetch_directory();
			}

			if (isset($_GET[$this->config->item('controller_trigger')]))
			{
				$this->set_class(trim($this->uri->_filter_uri($_GET[$this->config->item('controller_trigger')])));
				$segments[] = $this->fetch_class();
			}

			if (isset($_GET[$this->config->item('function_trigger')]))
			{
				$this->set_method(trim($this->uri->_filter_uri($_GET[$this->config->item('function_trigger')])));
				$segments[] = $this->fetch_method();
			}
		}

		// Load the routes.php file.
		if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/routes.php'))
		{
			include(APPPATH.'config/'.ENVIRONMENT.'/routes.php');
		}
		elseif (is_file(APPPATH.'config/routes.php'))
		{
			include(APPPATH.'config/routes.php');
		}

		$this->routes = ( ! isset($route) OR ! is_array($route)) ? array() : $route;
		unset($route);

		// Set the default controller so we can display it in the event
		// the URI doesn't correlated to a valid controller.
		$this->default_controller = ( ! isset($this->routes['default_controller']) OR $this->routes['default_controller'] == '') ? FALSE : strtolower($this->routes['default_controller']);

		// Were there any query string segments?  If so, we'll validate them and bail out since we're done.
		if (count($segments) > 0)
		{
			return $this->_validate_request($segments);
		}

		// Fetch the complete URI string
		$this->uri->_fetch_uri_string();

		// Is there a URI string? If not, the default controller specified in the "routes" file will be shown.
		if ($this->uri->uri_string == '')
		{
			return $this->_set_default_controller();
		}

		// Do we need to remove the URL suffix?
		$this->uri->_remove_url_suffix();

		// Compile the segments into an array
		$this->uri->_explode_segments();

		// Parse any custom routing that may exist
		$this->_parse_routes();

		// Re-index the segment array so that it starts with 1 rather than 0
		$this->uri->_reindex_segments();
	}

	function _set_default_controller()
	{
		if ($this->default_controller === FALSE)
		{
			show_error("Unable to determine what should be displayed. A default route has not been specified in the routing file.");
		}
		// Is the method being specified?
		if (strpos($this->default_controller, '/') !== FALSE)
		{
			$x = explode('/', $this->default_controller);

			$this->set_class($x[0]);
			$this->set_method($x[1]);
			$this->_set_request($x);
		}
		else
		{
			$this->set_class($this->default_controller);
			$this->set_method('index');
			$this->_set_request(array($this->default_controller, 'index'));
		}

		// re-index the routed segments array so it starts with 1 rather than 0
		$this->uri->_reindex_segments();

		log_message('debug', "No URI present. Default controller set.");
	}

	function _set_request($segments = array())
	{
	   // echo "DEBUG (Router _set_request): called with segments: "; var_dump($segments); echo "<br>";
        $segments = $this->_validate_request($segments);
        // echo "DEBUG (Router _set_request): after validate: "; var_dump($segments); echo "<br>";
        
	

		if (count($segments) == 0)
		{
			return $this->_set_default_controller();
		}

		$this->set_class($segments[0]);

		if (isset($segments[1]))
		{
			// A standard method request
			$this->set_method($segments[1]);
		}
		else
		{
			// This lets the "routed" segment array identify that the default
			// index method is being used.
			$segments[1] = 'index';
		}

		// Update our "routed" segment array to contain the segments.
		// Note: If there is no custom routing, this array will be
		// identical to $this->uri->segments
		$this->uri->rsegments = $segments;
	}

function _validate_request($segments)
{
    // echo "DEBUG (Router _validate_request): START. Called with segments: "; var_dump($segments); echo "<br>";

    // Set the class and method
    $this->set_class($segments[0]);
    $this->set_method(isset($segments[1]) ? $segments[1] : 'index');

    // Does the requested controller exist in the root folder?
    // Ini akan mencoba mencari public_html/guest/app_custom/controllers/Yudha.php (jika segments[0] adalah 'Yudha')
    $path_root_controller = APPPATH.'controllers/'.$this->fetch_class().'.php';
    // echo "DEBUG (Router _validate_request): Checking root controller path: '$path_root_controller'<br>";
    // echo "DEBUG (Router _validate_request): file_exists('$path_root_controller'): "; var_dump(file_exists($path_root_controller)); echo "<br>";

    if (file_exists($path_root_controller))
    {
        // echo "DEBUG (Router _validate_request): Controller found in root application/controllers/.<br>";
        return $segments;
    }

    // Is the controller in a sub-directory?
    // Ini akan mencoba mencari public_html/guest/app_custom/controllers/Yudha/ (jika segments[0] adalah 'Yudha')
    $path_sub_directory = APPPATH.'controllers/'.$segments[0];
    // echo "DEBUG (Router _validate_request): Checking sub-directory path: '$path_sub_directory'<br>";
    // echo "DEBUG (Router _validate_request): is_dir('$path_sub_directory'): "; var_dump(is_dir($path_sub_directory)); echo "<br>";


    if (is_dir($path_sub_directory))
    {
        // Set the directory and remove it from the segment array
        $this->set_directory(array_shift($segments));

        // If the URL has an extension, we need to remove it from
        // the last segment
        $len = count($segments);
        if ($len > 0 && strpos($segments[$len-1], '.') !== FALSE)
        {
            $segments[$len-1] = substr($segments[$len-1], 0, strpos($segments[$len-1], '.'));
        }

        // Does the requested controller exist in the sub-directory?
        // Ini akan mencoba mencari public_html/guest/app_custom/controllers/Yudha/Yudha.php
        $path_sub_controller = APPPATH.'controllers/'.$this->fetch_directory().$this->fetch_class().'.php';
        // echo "DEBUG (Router _validate_request): Checking sub-directory controller path: '$path_sub_controller'<br>";
        // echo "DEBUG (Router _validate_request): file_exists('$path_sub_controller'): "; var_dump(file_exists($path_sub_controller)); echo "<br>";

        if ( ! file_exists($path_sub_controller))
        {
            // If it's a sub-directory but no controller is found within it,
            // check for 404 override.
            if ( ! empty($this->routes['404_override']))
            {
                $x = explode('/', $this->routes['404_override']);
                $this->set_directory(''); // Clear directory if it's a 404
                $this->set_class($x[0]);
                $this->set_method(isset($x[1]) ? $x[1] : 'index');
                return $x;
            }
            else
            {
                // echo "DEBUG (Router _validate_request): Controller not found in sub-directory and no 404 override.<br>";
                show_404($this->fetch_directory().$segments[0]); // Ini yang akan memicu 404
            }
        }
        // echo "DEBUG (Router _validate_request): Controller found in sub-directory.<br>";
        return $segments; // Controller ditemukan di sub-direktori
    }

    // --- MULAI KODE DEBUGGING SPESIFIK UNTUK KASUS ANDA ---
    // echo "DEBUG (Router _validate_request): NO STANDARD CONTROLLER FOUND (root or sub-dir). Checking specific routes.<br>";

    // Jika segmen yang masuk adalah 'Yudha', routes.php kita ingin mengarahkan ke 'Dashboard' controller.
    // Jadi, kita perlu memeriksa apakah file 'Dashboard.php' ada di jalur yang benar.
    // Karena APPPATH sudah menunjuk ke 'app_custom/', maka Dashboard.php harus di 'app_custom/controllers/Dashboard.php'

    $target_controller_name = 'Dashboard';
    $path_to_dashboard_controller = APPPATH . 'controllers/' . $target_controller_name . '.php';

    // echo "DEBUG (Router _validate_request): APPPATH (from index.php) is: " . APPPATH . "<br>";
    // echo "DEBUG (Router _validate_request): Attempting to find Dashboard controller at: " . $path_to_dashboard_controller . "<br>";
    // echo "DEBUG (Router _validate_request): file_exists('" . $path_to_dashboard_controller . "') returns: ";
    // var_dump(file_exists($path_to_dashboard_controller));
    // echo "<br>";

    if (file_exists($path_to_dashboard_controller)) {
        // echo "DEBUG (Router _validate_request): SUCCESS! Found Dashboard controller for segment '{$segments[0]}'. Setting class/method.<br>";
        $this->set_class($target_controller_name); // Set kelasnya menjadi 'Dashboard'
        $this->set_method(isset($segments[1]) ? $segments[1] : 'index'); // Set methodnya, default 'index'
        // Penting: Kembalikan segmen yang akan digunakan router
        return array($target_controller_name, isset($segments[1]) ? $segments[1] : 'index');
    }

    // --- AKHIR KODE DEBUGGING SPESIFIK ---

    // If we've gotten this far it means that the URI does not correlate to a valid
    // controller class.  We will now see if there is an override
    if ( ! empty($this->routes['404_override']))
    {
        // echo "DEBUG (Router _validate_request): No valid controller found, using 404_override: " . $this->routes['404_override'] . "<br>";
        $x = explode('/', $this->routes['404_override']);

        $this->set_class($x[0]);
        $this->set_method(isset($x[1]) ? $x[1] : 'index');

        return $x;
    }


	    /**
	     * Modifikasi Ary.
	     * Memproses route agar bisa seolah-olah dapat langsung memproses
	     * segment[0].
	     *
	     * Proses dilakukan dengan meredirect ke controller jurnal untuk
	     * dicek apakah segemnt[0] adalah salah satu judul dari artikel
	     * pada database.
	     *
	     * Setelah itu dengan teknik HTML 5 akan menggunakan method
	     * window.history.pushState() untuk mengganti url tanpa perlu
	     * refresh halaman.
	     *
	    if ($segments[0] != '')
	    {
	        echo $segments[0];
	        $this->redirect($this->config->item('base_url').'jurnal/index/'.$segments[0]);
	    }
	     */

		// Nothing else to do at this point but show a 404
// 		 echo "DEBUG (Router _validate_request): END. No valid controller found for segment: '{$segments[0]}', showing 404.<br>";
		show_404($segments[0]);
	}

	function _parse_routes()
	{
		// Turn the segment array into a URI string
		$uri = implode('/', $this->uri->segments);

		// Is there a literal match?  If so we're done
		if (isset($this->routes[$uri]))
		{
			return $this->_set_request(explode('/', $this->routes[$uri]));
		}

		// Loop through the route array looking for wild-cards
		foreach ($this->routes as $key => $val)
		{
			// Convert wild-cards to RegEx
			$key = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $key));

			// Does the RegEx match?
			if (preg_match('#^'.$key.'$#', $uri))
			{
			     //echo "DEBUG (Router _parse_routes): Route matched! URI: '$uri', Key: '$key', Value: '$val'<br>";
				// Do we have a back-reference?
				if (strpos($val, '$') !== FALSE AND strpos($key, '(') !== FALSE)
				{
					$val = preg_replace('#^'.$key.'$#', $val, $uri);
				}

				return $this->_set_request(explode('/', $val));
			}
		}

		// If we got this far it means we didn't encounter a
		// matching route so we'll set the site default route
// 		echo "DEBUG (Router _parse_routes): No custom route matched. Using default segments.<br>";
		$this->_set_request($this->uri->segments);
	}

	function set_class($class)
	{
		$this->class = str_replace(array('/', '.'), '', $class);
	}

	function fetch_class()
	{
		return $this->class;
	}

	function set_method($method)
	{
		$this->method = $method;
	}

	function fetch_method()
	{
		if ($this->method == $this->fetch_class())
		{
			return 'index';
		}

		return $this->method;
	}

	function set_directory($dir)
	{
		$this->directory = str_replace(array('/', '.'), '', $dir).'/';
	}

	function fetch_directory()
	{
		return $this->directory;
	}

	function _set_overrides($routing)
	{
		if ( ! is_array($routing))
		{
			return;
		}

		if (isset($routing['directory']))
		{
			$this->set_directory($routing['directory']);
		}

		if (isset($routing['controller']) AND $routing['controller'] != '')
		{
			$this->set_class($routing['controller']);
		}

		if (isset($routing['function']))
		{
			$routing['function'] = ($routing['function'] == '') ? 'index' : $routing['function'];
			$this->set_method($routing['function']);
		}
	}
}