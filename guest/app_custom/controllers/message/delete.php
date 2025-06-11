<?php

use Domain\MessageDomain,
	DataSource\MessageDataSource;

class Delete extends AdminController
{
	protected $requiredAgentStatus = "LoggedIn";

	protected function initialize()
	{
		$this->messageDataSource = new MessageDataSource($this->mysqli);
	}

	public function index()
	{

		if ($this->request->isXMLHTTPRequest())
		{
			$id = $this->request->getPost('value');

			$this->messageDataSource->deleteById($id);


			$result['status'] = 'TRUE';
			$result['message'] = 'Message Berhasil Di Hapus!';
			echo json_encode($result);
			return;
		}
	}
}