<?php

use Domain\HomeFindUsDomain,
	DataSource\HomeFindUsDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homefindusDataSource = new HomeFindUsDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->homefindusDataSource->deleteById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config Find Us Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}