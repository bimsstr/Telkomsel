<?php

use Domain\HomeProfilKamiDomain,
	DataSource\HomeProfilKamiDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homeprofilkamiDataSource = new HomeProfilKamiDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->homeprofilkamiDataSource->deleteById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config Profil Kami Detail Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}