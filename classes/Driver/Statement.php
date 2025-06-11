<?php

namespace Driver;

use MySQLi as MySQLi_Parent,
    MySQLi_Result,
    MySQLi_STMT,
    RuntimeException,
    Driver\Exception\StatementException,
    Driver\Exception\DuplicateKeyException;

class Statement extends MySQLi_STMT
{
    protected $query;

    protected $placeholders;

    protected $blobParams;

    protected $hasResultSet;

    protected $paramTypes;

    protected $params;

    protected $paramsReferences;

    protected $resultRow;

    protected $resultRowReferences;

    public function __construct(MySQLi_Parent $mysqli, $query, array $placeholders = array())
    {
        parent::__construct($mysqli, $query);

        if (isset($this->error) AND !empty($this->error))
        {
            throw new RuntimeException("Statement error in instantiating. Error number #{$this->errno} with the message '{$this->error}', query after transformation is '$query'.");
        }

        $this->query = $query;
        $this->placeholders = $placeholders;
        $this->blobParams = array();
        $this->validatePlaceholders();
        $resultMetadata = $this->result_metadata();
        $this->hasResultSet = $this->hasResultSet($resultMetadata);
        $this->createParametersArrayAndReferences();
        $this->createResultRowArrayAndReferences($resultMetadata);
        $this->bindResultRowArrayReferences();
    }

    public function execute(array $params = array())
    {
        if (!empty($params))
        {
            $this->setAndBindParameters($params);
        }

        $result = parent::execute();

        if (!$result)
        {
            $this->throwException();
        }

        return $result;
    }

    public function fetchArray()
    {
        $result = $this->fetch();

        if ($result === TRUE)
        {
            $row = array();

            foreach ($this->resultRow as $content)
            {
                $row[] = $content;
            }

            return $row;
        }

        return $result;
    }

    public function fetchAll()
    {
        $allRows = array();

        while ($row = $this->fetchArray())
        {
            $allRows[] = $row;
        }

        return $allRows;
    }

    public function fetchAssociativeArray()
    {
        $result = $this->fetch();

        if ($result === TRUE)
        {
            $row = array();

            foreach ($this->resultRow as $fieldName => $content)
            {
                $row[$fieldName] = $content;
            }

            return $row;
        }

        return $result;
    }

    public function fetchAllAssociative()
    {
        $allRows = array();

        while ($row = $this->fetchAssociativeArray())
        {
            $allRows[] = $row;
        }

        return $allRows;
    }

    public function fetchObject()
    {
        $result = $this->fetch();

        if ($result === TRUE)
        {
            $row = array();

            foreach ($this->resultRow as $fieldName => $content)
            {
                $row[$fieldName] = $content;
            }

            return (object) $row;
        }

        return $result;
    }

    public function fetchAllObject()
    {
        $allRows = array();

        while ($row = $this->fetchObject())
        {
            $allRows[] = $row;
        }

        return $allRows;
    }

    public function markParamAsBlob($placeholder)
    {
        if (!isset($this->placeholders[$placeholder]))
        {
            throw new RuntimeException("StatementWrapper error in marking parameter as blob. Placeholder '{$placeholder}' is not defined.");
        }

        $this->blob_params[] = $placeholder;
    }

    public function bind_param($args)
    {

    }

    public function bind_result()
    {

    }

    protected function validatePlaceholders()
    {
        $placeholderCount = count($this->placeholders);

        if ($this->param_count != $placeholderCount)
        {
            throw new RuntimeException("Statement error in constructing, fails to prepare the statement. Parameter count ({$this->param_count}) and placeholder count ({$placeholderCount}) does not match.");
        }
    }

    protected function hasResultSet($resultMetadata)
    {
        return (is_object($resultMetadata) AND is_a($resultMetadata, 'MySQLi_Result'));
    }

    protected function createParametersArrayAndReferences()
    {
        $this->paramsReferences = array();
        $this->paramsReferences['types'] = &$this->paramTypes;

        foreach ($this->placeholders as $placeholder)
        {
            $this->params[$placeholder] = NULL;
            $this->paramsReferences[$placeholder] = &$this->params[$placeholder];
        }
    }

    protected function createResultRowArrayAndReferences($resultMetadata)
    {
        if ($this->hasResultSet)
        {
            foreach ($resultMetadata->fetch_fields() as $field)
            {
                $this->resultRow[$field->name] = NULL;
                $this->resultRowReferences[$field->name] = &$this->resultRow[$field->name];
            }
        }
    }

    protected function bindResultRowArrayReferences()
    {
        if ($this->hasResultSet)
        {
            call_user_func_array(array('parent', 'bind_result'), $this->resultRowReferences);
        }
    }

    protected function setAndBindParameters(array $userParams)
    {
        // Ignore method call if we don't have parameters to process
        if ($this->param_count <= 0)
        {
            return;
        }

        foreach ($this->params as $placeholder => $param)
        {
            if (!array_key_exists($placeholder, $userParams))
            {
                throw new RuntimeException("Statement error when setting and binding parameters. Required parameter '{$placeholder}' is not defined when trying to set parameter.");
            }

            $this->params[$placeholder] = $userParams[$placeholder];
        }

        $this->createParamTypeString();
        call_user_func_array(array('parent', 'bind_param'), $this->paramsReferences);
    }

    protected function createParamTypeString()
    {
        $this->paramsReferences['types'] = '';

        foreach ($this->params as $placeholder => $param)
        {
            if (in_array($placeholder, $this->blobParams))
            {
                $this->paramsReferences['types'] .= 'b';
            }
            else if (is_integer($param))
            {
                $this->paramsReferences['types'] .= 'i';
            }
            else if (is_float($param))
            {
                $this->paramsReferences['types'] .= 'd';
            }
            else
            {
                $this->paramsReferences['types'] .= 's';
            }
        }
    }

    protected function throwException()
    {
        $message = 'Statement execution error. Error code: #'. $this->errno
                 . '. Error message: '. $this->error;

        if ($this->errno == '1062')
        {
            throw new DuplicateKeyException(
                $message,
                $this->errno,
                $this->error,
                $this->sqlstate,
                $this->query,
                $this->params
            );
        }

        throw new StatementException(
            $message,
            $this->errno,
            $this->error,
            $this->sqlstate,
            $this->query,
            $this->params
        );
    }
}