<?php

namespace Utilities;

class ValidationErrors
{
    protected $errors = array();

    public function __construct(array $errors = array())
    {
        $this->mergeWithArray($errors);
    }

    public function add($fieldName, $errorMessage)
    {
        $this->errors[$fieldName][] = $errorMessage;
    }

    public function hasError()
    {
        return (!empty($this->errors));
    }

    public function clear()
    {
        $this->errors = array();
    }

    public function get($fieldName)
    {

        if (array_key_exists($fieldName, $this->errors) == FALSE)
        {
            return array();
        }

        return $this->errors[$fieldName];
    }

    public function getAll()
    {
        return $this->errors;
    }

    public function merge(ValidationErrors $validationErrors)
    {
        $errors = $validationErrors->getAll();
        $this->mergeWithArray($errors);
    }

    protected function mergeWithArray(array $errors)
    {
        foreach ($errors as $fieldName => $errorMessages)
        {
            if (array_key_exists($fieldName, $this->errors) == FALSE)
            {
                $this->errors[$fieldName] = $errorMessages;
                continue;
            }

            foreach ($errorMessages as $message)
            {
                if (in_array($message, $this->errors[$fieldName]) == FALSE)
                {
                    $this->errors[] = $message;
                }
            }
        }
    }
}