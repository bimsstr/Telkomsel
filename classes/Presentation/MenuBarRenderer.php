<?php

namespace Presentation;

use DateTime,
    DataSource\HomeContactDataSource,
    DataSource\HomeSKDataSource,
    DataSource\BankDataSource,
    Domain\HomeContactDomain,
    Domain\HomeSKDomain,
    Domain\BankDomain,
    Utilities\UrlBuilder,
    Utilities\Convert,
    Utilities\Asset;

class MenuBarRenderer extends RootPresentation
{
    protected $urlBuilder;
    private $asset;
    private $convert;
    private $session;
	private $mysqli;

    public function __construct(
        UrlBuilder $urlBuilder,
        Asset $asset,
        $session,
        $mysqli
    )
    {
        $this->urlBuilder = $urlBuilder;
        $this->asset = $asset;
        $this->session = $session;
        $this->convert = new Convert();
    	$this->mysqli = $mysqli;
	}

	private function wordLimiter($str, $limit = 100, $end_char = '&#8230;')
	{
		if (trim($str) == '')
		{
			return $str;
		}

		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

		if (strlen($str) == strlen($matches[0]))
		{
			$end_char = '';
		}

		return rtrim($matches[0]).$end_char;
	}

    public function renderHeaderBar($page)
    {
        $this->homeskDataSource = New HomeSKDataSource($this->mysqli);
        $homeskdetailDomainArray = $this->homeskDataSource->getAllHomeSKDetailDomain();

        if (count($homeskdetailDomainArray) == 0){
            $syaratketentuan .='<p>tidak ada data</p>';
        }

    	$html .= '


    <!-- =========== Preloader Start ============ --><!--
    <div class="preloader-main">
        <div class="preloader-wapper">
            <svg class="preloader" xmlns="http://www.w3.org/2000/svg" version="1.1" width="600" height="200">
                <defs>
                    <filter id="goo" x="-40%" y="-40%" height="200%" width="400%">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -8" result="goo" />
                    </filter>
                </defs>
                <g filter="url(#goo)">
                    <circle class="dot bg-fill-primary " cx="50" cy="50" r="25" />
                    <circle class="dot" cx="50" cy="50" r="25" fill="#4c83ff" />
                </g>
            </svg>
            <div>
                <div class="loader-section section-left"></div>
                <div class="loader-section section-right"></div>
            </div>
        </div>
    </div>-->
    <!-- =========== Preloader End ============ -->

    <div class="main">

        <!-- =========== Start of Navigation (main menu) ============ -->
 <header class="header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg fixed-top bg-transparent color-primary">
        <div class="container">
            <a class="navbar-brand" href="'.$this->urlBuilder->build('home').'"><img src="'.$this->asset->get('images/new_indihome/indihome_logo_white.png').'" width="120px" alt="logo" class="img-fluid"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span style="color: white;"class="fa fa-align-justify"></span>
            </button>

            <div class="collapse navbar-collapse main-menu" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="'.$this->urlBuilder->build('home').'">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#about">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link page-scroll dropdown-toggle" href="#" id="navbarDropdownHome" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pricing
                        </a>
                        <div class="dropdown-menu submenu" aria-labelledby="navbarDropdownHome">
                        <!-- HIDE DEPRECATED MENU -->
                        <!--<a class="dropdown-item" href="'.$this->urlBuilder->build('indihome-streamix').'">Streamix</a>
                            <a class="dropdown-item" href="'.$this->urlBuilder->build('indihome-phoenix').'">Phoenix</a>
                            <a class="dropdown-item" href="'.$this->urlBuilder->build('indihome-value').'">Indihome Value</a>
                            <a class="dropdown-item" href="'.$this->urlBuilder->build('indihome-fit').'">Indihome Fit</a>
                            <a class="dropdown-item" href="'.$this->urlBuilder->build('indihome-prestige').'">Indihome Prestige</a>
                            <a class="dropdown-item" href="'.$this->urlBuilder->build('indihome-for-bumn').'">Indihome For BUMN</a>-->
                            <a class="dropdown-item" href="'.$this->urlBuilder->build('indihome-2P').'">Indihome 2P</a>
                            <a class="dropdown-item" href="'.$this->urlBuilder->build('indihome-3P').'">Indihome 3P</a>
                            <a class="dropdown-item" href="'.$this->urlBuilder->build('indihome-BB').'">Indihome Belajar & Bermain</a>
                            <a class="dropdown-item" href="'.$this->urlBuilder->build('indihome-SBR').'">SBR Indihome StaySafe</a>
                            <a class="dropdown-item" href="'.$this->urlBuilder->build('indihome-prepaid').'">Indihome Prepaid</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="'.$this->urlBuilder->build('sales').'">Sales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="https://www.indihome.co.id/addon" target="_blank">Add On</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="https://www.indihome.co.id/useetv" target="_blank">Usee TV</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--end navbar-->
</header>
        <!-- =========== End of Navigation (main menu)  ============ -->';

    	return $html;
    }

