<?php

use Domain\AdminDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\RandomStringGenerator,
	Validation\GeneralValidation,
	Utilities\ValidationErrors;


class Login extends AdminController
{
	protected $requiredAdminStatus = 'NotLoggedIn';

	private $randomStringGenerator;

	protected function initialize()
	{
		$this->randomStringGenerator = new RandomStringGenerator();
	}
	

	public function index()
	{
		if($this->request->getPost('process')== 'loginAdmin'){
			$this->processLogin();
		}
		$this->renderLoginForm();
	}


	private function processLogin()
	{
		$username = $this->request->getPost('login_username');
		$password = $this->request->getPost('login_password');

		// Hapus baris DEBUG ini:
		// echo "DEBUG: Login Username: "; var_dump($username); echo "<br>";
		// echo "DEBUG: Login Password: "; var_dump($password); echo "<br>";

		$validationErrors = new ValidationErrors();
		if ($username == 'login')
		{
			$validationErrors->add('login_username', $this->lang->getRequiredErrorMessage('username'));
			$this->renderLoginForm($validationErrors);
			return;
		}
		if ($password == 'login')
		{
			$validationErrors->add('login_password', $this->lang->getRequiredErrorMessage('password'));
			$this->renderLoginForm($validationErrors);
			return;
		}



		$adminDomain = $this->adminDataSource->getAdminDomainByUsername($username);


		if (!($adminDomain instanceof AdminDomain))
		{
			$sessionMessage['type'] = 'error';
			// $sessionMessage['message'] = $this->lang->getIsNotFoundErrorMessage("admin", "username or password" , $username );
			$sessionMessage['message'] = 'Kombinasi Username dan Password Tidak Ditemukan tidak ditemukan';
			$this->session->set('sessionAdminMessage', $sessionMessage);

			$this->redirect('login');
			return;
		}
		// Hapus baris DEBUG ini:
		// echo "DEBUG: adminDomain is an instance of AdminDomain.<br>";

		if ($adminDomain->getPassword() != $this->randomStringGenerator->encryptStringAgent($password, $username))
		{
			$sessionMessage['type'] = 'error';
			// $sessionMessage['message'] = $this->lang->getIsNotFoundErrorMessage("admin", "username or password" , $username );
			$sessionMessage['message'] = 'Kombinasi Username dan Password Tidak Ditemukan tidak ditemukan';
			$this->session->set('sessionAdminMessage', $sessionMessage);

			$this->redirect('login');
			return;
		}
		// Hapus baris DEBUG ini:
		// echo "DEBUG: Password Matched.<br>";
	

		if($adminDomain->getStatus() != "active")
		{
			$sessionMessage['type'] = 'warning';
			$sessionMessage['message'] = 'Akun Anda masih belum aktif, silahkan hubungi Admin untuk Info Akun';
			$this->session->set('sessionAdminMessage', $sessionMessage);

			$this->redirect('login');
			return;
		}
		// Hapus baris DEBUG ini:
		// echo "DEBUG: Admin Status is Active.<br>";

		// Hapus baris DEBUG ini:
		// echo "DEBUG: All validations passed, attempting to create user session.<br>";
		// Hapus baris exit ini (jika ada):
		// exit; // Ini harus dihapus

		// Bagian ini HARUS DI AKTIFKAN KEMBALI
		$this->authenticatorDomain->createUserSession($adminDomain->getId());

	    $sessionMessage['type'] = 'success';
	    $sessionMessage['message'] = 'Selamat Datang '.$adminDomain->getFullname().'!';
	    $this->session->set('sessionAdminMessage', $sessionMessage);

	    $username = $adminDomain->getUsername(); // Ambil username dari objek adminDomain
$this->redirect($username); // Redirect ke username
	}

	private function renderLoginForm(ValidationErrors $validationErrors = NULL)
	{
		if ($validationErrors == NULL)
		{
			$validationErrors = new ValidationErrors();
		}

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader('Indihome Jogja | Admin Page', 'login tooltips bg-dark');
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();

		$this->overideViewVariable();

		$this->load->view('login', $this->viewVariable);
	}
}