<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Domain\MysqlErrorDomain;

class MysqlErrorDataSource
{
    /**
     * @var
     */
    private $mysqli;

    /**
     * Melakukan
     *
     * @param
     * @return
     */
    function __construct(MySQLi $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function getMysqlErrorDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                mysql_error
            WHERE
                id = :id
            LIMIT 1
        ');
        $statement->execute(array(
            ':id' => $id
        ));
        $row = $statement->fetchAssociativeArray();
        $statement->close();

        if (!is_array($row))
        {
            return FALSE;
        }

        return $this->instantiateMysqlErrorDomain($row);
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function insert(MysqlErrorDomain $mysqlErrorDomain)
    {
        $this->mysqli->query('START TRANSACTION');
        $statement = $this->mysqli->buildStatement('
            INSERT
                mysql_error
            VALUES(
                :id,
                :createdDate,
                :kode,
                :pesan,
                :query,
                :param,
                :status,
                :solvedDate
            )
        ');
        $statement->execute(array(
            ':id' => $mysqlErrorDomain->getId(),
            ':createdDate' => $mysqlErrorDomain->getCreatedDate()->format('Y-m-d H:i:s'),
            ':kode' => $mysqlErrorDomain->getKode(),
            ':pesan' => $mysqlErrorDomain->getPesan(),
            ':query' => $mysqlErrorDomain->getQuery(),
            ':param' => $mysqlErrorDomain->getParam(),
            ':status' => $mysqlErrorDomain->getStatus(),
            ':solvedDate' => $mysqlErrorDomain->getSolvedDate()
        ));
        $this->mysqli->commit();
    }

    /**
     * CounterDataSource::instantiateCounterDomain()
     *
     * @param mixed $row
     * @return
     */
    private function instantiateMysqlErrorDomain(array $row)
    {
        $solvedDate = empty($row['solved_date']) ? NULL : new DateTime($row['solved_date']);

        $mysqlErrorDomain = new MysqlErrorDomain(
            $row['id'],
            new DateTime($row['created_date']),
            $row['kode'],
            $row['pesan'],
            $row['query'],
            $row['param'],
            $row['status'],
            $solvedDate
        );

        return $mysqlErrorDomain;
    }

    /**
     * MysqlErrorDataSource::update()
     *
     * @param mixed $mysqlErrorDomain
     * @return
     */
    public function update(MysqlErrorDomain $mysqlErrorDomain)
    {
        $statement = $this->mysqli->buildStatement('
            UPDATE
                mysql_error
            SET
                status = :status,
                solved_date = :solvedDate
            WHERE
                id = :id
        ');
        $statement->execute(array(
            ':id' => $mysqlErrorDomain->getId(),
            ':status' => $mysqlErrorDomain->getStatus(),
            ':solvedDate' => $mysqlErrorDomain->getSolvedDate()->format('Y-m-d H:i:s')
        ));

        return TRUE;
    }

    /**
     * MysqlErrorDataSource::getAllMysqlErrorNotSolveDomain()
     *
     * @param mixed $p
     * @param mixed $this
     * @return
     */
    public function getAllMysqlErrorDomain($limit, $offset)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
            	count(id) as jumlahData
            FROM
            	mysql_error
        ');
        $statement->execute();

        $result['jumlahData'] = 0;
        $result['mysqlErrorDomainArray'] = array();
        $row = $statement->fetchAssociativeArray();

        if ($row['jumlahData'] == 0)
        {
            return $result;
        }

        $result['jumlahData'] = $row['jumlahData'];
        $statement->close();

        $statement = $this->mysqli->buildStatement('
            SELECT
            	*
            FROM
            	mysql_error
            ORDER BY
                status ASC
            LIMIT
                :limit, :offset
        ');
        $statement->execute(array(
            ':limit' => $limit,
            ':offset' => $offset
        ));

        $rows = $statement->fetchAllAssociative();

        $statement->close();

        foreach ($rows as $row)
        {
            $result['mysqlErrorDomainArray'][] = $this->instantiateMysqlErrorDomain($row);
        }

        return $result;
    }

    /**
     * MysqlErrorDataSource::deleteById()
     *
     * @param mixed $id
     * @return
     */
    public function deleteById($id)
    {
        $statement = $this->mysqli->buildStatement('
            DELETE FROM
                mysql_error
            WHERE
                id = :id
            LIMIT 1
        ');
        $statement->execute(array(
            ':id' => $id
        ));
        $statement->close();

        return TRUE;
    }
}
