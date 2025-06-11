<?php

namespace Presentation;

use Http\Session,
	Utilities\Asset;

class AdminHtmlHeaderFooter extends RootPresentation
{
	protected $asset;
	protected $keywords;
	protected $description;
	protected $defaultCssAssetPath;
	protected $defaultMobileCssAssetPath;
	protected $jQueryAssetPath;
	protected $faviconAssetPath;
	protected $cssAssetPaths = array();
	protected $jsAssetPaths = array();
	protected $jsVariables=array();
	protected $jsCustomCode = array();
	private $urlBuilder;

	/**
	 * @var
	 */
	private $session;

	public function __construct(
		Asset $asset,
		array $defaultCssAssetPath,
		array $defaultMobileCssAssetPath,
		array $defaultJSAssetPath,
		Session $session,
		$faviconAssetPath,
		$urlBuilder
		)
	{
		$this->asset = $asset;
		$this->defaultCssAssetPath = $defaultCssAssetPath;
		$this->defaultMobileCssAssetPath = $defaultMobileCssAssetPath;
		$this->defaultJSAssetPath = $defaultJSAssetPath;
		$this->session = $session;
		$this->faviconAssetPath = $faviconAssetPath;
		$this->urlBuilder = $urlBuilder;
	}

	public function setKeywords($keywords)
	{
		$this->keywords = trim($keywords);
	}

