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

			$this->adminDataSource->deleteById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Admin Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}