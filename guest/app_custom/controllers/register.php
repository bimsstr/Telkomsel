<?php

use Domain\AdminDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\RandomStringGenerator,
	Validation\GeneralValidation,
	Utilities\ValidationErrors;


class Register extends AdminController
{
	protected $requiredAdminStatus = 'NotLoggedIn';

	private $randomStringGenerator;

	protected function initialize()
	{
		$this->randomStringGenerator = new RandomStringGenerator();
	}

	public function index()
	{
		if($this->request->getPost('process')== 'regisAdmin'){
			$this->addProcess();
		}

		$this->renderRegisterForm();
	}

	private function addProcess()
	{

		$admin_username = $this->request->getPost('register_username');
		$admin_password = $this->request->getPost('register_password');

		$adminDomain = $this->adminDataSource->getAdminDomainByUsername($admin_username);
		// var_dump($adminDomain);
		// exit();

		if($adminDomain instanceof AdminDomain)
		{
			$sessionMessage['type'] = 'error';
			// $sessionMessage['message'] = $this->lang->getIsNotFoundErrorMessage("admin", "username or password" , $username );
			$sessionMessage['message'] = 'Akun dengan KContact '.$admin_username.' sudah terdaftar';
			$this->session->set('sessionAdminMessage', $sessionMessage);

			$this->redirect('register');
			return;
		}

		$admin_name = $this->request->getPost('register_name');
		$admin_phone = $this->request->getPost('register_phone');
		$adminDomain = new AdminDomain(
			null,
			$admin_username,
			$this->randomStringGenerator->encryptStringAgent($admin_password, $admin_username),
			$admin_name,
			null,
			null,
			$admin_phone,
			null,
			null,
			null,
			null,
			null,
			'sales',
			'inactive'
		);

		$adminDomain = $this->adminDataSource->registerAdmin($adminDomain);
		
		$sessionAdminMessage['type'] = 'success';
		$sessionAdminMessage['message'] = 'Akun Anda telah berhasil terdaftar. Silahkan menunggu untuk proses aktivasi Akun';
		$this->session->set('sessionAdminMessage', $sessionAdminMessage);

		$this->redirect('register');
		return;
	}

	private function renderRegisterForm(ValidationErrors $validationErrors = NULL)
	{
		if ($validationErrors == NULL)
		{
			$validationErrors = new ValidationErrors();
		}

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader('Indihome Jogja | Admin Page', 'login tooltips bg-dark');
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();

		$this->overideViewVariable();

		$this->load->view('register', $this->viewVariable);
	}
}