<?php
use	Domain\HomePackageAfiliasiDomain,
	Domain\HomePackageDetailDomain,
	Domain\HomePackageDomain,
	DataSource\HomePackageAfiliasiDataSource,
	DataSource\HomePackageDataSource,
	DataSource\AdminDataSource,
	DataSource\HomeTitleDataSource,
	DataSource\HomeAboutDataSource,
	DataSource\HomeFindUsDataSource,
	DataSource\HomeContactDataSource,
	DataSource\HomeCompanyProfileDataSource,
	DataSource\HomePartnerDataSource,
	DataSource\HomeSKDataSource,
	DataSource\HomeSalesDataSource,
	DataSource\MessageDataSource;

class Afiliasi extends RootController
{
	protected function initialize()
	{
		$this->adminDataSource = New AdminDataSource($this->mysqli);
		$this->salesDataSource = New HomeSalesDataSource($this->mysqli);
		$this->hometitleDataSource = New HomeTitleDataSource($this->mysqli);
		$this->homeaboutDataSource = New HomeAboutDataSource($this->mysqli);
		$this->homefindusDataSource = New HomeFindUsDataSource($this->mysqli);
		$this->homecontactDataSource = New HomeContactDataSource($this->mysqli);
		$this->homecompanyprofileDataSource = New HomeCompanyProfileDataSource($this->mysqli);
		$this->homepartnerDataSource = New HomePartnerDataSource($this->mysqli);
		$this->homepackageafiliasiDataSource = New HomePackageAfiliasiDataSource($this->mysqli);
		$this->homepackagedetailDataSource = New HomePackageDataSource($this->mysqli);
		$this->homeskDataSource = New HomeSKDataSource($this->mysqli);
		$this->messageDataSource = new MessageDataSource($this->mysqli);
	}

	public function index($usernamesales)
	{
		$adminDomain = $this->adminDataSource->getAdminDomainByUsername($usernamesales);


		if ($adminDomain == false)
		{
			$sessionMessage['type'] = 'warning';
			$sessionMessage['message'] = 'Mohon maaf, Website Afiliasi Anda Tidak Ditemukan';
			$this->session->set('sessionMessage', $sessionMessage);

			$this->redirect('');
			return;
		}

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

			$this->redirect('home');
			return;
		}

		$homepackageafiliasiDataSource = $this->homepackageafiliasiDataSource->getAllPackageAfiliasi($usernamesales);
        if ($this->request->getPost('process') == 'sortafiliasi')
        {
            $data = $this->request->getPost();
            $sort = $this->request->getPost('sortby');
            if($sort=="termurah"){
            	$homepackageafiliasiDataSource = $this->homepackageafiliasiDataSource->getAllHomePackageAfiliasiDomainByPriceLow($usernamesales);	
            }else if($sort=="termahal"){
            	$homepackageafiliasiDataSource = $this->homepackageafiliasiDataSource->getAllHomePackageAfiliasiDomainByPriceHigh($usernamesales);	
            }else if($sort=="bestseller"){
            	$homepackageafiliasiDataSource = $this->homepackageafiliasiDataSource->getAllHomePackageAfiliasiDomainByKeterangan($usernamesales);
            }else if($sort=="category"){
            	$homepackageafiliasiDataSource = $this->homepackageafiliasiDataSource->getAllHomePackageAfiliasiDomainByCategory($usernamesales);
            }
        }

