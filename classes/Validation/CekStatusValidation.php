<?php

namespace Validation;

use Utilities\ValidationErrors;

class CekStatusValidation extends RootValidation
{
	public function validateCekStatus($codeBook,$email)
	{
		if ($this->isNotEmpty($codeBook) == FALSE)
		{

			$this->validationErrors->add('codeBook', $this->lang->getRequiredErrorMessage("Kode Booking"));
		}

		if ($this->isNotEmpty($email) == FALSE)
		{

			$this->validationErrors->add('email', $this->lang->getRequiredErrorMessage("Email"));
		}

		return !($this->validationErrors->hasError());
	}

}