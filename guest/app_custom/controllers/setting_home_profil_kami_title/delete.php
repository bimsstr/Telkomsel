<?php

use Domain\HomeProfilKamiTitleDomain,
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

			$this->homeprofilkamiDataSource->delete_pkt_ById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config Profil Kami Title Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}