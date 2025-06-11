<?php

use Domain\HomePartnerDomain,
	DataSource\HomePartnerDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homepartnerDataSource = new HomePartnerDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->homepartnerDataSource->deleteById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config Partner Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}