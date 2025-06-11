<?php

use Domain\HomeTitleDomain,
	DataSource\HomeTitleDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected $hometitleDataSource;

	protected function initialize()
	{
		$this->hometitleDataSource = new HomeTitleDataSource($this->mysqli);
	}

	public function index()
	{
		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->hometitleDataSource->deleteById($id);

			$result['status'] = 'TRUE';
			$result['message'] = 'Config HomeTitle Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}