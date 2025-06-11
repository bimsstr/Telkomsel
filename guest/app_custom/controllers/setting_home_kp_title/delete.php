<?php

use Domain\HomeKPTitleDomain,
	DataSource\HomeKPDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homekpDataSource = new HomeKPDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->homekpDataSource->delete_kpt_ById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config Kebijakan Privasi Title Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}