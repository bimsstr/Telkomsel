<?php

use Domain\HomeSKDomain,
	DataSource\HomeSKDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homeskDataSource = new HomeSKDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->homeskDataSource->deleteById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config Syarat dan Ketentuan Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}