    public function renderFooterBar()
    {
        $this->homecontactDataSource = New HomeContactDataSource($this->mysqli);
        $homecontactDomainArray = $this->homecontactDataSource->getAllHomeContactDomain();

        $now = new DateTime();
        $fb_base_url .= 'https://www.facebook.com/';
        $ig_base_url .= 'https://www.instagram.com/';
        $twitter_base_url .= 'https://www.twitter.com/';
        $fb_html = '';
        $ig_html = '';
        $twitter_html = '';

        if (count($homecontactDomainArray) == 0){
            $company_image .='<p>tidak ada data</p>';
            $company_description .='<p>tidak ada data</p>';
            $company_address .='<p>tidak ada data</p>';
            $company_telephone .='<p>tidak ada data</p>';
        }

        foreach($homecontactDomainArray as $homecontactDomain) {
            $company_image .='
                <span class="mb-20">
                    <a href="#">
                        <img src="'.$this->asset->get('images/logo/'.$homecontactDomain->getLogo()).'"  alt="logo">
                    </a>
                </span>';

            $company_description .='<p>'.$homecontactDomain->getDescription().'</p>';
            $company_address .='<p>'.$homecontactDomain->getAddress().'</p>';
            $company_telephone .=''.$homecontactDomain->getTelephone().'';
            $company_email .=''.$homecontactDomain->getEmail().'';
            $company_facebook_url .=''.$homecontactDomain->getFbUrl().'';
            $company_instagram_url .=''.$homecontactDomain->getIgUrl().'';
            $company_twitter_url .=''.$homecontactDomain->getTwitterUrl().'';

            if($homecontactDomain->getFbStatus() == 'active'){
                $fb_html .= '<li class="list-inline-item"><a href="'.$fb_base_url.''.$company_facebook_url.'"><span class="fa fa-facebook"></span></a></li>';
            }
            if($homecontactDomain->getIgStatus() == 'active'){
                $ig_html .= '<li class="list-inline-item"><a href="'.$ig_base_url.''.$company_instagram_url.'"><span class="fa fa-instagram"></span></a></li>';
            }
            if($homecontactDomain->getTwitterStatus() == 'active'){
                $twitter_html .= '<li class="list-inline-item"><a href="'.$twitter_base_url.''.$company_twitter_url.'"><span class="fa fa-twitter"></span></a></li>';
            }


        }

    	$html .= '
		<!--footer section start-->
        <footer class="footer-section" style="background-color : #E73328;">
            <!--footer top start-->
                <div class="footer-top pt-150 pb-5 background-img-2" style="background-image: url("asset/images/footer-bg.png") no-repeat center top / cover">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-3 ml-auto mb-4 mb-lg-0">
                    <div class="footer-nav-wrap text-white">
                        '.$company_image.''.$company_description.'
                        <div class="social-list-wrap">
                            <ul class="social-list list-inline list-unstyled">
                                '.$fb_html.'
                                '.$ig_html.'
                                '.$twitter_html.'
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 ml-auto mb-4 mb-lg-0">
                    <div class="footer-nav-wrap text-white">
                        <h5 class="mb-3 text-white">Tentang Kami</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="'.$this->urlBuilder->build('profil-kami').'">Profil Kami</a></li>
                            <li class="mb-2"><a href="'.$this->urlBuilder->build('syarat-ketentuan').'">Syarat dan Ketentuan</a></li>
                            <li class="mb-2"><a href="'.$this->urlBuilder->build('kebijakan-privasi').'">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                </div>
                 <div class="col-lg-3 ml-auto mb-4 mb-lg-0">
                    <div class="footer-nav-wrap text-white">
                        <h5 class="mb-3 text-white">Informasi</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="'.$this->urlBuilder->build('paket-indihome-jogja').'">Paket Indihome</a></li>
                            <li class="mb-2"><a href="https://www.indihome.co.id/pusat-bantuan" target="_blank">Tanya Jawab</a></li>
                            <li class="mb-2"><a href="'.$this->urlBuilder->build('sales').'">Tim Sales Kami</a>
                    </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 ml-auto mb-4 mb-lg-0">
                    <div class="footer-nav-wrap text-white">
                        <h5 class="mb-3 text-white">Hubungi Kami</h5>
                        <ul class="list-unstyled support-list">
                            <li class="mb-2 d-flex align-items-center"><span class="fa fa-address"></span>
                                '.$company_address.'
                            </li>
                        </ul>
                        <br>
                        <br>
                        <ul class="list-unstyled support-list">
                            <li class="mb-2 d-flex align-items-center"><span class="fa fa-address"></span>
                                Provided By:
                            </li>
                                    <img src="'.$this->asset->get('images/new_indihome/telkom_ver_white.png').'"  alt="logotelkom">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--footer top end-->

    <!--footer copyright start-->
    <div class="footer-bottom gray-light-bg pt-4 pb-4">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-md-6 col-lg-7"><p class="copyright-text pb-0 mb-0">Copyright © 2020 PT Telekomunikasi Indonesia (Persero) Tbk All Right Reserved.
                </div>
            </div>
        </div>
    </div>
    <!--footer copyright end-->
</footer>';

		return $html;
    }

	public function renderMenuBar($active = '')
	{

	}

    public function renderSessionMessage()
    {
        $sessionMessage = $this->session->get('sessionMessage');
        $this->session->remove('sessionMessage');
        if ($sessionMessage == NULL)
        {
            return '<script type="text/javascript">function sessionMessage(){}; </script>';
        }

        $data = '<script type="text/javascript">
            function sessionMessage(){
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-full-width",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "1000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                toastr.'.$sessionMessage['type'].'("'.$sessionMessage['message'].'", "'.$sessionMessage['title'].'")
            }
        </script>';

        return $data;
    }
}

?>