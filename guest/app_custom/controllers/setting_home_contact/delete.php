<?php

use Domain\HomeContactDomain,
	DataSource\HomeContactDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homecontactDataSource = new HomeContactDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->homecontactDataSource->deleteById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config Contact Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}