<?php

use DataSource\DepositAgentDataSource;

class Notification extends RootController
{
	protected $requiredAgentStatus = 'LoggedIn';

	private $depositAgentDataSource;

	protected function initialize()
	{
		$this->depositAgentDataSource = new DepositAgentDataSource($this->mysqli);
	}

	public function index()
	{
		if ($this->request->isXMLHTTPRequest()) {
			$jumlahDeposit = $this->depositAgentDataSource->getTotalPending($this->agent->getAgentCode());

			$result['deposit'] = $jumlahDeposit;
			echo json_encode($result);exit();
		}
	}

}