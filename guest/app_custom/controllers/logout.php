<?php

class Logout extends AdminController
{
	protected $requiredAdminStatus = 'LoggedIn';

	public function index()
	{
		$this->authenticatorDomain->removeUserSession();
		$sessionMessage['type'] = 'success';
		$sessionMessage['message'] = 'Logout berhasil..';
		$this->session->set('sessionAdminMessage', $sessionMessage);

		$this->redirect('login');
	}
}