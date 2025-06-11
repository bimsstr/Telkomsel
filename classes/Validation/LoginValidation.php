<?php

namespace Validation;

use Utilities\ValidationErrors;

class LoginValidation extends RootValidation
{
	public function validateForRegister($data)
	{
		// var_dump($data);
		// exit();
		if ($this->isNotEmpty($data['name']) == FALSE)
		{

			$this->validationErrors->add('admin_name', $this->lang->getRequiredErrorMessage("Nama"));
		}

		if ($this->isNotEmpty($data['email']) == FALSE)
		{

			$this->validationErrors->add('admin_email', $this->lang->getRequiredErrorMessage("Email"));
		}

		if ($this->isNotEmpty($data['username']) == FALSE)
		{

			$this->validationErrors->add('admin_username', $this->lang->getRequiredErrorMessage("Username"));
		}

		if ($this->isNotEmpty($data['password']) == FALSE)
		{

			$this->validationErrors->add('admin_password', $this->lang->getRequiredErrorMessage("Password"));
		}

		return !($this->validationErrors->hasError());
	}

}