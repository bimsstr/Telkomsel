<?php

namespace Validation;

use Utilities\ValidationErrors;

class BookValidation extends RootValidation
{
	public function validateForBookData($data)
	{
		if ($this->isNotEmpty($data['namaKontak']) == FALSE)
		{

			$this->validationErrors->add('nama_kontak', $this->lang->getRequiredErrorMessage("Nama"));
		}

		if ($this->isNotEmpty($data['email']) == FALSE)
		{

			$this->validationErrors->add('email', $this->lang->getRequiredErrorMessage("email"));
		}

		if ($this->isNotEmpty($data['noHandphone']) == FALSE)
		{

			$this->validationErrors->add('no_handphone', $this->lang->getRequiredErrorMessage("Phone Number"));
		}

		return !($this->validationErrors->hasError());
	}

}