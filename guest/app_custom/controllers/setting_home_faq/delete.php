<?php

use Domain\HomeFaqDomain,
	DataSource\HomeFaqDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homefaqDataSource = new HomeFaqDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->homefaqDataSource->deleteById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config FAQ Detail Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}