<?php

use DataSource\HomeFaqDataSource,
	DataSource\AdminDataSource,
	DataSource\HomeContactDataSource,
	DataSource\HomeSKDataSource,
	DataSource\HomeKPDataSource,
	DataSource\HomePackageDataSource,
	DataSource\HomeProfilKamiDataSource,
	DataSource\MessageDataSource,
	DataSource\HomeSalesDataSource,
	Domain\AdminDomain,
	Domain\HomeContactDomain,
	Domain\HomeFaqDomain,
	Domain\HomSKDomain,
	Domain\HomeSKDetailDomain,
	Domain\HomeKPDomain,
	Domain\HomeKPDetailDomain,
	Domain\HomeKPTitleDomain,
	Domain\HomeContactUsDomain,
	Domain\HomePackageDetailDomain,
	Domain\HomeProfilKamiDomain,
	Domain\HomeProfilKamiTitleDomain,
	Domain\MessageDomain,
	Domain\HomeSalesDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationErrors,
	Validation\HomeValidation;

class Page extends RootController
{
	protected function initialize()
	{
		$this->homefaqDataSource = new HomeFaqDataSource($this->mysqli);
		$this->salesDataSource = New HomeSalesDataSource($this->mysqli);
		$this->homeskDataSource = new HomeSKDataSource($this->mysqli);
		$this->homekpDataSource = new HomeKPDataSource($this->mysqli);
		$this->homepackageDataSource = new HomePackageDataSource($this->mysqli);
		$this->homeprofilkamiDataSource = new HomeProfilKamiDataSource($this->mysqli);
		$this->messageDataSource = new MessageDataSource($this->mysqli);
		$this->homecontactDataSource = New HomeContactDataSource($this->mysqli);
		$this->adminDataSource = New AdminDataSource($this->mysqli);

	}

	public function tentang_kami()
	{

	}

	public function contact()
	{
		if ($this->request->getPost('process') == "send_message")
		{
			$data = $this->request->getPost();

			$dataPost = array(
					'name' => $this->request->getPost('name'),
					'phone' => $this->request->getPost('phone'),
					'email' => $this->request->getPost('email'),
					'title' => $this->request->getPost('title'),
					'message' => $this->request->getPost('message'),
			);
			// $contactUsValidation = new HomeValidation($this->lang);

			// if ($contactUsValidation->validateForInsertContactUs($dataPost) == FALSE)
			// {
			// 	$this->renderContact($contactUsValidation->getValidationErrors());
			// 	return;
			// }

			$now = date_create('now')->format('Y-m-d H:i:s');

			$messageDomain = new MessageDomain(
				NULL,
				$dataPost['name'],
				$dataPost['phone'],
				$dataPost['email'],
				$dataPost['title'],
				$dataPost['message'],
				$now,
				'unread'
			);

			if($this->messageDataSource->insert($messageDomain) == FALSE)
			{
				$sessionMessage['type'] = 'error';
				$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
				$this->session->set('sessionMessage', $sessionMessage);

				$this->redirect('contact');
				return;
			}

			$sessionMessage['type'] = 'success';
			$sessionMessage['message'] = 'Pesan Anda Telah Terkirim, Terima Kasih.';
			$this->session->set('sessionMessage', $sessionMessage);

			$this->redirect('contact');
			return;
		}

		$this->renderContact();
	}

	public function renderContact(ValidationErrors $validationErrors = NULL)
	{
		if ($validationErrors == NULL)
		{
			$validationErrors = new ValidationErrors();
		}

		$this->htmlHeaderFooter->addJsCustomCode('

		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(
			'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;key=AIzaSyAh8JWW87OfFXolucTFtXnkPjc4U9frqK4' => TRUE,
			'js/map.js' => FALSE
		));
		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);

		$this->htmlHeaderFooter->setDescription("contact");
		$this->htmlHeaderFooter->setKeywords("key");

