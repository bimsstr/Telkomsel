<?php

use Domain\HomeFaqCategoryDomain,
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

			$this->homefaqDataSource->delete_faqc_ById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Config FAQ Category Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}