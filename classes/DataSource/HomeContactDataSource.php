<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\HomeContactDomain;

class HomeContactDataSource extends RootDataSource
{
    public function insert(HomeContactDomain $homecontactDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_contact
                VALUES(
                    :id,
                    :logo,
                    :description,
                    :address,
                    :telephone,
                    :email,
                    :fbUrl,
                    :fbStatus,
                    :igUrl,
                    :igStatus,
                    :twitterUrl,
                    :twitterStatus,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homecontactDomain->getId(),
                ':logo' => $homecontactDomain->getLogo(),
                ':description' => $homecontactDomain->getDescription(),
                ':address' => $homecontactDomain->getAddress(),
                ':telephone' => $homecontactDomain->getTelephone(),
                ':email' => $homecontactDomain->getEmail(),
                ':fbUrl' => $homecontactDomain->getFbUrl(),
                ':fbStatus' => $homecontactDomain->getFbStatus(),
                ':igUrl' => $homecontactDomain->getIgUrl(),
                ':igStatus' => $homecontactDomain->getIgStatus(),
                ':twitterUrl' => $homecontactDomain->getTwitterUrl(),
                ':twitterStatus' => $homecontactDomain->getTwitterStatus(),
                ':createdDate' => $homecontactDomain->getCreatedDate(),
                ':status' => $homecontactDomain->getStatus()
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

    public function getAllHomeContactDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE status LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_contact
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homecontactDomainArray'] = array();
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
                home_contact
            '.$where.'
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
            $result['homecontactDomainArray'][] = $this->instantiateHomeContactDomain($row);
        }
        return $result;
    }

    public function getAllHomeContactDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_contact
                '.$where.'
                order by id DESC
                LIMIT 1
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateHomeContactDomain($row);
        }
        return $result;
    }

    public function getHomeContactDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_contact
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

        return $this->instantiateHomeContactDomain($row);
    }


    public function update(HomeContactDomain $homecontactDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
             $statement = $this->mysqli->buildStatement('
                UPDATE home_contact SET
                    logo = :logo,
                    description = :description,
                    address = :address,
                    telephone = :telephone,
                    email = :email,
                    fb_url = :fbUrl,
                    fb_status = :fbStatus,
                    ig_url = :igUrl,
                    ig_status = :igStatus,
                    twitter_url = :twitterUrl,
                    twitter_status = :twitterStatus,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homecontactDomain->getId(),
                ':logo' => $homecontactDomain->getLogo(),
                ':description' => $homecontactDomain->getDescription(),
                ':address' => $homecontactDomain->getAddress(),
                ':telephone' => $homecontactDomain->getTelephone(),
                ':email' => $homecontactDomain->getEmail(),
                ':fbUrl' => $homecontactDomain->getFbUrl(),
                ':fbStatus' => $homecontactDomain->getFbStatus(),
                ':igUrl' => $homecontactDomain->getIgUrl(),
                ':igStatus' => $homecontactDomain->getIgStatus(),
                ':twitterUrl' => $homecontactDomain->getTwitterUrl(),
                ':twitterStatus' => $homecontactDomain->getTwitterStatus(),
                ':createdDate' => $homecontactDomain->getCreatedDate(),
                ':status' => $homecontactDomain->getStatus()
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
                    home_contact
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

    private function instantiateHomeContactDomain(array $row)
    {
         $homecontactDomain = new HomeContactDomain(
            $row['id'],
            $row['logo'],
            $row['description'],
            $row['address'],
            $row['telephone'],
            $row['email'],
            $row['fb_url'],
            $row['fb_status'],
            $row['ig_url'],
            $row['ig_status'],
            $row['twitter_url'],
            $row['twitter_status'],
            $row['created_date'],
            $row['status']
        );

        return $homecontactDomain;
    }
}
