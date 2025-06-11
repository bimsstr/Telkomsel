<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\HomePartnerDomain;
    // Domain\HomePackageDetailDomain;

class HomePartnerDataSource extends RootDataSource
{
    public function insert(HomePartnerDomain $homepartnerDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_partner
                VALUES(
                    :id,
                    :image,
                    :description,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homepartnerDomain->getId(),
                ':image' => $homepartnerDomain->getImage(),
                ':description' => $homepartnerDomain->getDescription(),
                ':createdDate' => $homepartnerDomain->getCreatedDate(),
                ':status' => $homepartnerDomain->getStatus()
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

    public function getAllHomePartnerDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE status LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_partner
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homepartnerDomainArray'] = array();
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
                home_partner
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
            $result['homepartnerDomainArray'][] = $this->instantiateHomePartnerDomain($row);
        }
        return $result;
    }

    public function getAllHomePartnerDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_partner
                '.$where.'
                order by id ASC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateHomePartnerDomain($row);
        }
        return $result;
    }

    public function getHomePartnerDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_partner
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

        return $this->instantiateHomePartnerDomain($row);
    }


    public function update(HomePartnerDomain $homepartnerDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_partner SET
                    image = :image,
                    description = :description,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homepartnerDomain->getId(),
                ':image' => $homepartnerDomain->getImage(),
                ':description' => $homepartnerDomain->getDescription(),
                ':createdDate' => $homepartnerDomain->getCreatedDate(),
                ':status' => $homepartnerDomain->getStatus()
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
                    home_partner
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

    private function instantiateHomePartnerDomain(array $row)
    {
         $homepartnerDomain = new HomePartnerDomain(
            $row['id'],
            $row['image'],
            $row['description'],
            $row['created_date'],
            $row['status']
        );

        return $homepartnerDomain;
    }
}
