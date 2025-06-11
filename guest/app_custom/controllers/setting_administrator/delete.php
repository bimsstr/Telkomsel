<?php

use Domain\AdminDomain,
	DataSource\AdminDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected $adminDataSource;

	protected function initialize()
	{
		$this->adminDataSource = new AdminDataSource($this->mysqli);
	}

	public function index()
	{
		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');
			$package_by = $this->request->getGet('package_by');

			$this->adminDataSource->deleteByUsername($package_by);
			$this->adminDataSource->deleteById($id);
			
			$result['status'] = 'TRUE';
			$result['message'] = 'Akun Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}