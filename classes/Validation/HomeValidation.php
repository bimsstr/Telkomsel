<?php

namespace Validation;

use Utilities\ValidationErrors;

class HomeValidation extends RootValidation
{
	public function validateForInsertContactUs($data)
	{
		if ($this->isNotEmpty($data['f_name']) == FALSE)
		{

			$this->validationErrors->add('f_name', $this->lang->getRequiredErrorMessage("First Name"));
		}

		if ($this->isNotEmpty($data['l_name']) == FALSE)
		{

			$this->validationErrors->add('l_name', $this->lang->getRequiredErrorMessage("Last Name"));
		}

		if ($this->isNotEmpty($data['email']) == FALSE)
		{

			$this->validationErrors->add('email', $this->lang->getRequiredErrorMessage("Email"));
		}

		if ($this->isNotEmpty($data['phone']) == FALSE)
		{

			$this->validationErrors->add('phone', $this->lang->getRequiredErrorMessage("Phone"));
		}

		if ($this->isNotEmpty($data['message']) == FALSE)
		{

			$this->validationErrors->add('message', $this->lang->getRequiredErrorMessage("message"));
		}

		return !($this->validationErrors->hasError());
	}




}