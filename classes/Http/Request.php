<?php

namespace Http;

class Request
{
    protected $server;

    protected $get;

    protected $post;

    protected $files;

    protected $cookie;

    protected $request;

    protected $env;

    protected $headers;

    public function __construct($server, $get, $post, $files, $cookie, $request, $env)
    {
        $this->server = $server;
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
        $this->cookie = $cookie;
        $this->request = $request;
        $this->env = $env;
        $this->initializeHeaders();
    }

    public static function createFromSuperglobals()
    {
        return new Request(
            $_SERVER,
            $_GET,
            $_POST,
            $_FILES,
            $_COOKIE,
            $_REQUEST,
            $_ENV
        );
    }

    public function isGet()
    {
        return ($this->getServer('REQUEST_METHOD') == 'GET');
    }

    public function isPost()
    {
        return ($this->getServer('REQUEST_METHOD') == 'POST');
    }

    public function isPut()
    {
        return ($this->getServer('REQUEST_METHOD') == 'PUT');
    }

    public function isDelete()
    {
        return ($this->getServer('REQUEST_METHOD') == 'DELETE');
    }

    public function isHead()
    {
        return ($this->getServer('REQUEST_METHOD') == 'HEAD');
    }

    public function isOptions()
    {
        return ($this->getServer('REQUEST_METHOD') == 'OPTIONS');
    }

    public function isXMLHTTPRequest()
    {
        return ($this->getHeader('X-REQUESTED-WITH') == 'XMLHttpRequest');
    }

    public function isHTTPS()
    {
        $https = $this->getServer('HTTPS');
        return (
            isset($https) &&
            !empty($https) &&
            strtolower($https) != 'off'
        );
    }

    public function isCLI()
    {
        $remoteAddr = $this->getServer('REMOTE_ADDR');
        return (
            strtolower(php_sapi_name()) == 'cli' AND
            empty($remoteAddr)
        );
    }

    public function getUserIpAddress()
    {
        $httpClientIP = $this->getServer('HTTP_CLIENT_IP');
        $httpForwardedFor = $this->getServer('HTTP_FORWARDED_FOR');
        $remoteAddress = $this->getServer('REMOTE_ADDR');

        if (!empty($httpClientIP))
        {
            $ip = $httpClientIP;
        }
        else if (!empty($httpForwardedFor))
        {
            $ip = $httpForwardedFor;
        }
        else
        {
            $ip = $remoteAddress;
        }

        return $ip;
    }

    public function getServer($index = NULL, $default = NULL)
    {
        if ($index == NULL)
        {
            return $this->server;
        }

        if (array_key_exists($index, $this->server))
        {
            return $this->server[$index];
        }

        return $default;
    }

    public function getGet($index = NULL, $default = NULL, $rule = NULL)
    {
        if ($index == NULL)
        {
            return $this->get;
        }

        if (array_key_exists($index, $this->get))
        {
            if ($rule == 'page')
            {
                if ((int)$this->get[$index] <= 0)
                {
                    return 1;
                }
            }

            return trim(urldecode($this->get[$index]));
        }

        return $default;
    }

    public function getPost($index = NULL, $default = NULL)
    {
        if ($index == NULL)
        {
            return $this->post;
        }

        if (array_key_exists($index, $this->post))
        {
            //echo '<pre>', var_dump($this->post['member_id']), '</pre>';exit;
            if (is_array($this->post[$index]))
            {
                return ($this->post[$index]);
            }
            return trim($this->post[$index]);
        }

        return $default;
    }

    public function getFiles($index = NULL, $default = NULL)
    {
        if ($index == NULL)
        {
            return $this->files;
        }

        if (array_key_exists($index, $this->files))
        {
            return $this->files[$index];
        }

        return $default;
    }

    public function getCookie($index = NULL, $default = NULL)
    {
        if ($index == NULL)
        {
            return $this->cookie;
        }

        if (array_key_exists($index, $this->cookie))
        {
            return $this->cookie[$index];
        }

        return $default;
    }

    public function getRequest($index = NULL, $default = NULL)
    {
        if ($index == NULL)
        {
            return $this->request;
        }

        if (array_key_exists($index, $this->request))
        {
            return $this->request[$index];
        }

        return $default;
    }

    public function getHeader($index = NULL, $default = NULL)
    {
        if ($index == NULL)
        {
            return $this->headers;
        }

        $index = strtoupper($index);

        if (array_key_exists($index, $this->headers))
        {
            return $this->headers[$index];
        }

        return $default;
    }

    public function issetServer($index)
    {
        return isset($this->server[$index]);
    }

    public function issetGet($index)
    {
        return isset($this->get[$index]);
    }

    public function issetPost($index)
    {
        return isset($this->post[$index]);
    }

    public function issetFiles($index)
    {
        return isset($this->files[$index]);
    }

    public function issetCookie($index)
    {
        return isset($this->cookie[$index]);
    }

    public function issetRequest($index)
    {
        return isset($this->request[$index]);
    }

    public function issetEnv($index)
    {
        return isset($this->env[$index]);
    }

    public function issetHeader($index)
    {
        return isset($this->headers[$index]);
    }

    protected function initializeHeaders()
    {
        $this->headers = array();
        foreach ($this->server as $key => $value)
        {
            if (substr($key, 0, 5) == 'HTTP_')
            {
                $headerKey = str_replace('_', '-', substr($key, 5));
                $headerKey = strtoupper($headerKey);
                $this->server[$headerKey] = $value;
            }
        }

        if (!function_exists('apache_request_headers'))
        {
            return;
        }

        $apacheHeaders = apache_request_headers();

        if ($apacheHeaders == FALSE)
        {
            return;
        }

        foreach ($apacheHeaders as $key => $value)
        {
            $key = strtoupper($key);
            $this->headers[$key] = $value;
        }
    }
}

?>