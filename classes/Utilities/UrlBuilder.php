<?php

namespace Utilities;

use InvalidArgumentException;

class UrlBuilder
{
    protected $baseURL;
    protected $keyAdminUrl;
    protected $fileExternal;
    private $paramGet;
	private $publicUrl;

    public function __construct($baseURL, $keyAdminUrl, $fileExternal, $paramGet = '', $publicUrl)
    {
        $baseURL = rtrim($baseURL, '/');
        $this->baseURL = $baseURL;
        $this->keyAdminUrl = $keyAdminUrl;
        $this->fileExternal = $fileExternal;
        $this->paramGet = $paramGet;
    	$this->publicUrl = $publicUrl;
    }

    public function getBaseUrl()
    {
        return $this->baseURL;
    }

    public function buildExternal($path, $query = '')
    {
        $pathString = $this->formatPathInput($this->fileExternal. '/' .$path);
        $queryString = $this->formatQueryInput($query);
        $baseUrl = str_replace($this->keyAdminUrl, '', $this->baseURL);

        $url = rtrim($this->baseURL, '/') .'/'. $pathString;

        if (!empty($queryString))
        {
            $url .= '?'. $queryString;
            $getArray = explode('&', $queryString);
            $getKeyArray = array();
            foreach ($getArray as $get)
            {
                $getKey = explode('=', $get);
                $getKeyArray[] = $getKey[0];
            }
        }

        return $url;
    }

    public function build($path, $query = '', $withDefaultParamGet = FALSE)
    {
        $pathString = $this->formatPathInput($path);
        $queryString = $this->formatQueryInput($query);

        $url = $this->baseURL .'/'. $pathString;

        if (!empty($queryString))
        {
            $url .= '?'. $queryString;
            $getArray = explode('&', $queryString);
            $getKeyArray = array();
            foreach ($getArray as $get)
            {
                $getKey = explode('=', $get);
                $getKeyArray[] = $getKey[0];
            }

            if ($withDefaultParamGet)
            {
                if (count($this->paramGet) > 0)
                {
                    foreach ($this->paramGet as $key => $value)
                    {
                        if (array_search($key, $getKeyArray) === FALSE)
                            $url .= '&'.$key.'='.$value;
                    }
                }
            }
        }
        else if ($withDefaultParamGet)
        {
            if (count($this->paramGet) > 0)
            {
                $url .= '?'. $queryString;
                foreach ($this->paramGet as $key => $value)
                {
                    $url .= $key.'='.$value.'&';
                }
                $url = rtrim($url, '&');
            }
        }

        return $url;
    }

    protected function formatPathInput($path)
    {
        if (is_string($path))
        {
            return trim($path, '/');
        }

        if (is_array($path))
        {
            $pathString = '';

            foreach ($path as $segment)
            {
                $segment = rawurlencode($segment);
                $pathString .= $segment .'/';
            }

            return trim($pathString, '/');
        }

        throw InvalidArgumentException('URLBuilder error in building URL. Path must be either string or array.');
    }

    protected function formatQueryInput($query)
    {
        if (is_string($query))
        {
            $query = trim($query);
            $query = ltrim($query, '?');
            return $query;
        }

        if (is_array($query))
        {
            //$queryString = http_build_query($query, '', '&amp;', PHP_QUERY_RFC3986);
            $queryString = http_build_query($query, '', '&amp;');
            return $queryString;
        }

        throw InvalidArgumentException('URLBuilder error in building URL. Query must be either string or array.');
    }

	public function getPublicUrl($path){
		return rtrim($this->publicUrl,'/').'/'.$path;
	}

    public function getPublicAsset($path){
        return dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'asset'.DIRECTORY_SEPARATOR.$path;
    }
}