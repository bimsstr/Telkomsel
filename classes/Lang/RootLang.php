<?php

namespace Lang;

class RootLang
{
    // ERROR
	protected $notValidEmail;
    protected $requiredErrorMessage;
    protected $notValidErrorMessage;
    protected $notEqualErrorMessage;
    protected $minLengthErrorMessage;
    protected $maxLengthErrorMessage;
    protected $betweenErrorMessage;
    protected $inputErrorMessage;
    protected $hasRegisteredMessage;
    protected $startWithLetterErrorMessage;
    protected $isDigitErrorMessage;
	protected $isAlphaNumericErrorMessage;
    protected $hasDefaultValueErrorMessage;
    protected $expiredPromoErrorMessage;
    protected $notLoggedInErrorMessage;
    protected $loggedInErrorMessage;
    protected $bannedErrorMessage;
    protected $isNotAvailableErrorMessage;
    protected $internalErrorMessage;
    protected $notFoundDataErrorMessage;
    protected $minimalNominalErrorMessage;
    protected $hasTokiCreatedErrorMessage;
    protected $hasNoTokiCreatedErrorMessage;
    protected $hasNoPermissionErrorMessage;
    protected $hasDuplicateErrorMessage;
	protected $notValidParameter;
	protected $notValidSelectBox;
	protected $notEnoughSaldo;
	protected $notValidSerializeInput;
	protected $alreadyRegistered;
	protected $expiredSchedule;

	protected $usernameRegistered;
	protected $emailRegistered;
	protected $exceedDownlineNumber;
	protected $exceedShareDownlineNumber;

	protected $notValidFinger;
	protected $dateNotValidMessage;
	protected $dateBackSmallerErrorMessage;
	protected $flightNotSet;
	protected $confirmOrder;

	protected $bookingErrorMessage;
	protected $bookingSuccessMessage;

	protected $issuedNotPrivilege;
	protected $issuedNotPermitted;
	protected $insufficientBalance;
    protected $issuedError;
	protected $issuedSuccess;

    protected $downloadTicketNotPermited;

	// perubahan status
	protected $statusChange;


    // SUCCESS
    protected $deletedSuccessMessage;
    protected $insertSuccessMessage;
    protected $updateSuccessMessage;
	protected $registerFingerSuccess;

    protected $fileNotFound;

    public function getDownloadTicketNotPermited()
    {
        return $this->downloadTicketNotPermited;
    }

	public function getIssuedNotPrivilege()
	{
		return $this->issuedNotPrivilege;
	}

    public function getIssuedError()
    {
        return $this->issuedError;
    }
    
	public function getIssuedSuccess()
	{
		return $this->issuedSuccess;
	}

	public function getInsufficientBalance()
	{
		return $this->insufficientBalance;
	}

	public function getIssuedNotPermitted()
	{
		return $this->issuedNotPermitted;
	}

	public function getDateNotValidMessage($string)
	{
		return sprintf($this->dateNotValidMessage, $string);
	}

	public function getBookingSuccessMessage()
	{
		return $this->bookingSuccessMessage;
	}

	public function getBookingErrorMessage()
	{
		return $this->bookingErrorMessage;
	}

	public function getConfirmOrder()
	{
		return $this->confirmOrder;
	}

	public function getFlightNotSet()
	{
		return $this->flightNotSet;
	}

	public function getDateBackSmallerErrorMessage()
	{
		return $this->dateBackSmallerErrorMessage;
	}

	public function getExceedDownlineNumber()
	{
		return $this->exceedDownlineNumber;
	}

	public function getExceedShareDownlineNumber($string)
	{
		return sprintf($this->exceedShareDownlineNumber , $string);
	}

	public function getUsernameRegistered($string)
	{
		return sprintf($this->usernameRegistered, $string);
	}

	public function getEmailRegistered($string)
	{
		return sprintf($this->emailRegistered , $string);
	}

    public function getFileNotFound()
    {
        return $this->fileNotFound;
    }


	public function getNotValidFinger()
	{
		return $this->notValidFinger;
	}

	public function getRegisterFingerSuccess($name)
	{
		return sprintf($this->registerFingerSuccess, $name);
	}

	public function getExpiredSchedule()
	{
		return $this->expiredSchedule;
	}

	public function getIsAlphaNumericErrorMessage($field)
	{
		return sprintf($this->isAlphaNumericErrorMessage, $field);
	}

	public function getAlreadyRegistered($name, $class)
	{
		return sprintf($this->alreadyRegistered , $name, $class);
	}

	public function getNotValidSerializeInput($field)
	{
		return sprintf($this->notValidSerializeInput , $field);
	}

	public function getNotEnoughSaldo()
	{
		return $this->notEnoughSaldo;
	}

	public function getNotValidSelectBox($field)
	{
		return sprintf($this->notValidSelectBox, $field);
	}

	/**
	 * fungsi ini digunakan untuk mengembalikan pesan eror ketika halaman yang diakses dikirimkan parameter yang tidak valid.
	 *
	 * @param string $parameterValue merupakan nilai parameter yang dikirimkan.
	 *
	 * @return
	 */
	public function getNotValidParameterMessage($parameterValue)
	{
		return sprintf($this->notValidParameter , $parameterValue);
	}

