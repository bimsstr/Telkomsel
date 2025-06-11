<?php

namespace Validation;

use Utilities\ValidationErrors,
    Lang\RootLang;

class RootValidation
{
    protected $validationErrors;

    protected $lang;

    public function __construct(
        RootLang $lang
    )
    {
        $this->validationErrors = new ValidationErrors();
        $this->lang = $lang;
    }

    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

    public function clear()
    {
        $this->validationErrors->clear();
    }

    protected function isNotEmpty($param)
    {
        if (is_string($param))
        {
            $param = trim($param);

            if ($param == '')
            {
                return FALSE;
            }

            return TRUE;
        }

        return TRUE;
    }

    protected function hasMinimumLength($param, $minimumLength)
    {
        if (strlen($param) < $minimumLength)
        {
            return FALSE;
        }

        return TRUE;
    }

    protected function hasMaximumLength($param, $maximumLength)
    {
        if (strlen($param) > $maximumLength)
        {
            return FALSE;
        }

        return TRUE;
    }

    protected function lengthInBetween($param, $minimumLength, $maximumLength)
    {
        $length = strlen($param);

        if ($length < $minimumLength || $length > $maximumLength)
        {
            return FALSE;
        }

        return TRUE;
    }

    protected function isEmail($email)
    {
        $result = filter_var($email, FILTER_VALIDATE_EMAIL);
        return !($result === FALSE);
    }

    protected function startsWithLetters($param)
    {
        if (strlen($param) < 1)
        {
            return FALSE;
        }

        $firstLetter = $param{0};
        return ctype_alpha($firstLetter);
    }

    protected function isAlphaNumeric($param)
    {
        return ctype_alnum($param);
    }

    protected function isValidDate($param)
    {
        if (!preg_match('/[0-9]{2}-[0-9]{2}-[0-9]{4}/', $param))
        {
            return FALSE;
        }
        list($d,$m,$y) = explode('-',$param);
        return checkdate($m,$d,$y);
    }

    protected function isDigit($param)
    {
        $param = (string)$param;
        return ctype_digit($param);
    }

    protected function isLowerCase($param)
    {
        return ctype_lower($param);
    }

    protected function startsWith($param, $startsWith)
    {
        if (strlen($param) < 1)
        {
            return FALSE;
        }

        $firstLetter = $param{0};
        return ($firstLetter == $startsWith);
    }
}
