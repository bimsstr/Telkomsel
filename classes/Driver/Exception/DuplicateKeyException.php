<?php

namespace Driver\Exception;

class DuplicateKeyException extends StatementException
{
    protected $duplicateKeyName = '';

    protected $duplicateValue;

    public function getDuplicateKeyName()
    {
        return $this->duplicateKeyName;
    }

    public function getDuplicateValue()
    {
        return $this->duplicateValue;
    }

    protected function initialize()
    {
        $result = preg_match_all(
            '/^Duplicate entry \'(.+)\' for key \'(.+)\'$/',
            $this->mysqlErrorMessage,
            $matches
        );

        if ($result >= 1)
        {
            $this->duplicateValue = $matches[1][0];
            $this->duplicateKeyName = $matches[2][0];
        }
    }
}