<?php

namespace Lang;

class EnglishLang extends RootLang
{
    public function __construct($urlBuilder)
    {
        // ERROR MESSAGE
        $this->notValidEmail = '%s not valid email!';
        $this->requiredErrorMessage = '%s required!';
        $this->notValidErrorMessage = 'Format %s not valid! %s';
        $this->notEqualErrorMessage = '%s and %s not equal!';
        $this->minLengthErrorMessage = '%s minimal %s character!';
        $this->maxLengthErrorMessage = '%s maximal %s character!';
        $this->betweenErrorMessage = '%s value must be between %s and %s!';
        $this->inputErrorMessage = 'Wrong input %s!';
        $this->hasRegisteredMessage = '%s already registered! Please login <a href="'.$urlBuilder->build('member/login').'" style="color:#fff;text-shadow: 0px 1px 0px #96221a;">here</a>';
        $this->startWithLetterErrorMessage = '%s must start with letter!';
        $this->isDigitErrorMessage = 'Input %s must be number!';
        $this->isAlphaNumericErrorMessage = 'Input %s must be letter and number!';
        $this->hasDefaultValueErrorMessage = '%s required! give %s value if empty.';
        $this->expiredPromoErrorMessage = '%s not found, expired, or exceed maximum use!';
        $this->notLoggedInErrorMessage = 'Sorry, You can\'t access this page.!';
        $this->bannedErrorMessage = 'Sorry, Your member status can\'t be use!';
        $this->loggedInErrorMessage = 'Sorry, You must logged in to access this page!';
        $this->isNotAvailableErrorMessage = 'Sorry, %s already used. Please using another %s.';
        $this->internalErrorMessage = 'Sorry for the inconvenience, there is internal error.';
        $this->notFoundDataErrorMessage = 'Can\'t find %s in %s with value %s!';
        $this->minimalNominalErrorMessage = '%s minimum is %s!';
        $this->hasNoPermissionErrorMessage = 'You don\'t have privilege to access this page!';
        $this->hasDuplicateErrorMessage = '%s duplicated!';
        $this->notValidParameter = 'Parameter %i is not valid for this page!';
        $this->notValidSelectBox = 'Please choose %s from available select box!';
        $this->notEnoughSaldo = 'Saldo not enough to do transaction!';
        $this->notValidSerializeInput = 'There is %s not complete! Please try again.';
        $this->alreadyRegistered = '%s already registered on class %s';
        $this->expiredSchedule = 'Time has elapsed..';

    	$this->usernameRegistered = 'Username %s already registered!';
    	$this->emailRegistered = 'Email %s already registered!';
    	$this->exceedDownlineNumber = 'You can\'t create any downline again, please contact admin.';
    	$this->exceedShareDownlineNumber = 'You can\'t give %s for your new downline, please contact admin';

        $this->notValidFinger = 'Fingerprint not valid..!';

        $this->statusChange = 'Data %s changed into %s ';
    	$this->dateBackSmallerErrorMessage = 'Return date must be after your departure date..';
    	$this->flightNotSet = 'Please choose your flight..';
    	$this->confirmOrder = 'You already filled passengers data, please continue the process or cancel by pressing cancel button..';
		$this->bookingErrorMessage = 'Error on booking process, please re-process';
    	$this->bookingSuccessMessage = 'Booking successfull, please issued ticket immediately.';
    	$this->dateNotValidMessage = 'Minimum date to $s is today.';

    	$this->issuedNotPrivilege = 'Your account not allowed to do issuedm please contact your agent.';
		$this->issuedNotPermitted = 'Your account not allowed to do issued in this ticket.';
    	$this->insufficientBalance = 'Your balance is insufficient to do issued in this ticket.';
        $this->issuedError = 'Issued Failed, Please contact admin to clear this problem.';
    	$this->issuedSuccess = 'Issued Succeed, you can follow up this issued ticket.';

        $this->downloadTicketNotPermited = 'Anda tidak diperbolehkan mendownload tiket ini.';

        // SUCCESS
        $this->deletedSuccessMessage = 'Data %s for %s with value %s deleted!';
        $this->insertSuccessMessage = 'Data saved!';
        $this->updateSuccessMessage = 'Data edited!';
        $this->registerFingerSuccess = 'Fingerprint %s registered! ';
    }
}