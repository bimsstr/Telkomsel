<?php

use Http\Request,
Http\Session,
Http\Cookie,
DataSource\AdminDataSource,
Domain\AuthenticatorAdminDomain,
Domain\AdminDomain,
Driver\MySQLi,
Utilities\UrlBuilder,
Utilities\Asset,
Presentation\Pagination,
Presentation\AdminHtmlHeaderFooter,
Presentation\Breadcrumb,
Presentation\AdminMenuBarRenderer,
Utilities\Convert,
Lang\EnglishLang;

class AdminController extends CI_Controller
{
    protected $user = 'u5540864_jogja';
    protected $pass = 'Indihome12345';
    protected $db = 'u5540864_indihome_jogja';
    
    protected $key = '11';
    protected $fileExternal = 'bucket';
    protected $keyAdminUrl = 'guest';

    protected $keyCookie = '22';
    protected $assetName = 'asset';
    protected $urlBuilder;
    protected $request;
    protected $session;
    protected $cookie;
    protected $authenticatorDomain;
    protected $adminDataSource;

    protected $asset;
    protected $adminDomain = NULL;
    protected $requiredAdminStatus = NULL;
    protected $htmlHeaderFooter;
    protected $pagination;
    protected $mysqli;
    protected $maxDataPerPage = 20;
    protected $lang;
    protected $breadcrumb;
    protected $menuBarRenderer;


    
    /*VIEW VARIABLE*/
    protected $viewVariable;
    protected $htmlHeader;
    protected $htmlFooter;
    // protected $breadcrumbArray;
    protected $headerBar;
    protected $footerBar;
    protected $sideBar;
    protected $validationErrorsRenderer;
    protected $privilege;
    protected $convert;
    protected $breadcrumbArray = array();

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
        $this->initializeAuthenticatorDomain();
        $this->initializeAdminDataSource();
        $this->initializeCurrentlyLoggedInAdmin();
        $this->validateRequiredAdminStatus();
        $this->initializeHtmlHeaderFooter();
        $this->initializeMenuBarRenderer();
        $this->initializeHeaderFooterBar();