	public function appendKeywords($keywords)
	{
		$keywords = trim(keywords);
		$this->keywords .= ' '. $keywords;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function addCssAsset($path)
	{
		$this->cssAssetPaths[] = $path;
	}

	public function clearCssAssets()
	{
		$this->cssAssetPaths = array();
	}

	public function setDefaultCssAsset($path)
	{
		$this->defaultCssAssetPath = $path;
	}

	public function setDefaultMobileCssAsset($path)
	{
		$this->defaultMobileCssAssetPath = $path;
	}

	public function addJsAsset($path)
	{
		$this->jsAssetPaths[] = $path;
	}

	public function clearJsAssets()
	{
		$this->jsAssetPaths = array();
	}

	public function setFaviconAsset($path)
	{
		$this->faviconAssetPath = $path;
	}

	public function renderHtmlHeader($title = 'Indihome Jogja | Admin Page', $class='')
	{
		$title = $this->clean($title);
		$keywords = $this->renderKeywordsMetaTag();
		$description = $this->renderDescriptionMetaTag();
		$faviconLink = $this->renderFaviconLink();
		$cssLinks = $this->renderCssLinks();
		$html = '
		<!DOCTYPE html>
		<html lang="en">
		<head>
    		<meta charset="UTF-8">
    		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    		<meta content="width=device-width, initial-scale=1" name="viewport" />
    		
			<title>'. $title .'</title>
			'. $keywords .'
			'. $description .'
			'. $faviconLink .'
			'. $cssLinks .'
			<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
		</head>
		<body class="light">';
		return $html;
	}

	public function renderHtmlFooter()
	{
		$this->session->remove('generalMessage');
		$jsLinks = $this->renderJsLinks();
		$jsVariables = $this->renderJsVariables();
		$jsCustomCode = $this->renderJsCustomCode();

		$html = $jsLinks .'
		    '. $jsVariables .'
		    '. $jsCustomCode .'</body></html>';

		return $html;
	}

	public function renderMobileHtmlHeader($title)
	{
		$title = $this->clean($title);
		$keywords = $this->renderKeywordsMetaTag();
		$description = $this->renderDescriptionMetaTag();
		$faviconLink = $this->renderFaviconLink();
		$cssLinks = $this->renderCssLinks(TRUE);
		$jsLinks = $this->renderJsLinks();
		$html = '<!--?xml version="1.0" encoding="utf-8"?-->
		<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		    <title>'. $title .'</title>
		    '. $keywords .'
		    '. $description .'
		    '. $faviconLink .'
		    '. $cssLinks .'
		    '. $jsLinks .'
		</head>
		<body class="">';
		return $html;
	}

	public function renderMobileHtmlFooter()
	{
		return '</body></html>';
	}

	protected function renderKeywordsMetaTag()
	{
		if (empty($this->keywords))
		{
			return '';
		}

		return '<meta name="keywords" content="'. $this->keywords .'" />';
	}

	protected function renderDescriptionMetaTag()
	{
		if (empty($this->description))
		{
			return '';
		}

		return '<meta name="description" content="'. $this->description .'" />';
	}

	protected function renderFaviconLink()
	{
		if (empty($this->faviconAssetPath))
		{
			return '';
		}

		$faviconURL = $this->asset->get($this->faviconAssetPath);
		return '<link rel="shortcut icon" href="'.$faviconURL.'" type="image/x-icon">
		<link rel="icon" href="'.$faviconURL.'" type="image/x-icon">';
	}

	protected function renderCssLinks($mobile = FALSE)
	{
		if ($mobile)
		{
			$defaultCssAsset = $this->defaultMobileCssAssetPath;
		}
		else
		{
			$defaultCssAsset = $this->defaultCssAssetPath;
		}

		$cssLinks = '';
		$cssAssetPaths = $defaultCssAsset;

		foreach ($this->cssAssetPaths as $css)
		{
			$cssAssetPaths = array_merge($cssAssetPaths, $css);
		}

		foreach ($cssAssetPaths as $assetPath => $media)
		{
			if (empty($assetPath))
			{
				continue;
			}

			$cssUrl = $this->asset->get($assetPath);
			$cssLinks .= '<link rel="stylesheet" href="'. $cssUrl .'" type="text/css" media="'.$media.'" />
			';


		}

		return $cssLinks;
	}

	protected function renderJsLinks()
	{
		$jsLinks = '<script type="text/javascript">var $baseUrl = "'.$this->urlBuilder->getBaseUrl().'";</script>';

		$jsAssetPaths = $this->defaultJSAssetPath;

		if(count($this->jsAssetPaths) > 0)
		{
			foreach($this->jsAssetPaths as $js)
			{
				$jsAssetPaths = array_merge($jsAssetPaths, $js);
			}
		}

		foreach($jsAssetPaths as $assetPath => $link)
		{
			if(empty($assetPath))
			{
				continue;
			}

			if($link == TRUE)
			{
				$jsLinks .= '<script type="text/javascript" src="'.$assetPath.'"></script>
							';
			}
			else
			{
				$jsUrl = $this->asset->get($assetPath);
				$jsLinks .= '<script type="text/javascript" src="'.$jsUrl.'"></script>
							';

			}
		}
		return $jsLinks;
	}

	public function addJsVariable($varName, $value)
	{
		$this->jsVariables[$varName] = $value;
	}

	protected function renderJsVariables()
	{
		$jsVars = '';

		if (count($this->jsVariables) > 0)
		{
			$jsVars .= '<script type="text/javascript">';
		}
		foreach ($this->jsVariables as $varName => $value)
		{
			if (is_int($value))
			{
				$jsVars .= 'window.'. $varName .' = '. $value .';';
			}
			else if (is_string($value))
			{
				$value = preg_replace('/\\\'/', '\\\'', $value);
				$jsVars .= 'window.'. $varName .' = \''. $value .'\''. ';';
			}
		}
		if (count($this->jsVariables) > 0)
		{
			$jsVars .= '</script>';
		}

		return $jsVars;
	}

	public function addJsCustomCode($code)
	{
		$this->jsCustomCode[] = $code;
	}

	public function renderJsCustomCode(	)
	{
		$code = '<script type="text/javascript">
		            $(function(){';
		$code .= ' $(\'[data-toggle="tooltip"]\').tooltip(); ';
		if (count($this->jsCustomCode) > 0)
		{
			foreach ($this->jsCustomCode as $jsCode)
			{
				$code .= $jsCode;
			}
		}


		$code .= 'sessionMessage();';
		$code .= '});</script>';

		return $code;
	}

	public function addJsBannedCode()
	{
		$this->jsCustomCode[] =
			'';
	}


	public function addJsDeleteCode()
	{
		$this->jsCustomCode[] = '
		        $(".del").click(function(){
		            yakin = confirm($(this).attr("data-text"));
		            if (yakin)
		            {
		                value = $(this).attr("data-value");
		                target = $(this);
		                $.ajax({
		                    type:"POST",
		                    data:"value=" + value,
		                	dataType:"html",
		                	url:$(this).attr("data-url"),

		                    success: function(msg){
		                       $json = $.parseJSON(msg);

		                        toastr.options = {
									"closeButton": false,
									"debug": false,
									"onclick": null,
									"positionClass": "toast-top-full-width",
									"showDuration": "1000",
									"hideDuration": "1000",
									"timeOut": "5000",
									"extendedTimeOut": "1000",
									"showEasing": "swing",
									"hideEasing": "swing",
									"showMethod": "slideDown",
									"hideMethod": "slideUp"
				                }

		                        if ($json.status == "TRUE") {
		                            target.parent().parent().parent().hide("slow");
		                        	toastr.success($json.message);
		                        }
		                        else {
		                        	toastr.error($json.message);
		                        }
		                    }
		                });
		            }
		        });';
	}
}
?>