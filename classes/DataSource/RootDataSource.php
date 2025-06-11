<?php

namespace DataSource;

use DateTime,
    Exception,
    RuntimeException,
    Domain\MysqlErrorDomain,
    DataSource\MysqlErrorDataSource,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Driver\Exception\DuplicateKeyException,
    Utilities\ValidationErrors;

class RootDataSource
{
    private $isInDevelopment = TRUE;

    private $defaultDuplicateKeyMessage = '%1$s sudah terdaftar. Silakan gunakan %2$s yang lain.';

    protected $mysqli;

    protected $validationErrors;

    protected $duplicateKeySettings = array();

    /**
     * @var
     */
    private $mysqlErrorDataSource;

    public function __construct(MySQLi $mysqli)
    {
        $this->mysqli = $mysqli;
        $this->validationErrors = new ValidationErrors;
        $this->initialize();

        $this->mysqlErrorDataSource = new MysqlErrorDataSource($this->mysqli);
    }

    protected function generateId($tableName, $prefix)
    {
        $counterDomain = $this->counterDataSource->getCounterDomainByNamaTable($tableName, $prefix);
        if (!($counterDomain instanceof CounterDomain))
        {
            $jumlah = 1;
            $counterDomain = new CounterDomain(
                $tableName,
                $prefix,
                $jumlah
            );

            $this->counterDataSource->insert($counterDomain);
        }
        else
        {
            $counterDomain->addJmlCounter();
            $this->counterDataSource->update($counterDomain);
        }

        return $prefix.str_pad($counterDomain->getJumlah(), 4, '0', STR_PAD_LEFT);
    }

    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

    protected function initialize()
    {

    }

    protected function processStatementException(StatementException $exception, $currentUrl = '')
    {
        if ($exception instanceof DuplicateKeyException)
        {
            $keyName = $exception->getDuplicateKeyName();

            if ($this->hasValidDuplicateKeySetting($keyName))
            {
                $message = sprintf(
                    $this->duplicateKeySettings[$keyName]['message'],
                    $this->duplicateKeySettings[$keyName]['firstWordLabel'],
                    $this->duplicateKeySettings[$keyName]['label']
                );

                $this->validationErrors->add(
                    $this->duplicateKeySettings[$keyName]['fieldName'],
                    $message
                );

                return;
            }

            $className = get_class();
            throw new RuntimeException('Duplicate key error for key name \''. $keyName .'\'. Key name is not registered in \''. $className .'\'. Please edit class file accordingly.'.$currentUrl.'.');
        }
        echo '<pre>', var_dump($exception), '</pre>';exit;
        //throw $exception;
    }

    protected function hasValidDuplicateKeySetting($keyName)
    {
        if (
            array_key_exists($keyName, $this->duplicateKeySettings) == FALSE ||
            is_array($this->duplicateKeySettings[$keyName]) == FALSE ||
            isset($this->duplicateKeySettings[$keyName]['fieldName']) == FALSE ||
            isset($this->duplicateKeySettings[$keyName]['firstWordLabel']) == FALSE ||
            isset($this->duplicateKeySettings[$keyName]['label']) == FALSE
        )
        {
            return FALSE;
        }

        if (isset($this->duplicateKeySettings[$keyName]['message']) == FALSE)
        {
            $this->duplicateKeySettings[$keyName]['message'] = $this->defaultDuplicateKeyMessage;
        }

        return TRUE;
    }

    protected function getDateObject($dateString)
    {
        if (empty($dateString))
        {
            return NULL;
        }

        return new DateTime($dateString);
    }

    protected function formatDateTime(DateTime $dateTime = NULL, $format = 'Y-m-d H:i:s')
    {
        if ($dateTime instanceof DateTime)
        {
            return $dateTime->format($format);
        }

        return NULL;
    }

    protected function curPageURL() {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on")
        {
            $pageURL .= "s";
        }

        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80")
        {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        }
        else
        {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }

        return $pageURL;
    }

    protected function getLastInsertId()
    {
        $result = $this->mysqli->query('SELECT LAST_INSERT_ID() AS id');

        if ($result === FALSE)
        {
            return 0;
        }

        $row = $result->fetch_assoc();
        return $row['id'];
    }

    protected function isInDevelopment()
    {
        return $this->isInDevelopment;
    }

    protected function insertError($exeption)
    {
    	$this->mysqli->rollback();
        $mysqlErrorDomain = new MysqlErrorDomain(
            NULL,
            new DateTime(),
            $exeption->getCode(),
            $exeption->getMessage(),
            $exeption->getQuery(),
            serialize($exeption->getParams()),
            'problem',
            NULL);
        $this->mysqlErrorDataSource->insert($mysqlErrorDomain);
    }
}

?>