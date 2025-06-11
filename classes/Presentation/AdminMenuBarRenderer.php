<?php

namespace Presentation;

use DateTime,
	Utilities\UrlBuilder,
	Domain\AdminDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\Convert,
	Utilities\Asset,
    DataSource\AdminDataSource;

class AdminMenuBarRenderer extends RootPresentation
{
	protected $urlBuilder;
	private $agentDomain;
	private $asset;
	private $convert;
	private $session;

	public function __construct(
		UrlBuilder $urlBuilder,
		AdminDomain $adminDomain,
		Asset $asset,
		$session,
		$lang
	)
	{
		$this->adminDomain = $adminDomain;
		$this->urlBuilder = $urlBuilder;
		$this->asset = $asset;
		$this->session = $session;
		$this->convert = new Convert();
	}

	public function renderHeaderBar($active = "")
	{

		$html = '
        <!-- Start Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30">
                    <img class="loading-img-spin" src="'.$this->asset->get('img/indihome.png').'" alt="admin">
                </div>
                    <p>Sabar Bro .. Lagi Loading :)</p>
            </div>
        </div>
        <!-- End Page Loader -->
        <!-- Overlay For Sidebars -->
            <div class="overlay"></div>
        <!-- End Overlay For Sidebars -->
        
    	<!-- Top Bar -->
    	<nav class="navbar">
	        <div class="container-fluid">
            	<div class="navbar-header">
	                <a href="#" onClick="return false;" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false"></a>
                	<a href="#" onClick="return false;" class="bars"></a>
                	<a class="navbar-brand" href="'.$this->urlBuilder->build('dashboard').'">
                    <img style ="width:70%" src="'.$this->asset->get('img/indihome_logo_color_medium.png').'" alt="" />
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="#" onClick="return false;" class="sidemenu-collapse">
                            <i data-feather="align-justify"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Full Screen Button -->
                    <li class="fullscreen">
                        <a href="javascript:;" class="fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                    <!-- #END# Full Screen Button -->
                    <li class="dropdown user_profile">
                        <div class="chip dropdown-toggle" data-toggle="dropdown">
                            <img src="'.$this->asset->getAssetForAdmin('images/profile/'.$this->adminDomain->getImage().'').'">
                            '.$this->adminDomain->getFullname().'
                        </div>
                        <ul class="dropdown-menu pullDown">
                            <li class="body">
                                <ul class="user_dw_menu">
                                    <li>
                                        <a href="'.$this->urlBuilder->build('profile').'">
                                            <i class="material-icons">person</i>Profile
                                        </a>
                                    </li>
                                    <li><a href="'.$this->urlBuilder->build('logout').'"><i class="material-icons">power_settings_new</i>Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="user_profile">
                        <a href="#" onClick="return false;" class="js-right-sidebar" data-close="true">
                            <i data-feather="settings"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>';

