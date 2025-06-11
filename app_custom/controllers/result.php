<?php
use	Domain\TourDomain,
	Domain\TransaksiDomain,
	DataSource\SliderSearchDataSource,
	DataSource\TourDataSource,
	DataSource\TransaksiDataSource,
	DataSource\TransaksiItemDataSource,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationErrors,
	Utilities\Mailer,
	Services\TemplateEmailService,
	Validation\BookValidation;

class Result extends RootController
{
	private $sliderSearchDataSource;
	private $tourDataSource;
	private $transaksiDataSource;
	private $transaksiItemDataSource;

	protected function initialize()
	{
		$this->sliderSearchDataSource = new SliderSearchDataSource($this->mysqli);
		$this->tourDataSource = new TourDataSource($this->mysqli);
		$this->transaksiDataSource = new TransaksiDataSource($this->mysqli);
		$this->transaksiItemDataSource = new TransaksiItemDataSource($this->mysqli);
	}

	public function index()
	{
		$arrayParam = json_decode($this->convert->decrypt($this->request->getGet("id")));

		$tourDomain = $this->tourDataSource->getTourDomainById($arrayParam->id_tour);

		if (!($tourDomain instanceof TourDomain)) {
			$sessionMessage['type'] = 'warning';
			$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
			$this->session->set('sessionMessage', $sessionMessage);

			$this->redirect('');
			return;
		}


		$transaksiDomain = $this->transaksiDataSource->getTransaksiDomainById($arrayParam->id_transaksi);

		if (!($transaksiDomain instanceof TransaksiDomain)) {
			$sessionMessage['type'] = 'warning';
			$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
			$this->session->set('sessionMessage', $sessionMessage);

			$this->redirect('');
			return;
		}

		$transaksiItemDomain = $this->transaksiItemDataSource->getTransaksiDomainByIdTransaksi($transaksiDomain->getId());

		$this->htmlHeaderFooter->addJsCustomCode('

		');

		$this->htmlHeaderFooter->addCssAsset(array(
			'lib/nivo-slider/css/nivo-slider.css' => 'screen',
			'lib/nivo-slider/css/preview.css' => 'screen',
			'lib/animate/animate.css' => 'screen'
		));

		$this->htmlHeaderFooter->addJsAsset(array(
			'lib/nivo-slider/js/jquery.nivo.slider.js' => FALSE,
			'lib/nivo-slider/home.js' => FALSE
		));

		$this->htmlHeaderFooter->setDescription();
		$this->htmlHeaderFooter->setKeywords();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('home');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		$sliderSearchDomainArray = $this->sliderSearchDataSource->getAllSliderSearchForHome();
		$random = rand(0,count($sliderSearchDomainArray)-1);
		$this->breadcrumbArray = array(
			array('Home', $this->urlBuilder->getBaseUrl(), ''),
		    array('Konfirmasi', '', '')
		);
		$this->overideViewVariable(array(
										'tourDomain'=>$tourDomain,
										'sliderSearchDomain' => $sliderSearchDomainArray[$random],
										'transaksiDomain'=>$transaksiDomain,
										'transaksiItemDomain' => $transaksiItemDomain
									));

		$this->load->view('result', $this->viewVariable);

	}

}