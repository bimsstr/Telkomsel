<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\MessageDomain;

class MessageDataSource extends RootDataSource
{
    public function insert(MessageDomain $messageDomain)
    {
        try
        {
             $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    message
                VALUES(
                    :id,
                    :name,
                    :phone,
                    :email,
                    :title,
                    :message,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $messageDomain->getId(),
                ':name' => $messageDomain->getName(),
                ':phone' => $messageDomain->getPhone(),
                ':email' => $messageDomain->getEmail(),
                ':title' => $messageDomain->getTitle(),
                ':message' => $messageDomain->getMessage(),
                ':createdDate' => $messageDomain->getCreatedDate(),
                ':status' => $messageDomain->getStatus()
            ));
            $statement->close();

            if ($withTransaction)
            {
                $this->mysqli->commit();
            }
            return TRUE;
        }
        catch (StatementException $exception)
        {
            if ($this->isInDevelopment())
            {
                echo '<pre>', var_dump($exception), '</pre>';exit;
            }
            else
            {
                $this->insertError($exception);
            }

            return FALSE;
        }
    }

    public function getAllMessageDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE id LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                message
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['messageDomainArray'] = array();
        $row = $statement->fetchAssociativeArray();
        $statement->close();

        if ($row['jumlahData'] == 0)
        {
            return $result;
        }

        $result['jumlahData'] = $row['jumlahData'];

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                message
            '.$where.'
            ORDER BY ID DESC
            LIMIT
                :limit, :offset
        ');
        $statement->execute(array(
            ':limit' => $limit,
            ':offset' => $offset,
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result['messageDomainArray'][] = $this->instantiateMessageDomain($row);
        }
        return $result;
    }

    public function getAllMessageDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                message
                '.$where.'
                order by id DESC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['category']]))){

                $result[$row['category']] = array();
            }

            $result[$row['category']][] = $this->instantiateMessageDomain($row);
        }
        return $result;
    }

    public function getMessageDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                message
            WHERE
                id = :id
        ');
        $statement->execute(array(
            ':id' => $id
        ));
        $row = $statement->fetchAssociativeArray();

        $statement->close();

        if (!(is_array($row)))
        {
            return FALSE;
        }

        return $this->instantiateMessageDomain($row);
    }


    public function update(MessageDomain $messageDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE message SET
                    name = :name,
                    phone = :phone,
                    email = :email,
                    title = :title,
                    message = :message,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $messageDomain->getId(),
                ':name' => $messageDomain->getName(),
                ':phone' => $messageDomain->getPhone(),
                ':email' => $messageDomain->getEmail(),
                ':title' => $messageDomain->getTitle(),
                ':message' => $messageDomain->getMessage(),
                ':createdDate' => $messageDomain->getCreatedDate(),
                ':status' => $messageDomain->getStatus()
            ));
            $statement->close();

            if ($withTransaction)
            {
                $this->mysqli->commit();
            }

            return TRUE;
        }
        catch (StatementException $exception)
        {
            if ($this->isInDevelopment())
            {
                echo '<pre>', var_dump($exception), '</pre>';exit;
            }
            else
            {
                $this->insertError($exception);
            }

            return FALSE;
        }
    }



    public function deleteById($id)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                DELETE FROM
                    message
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $id
            ));
            $statement->close();

            return TRUE;
        }
        catch (StatementException $exception)
        {
            if ($this->isInDevelopment())
            {
                echo '<pre>', var_dump($exception), '</pre>';exit;
            }
            else
            {
                $this->insertError($exception);
            }

            return FALSE;
        }
    }

    private function instantiateMessageDomain(array $row)
    {
         $messageDomain = new MessageDomain(
            $row['id'],
            $row['name'],
            $row['phone'],
            $row['email'],
            $row['title'],
            $row['message'],
            $row['created_date'],
            $row['status']
        );

        return $messageDomain;
    }

    public function update_status(MessageDomain $messageDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE message SET
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $messageDomain->getId(),
                ':status' => $messageDomain->getStatus()
            ));
            $statement->close();

            if ($withTransaction)
            {
                $this->mysqli->commit();
            }

            return TRUE;
        }
        catch (StatementException $exception)
        {
            if ($this->isInDevelopment())
            {
                echo '<pre>', var_dump($exception), '</pre>';exit;
            }
            else
            {
                $this->insertError($exception);
            }

            return FALSE;
        }
    }

    public function countUnreadEmail()
    {
        $status = 'unread';
        $where = 'WHERE status = "'.$status.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                message
            '.$where.'
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $result['jumlahData'] = 0;
        $row = $statement->fetchAssociativeArray();
        $statement->close();

        return $row['jumlahData'];
    }
}
