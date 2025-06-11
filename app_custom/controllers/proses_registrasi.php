<?php

use DataSource\RegisterDataSource,
	DataSource\HomeSKDataSource,
	Domain\RegisterDomain,
	Utilities\ValidationErrors,
	Validation\RegisterValidation,
	Presentation\ValidationErrorsRenderer;



class Proses_registrasi extends RootController
{


	private $registerDataSource;

	protected function initialize()
	{
		$this->registerDataSource = New RegisterDataSource($this->mysqli);
		$this->homeskDataSource = New HomeSKDataSource($this->mysqli);
	}

	public function index()
	{
		if($this->request->getPost('process')=="Daftar"){
			$this->addProcess($registerDataSource);
		}
		$this->renderProses_Registrasi(NULL);
		
	}

	private function renderProses_Registrasi(ValidationErrors $validationErrors = NULL )
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

		));

		// $this->htmlHeaderFooter->setDescription();
 		// $this->htmlHeaderFooter->setKeywords();
 		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
        $this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
        $this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar('home');
        $this->footerBar = $this->menuBarRenderer->renderFooterBar();

		//----data
		$homeskdetailDomainArray = $this->homeskDataSource->getAllHomeSKDetailDomain();
		//end of data

		$this->overideViewVariable(array(
			'homeskdetailDomainArray' => $homeskdetailDomainArray
		)
		);

		$this->load->view('Proses_registrasi', $this->viewVariable);
	}

	private function addProcess(RegisterDomain $registerDataSource){

		$dataPost = array(
				"username" => $this->request->getPost('agen_username'),
				"email" => $this->request->getPost('agen_email'),
				"nama" => $this->request->getPost('agen_nama'),
				"noHp1" => $this->request->getPost('agen_nophone1'),
				"noHp2" => $this->request->getPost('agen_nophone2'),
				"alamat" => $this->request->getPost('agen_alamat'),
				"provinsi" => $this->request->getPost('agen_provinsi'),
				"paket" => $this->request->getPost('agen_paket'),
				"kodePromo" => $this->request->getPost('kode_promo'),
				"namaUsaha" => $this->request->getPost('agen_perusahaan'),
				"jamDihubungi" => $this->request->getPost('agen_pilihjam'),
				"agenInfo"=> $this->request->getPost('agen_infodari')
		);


		// $tanggalTour = DateTime::createFromFormat('d-m-Y', $dataPost['tanggalTour']);
		$now = date_create('now')->format('Y-m-d H:i:s');

		$registerValidation = new RegisterValidation($this->lang);

		if ($registerValidation->validateForRegisterData($dataPost) == FALSE)
		{

			$this->renderProses($registerDataSource, $registerValidation->getValidationErrors());
			return;
		}

		$registerDomain = new RegisterDomain(
			NULL,
			$now,
			$dataPost['username'],
			$dataPost['email'],
			$dataPost['nama'],
			$dataPost['noHp1'],
			$dataPost['noHp1'],
			$dataPost['alamat'],
			$dataPost['provinsi'],
			$dataPost['paket'],
			NULL,
			NULL,
			'request',
			NULL,
			$dataPost['namaUsaha'],
			$dataPost['jamDihubungi'],
			$dataPost['agenInfo']
		);


		$registerDomain = $this->registerDataSource->insert($registerDomain);

		if($registerDomain == FALSE)
		{
			$sessionMessage['type'] = 'error';
			$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
			$this->session->set('sessionMessage', $sessionMessage);

			$this->redirect('proses-registrasi');
			return;
		} 
			$sessionMessage['type'] = 'success';
			$sessionMessage['message'] = "MASUK BROO!!";
			$this->session->set('sessionMessage', $sessionMessage);

			$this->redirect('register-result');
			return;
	}

	private function renderProses(RegisterDomain $registerDataSource, ValidationErrors $validationErrors = NULL )
	{
		if ($validationErrors == NULL)
		{
			$validationErrors = new ValidationErrors();
		}

		$this->htmlHeaderFooter->addJsCustomCode('
			$(".allow_only_numbers").keydown(function(e) {

					if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
					    ((e.keyCode == 65 || e.keyCode == 86 || e.keyCode == 67) && (e.ctrlKey === true || e.metaKey === true)) ||
					    (e.keyCode >= 35 && e.keyCode <= 40)) {
					    	return;
					}

					if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
						e.preventDefault();
					}
			});

			/*---------------------------------------------
    		CheckBox to Enable Button
    		---------------------------------------------*/

    		$("#termcondition").click(function(){
		    //If the checkbox is checked.
    		if($(this).is(":checked")){
        		//Enable the submit button.
        		$("#submitButton").attr("disabled", false);
    		} else{
        		//If it is not checked, disable the button.
        		$("#submitButton").attr("disabled", true);
    		}
			});
		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));


		$this->htmlHeaderFooter->addJsAsset(array(
		));

		// $this->htmlHeaderFooter->setDescription();
		// $this->htmlHeaderFooter->setKeywords();
		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();


		$this->overideViewVariable(array(
				// 'valueGet' => $valueGet,
				// 'sliderSearchDomain' => $sliderSearchDomainArray[$random],
				// 'registerDataSource' => $registerDataSource
		));

		$this->load->view('Proses_registrasi', $this->viewVariable);
	}
}