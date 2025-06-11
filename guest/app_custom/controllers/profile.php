<?php

use Domain\AdminDomain,
	DataSource\AdminDataSource,
	Validation\GeneralValidation,
	Presentation\ValidationErrorsRenderer,
	Utilities\RandomStringGenerator,
	Utilities\ValidationErrors;

class Profile extends AdminController
{
	protected $requiredAdminStatus = 'LoggedIn';

	protected function initialize()
	{
		$this->adminDataSource = New AdminDataSource($this->mysqli);
		$this->randomStringGenerator = new RandomStringGenerator();
	}

	public function index()
	{
		if ($this->request->getPost('process') == 'edit_password')
		{
			$this->editProcess($this->adminDomain);
			return;
		}

		$this->renderProfile($this->adminDomain);
	}

	private function editProcess(AdminDomain $adminDomain)
	{
		$dataPost = array(
			'old_password' => $this->request->getPost('old_password'),
			'new_password' => $this->request->getPost('new_password'),
			'newre_password' => $this->request->getPost('newre_password'),
		);

		$generalValidation = new GeneralValidation($this->lang);

		if($generalValidation->validateForProfile($dataPost) == FALSE)
		{
			$sessionAdminMessage['type'] = 'error';
			$sessionAdminMessage['message'] = $this->lang->getInputErrorMessage("");
			$this->session->set('sessionAdminMessage', $sessionAdminMessage);

			$this->renderEdit($adminDomain, $generalValidation->getValidationErrors());
			return;
		}

		if ($adminDomain->getPassword() !== $this->randomStringGenerator->encryptStringAgent($dataPost['old_password'], $adminDomain->getUsername()))
		{
			$sessionMessage['type'] = 'error';
			$sessionMessage['message'] = 'Old Password is incorrect';
			$this->session->set('sessionAdminMessage', $sessionMessage);

			$this->redirect('profile');
			return;
		}

		$adminDomain->setPassword($this->randomStringGenerator->encryptStringAgent($dataPost['new_password'], $adminDomain->getUsername()));
		if ($this->adminDataSource->update($adminDomain) == FALSE)
		{
			$sessionAdminMessage['type'] = 'error';
			$sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
			$this->session->set('sessionAdminMessage', $sessionAdminMessage);

			$this->redirect('');
			return;
		}

		$sessionAdminMessage['type'] = 'success';
		$sessionAdminMessage['message'] = $this->lang->getUpdateSuccessMessage();
		$this->session->set('sessionAdminMessage', $sessionAdminMessage);

		$this->redirect('');
		return;
	}

	
	private function renderProfile(AdminDomain $adminDomain, ValidationErrors $validationErrors = NULL)
	{
		if ($validationErrors == NULL)
		{
			$validationErrors = new ValidationErrors();
		}

		$this->htmlHeaderFooter->addJsCustomCode($jsCustom);
		$this->htmlHeaderFooter->addJsAsset(array(
			"scripts/chosen.jquery.min.js" => FALSE,
			'js/admin.js' => FALSE,
		));
		$this->htmlHeaderFooter->addCssAsset(array(
			"styles/chosen.css" => "screen",
			"styles/jquery-ui-1.10.3.custom.min.css" => "screen"
		));
		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('profile');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();

		// breadcrumb
		$this->breadcrumbArray = array(
		    array('Settings', '' , 'icon-cogs'),
		    array('Profile', '')
		);
		// end breadcrumb

		//DATA
		$adminDomainArray = $this->adminDataSource->getAdminDomainByUsername($this->adminDomain->getUsername());

		$this->overideViewVariable(array(
		    'adminDomain' => $adminDomain,
		    'adminDomainArray' => $adminDomainArray,
		));

		$this->load->view('profile', $this->viewVariable);
	}
}