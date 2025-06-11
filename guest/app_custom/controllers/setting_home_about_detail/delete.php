<?php

use Domain\HomeAboutDetailDomain,
	DataSource\HomeAboutDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homeaboutDataSource = new HomeAboutDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->homeaboutDataSource->deletehadById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config Home About Detail Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}