<?php

namespace Validation;

use Utilities\ValidationErrors;

class RegisterValidation extends RootValidation
{
	public function validateForRegisterData($data)
	{
		// var_dump($data);
		// exit();
		if ($this->isNotEmpty($data['username']) == FALSE)
		{

			$this->validationErrors->add('agen_username', $this->lang->getRequiredErrorMessage("Username"));
		}

		if ($this->isNotEmpty($data['email']) == FALSE)
		{

			$this->validationErrors->add('agen_email', $this->lang->getRequiredErrorMessage("Email"));
		}

		if ($this->isNotEmpty($data['noHp1']) == FALSE)
		{

			$this->validationErrors->add('agen_nophone1', $this->lang->getRequiredErrorMessage("Phone Number 1"));
		}

		if ($this->isNotEmpty($data['noHp2']) == FALSE)
		{

			$this->validationErrors->add('agen_nophone2', $this->lang->getRequiredErrorMessage("Phone Number 2"));
		}

		if ($this->isNotEmpty($data['nama']) == FALSE)
		{

			$this->validationErrors->add('agen_nama', $this->lang->getRequiredErrorMessage("Nama Lengkap"));
		}

		if ($this->isNotEmpty($data['alamat']) == FALSE)
		{

			$this->validationErrors->add('agen_alamat', $this->lang->getRequiredErrorMessage("Alamat"));
		}

		if ($this->isNotEmpty($data['namaUsaha']) == FALSE)
		{

			$this->validationErrors->add('agen_perusahaan', $this->lang->getRequiredErrorMessage("Nama Usaha"));
		}


		return !($this->validationErrors->hasError());
	}

}