		//echo "<pre>",var_dump($this->validationErrorsRenderer),"</pre>";exit();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('contactus');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// echo '<pre>' , var_dump($homecontactusDomainArray) , '</pre>';
		// exit();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), ''),
		    array('Contact Us', '', '')
		);

		$this->overideViewVariable(array(
		));

		$this->load->view('page_contact', $this->viewVariable);

	}

	public function faq()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("faq");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('homefaq');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home > ', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('FAQ', '', '')
		);

		//DATA
		$homefaqDomainArray = $this->homefaqDataSource->getAllHomeFaqDomain();
		$homefaqcategoryDomainArray = $this->homefaqDataSource->getAllHomeFaqCategoryDomain();

		$this->overideViewVariable(array(
			'homefaqDomainArray' => $homefaqDomainArray,
			'homefaqcategoryDomainArray' => $homefaqcategoryDomainArray,
		));

		$this->load->view('page_faq', $this->viewVariable);
	}

	public function syarat_ketentuan()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("syarat");
		$this->htmlHeaderFooter->setKeywords("snk");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('homefaq');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home > ', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Syarat dan Ketentuan', '', '')
		);

		//DATA
		$homeskDomainArray = $this->homeskDataSource->getAllHomeSKDomain();
		$homeskdetailDomainArray = $this->homeskDataSource->getAllHomeSKDetailDomain();

		$this->overideViewVariable(array(
			'homeskDomainArray' => $homeskDomainArray,
			'homeskdetailDomainArray' => $homeskdetailDomainArray,
		));

		$this->load->view('page_syarat_ketentuan', $this->viewVariable);
	}

	public function kebijakan_privasi()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("privacy_policy");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('homefaq');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home > ', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Kebijakan Privasi', '', '')
		);

		//DATA
		$homekpDomainArray = $this->homekpDataSource->getAllHomeKPDomain();
		$homekpdetailDomainArray = $this->homekpDataSource->getAllHomeKPDetailDomain();
		$homekptitleDomainArray = $this->homekpDataSource->getAllHomeKPTitleDomain();

		// echo '<pre>' , var_dump($homekpDomainArray) , '</pre>';
		// echo '<pre>' , var_dump($homekpdetailDomainArray) , '</pre>';
		// exit();

		$this->overideViewVariable(array(
			'homekpDomainArray' => $homekpDomainArray,
			'homekpdetailDomainArray' => $homekpdetailDomainArray,
			'homekptitleDomainArray' => $homekptitleDomainArray,
		));

		$this->load->view('page_kebijakan_privasi', $this->viewVariable);
	}


	public function paket_indihome_jogja()
	{
		$homepackagedetailDomainArray = $this->homepackageDataSource->getAllHomePackageDetailDomain();
		if ($this->request->getPost('process') == 'sort')
        {
            $data = $this->request->getPost();
            $sort = $this->request->getPost('sortby');
            if($sort=="termurah"){
            	$homepackagedetailDomainArray = $this->homepackageDataSource->getAllHomePackageDetailDomainByPriceLow();
            }else if($sort=="termahal"){
            	$homepackagedetailDomainArray = $this->homepackageDataSource->getAllHomePackageDetailDomainByPriceHigh();
            }else if($sort=="bestseller"){
            	$homepackagedetailDomainArray = $this->homepackageDataSource->getAllHomePackageDetailDomainByKeterangan();
            }else if($sort=="category"){
            	$homepackagedetailDomainArray = $this->homepackageDataSource->getAllHomePackageDetailDomainByCategory();
            }

        }
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("paket_indihome_jogja");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('homefaq');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Keagenan', '', '')
		);

		//DATA

		//paket keagenan
		// $homepackagedetailDomainArray = $this->homepackageDataSource->getAllHomePackageDetailDomain();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
		));

		$this->load->view('page_paket_indihome_jogja', $this->viewVariable);
	}

	public function profil_kami()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("profile");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('homefaq');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Profil Kami', '', '')
		);

		//DATA
		//TITLE
		$homeprofilkamiDomainArray = $this->homeprofilkamiDataSource->getAllHomeProfilKamiDomain();

		//PROFILE
		$homeprofilkamititleDomainArray = $this->homeprofilkamiDataSource->getAllHomeProfilKamiTitleDomain();

		//CONTACT
		$homecontactDomainArray = $this->homecontactDataSource->getAllHomeContactDomain();

		$this->overideViewVariable(array(
			'homeprofilkamiDomainArray' => $homeprofilkamiDomainArray,
			'homeprofilkamititleDomainArray' => $homeprofilkamititleDomainArray,
			'homecontactDomainArray' => $homecontactDomainArray
		));

		$this->load->view('page_profil_kami', $this->viewVariable);
	}

	public function sales()
	{
		$salesDomainArray = $this->adminDataSource->getAllAdminDomainbyTier();
		if ($this->request->getPost('process') == 'sort')
        {
            // $this->addProcess();
            // return;
            $data = $this->request->getPost();
            $sort = $this->request->getPost('sortby');
            if($sort=="bintang"){
            	$salesDomainArray = $this->adminDataSource->getAllAdminDomainbyTierAndStar();
            }else if($sort=="nama"){
            	$salesDomainArray = $this->adminDataSource->getAllAdminDomainbyTierAndName();
            }else{
            	$salesDomainArray = $this->adminDataSource->getAllAdminDomainbyTier();
            }

        }

		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("test");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('sales');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Our Team', '', '')
		);

		//data detail

		$salesTitleDomainArray = $this->salesDataSource->getAllHomeSalesDomain();

		$this->overideViewVariable(array(
			'salesDomainArray' => $salesDomainArray,
			'salesTitleDomainArray' => $salesTitleDomainArray
		));

		$this->load->view('page_sales', $this->viewVariable);
	}

	public function pilih_sales()
	{
		$paket = $this->request->getGet('paket');

		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("pick_sales");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('homefaq');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Our Team', '', '')
		);

		//data detail
		$salesDomainArray = $this->adminDataSource->getAllAdminDomainbyTier();
		$salesTitleDomainArray = $this->salesDataSource->getAllHomeSalesDomain();

		$this->overideViewVariable(array(
			'salesDomainArray' => $salesDomainArray,
			'salesTitleDomainArray' => $salesTitleDomainArray,
			'paket' => $paket
		));

		$this->load->view('page_pilih_sales', $this->viewVariable);
	}

	public function paket_streamix()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("streamix");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('paket_streamix');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Streamix', '', '')
		);

		//DATA

		//paket keagenan
		$homepackagedetailDomainArray = $this->homepackageDataSource->getPackageStreamix();
		$homepackageblogDomainArray = $this->homepackageDataSource->getPackageBlogStreamix();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			'homepackageblogDomainArray' => $homepackageblogDomainArray,
		));

		$this->load->view('page_paket_streamix', $this->viewVariable);
	}

	public function paket_phoenix()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("phoenix");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('paket_phoenix');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Phoenix', '', '')
		);

		//DATA

		//paket keagenan
		$homepackagedetailDomainArray = $this->homepackageDataSource->getPackagePhoenix();
		$homepackageblogDomainArray = $this->homepackageDataSource->getPackageBlogPhoenix();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			'homepackageblogDomainArray' => $homepackageblogDomainArray,
		));

		$this->load->view('page_paket_phoenix', $this->viewVariable);
	}

	public function paket_value()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("value");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('paket_value');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Indihome Value', '', '')
		);

		//DATA

		//paket keagenan
		$homepackagedetailDomainArray = $this->homepackageDataSource->getPackageValue();
		$homepackageblogDomainArray = $this->homepackageDataSource->getPackageBlogValue();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			'homepackageblogDomainArray' => $homepackageblogDomainArray,
		));

		$this->load->view('page_paket_value', $this->viewVariable);
	}

	public function paket_fit()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("fit");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('paket_fit');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Indihome Fit', '', '')
		);

		//DATA

		//paket keagenan
		$homepackagedetailDomainArray = $this->homepackageDataSource->getPackageFit();
		$homepackageblogDomainArray = $this->homepackageDataSource->getPackageBlogFit();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			'homepackageblogDomainArray' => $homepackageblogDomainArray,
		));

		$this->load->view('page_paket_fit', $this->viewVariable);
	}

	public function paket_prestige()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("paket_prestige");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('paket_prestige');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Indihome Prestige', '', '')
		);

		//DATA

		//paket keagenan
		$homepackagedetailDomainArray = $this->homepackageDataSource->getPackagePrestige();
		$homepackageblogDomainArray = $this->homepackageDataSource->getPackageBlogPrestige();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			'homepackageblogDomainArray' => $homepackageblogDomainArray,
		));

		$this->load->view('page_paket_prestige', $this->viewVariable);
	}

	public function paket_bumn()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("test");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('paket_bumn');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Indihome Bumn', '', '')
		);

		//DATA

		//paket keagenan
		$homepackagedetailDomainArray = $this->homepackageDataSource->getPackageBumn();
		$homepackageblogDomainArray = $this->homepackageDataSource->getPackageBlogBumn();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			'homepackageblogDomainArray' => $homepackageblogDomainArray,
		));

		$this->load->view('page_paket_bumn', $this->viewVariable);
	}

		public function paket_prepaid()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("prepaid");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('paket_prepaid');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Indihome Prepaid', '', '')
		);

		//DATA

		//paket keagenan
		$homepackagedetailDomainArray = $this->homepackageDataSource->getPackagePrepaid();
		$homepackageblogDomainArray = $this->homepackageDataSource->getPackageBlogPrepaid();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			'homepackageblogDomainArray' => $homepackageblogDomainArray,
		));

		$this->load->view('page_paket_prepaid', $this->viewVariable);
	}

	public function paket_2P()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("test");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('paket_2P');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Indihome 2P', '', '')
		);

		//DATA

		//paket keagenan
		$homepackagedetailDomainArray = $this->homepackageDataSource->getPackage2P();
		$homepackageblogDomainArray = $this->homepackageDataSource->getPackageBlog2P();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			'homepackageblogDomainArray' => $homepackageblogDomainArray,
		));

		$this->load->view('page_paket_2P', $this->viewVariable);
	}

	public function paket_3P()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("3P");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('paket_3P');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Indihome 3P', '', '')
		);

		//DATA

		//paket keagenan
		$homepackagedetailDomainArray = $this->homepackageDataSource->getPackage3P();
		$homepackageblogDomainArray = $this->homepackageDataSource->getPackageBlog3P();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			'homepackageblogDomainArray' => $homepackageblogDomainArray,
		));

		$this->load->view('page_paket_3P', $this->viewVariable);
	}

	public function paket_BB()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("paket_BB");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('paket_BB');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Indihome Belajar dan Bermain', '', '')
		);

		//DATA

		//paket keagenan
		$homepackagedetailDomainArray = $this->homepackageDataSource->getPackageBB();
		$homepackageblogDomainArray = $this->homepackageDataSource->getPackageBlogBB();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			'homepackageblogDomainArray' => $homepackageblogDomainArray,
		));

		$this->load->view('page_paket_BB', $this->viewVariable);
	}

	public function paket_SBR()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".collapse").on("hidden.bs.collapse", function(){
				$(this).parent().find(".panel-heading").removeClass("showed");
			}).on("shown.bs.collapse", function(){
				$(this).parent().find(".panel-heading").addClass("showed");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription("paket_SBR");
		$this->htmlHeaderFooter->setKeywords("key");
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('paket_SBR');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), 'feather feather-arrow-down-left'),
		    array('Paket Indihome SBR', '', '')
		);

		//DATA

		//paket keagenan
		$homepackagedetailDomainArray = $this->homepackageDataSource->getPackageSBR();
		$homepackageblogDomainArray = $this->homepackageDataSource->getPackageBlogSBR();

		$this->overideViewVariable(array(
			'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			'homepackageblogDomainArray' => $homepackageblogDomainArray,
		));

		$this->load->view('page_paket_SBR', $this->viewVariable);
	}
}