		$this->renderAfiliasi($homepackageafiliasiDataSource, $valueGet, $usernamesales);
	}

	private function renderAfiliasi(array $homepackageafiliasiArray, $valueGet, $usernamesales) // Mengganti HomePackageAfiliasiDomain dengan array
	{	// Catatan: Nama variabel diubah dari $homepackageafiliasiDataSource menjadi $homepackageafiliasiArray
        // agar lebih jelas bahwa ini adalah array. Anda juga perlu mengubahnya di bagian $this->overideViewVariable
        // dan di view 'afiliasi' jika Anda menggunakan nama variabel ini di sana.
		$this->htmlHeaderFooter->addJsCustomCode('
			$("#tour-gallery").owlCarousel({
				navigation: true,
				slideSpeed: 300,
				paginationSpeed: 400,
				singleItem: true,
				touchDrag: false,
				pagination: false,
				mouseDrag: false
			});

			$.scrollUp({
				scrollName: "tabs01",
				scrollText: "Itinerary",
				easingType: "linear",
				scrollSpeed: 900,
				animation: "fade",
				animationInSpeed: 2000
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(
			'lib/nivo-slider/css/nivo-slider.css' => 'screen',
			'lib/nivo-slider/css/preview.css' => 'screen',
			'lib/animate/animate.css' => 'screen'
		));

		$this->htmlHeaderFooter->addJsAsset(array(
			'js/owl.carousel.min.js' => FALSE,
			'lib/nivo-slider/js/jquery.nivo.slider.js' => FALSE,
			'lib/nivo-slider/home.js' => FALSE
		));

    	$this->htmlHeaderFooter->setDescription("Deskripsi untuk halaman afiliasi ". $usernamesales); // Contoh: Tambahkan string deskripsi
		$this->htmlHeaderFooter->setKeywords("kata kunci, afiliasi, indihome, " . $usernamesales); // Sekalian perbaiki setKeywords jika punya masalah serupa

		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('home');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		//----data
		// $sliderSearchDomainArray = $this->sliderSearchDataSource->getAllSliderSearchForHome();
		// $destinationDomainArray = $this->destinationDataSource->getAllDestinationDomainForHome();
		// $categoryDomainArray = $this->categoryDataSource->getAllCategoryDomainForHome();
		// $tourGalleryDomainArray = $this->tourGalleryDataSource->getTourGalleryDomainByIdTour($tourDataSource->getId());
		// $random = rand(0,count($sliderSearchDomainArray)-1);
		//end of data

		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), ''),
		    array('Afiliasi', '', '')
		);


//data
		$salesDomainArray = $this->adminDataSource->getAdminPhone($usernamesales);
		$salesTitleDomainArray = $this->salesDataSource->getAllHomeSalesDomain();
		$hometitleDomainArray = $this->hometitleDataSource->getAllHomeTitleDomain();
		$homeaboutDomainArray = $this->homeaboutDataSource->getAllHomeAboutDomain();
		$homeaboutdetailDomainArray = $this->homeaboutDataSource->getAllHomeAboutDetailDomain();
		$homefindusDomainArray = $this->homefindusDataSource->getAllHomeFindUsDomain();
		$homecontactDomainArray = $this->homecontactDataSource->getAllHomeContactDomain();
		$homecompanyprofileDomainArray = $this->homecompanyprofileDataSource->getAllHomeCompanyProfileDomain();
		$homepartnerDomainArray = $this->homepartnerDataSource->getAllHomePartnerDomain();
		$homepackageDomainArray = $this->homepackageafiliasiDataSource->getAllHomePackageDomain();
		$homepackagedetailDomainArray = $this->homepackagedetailDataSource->getAllHomePackageDetailDomainByLimitForShow(10,0);
		$homepackagecategoryDomainArray = $this->homepackageafiliasiDataSource->getAllHomePackageCategoryDomain();
		$homeskDomainArray = $this->homeskDataSource->getAllHomeSKDomain();
		$homeskdetailDomainArray = $this->homeskDataSource->getAllHomeSKDetailDomain();
	
		// var_dump($homepackageDomainArray)
		// var_dump($salesDomainArray);
		// exit();
		$this->overideViewVariable(array(
				'homepackageafiliasiDataSource' => $homepackageafiliasiDataSource,
				'salesDomainArray' => $salesDomainArray,
				'valueGet' => $valueGet,
				'hometitleDomainArray' => $hometitleDomainArray,
				'homeaboutDomainArray' => $homeaboutDomainArray,
				'homeaboutdetailDomainArray' => $homeaboutdetailDomainArray,
				'homefindusDomainArray' => $homefindusDomainArray,
				'homecontactDomainArray' => $homecontactDomainArray,
				'homecompanyprofileDomainArray' => $homecompanyprofileDomainArray,
				'homepartnerDomainArray' => $homepartnerDomainArray,
				'homepackageDomainArray' => $homepackageDomainArray,
				'homepackagecategoryDomainArray' => $homepackagecategoryDomainArray,
				'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
				'homeskDomainArray' => $homeskDomainArray,
				'homeskdetailDomainArray' => $homeskdetailDomainArray,
				'salesTitleDomainArray' => $salesTitleDomainArray,
				'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
			)
		);

		$this->load->view('afiliasi', $this->viewVariable);
	}
}