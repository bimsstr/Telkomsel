<?php

namespace Presentation;

use Http\Session,
    Utilities\Asset;

class HtmlHeaderFooter extends RootPresentation
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
    protected $jsVariables = array();
    protected $jsCustomCode = array();

    private $session;
	private $urlBuilder;
    private $adminNotifDelaySetting;

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

    public function renderHtmlHeader($title = 'IndiHome Jogja | Internet Indonesia | Internet Cepat | Internet Rumah ', $class = '', $robots = 'index,follow')
    {
        $title = $this->clean($title);
        $keywords = $this->renderKeywordsMetaTag();
        $description = $this->renderDescriptionMetaTag();
        $faviconLink = $this->renderFaviconLink();
        $cssLinks = $this->renderCssLinks();
        $html = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
		<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
		<!--[if !IE]><!-->
		
        <html lang="id" xml:lang="id" xmlns="http://www.w3.org/1999/xhtml" class="">
		<head>
			<meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
			<meta name="robots" content="'.$robots.'" />
			<title>'. $title .'</title>
			'. $keywords .'
			'. $description .'
			<link rel="alternate" hreflang="id" href="alternateURL">
			'. $faviconLink .'
			'. $cssLinks .'

            <link href="fonts/aileron.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,400i" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Alice" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Monda&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700%7COpen+Sans&amp;display=swap" rel="stylesheet">
		</head>
		<body class="theme-red" data-spy="scroll" data-target="#navbar-nav">';

        return $html;
    }

    public function renderHtmlFooter()
    {
        $jsLinks = $this->renderJsLinks();
        $jsVariables = $this->renderJsVariables();
        $jsCustomCode = $this->renderJsCustomCode();
        $html =
			$jsLinks .'
            '. $jsVariables .'
            '. $jsCustomCode .'
			</body>
			</html>';

        return $html;
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
        return '
			<link rel="shortcut icon" href="'.$faviconURL.'" type="image/x-icon">
			<link rel="icon" href="'.$faviconURL.'" type="image/x-icon">';
    }

    protected function renderCssLinks()
    {
        $defaultCssAsset = $this->defaultCssAssetPath;

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

            $cssLinks .= '
            <link rel="stylesheet" href="'. $cssUrl .'" type="text/css" media="'.$media.'" />';
        }

    	$cssLinks .= '
			<!--[if IE]>
				<link rel="stylesheet" href="'.$this->asset->get('css/ie.css').'">
			<![endif]-->

			<!--[if lte IE 8]>
				<script src="'.$this->asset->get('vendor/respond/respond.js').'"></script>
				<script src="'.$this->asset->get('vendor/excanvas/excanvas.js').'"></script>
			<![endif]-->';

        return $cssLinks;
    }

    protected function renderCssLinksWithoutDefault()
    {
        $cssLinks = '';
        $cssAssetPaths = array();

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

            $cssLinks .= '<link rel="stylesheet" href="'. $cssUrl .'" type="text/css" media="'.$media.'" />';
        }

        return $cssLinks;
    }

    protected function renderJsLinks()
    {
        $jsLinks = '';
        $jsAssetPaths = $this->defaultJSAssetPath;

        if (count($this->jsAssetPaths) > 0)
        {
            foreach ($this->jsAssetPaths as $js)
            {
                $jsAssetPaths = array_merge($jsAssetPaths, $js);
            }
        }
        foreach ($jsAssetPaths as $assetPath => $link)
        {
            if (empty($assetPath))
            {
                continue;
            }

            if ($link == TRUE)
            {
                $jsLinks .= '
				<script type="text/javascript" src="'. $assetPath .'"></script>';
            }
            else
            {
                $jsUrl = $this->asset->get($assetPath);
                $jsLinks .= '
				<script type="text/javascript" src="'. $jsUrl .'"></script>';
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

    public function renderJsCustomCode()
    {
    	$code .= '
		<script type="text/javascript">
			$(function(){';
        if (count($this->jsCustomCode) > 0)
        {
            foreach ($this->jsCustomCode as $jsCode)
            {
                $code .= $jsCode;
            }
        }

		$code .= '
			$("#openwhatsapp").click(function(e){
				e.preventDefault();
				$(".whatsapp-box").toggleClass("whatsapp-show");
				$(this).toggleClass("whatsapp-box-aktif");
				$("#scrollUp").toggleClass("add-bottom");
			});';

		//zopim
		$code .= '';

		//google_analytic
		$code .= '';

    	$code .= '
				sessionMessage();
			});
		</script>';

        return $code;
    }

    public function addJsDeleteCode()
	{
		$this->jsCustomCode[] = '
		$(".del").click(function(){
			yakin = confirm($(this).attr("data-text"));
			if (yakin){
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
							"closeButton": true,
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
							target.parent().parent().parent().parent().parent().hide("slow");
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