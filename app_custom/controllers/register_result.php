<?php
use	Domain\RegisterDomain,
	Domain\TransaksiDomain,
	DataSource\SliderSearchDataSource,
	DataSource\TourDataSource,
	DataSource\RegisterDataSource,
	DataSource\TransaksiItemDataSource,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationErrors,
	Utilities\Mailer,
	Services\TemplateEmailService,
	Validation\RegisterValidation;

class Register_result extends RootController
{
	private $registerDataSource;

	protected function initialize()
	{
		// $this->sliderSearchDataSource = new SliderSearchDataSource($this->mysqli);
		// $this->tourDataSource = new TourDataSource($this->mysqli);
		// $this->transaksiDataSource = new TransaksiDataSource($this->mysqli);
		// $this->transaksiItemDataSource = new TransaksiItemDataSource($this->mysqli);
		$this->registerDataSource = new RegisterDataSource($this->mysqli);
	}

	public function index()
	{
		$this->htmlHeaderFooter->addJsCustomCode('

		');

		$this->htmlHeaderFooter->addCssAsset(array(
			// 'lib/nivo-slider/css/nivo-slider.css' => 'screen',
			// 'lib/nivo-slider/css/preview.css' => 'screen',
			// 'lib/animate/animate.css' => 'screen'
		));

		$this->htmlHeaderFooter->addJsAsset(array(
			// 'lib/nivo-slider/js/jquery.nivo.slider.js' => FALSE,
			// 'lib/nivo-slider/home.js' => FALSE
		));

		$this->htmlHeaderFooter->setDescription();
		$this->htmlHeaderFooter->setKeywords();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('home');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// $sliderSearchDomainArray = $this->sliderSearchDataSource->getAllSliderSearchForHome();
		// $random = rand(0,count($sliderSearchDomainArray)-1);
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), ''),
		    array('Konfirmasi', '', '')
		);
		$this->overideViewVariable(array(
										// 'tourDomain'=>$tourDomain,
										// 'sliderSearchDomain' => $sliderSearchDomainArray[$random],
										// 'transaksiDomain'=>$transaksiDomain,
										// 'transaksiItemDomain' => $transaksiItemDomain
									));

		$this->load->view('register_result', $this->viewVariable);

	}

}