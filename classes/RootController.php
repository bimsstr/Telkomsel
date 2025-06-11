<?php

use Http\Request,
    Http\Session,
    Http\Cookie,
    Driver\MySQLi,
    Utilities\UrlBuilder,
    Utilities\Asset,
    Presentation\Pagination,
    Presentation\HtmlHeaderFooter,
    Presentation\Breadcrumb,
    Presentation\MenuBarRenderer,
    Utilities\Convert,
    Lang\IndonesiaLang;

class RootController extends CI_Controller
{
    protected $user = 'u5540864_jogja';
    protected $pass = 'Indihome12345';
    protected $db = 'u5540864_indihome_jogja';


    protected $key = 'MTvl';
    protected $assetName = 'asset';
    protected $fileExternal = 'bucket';
    protected $keyCookie = 'MT02';
    protected $keyAdminUrl = '';
    protected $urlBuilder;
    protected $request;
    protected $session;
    protected $cookie;
    protected $asset;
    protected $admin = NULL;
    protected $htmlHeaderFooter;
    protected $pagination;
    protected $mysqli;
    protected $mysqliCabang;
    protected $mysqliAgent;
    protected $maxDataPerPage = 20;
    protected $lang;
    protected $breadcrumb;
    protected $menuBarRenderer;
	protected $perusahaanSetting;

    /*VIEW VARIABLE*/
    protected $viewVariable;
    protected $htmlHeader;
    protected $htmlFooter;
    protected $breadcrumbArray;
    protected $headerBar;
    protected $footerBar;
    protected $menuBar;
    protected $validationErrorsRenderer;
    protected $privilege;
    protected $convert;

    public function __construct()
    {
        parent::__construct();
        $this->breadcrumb = new Breadcrumb();
        $this->convert = new Convert();
        $this->initializeRequest();
        $this->initializeUrlBuilder();
        $this->initializeAsset();
        $this->initializeDefaultTimezone();
        $this->initializeSession();
        $this->initializeCookie();
        $this->initializeMySQLi();
        $this->initializeLang();
    	$this->initializeMenuBarRenderer();
    	$this->initializeHtmlHeaderFooter();
        $this->initializeHeaderFooterBar();

        $this->initialize();
    }

    protected function initialize()
    {

    }

    protected function initializeUrlBuilder()
{
    $this->urlBuilder = new UrlBuilder(
        base_url(),             // $baseURL
        $this->keyAdminUrl,     // $keyAdminUrl
        $this->fileExternal,    // $fileExternal
        $this->request->getGet(), // $paramGet
        'indihomefiberjogja.com' // $publicUrl - GANTI DENGAN NILAI SEBENARNYA
    );
}

    protected function initializeAsset()
    {
        $this->asset = new Asset(
            $this->urlBuilder,
            $this->assetName,
            $this->fileExternal,
            $this->keyAdminUrl
        );
    }

    protected function initializeRequest()
    {
        $this->request = Request::createFromSuperglobals();
    }

    protected function initializePagination($itemPerPage, $sumData, $currentPage, $path, $queryData, $urlBuilder, $paramGet = 'page', $space=2)
    {
        $this->pagination = new Pagination($itemPerPage, $sumData, $currentPage, $path, $queryData, $urlBuilder, $paramGet, $space);
    }

    protected function initializeCookie()
    {
        $this->cookie = new Cookie;
    }

    protected function initializeSession()
    {
        $this->session = new Session;
        $this->session->start();
    }

    protected function initializeMySQLi()
    {
    	$this->mysqli = new MySQLi(
    	    'localhost',
    	    $this->user,
    	    $this->pass,
    	    $this->db
   		);
    }

    protected function initializeDefaultTimezone()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    protected function initializeHtmlHeaderFooter()
    {
        $this->htmlHeaderFooter = new HtmlHeaderFooter(
            $this->asset,
            array(
				'lib/font-awesome/css/font-awesome.min.css' => 'screen',
                'css/popup.css' => 'screen',
                'css/themify-icons.css' => 'screen',
                'fonts/gicon.css' => 'screen',
                'css/bootstrap.min.css' => 'screen',
                'css/magnific-popup.css' => 'screen',
                'css/animate.min.css' => 'screen',
                'css/jquery.mb.YTPlayer.min.css' => 'screen',
                'css/owl.carousel.min.css' => 'screen',
                'css/owl.theme.default.min.css' => 'screen',
                'css/style.css' => 'screen',
                'css/responsive.css' => 'screen',
                'lib/toastr2/build/toastr.css' => 'screen'
            ),
            array(),
            array(
                'js/jquery-3.4.1.min.js' => FALSE,
                'lib/toastr2/build/toastr.min.js' => FALSE,
                'js/popper.min.js' => FALSE,
                'js/bootstrap.min.js' => FALSE,
                'js/jquery.magnific-popup.min.js' => FALSE,
                'js/jquery.easing.min.js' => FALSE,
                'js/jquery.mb.YTPlayer.min.js' => FALSE,
                'js/wow.min.js' => FALSE,
                'js/owl.carousel.min.js' => FALSE,
                'js/jquery.countdown.min.js' => FALSE,
                'js/scripts.js' => FALSE,

            ),
            $this->session,
            'images/new_indihome/indihome.png',
        	$this->urlBuilder
        );
    }

    protected function redirect($url, $query = '', $withDefaultParamGet = TRUE)
    {
        redirect($this->urlBuilder->build($url, $query, $withDefaultParamGet));
        return;
    }

    public function initializeLang()
    {
        $lang = $this->cookie->getCookie('lang'.$this->keyCookie);

        switch ($lang)
        {
            default:
                $this->lang = new IndonesiaLang($this->urlBuilder);
        } // switch
    }

    public function initializeMenuBarRenderer()
    {
		$this->menuBarRenderer = new MenuBarRenderer($this->urlBuilder, $this->asset, $this->session, $this->mysqli, $this->agentPublicUrl, $this->perusahaan, $this->perusahaanSetting);
    }

    private function initializeHeaderFooterBar()
    {
        //$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
        $this->footerBar = $this->menuBarRenderer->renderFooterBar();
    }

	public function checkPrivilege($privilege = 0)
	{
		if ($this->admin instanceof AdminDomain)
		{
			$requiredAdminStatus = array_keys($this->requiredAdminStatus);

			return $this->convert->convertBinerToArray($this->admin->getPrivilegeArrayByKey($requiredAdminStatus[$privilege]));
		}
	}

    public function overideViewVariable(array $viewVariableArray = array())
    {
        $this->viewVariable = array(
            'urlBuilder' => $this->urlBuilder,
            'asset' => $this->asset,
            'htmlHeader' => $this->htmlHeader,
            'htmlFooter' => $this->htmlFooter,
            'headerBar' => $this->headerBar,
            'footerBar' => $this->footerBar,
            'menuBar' => $this->menuBar,
            'convert' => $this->convert,
			'perusahaan' => $this->perusahaan,
			'perusahaanSetting' => $this->perusahaanSetting,
            'breadcrumb' => $this->breadcrumb->renderBreadcrumb($this->breadcrumbArray),
            'validationErrorsRenderer' => $this->validationErrorsRenderer,
            'messageSession' => $this->menuBarRenderer->renderSessionMessage(),
        	'privilege' => $this->checkPrivilege(),
            'getParam' => $this->convert->convertToGetUrl($this->request->getGet())
        );

        foreach ($viewVariableArray as $key => $value)
        {
            $this->viewVariable[$key] = $value;
        }
    }
}
?>
