<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Output {

	protected $final_output;

	protected $cache_expiration	= 0;

	protected $headers			= array();

	protected $mime_types		= array();

	protected $enable_profiler	= FALSE;

	protected $_zlib_oc			= FALSE;

	protected $_profiler_sections = array();

	protected $parse_exec_vars	= TRUE;

	function __construct()
	{
		$this->_zlib_oc = @ini_get('zlib.output_compression');

		// Get mime types for later
		if (defined('ENVIRONMENT') AND file_exists(APPPATH.'config/'.ENVIRONMENT.'/mimes.php'))
		{
		    include APPPATH.'config/'.ENVIRONMENT.'/mimes.php'; // Corrected space character here
		}
		else
		{
			include APPPATH.'config/mimes.php';
		}


		$this->mime_types = $mimes;

		log_message('debug', "Output Class Initialized");
	}

	function get_output()
	{
		return $this->final_output;
	}

	function set_output($output)
	{
		$this->final_output = $output;

		return $this;
	}

	function append_output($output)
	{
		if ($this->final_output == '')
		{
			$this->final_output = $output;
		}
		else
		{
			$this->final_output .= $output;
		}

		return $this;
	}

	function set_header($header, $replace = TRUE)
	{
		// If zlib.output_compression is enabled it will compress the output,
		// but it will not modify the content-length header to compensate for
		// the reduction, causing the browser to hang waiting for more data.
		// We'll just skip content-length in those cases.

		if ($this->_zlib_oc && strncasecmp($header, 'content-length', 14) == 0)
		{
			return;
		}

		$this->headers[] = array($header, $replace);

		return $this;
	}

	function set_content_type($mime_type)
	{
		if (strpos($mime_type, '/') === FALSE)
		{
			$extension = ltrim($mime_type, '.');

			// Is this extension supported?
			if (isset($this->mime_types[$extension]))
			{
				$mime_type = $this->mime_types[$extension]; // Corrected: was $mime_type =& $this->mime_types[$extension];

				if (is_array($mime_type))
				{
					$mime_type = current($mime_type);
				}
			}
		}

		$header = 'Content-Type: '.$mime_type;

		$this->headers[] = array($header, TRUE);

		return $this;
	}

	function set_status_header($code = 200, $text = '')
	{
		set_status_header($code, $text);

		return $this;
	}

	function enable_profiler($val = TRUE)
	{
		$this->enable_profiler = (is_bool($val)) ? $val : TRUE;

		return $this;
	}

	function set_profiler_sections($sections)
	{
		foreach ($sections as $section => $enable)
		{
			$this->_profiler_sections[$section] = ($enable !== FALSE) ? TRUE : FALSE;
		}

		return $this;
	}

	function cache($time)
	{
		$this->cache_expiration = ( ! is_numeric($time)) ? 0 : $time;

		return $this;
	}

	function _display($output = '')
	{
		// Note:  We use globals because we can't use $CI =& get_instance()
		// since this function is sometimes called by the caching mechanism,
		// which happens before the CI super object is available.
		global $BM, $CFG;

		// Grab the super object if we can.
		if (class_exists('CI_Controller'))
		{
			$CI = get_instance(); // Corrected: was $CI =& get_instance();
		}

		// --------------------------------------------------------------------

		// Set the output data
		if ($output == '')
		{
			$output = $this->final_output; // Corrected: was $output =& $this->final_output;
		}

		// --------------------------------------------------------------------

		// Do we need to write a cache file?  Only if the controller does not have its
		// own _output() method and we are not dealing with a cache file, which we
		// can determine by the existence of the $CI object above
		if ($this->cache_expiration > 0 && isset($CI) && ! method_exists($CI, '_output'))
		{
			$this->_write_cache($output);
		}

		// --------------------------------------------------------------------

		// Parse out the elapsed time and memory usage,
		// then swap the pseudo-variables with the data

		$elapsed = $BM->elapsed_time('total_execution_time_start', 'total_execution_time_end');

		if ($this->parse_exec_vars === TRUE)
		{
			$memory	 = ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB';

			$output = str_replace('{elapsed_time}', $elapsed, $output);
			$output = str_replace('{memory_usage}', $memory, $output);
		}

		// --------------------------------------------------------------------

		// Is compression requested?
		if ($CFG->item('compress_output') === TRUE && $this->_zlib_oc == FALSE)
		{
			if (extension_loaded('zlib'))
			{
				if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) AND strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE)
				{
					ob_start('ob_gzhandler');
				}
			}
		}

		// --------------------------------------------------------------------

		// Are there any server headers to send?
		if (count($this->headers) > 0)
		{
			foreach ($this->headers as $header)
			{
				@header($header[0], $header[1]);
			}
		}

		// --------------------------------------------------------------------

		// Does the $CI object exist?
		// If not we know we are dealing with a cache file so we'll
		// simply echo out the data and exit.
		if ( ! isset($CI))
		{
			echo $output;
			log_message('debug', "Final output sent to browser");
			log_message('debug', "Total execution time: ".$elapsed);
			return TRUE;
		}

		// --------------------------------------------------------------------

		// Do we need to generate profile data?
		// If so, load the Profile class and run it.
		if ($this->enable_profiler == TRUE)
		{
			$CI->load->library('profiler');

			if ( ! empty($this->_profiler_sections))
			{
				$CI->profiler->set_sections($this->_profiler_sections);
			}

			// If the output data contains closing </body> and </html> tags
			// we will remove them and add them back after we insert the profile data
			if (preg_match("|</body>.*?</html>|is", $output))
			{
				$output  = preg_replace("|</body>.*?</html>|is", '', $output); // Corrected: replaced non-breaking space
				$output .= $CI->profiler->run();
				$output .= '</body></html>';
			}
			else
			{
				$output .= $CI->profiler->run();
			}
		}

		// --------------------------------------------------------------------

		// Does the controller contain a function named _output()?
		// If so send the output there.  Otherwise, echo it.
		if (method_exists($CI, '_output'))
		{
			$CI->_output($output);
		}
		else
		{
			echo $output; // Corrected: replaced non-breaking space
		}

		log_message('debug', "Final output sent to browser");
		log_message('debug', "Total execution time: ".$elapsed);
	}

	function _write_cache($output)
	{
		$CI = get_instance(); // Corrected: was $CI =& get_instance();
		$path = $CI->config->item('cache_path');

		$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

		if ( ! is_dir($cache_path) OR ! is_really_writable($cache_path))
		{
			log_message('error', "Unable to write cache file: ".$cache_path);
			return;
		}

		$uri =	$CI->config->item('base_url').
				$CI->config->item('index_page').
				$CI->uri->uri_string();

		$cache_path .= md5($uri);

		if ( ! $fp = @fopen($cache_path, FOPEN_WRITE_CREATE_DESTRUCTIVE))
		{
			log_message('error', "Unable to write cache file: ".$cache_path);
			return;
		}

		$expire = time() + ($this->cache_expiration * 60);

		if (flock($fp, LOCK_EX))
		{
			fwrite($fp, $expire.'TS--->'.$output);
			flock($fp, LOCK_UN);
		}
		else
		{
			log_message('error', "Unable to secure a file lock for file at: ".$cache_path);
			return;
		}
		fclose($fp);
		@chmod($cache_path, FILE_WRITE_MODE);

		log_message('debug', "Cache file written: ".$cache_path);
	}

	function _display_cache(&$CFG, &$URI)
	{
		$cache_path = ($CFG->item('cache_path') == '') ? APPPATH.'cache/' : $CFG->item('cache_path');

		// Build the file path.  The file name is an MD5 hash of the full URI
		$uri =	$CFG->item('base_url').
				$CFG->item('index_page').
				$URI->uri_string;

		$filepath = $cache_path.md5($uri);

		if ( ! @file_exists($filepath))
		{
			return FALSE;
		}

		if ( ! $fp = @fopen($filepath, FOPEN_READ))
		{
			return FALSE;
		}

		flock($fp, LOCK_SH);

		$cache = '';
		if (filesize($filepath) > 0)
		{
			$cache = fread($fp, filesize($filepath));
		}

		flock($fp, LOCK_UN);
		fclose($fp);

		// Strip out the embedded timestamp
		if ( ! preg_match("/(\d+TS--->)/", $cache, $match))
		{
			return FALSE;
		}

		// Has the file expired? If so we'll delete it.
		if (time() >= trim(str_replace('TS--->', '', $match['1'])))
		{
			if (is_really_writable($cache_path))
			{
				@unlink($filepath);
				log_message('debug', "Cache file has expired. File deleted");
				return FALSE;
			}
		}

		// Display the cache
		$this->_display(str_replace($match['0'], '', $cache));
		log_message('debug', "Cache file is current. Sending it to browser.");
		return TRUE;
	}
}