		return $html;
	}

	public function renderSideBarMenu($active = 'dashboard')
	{    
        if($this->adminDomain->getTier() == "sales"){
            $toggle_menu_content = '';
            $toggle_menu_setting_sales = '';

            $dashboard = '';
            $setting_admin_sales = '';
            $paket_afiliasi = '';

            switch($active)
            {
            case "setting_admin_sales" :
                $dashboard = "";
                $message="";
                $setting_admin_sales = " active";
                $paket_afiliasi = "";
                $toggle_menu_setting_sales = "toggled";
                $toggle_menu_content = "";
                $toggle_menu_email = "";
                break;

            case "paket_afiliasi" :
                $dashboard = "";
                $message="";
                $paket_afiliasi = " active";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "toggled";
                $toggle_menu_content = "";
                $toggle_menu_email = "";
                break;

            default :
                $dashboard = " active";       
                $message="";
                $setting_admin_sales = "";
                $paket_afiliasi = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = "";
                $toggle_menu_email = "";
        }

        $html = '
        <div>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">-- Main</li>
                    <li class="'.$dashboard.'">
                        <a href="'.$this->urlBuilder->build('dashboard').'">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="header">-- Configuration</li>
                    <li>
                        <a href="#" onClick="return false;" class="menu-toggle'.$toggle_menu_setting_sales.'">
                            <i data-feather="edit"></i>
                            <span>Setting</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="'.$setting_admin_sales.'">
                                <a href="'.$this->urlBuilder->build('setting-administrator-sales/edit','id='.$this->adminDomain->getID(),TRUE).'">Edit Profile</a>
                            </li>
                            <li class="'.$paket_afiliasi.'">
                                <a href="'.$this->urlBuilder->build('setting-home-package-afiliasi').'">Edit Paket Afiliasi</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <div class="align-right right-sidebar-close">
                <i data-feather="x"></i>
            </div>
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation">
                    <a href="#skins" style ="align:left;"data-toggle="tab" class="active">SKINS</a>
                </li>
                <li role="presentation">
                    <a href="#settings" data-toggle="tab">SETTINGS</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane in active in active stretchLeft" id="skins">
                    <div class="demo-skin">
                        <div class="rightSetting">
                            <p>GENERAL SETTINGS</p>
                            <ul class="setting-list list-unstyled m-t-20">
                                <li>
                                    <div class="form-check">
                                        <div class="form-check m-l-10">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked> Save
                                                History
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <div class="form-check m-l-10">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked> Show
                                                Status
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <div class="form-check m-l-10">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked> Auto
                                                Submit Issue
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <div class="form-check m-l-10">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked> Show
                                                Status To All
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="rightSetting">
                            <p>SIDEBAR MENU COLORS</p>
                            <button type="button"
                                class="btn btn-sidebar-light btn-border-radius p-l-20 p-r-20">Light</button>
                            <button type="button"
                                class="btn btn-sidebar-dark btn-default btn-border-radius p-l-20 p-r-20">Dark</button>
                        </div>
                        <div class="rightSetting">
                            <p>THEME COLORS</p>
                            <button type="button"
                                class="btn btn-theme-light btn-border-radius p-l-20 p-r-20">Light</button>
                            <button type="button"
                                class="btn btn-theme-dark btn-default btn-border-radius p-l-20 p-r-20">Dark</button>
                        </div>
                        <div class="rightSetting">
                            <p>SKINS</p>
                            <ul class="demo-choose-skin choose-theme list-unstyled">
                                <li data-theme="black" class="actived">
                                    <div class="black-theme"></div>
                                </li>
                                <li data-theme="white">
                                    <div class="white-theme white-theme-border"></div>
                                </li>
                                <li data-theme="purple">
                                    <div class="purple-theme"></div>
                                </li>
                                <li data-theme="blue">
                                    <div class="blue-theme"></div>
                                </li>
                                <li data-theme="cyan">
                                    <div class="cyan-theme"></div>
                                </li>
                                <li data-theme="green">
                                    <div class="green-theme"></div>
                                </li>
                                <li data-theme="orange">
                                    <div class="orange-theme"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane stretchRight" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" checked>
                                        <span class="lever switch-col-green"></span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label>
                                        <input type="checkbox">
                                        <span class="lever switch-col-blue"></span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" checked>
                                        <span class="lever switch-col-purple"></span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" checked>
                                        <span class="lever switch-col-cyan"></span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" checked>
                                        <span class="lever switch-col-red"></span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label>
                                        <input type="checkbox">
                                        <span class="lever switch-col-lime"></span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </div>';

    return $html;

        }else {
        $toggle_menu_content = '';
        $toggle_menu_setting = '';
        $toggle_menu_setting_sales = '';

        $dashboard = '';
        $hometitle = '';
        $homeabout = '';
        $homefindus = '';
        $homepackage = '';
        $homefaq = '';
        $homesk = '';
        $homekp = '';
        $homepartner = '';
        $homecontact = '';
        $profilkami='';
        
        $setting_admin = '';
        $setting_admin_sales = '';


        switch($active)
        {
            case "hometitle" :
                $dashboard = "";
                $hometitle = " active";
                $homeabout = "";
                $homefindus = "";
                $homepackage = "";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homepartner = "";
                $homecontact = "";
                $profilkami="";
                $setting_admin = "";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = " toggled";
                $toggle_menu_setting = "";
                break;

            case "homeabout" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = " active";
                $homefindus = "";
                $homepackage = "";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homepartner = "";
                $homecontact = "";
                $profilkami="";
                $setting_admin = "";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = " toggled";
                $toggle_menu_setting = "";
                break;

            case "homefindus" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = "";
                $homefindus = " active";
                $homepackage = "";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homepartner = "";
                $homecontact = "";
                $profilkami="";
                $setting_admin = "";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = " toggled";
                $toggle_menu_setting = "";
                break;

            case "homepackage" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = "";
                $homefindus = "";
                $homepackage = " active";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homepartner = "";
                $homecontact = "";
                $profilkami="";
                $setting_admin = "";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = " toggled";
                $toggle_menu_setting = "";
                break;

            case "homefaq" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = ""; "";
                $homepackage = "";
                $homefaq = " active";
                $homesk = "";
                $homekp = "";
                $homepartner = "";
                $homecontact = "";
                $profilkami="";
                $setting_admin = "";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = " toggled";
                $toggle_menu_setting = "";
                break;

            case "homesk" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = "";
                $homefindus = "";
                $homepackage = "";
                $homefaq = "";
                $homesk = " active";
                $homekp = "";
                $homepartner = "";
                $homecontact = "";
                $profilkami="";
                $setting_admin = "";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = " toggled";
                $toggle_menu_setting = "";
                break;

            case "homekp" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = "";
                $homefindus = "";
                $homepackage = "";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homekp = " active";
                $homepartner = "";
                $homecontact = "";
                $profilkami="";
                $setting_admin = "";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = " toggled";
                $toggle_menu_setting = "";
                break;

             case "homecontact" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = "";
                $homefindus = "";
                $homepackage = "";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homepartner = "";
                $homecontact = " active";
                $profilkami="";
                $setting_admin = "";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = " toggled";
                $toggle_menu_setting = "";
                break;  

            case "homepartner" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = "";
                $homefindus = "";
                $homepackage = "";
                $homecp = "";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homepartner = " active";
                $homecontact = "";
                $profilkami="";
                $setting_admin = "";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = " toggled";
                $toggle_menu_setting = "";
                break;

            case "profilkami" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = "";
                $homefindus = "";
                $homepackage = "";
                $homecp = "";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homepartner = "";
                $homecontact = "";
                $profilkami=" active";
                $setting_admin = "";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = " toggled";
                $toggle_menu_setting = "";
                break;

            case "setting_admin" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = "";
                $homefindus = "";
                $homepackage = "";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homepartner = "";
                $homecontact = "";
                $message="";
                $profilkami="";
                $setting_admin = " active";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = "";
                $toggle_menu_setting = " toggled";
                break;

            case "setting_admin_sales" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = "";
                $homefindus = "";
                $homepackage = "";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homepartner = "";
                $homecontact = "";
                $message="";
                $profilkami="";
                $setting_admin = "";
                $setting_admin_sales = " active";
                $toggle_menu_setting_sales = " toggled";
                $toggle_menu_content = "";
                $toggle_menu_setting = "";
                break;

            case "setting_admin" :
                $dashboard = "";
                $hometitle = "";
                $homeabout = "";
                $homefindus = "";
                $homepackage = "";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homepartner = "";
                $homecontact = "";
                $message="";
                $profilkami="";
                $setting_admin = " active";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = "";
                $toggle_menu_setting = " toggled";
                break;

            default :
                $dashboard = " active";
                $hometitle = "";
                $homeabout = "";
                $homefindus = "";
                $homepackage = "";
                $homefaq = "";
                $homesk = "";
                $homekp = "";
                $homepartner = "";
                $homecontact = "";          
                $message="";
                $profilkami="";
                $setting_admin = "";
                $setting_admin_sales = "";
                $toggle_menu_setting_sales = "";
                $toggle_menu_content = "";
                $toggle_menu_setting = "";
        }

        $html = '
        <div>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">-- Main</li>
                    <li class="'.$dashboard.'">
                        <a href="'.$this->urlBuilder->build('dashboard').'">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#" onClick="return false;" class="menu-toggle'.$toggle_menu_content.'">
                            <i data-feather="sliders"></i>
                            <span>Content</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="'.$hometitle.'">
                                <a href="'.$this->urlBuilder->build('setting-home-title').'" >Home - Title</a>
                            </li>
                            <li class="'.$homeabout.'">
                                <a href="'.$this->urlBuilder->build('setting-home-about').'">Home - About</a>
                            </li>
                            <li class="'.$homefindus.'">
                                <a href="'.$this->urlBuilder->build('setting-home-find-us').'">Home - Find Us</a>
                            </li>
                            <li class="'.$homepackage.'">
                                <a href="'.$this->urlBuilder->build('setting-home-package').'">Home - Package</a>
                            </li>
                            <li class="'.$homecontact.'">
                                <a href="'.$this->urlBuilder->build('setting-home-contact').'">Home - Contact</a>
                            </li>
                            <li class="'.$homepartner.'">
                                <a href="'.$this->urlBuilder->build('setting-home-partner').'">Home - Partner</a>
                            </li>
                            <li class="'.$profilkami.'">
                                <a href="'.$this->urlBuilder->build('setting-home-profil-kami').'">Page - Profil Kami</a>
                            </li>
                            <li class="'.$homesk.'">
                                <a href="'.$this->urlBuilder->build('setting-home-sk').'">Page - Syarat & Ketentuan</a>
                            </li>
                            <li class="'.$homekp.'">
                                <a href="'.$this->urlBuilder->build('setting-home-kp').'">Page - Kebijakan Privasi</a>
                            </li>
                            <li class="'.$homefaq.'">
                                <a href="'.$this->urlBuilder->build('setting-home-faq').'">Page - FAQ</a>
                            </li>
                        </ul>
                    </li>
                    <li class="header">-- Configuration</li>
                    <li>
                        <a href="#" onClick="return false;" class="menu-toggle'.$toggle_menu_setting.'">
                            <i data-feather="edit"></i>
                            <span>Setting</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="'.$setting_admin.'">
                                <a href="'.$this->urlBuilder->build('setting-administrator').'">Setting Administrator</a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <div class="align-right right-sidebar-close">
                <i data-feather="x"></i>
            </div>
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation">
                    <a href="#skins" data-toggle="tab" class="active">SKINS</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane in active in active stretchLeft" id="skins">
                    <div class="demo-skin">
                        <div class="rightSetting">
                            <p>SIDEBAR MENU COLORS</p>
                            <button type="button"
                                class="btn btn-sidebar-light btn-border-radius p-l-20 p-r-20">Light</button>
                            <button type="button"
                                class="btn btn-sidebar-dark btn-default btn-border-radius p-l-20 p-r-20">Dark</button>
                        </div>
                        <div class="rightSetting">
                            <p>THEME COLORS</p>
                            <button type="button"
                                class="btn btn-theme-light btn-border-radius p-l-20 p-r-20">Light</button>
                            <button type="button"
                                class="btn btn-theme-dark btn-default btn-border-radius p-l-20 p-r-20">Dark</button>
                        </div>
                        <div class="rightSetting">
                            <p>SKINS</p>
                            <ul class="demo-choose-skin choose-theme list-unstyled">
                                <li data-theme="black" class="actived">
                                    <div class="black-theme"></div>
                                </li>
                                <li data-theme="white">
                                    <div class="white-theme white-theme-border"></div>
                                </li>
                                <li data-theme="purple">
                                    <div class="purple-theme"></div>
                                </li>
                                <li data-theme="blue">
                                    <div class="blue-theme"></div>
                                </li>
                                <li data-theme="cyan">
                                    <div class="cyan-theme"></div>
                                </li>
                                <li data-theme="green">
                                    <div class="green-theme"></div>
                                </li>
                                <li data-theme="orange">
                                    <div class="orange-theme"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </div>';

    return $html;
        }
    }

    public function renderSessionMessage()
    {
        $sessionMessage = $this->session->get('sessionAdminMessage');
        $this->session->remove('sessionAdminMessage');
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
                    "positionClass": "toast-bottom-full-width",
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


	public function renderFooterBar()
	{
		return '
				<footer>
					&copy; 2018 Crafted with love in Jogja
				</footer>';
	}
}
?>