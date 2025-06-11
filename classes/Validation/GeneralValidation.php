<?php

namespace Validation;

class GeneralValidation extends RootValidation
{
	public function validateForProfile (
		$dataArray
	)
	{
		$this->validateNotNull($dataArray['old_password'], "old_password", "Old Password");
		$this->validateNotNull($dataArray['new_password'], "new_password", "New Password");
		$this->validateNotNull($dataArray['newre_password'], "newre_password", "Retype New Password");

		if ($newPassword !== $newrePassword) {
			$this->validationErrors->add(
				'new_password',
				'Password missmatch'
			);
			$this->validationErrors->add(
				'newre_password',
				'Password missmatch'
			);
		}

		return !($this->validationErrors->hasError());
	}

	private function validateNumeric($str, $field, $text)
	{
		if($this->isDigit($str) == FALSE)
		{
			$this->validationErrors->add(
				$field,
				$this->lang->getIsDigitErrorMessage($text)
			);
		}
	}

	private function validateNotNull($str, $field, $text)
	{
		if ($this->isNotEmpty($str) == FALSE)
		{
			$this->validationErrors->add(
			    $field,
			    $this->lang->getRequiredErrorMessage($text)
			);
		}
	}

	private function validateEmail($str, $field, $text)
	{
		if ($this->isNotEmpty($str) == FALSE)
		{
			$this->validationErrors->add(
			    $field,
			    $this->lang->getRequiredErrorMessage($text)
			);
		}

		if ($this->isEmail($str) == false) {
			$this->validationErrors->add(
			    $field,
			    $this->lang->getNotValidEmail($text)
			);
		}
	}

	public function validateForAdminInsert($dataArray)
	{
		$this->validateNotNull($dataArray['username'], "username", "Username");
		$this->validateNotNull($dataArray['password'], "password", "Password");
		$this->validateNotNull($dataArray['name'], "name", "name");
		$this->validateEmail($dataArray['email'], "email", "Email");

		return !($this->validationErrors->hasError());
	}
}
?>