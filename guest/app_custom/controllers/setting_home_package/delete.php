<?php

use Domain\HomePackageDomain,
	DataSource\HomePackageDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homepackageDataSource = new HomePackageDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->homepackageDataSource->deleteById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config Home Package Title Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}