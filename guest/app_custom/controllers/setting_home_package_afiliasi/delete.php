<?php

use Domain\HomePackageAfiliasiDomain,
	DataSource\HomePackageAfiliasiDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homepackageafiliasiDataSource = new HomePackageAfiliasiDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->homepackageafiliasiDataSource->delete_hpa_ById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Paket Afiliasi Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}