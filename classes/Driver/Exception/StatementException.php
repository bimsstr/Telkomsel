<?php

namespace Driver\Exception;

use RuntimeException;

class StatementException extends RuntimeException
{
    protected $mysqlErrorMessage;

    protected $sqlstate;

    protected $query;

    protected $params;

    public function __construct(
        $message,
        $mysqlErrorCode,
        $mysqlErrorMessage,
        $sqlstate,
        $query,
        array $params
    )
    {
        parent::__construct($message, $mysqlErrorCode);
        $this->mysqlErrorMessage = $mysqlErrorMessage;
        $this->sqlstate = $sqlstate;
        $this->query = $query;
        $this->params = $params;
        $this->initialize();
    }

    public function getMysqlErrorMessage()
    {
        return $this->mysqlErrorMessage;
    }

    public function getSqlstate()
    {
        return $this->sqlstate;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getParams()
    {
        return $this->params;
    }

    protected function initialize()
    {

    }
}