        $this->initialize();

    }

    protected function initialize()
    {

    }

    protected function initializeUrlBuilder()
    {
        $this->urlBuilder = new UrlBuilder(base_url(), $this->keyAdminUrl, $this->fileExternal, $this->request->getGet(), base_url() );
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

    protected function initializeAuthenticatorDomain()
    {
        $this->authenticatorDomain = new AuthenticatorAdminDomain(
            $this->session,
            $this->cookie,
            $this->request,
            $this->key
        );
    }

    protected function initializeAdminDataSource()
    {
        $this->adminDataSource = new AdminDataSource($this->mysqli);
    }

   protected function initializeCurrentlyLoggedInAdmin()
{
    $currentAdminId = $this->authenticatorDomain->getCurrentlyLoggedById();
    // Hapus baris DEBUG ini: echo "Current Admin ID: "; var_dump($currentAdminId); echo "<br>";

    if ($currentAdminId === FALSE)
    {
        // Hapus baris DEBUG ini: echo "Admin ID is FALSE, returning.<br>";
        return;
    }

    $adminDomain = $this->adminDataSource->getAdminDomainById($currentAdminId);
    // Hapus baris DEBUG ini: echo "Admin Domain Object: "; var_dump($adminDomain); echo "<br>";

    if ($adminDomain instanceof AdminDomain)
    {
        $this->adminDomain = $adminDomain;
        // Hapus baris DEBUG ini: echo "Admin Domain successfully set.<br>";
    } else {
        // Hapus baris DEBUG ini: echo "Admin Domain is NOT an instance of AdminDomain.<br>";
    }
}
     protected function validateRequiredAdminStatus()
    {
        if ($this->requiredAdminStatus === TRUE) // Ini mungkin kasus khusus yang tidak didefinisikan secara eksplisit di subclass
        {
            return;
        }

        if ($this->requiredAdminStatus == 'NotLoggedIn')
        {
            if ($this->adminDomain instanceof AdminDomain) // Jika sudah login, tapi statusnya NotLoggedIn (misal di halaman login)
            {
                $sessionAdminMessage['type'] = 'warning';
                $sessionAdminMessage['message'] = $this->lang->getNotLoggedInErrorMessage(); // "Anda sudah login."
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                // Redirect ke dashboard jika sudah login dan mencoba akses halaman NotLoggedIn (misal: halaman login)
                // Mengambil username untuk redirect dinamis seperti yang Anda inginkan
                if ($this->adminDomain && $this->adminDomain instanceof AdminDomain) {
                    $this->redirect($this->adminDomain->getUsername()); // Redirect ke /username
                } else {
                    $this->redirect('dashboard'); // Fallback jika username tidak terdefinisi
                }
                return;
            }
            return; // Jika belum login, dan statusnya NotLoggedIn (biarkan user di halaman login)
        }

        if ($this->requiredAdminStatus == 'LoggedIn') // Jika harus login (misal: di dashboard)
        {
            if (!($this->adminDomain instanceof AdminDomain)) // Jika belum login
            {
                $sessionAdminMessage['type'] = 'warning';
                $sessionAdminMessage['message'] = $this->lang->getLoggedInErrorMessage(); // "Anda perlu login."
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('login'); // Redirect ke halaman login
                return;
            }
            return; // Jika sudah login, biarkan berlanjut
        }

//         // privilege default
//     if ($this->adminDomain instanceof AdminDomain)
//     {
//         if ($this->requiredAdminStatus == NULL) {
//             return;
//         }
//         foreach ($this->requiredAdminStatus as $kategori => $access)
//         {
//             $adminPrivilegeArray = $this->adminDomain->getPrivilegeArray();
//             if (array_key_exists($kategori, $adminPrivilegeArray))
//             {
//                 if ($access === array())
//                 {
//                     return;
//                 }

//                 $privilegeArray = $this->convert->convertBinerToArray($adminPrivilegeArray[$kategori]);
//                 foreach ($privilegeArray as $privilege)
//                 {
//                     if (in_array($privilege, $access))
//                     {
//                         return;
//                     }
//                 }
//             }
//         }
//         $sessionAdminMessage['type'] = 'warning';
//         $sessionAdminMessage['message'] = $this->lang->getHasNoPermissionErrorMessage();
//         $this->session->set('sessionAdminMessage', $sessionAdminMessage);

//         if ($this->adminDomain->getPrivilegeGroup() == 'Administrator') {
//           $this->redirect('dashboard');
//       }
//       else {
//           $this->redirect('incoming');
//       }
//   }


        // default
  $sessionAdminMessage['type'] = 'warning';
  $sessionAdminMessage['message'] = $this->lang->getLoggedInErrorMessage();
  $this->session->set('sessionAdminMessage', $sessionAdminMessage);

  $this->redirect('login');
  return;
}

protected function initializeHtmlHeaderFooter()
{
    $this->htmlHeaderFooter = new AdminHtmlHeaderFooter(
        $this->asset,
        array(
                // 'css/bootstrap.min.css' => '',
                // 'plugins/font-awesome/css/font-awesome.min.css' => '',
                // 'css/style.css' => '',
                // 'css/style-responsive.css' => '',
                // 'plugins/bootstrap-toastr/toastr.min.css' => 'screen'
                // 'css/bootstrap.min.css' => 'screen',
                // 'css/form.min.css' => 'screen',
                // 'css/style-responsive.css' => 'screen',
                // 'css/style.css' => 'screen',
                'css/app.min.css' => 'screen',
                'css/style_my.css' => 'screen',
                'css/styles/all-themes.css' => 'screen',
                'css/extra-pages.css' => 'screen',
                'plugins/toastr2/build/toastr.css' => 'screen'
        ),
        array(),
        array(
                'js/jquery.min.js' => FALSE,
                'js/table.min.js' => FALSE,
                'plugins/toastr2/build/toastr.min.js' => FALSE,
                'js/bootstrap.min.js' => FALSE,
                'plugins/retina/retina.min.js' => FALSE,
                'plugins/nicescroll/jquery.nicescroll.js' => FALSE,
                'plugins/slimscroll/jquery.slimscroll.min.js' => FALSE,
                'plugins/backstretch/jquery.backstretch.min.js' => FALSE,
                'js/pages/index.js' => FALSE,
                'js/app.min.js' => FALSE,
                'js/chart.min.js' => FALSE,
                'js/bundles/apexcharts/apexcharts.min.js' => FALSE,
                'js/login-register.js' => FALSE,
                'js/apps.js' => FALSE,               
                // 'plugins/retina/retina.min.js' => FALSE,
                // 'plugins/nicescroll/jquery.nicescroll.js' => FALSE,
                // 'plugins/backstretch/jquery.backstretch.min.js' => FALSE,
                // 'plugins/bootstrap-toastr/toastr.min.js' => FALSE,
                // 'js/apps.js' => FALSE,
        ),
        $this->session,
        'img/indihome.png',
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
        $this->lang = new EnglishLang($this->urlBuilder);
        } // switch
    }

    public function initializeMenuBarRenderer()
    {
        if ($this->adminDomain instanceof Domain\AdminDomain) {
        $this->menuBarRenderer = new AdminMenuBarRenderer
        (
         $this->urlBuilder,
         $this->adminDomain,
         $this->asset,
         $this->session,
         $this->lang
     );
    } else  {
        // Handle kasus jika tidak ada admin yang login
        $this->menuBarRenderer = null; // Atau nilai default lainnya
     }
    }

    private function initializeHeaderFooterBar()
{
    if ($this->menuBarRenderer instanceof AdminMenuBarRenderer) {
        $this->footerBar = $this->menuBarRenderer->renderFooterBar();
    } else {
        // Handle kasus jika $this->menuBarRenderer adalah null
        $this->footerBar = ''; // Atau nilai default lainnya
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
            'sideBar' => $this->sideBar,
            'convert' => $this->convert,
            'breadcrumb' => $this->breadcrumb->renderAdminBreadcrumb($this->breadcrumbArray),
            'validationErrorsRenderer' => $this->validationErrorsRenderer,
            // 'messageSession' => $this->menuBarRenderer->renderSessionMessage(),
            'messageSession' => ($this->menuBarRenderer instanceof AdminMenuBarRenderer) ? $this->menuBarRenderer->renderSessionMessage() : '', // Tambahkan pemeriksaan null
            'getParam' => $this->convert->convertToGetUrl($this->request->getGet())
        );

        foreach ($viewVariableArray as $key => $value)
        {
            $this->viewVariable[$key] = $value;
        }
    }
}
?>
