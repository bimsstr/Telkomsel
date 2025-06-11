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

class AfiliasiPaket extends RootController
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
		$homepackageafiliasiDataSource = $this->homepackageafiliasiDataSource->getAllPackageAfiliasiComplete($usernamesales);
// 		echo "<pre>",var_dump($homepackageafiliasiDataSource),"</pre>";
// 		exit();
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

		$this->renderAfiliasiPaket($homepackageafiliasiDataSource, $valueGet, $usernamesales);
	}

	private function renderAfiliasiPaket(array $homepackageafiliasiDataSource, $valueGet, $usernamesales)
	{
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

		$this->htmlHeaderFooter->setDescription("deskripsi");
		$this->htmlHeaderFooter->setKeywords("key");

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

		$homepackagedetailDomainArray = $this->homepackagedetailDataSource->getAllHomePackageDetailDomainNoLimit($limit, $offset, $keyword = "");
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), ''),
		    array('Afiliasi', '', '')
		);

		$salesDomainArray = $this->adminDataSource->getAdminPhone($usernamesales);
		

		
		$this->overideViewVariable(array(
				'homepackageafiliasiDataSource' => $homepackageafiliasiDataSource,
				'homepackagedetailDomainArray' => $homepackagedetailDomainArray,
				'salesDomainArray' => $salesDomainArray,
				'valueGet' => $valueGet
			)
		);

		$this->load->view('afiliasipaket', $this->viewVariable);
	}
}