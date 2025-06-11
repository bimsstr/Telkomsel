<?php
use Domain\TransaksiItemDomain,
	Domain\TransaksiDomain,
	DataSource\TransaksiDataSource,
	DataSource\TransaksiItemDataSource,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationErrors,
	Validation\CekStatusValidation;

class Check_status extends RootController
{
	private $transaksiDataSource;
	private $transaksiItemDataSource;

	protected function initialize()
	{
		$this->transaksiDataSource = new TransaksiDataSource($this->mysqli);
		$this->transaksiItemDataSource = new TransaksiItemDataSource($this->mysqli);
	}

	public function index()
	{
		if ($this->request->getPost('process') == "cek") {
			$this->checkStatus();
			return;
		}

		$this->renderCheckStatus();

	}

	private function checkStatus(){
		$codeBook = $this->request->getPost('codeBook');
		$email = $this->request->getPost('email');

		$cekStatusValidation = new CekStatusValidation($this->lang);

		if ($cekStatusValidation->validateCekStatus($codeBook,$email) == FALSE)
		{
			$this->renderCheckStatus($cekStatusValidation->getValidationErrors());
			return;

		}

		$transaksiDomain = $this->transaksiDataSource->cekStatusTransaksi($codeBook, $email);

		if (!($transaksiDomain instanceof TransaksiDomain)) {
			$sessionMessage['type'] = 'warning';
			$sessionMessage['message'] = "Kode Book atau Email Tidak dikenali.";
			$this->session->set('sessionMessage', $sessionMessage);

			$this->redirect('check-status','',FALSE);
			return;
		}


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
		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('home');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();


		$this->overideViewVariable(array(
										'sessionMessage' => $this->session->get('sessionMessage'),
										'transaksiDomain'=>$transaksiDomain
									));

		$this->load->view('check_status', $this->viewVariable);

	}

	private function renderCheckStatus(ValidationErrors $validationErrors = NULL){

		if ($validationErrors == NULL)
		{
			$validationErrors = new ValidationErrors();
		}

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
		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('home');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();


		$this->overideViewVariable(array(
										'sessionMessage' => $this->session->get('sessionMessage')

									));

		$this->load->view('check_status', $this->viewVariable);

	}

}