<?php

use Domain\HomeCompanyProfileDomain,
	DataSource\HomeCompanyProfileDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homecompanyprofileDataSource = new HomeCompanyProfileDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->homecompanyprofileDataSource->deleteById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config Company Profile Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}