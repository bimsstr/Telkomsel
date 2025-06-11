<?php

use Domain\AdminDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationErrors;

class Tes extends AdminController
{
	protected $requiredAdminStatus = 'LoggedIn';

	protected function initialize()
	{
	}

	public function index()
	{
		echo $this->asset->getOutsideFile('gallery'.DIRECTORY_SEPARATOR.'home'); //for save
		echo '<br />';
		echo $this->asset->getAssetForAdmin('gallery/home'); //for get
	}
}