    /**
     * IndonesiaLang::getHasNoPermissionErrorMessage()
     *
     * @return
     */
    public function getHasNoPermissionErrorMessage()
    {
        return $this->hasNoPermissionErrorMessage;
    }

    /**
     * IndonesiaLang::getExpiredPromoErrorMessage()
     *
     * @return
     */
    public function getExpiredPromoErrorMessage($field)
    {
        return sprintf($this->expiredPromoErrorMessage, ucfirst($field));
    }

	public function getNotValidEmail($field)
	{
		return sprintf($this->notValidEmail, ucfirst($field));
	}

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getHasDefaultValueErrorMessage($field, $defaultValue)
    {
        return sprintf($this->hasDefaultValueErrorMessage, ucfirst($field), $defaultValue);
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getStartWithLetterErrorMessage($field)
    {
        return sprintf($this->startWithLetterErrorMessage, ucfirst($field));
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getHasRegisteredMessage($field)
    {
        return sprintf($this->hasRegisteredMessage, ucfirst($field));
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getNotEqualErrorMessage($field1, $field2)
    {
        return sprintf($this->notEqualErrorMessage, ucfirst($field1), $field2);
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getMinLengthErrorMessage($field, $min)
    {
        return sprintf($this->minLengthErrorMessage, ucfirst($field), $min);
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getIsDigitErrorMessage($field)
    {
        return sprintf($this->isDigitErrorMessage, ucfirst($field));
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getMaxLengthErrorMessage($field, $max)
    {
        return sprintf($this->maxLengthErrorMessage, ucfirst($field), $max);
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getBetweenErrorMessage($field, $min, $max)
    {
        return sprintf($this->betweenErrorMessage, ucfirst($field), $min, $max);
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getInputErrorMessage($field)
    {
        return sprintf($this->inputErrorMessage, $field);
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getRequiredErrorMessage($field)
    {
        return sprintf($this->requiredErrorMessage, ucfirst($field));
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getNotValidErrorMessage($field, $example = '')
    {
        return sprintf($this->notValidErrorMessage, $field, $example);
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getNotLoggedInErrorMessage()
    {
        return $this->notLoggedInErrorMessage;
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getLoggedInErrorMessage()
    {
        return $this->loggedInErrorMessage;
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getBannedErrorMessage()
    {
        return $this->bannedErrorMessage;
    }

    /**
     * RootLang::getIsNotAvailableErrorMessage()
     *
     * @param mixed $p
     * @return
     */
    public function getIsNotAvailableErrorMessage($field)
    {
        return sprintf($this->isNotAvailableErrorMessage, $field, $field);
    }

    /**
     * IndonesiaLang::getInternalErrorMessage()
     *
     * @return
     */
    public function getInternalErrorMessage()
    {
        return $this->internalErrorMessage;
    }

    public function getIsNotFoundErrorMessage($table, $key, $value)
    {
        return sprintf($this->notFoundDataErrorMessage, $table, $key, $value);
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getMinimalNominalErrorMessage($field, $min)
    {
        return sprintf($this->minimalNominalErrorMessage, ucfirst($field), $min);
    }


    /**
     * IndonesiaLang::getHasTokiCreatedErrorMessage()
     *
     * @return
     */
    public function getHasTokiCreatedErrorMessage()
    {
        return $this->hasTokiCreatedErrorMessage;
    }

    public function getHasNoTokiCreatedErrorMessage()
    {
        return $this->hasNoTokiCreatedErrorMessage;
    }


    /**
     * IndonesiaLang::getDeletedSuccessMessage()
     *
     * @return
     */
    public function getDeletedSuccessMessage($table, $key, $value)
    {
        return sprintf($this->deletedSuccessMessage, $table, $key, $value);
    }

	/**
	 * fungsi ini digunakan untuk mengembalikan pesan message perubahan status banned
	 *
	 * @param string $table merupakan nama table
	 * @param string $key merupakan field table kunci
	 * @param string $value merupakan nilai field kunci
	 * @param string $field merupakan field yang dirubah
	 * @param string $statusAwal merupakan status awal
	 * @param string $statusAkhir merupakan status akhir
	 *
	 * @return
	 */
	public function getStatusChange(  $statusAwal, $statusAkhir )
	{
		return sprintf($this->statusChange , $statusAwal , $statusAkhir);
	}


    /**
     * IndonesiaLang::getInsertSuccessMessage()
     *
     * @return
     */
    public function getInsertSuccessMessage()
    {
        return $this->insertSuccessMessage;
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getUpdateSuccessMessage()
    {
        return $this->updateSuccessMessage;
    }

    /**
     * RootLang::getDuplicateErrorMessage()
     *
     * @param mixed $p
     * @return
     */
    public function getDuplicateErrorMessage($field)
    {
        return sprintf($this->hasDuplicateErrorMessage, $field);
    }
}