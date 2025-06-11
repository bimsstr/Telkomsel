<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\HomeAboutDomain,
    Domain\HomeAboutDetailDomain;

class HomeAboutDataSource extends RootDataSource
{
    public function insert(HomeAboutDomain $homeaboutDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_about
                VALUES(
                    :id,
                    :bigQuotation,
                    :bigAbout,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homeaboutDomain->getId(),
                ':bigQuotation' => $homeaboutDomain->getBigQuotation(),
                ':bigAbout' => $homeaboutDomain->getBigAbout(),
                ':createdDate' => $homeaboutDomain->getCreatedDate(),
                ':status' => $homeaboutDomain->getStatus()
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

    public function getAllHomeAboutDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE big_quotation LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_about
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homeaboutDomainArray'] = array();
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
                home_about
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
            $result['homeaboutDomainArray'][] = $this->instantiateHomeAboutDomain($row);
        }
        return $result;
    }

    public function getAllHomeAboutDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_about
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
            $result[] = $this->instantiateHomeAboutDomain($row);
        }
        return $result;
    }

    public function getHomeAboutDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_about
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

        return $this->instantiateHomeAboutDomain($row);
    }


    public function update(HomeAboutDomain $homeaboutDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_about SET
                    big_quotation = :bigQuotation,
                    big_about = :bigAbout,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homeaboutDomain->getId(),
                ':bigQuotation' => $homeaboutDomain->getBigQuotation(),
                ':bigAbout' => $homeaboutDomain->getBigAbout(),
                ':createdDate' => $homeaboutDomain->getCreatedDate(),
                ':status' => $homeaboutDomain->getStatus()
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
                    home_about
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

    private function instantiateHomeAboutDomain(array $row)
    {
        $homeaboutDomain = new HomeAboutDomain(
            $row['id'],
            $row['big_quotation'],
            $row['big_about'],
            $row['created_date'],
            $row['status']
        );

        return $homeaboutDomain;
    }

    //HOME ABOUT DETAIL 

    public function insert_had(HomeAboutDetailDomain $homeaboutdetailDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_about_detail
                VALUES(
                    :id,
                    :cardImage,
                    :cardTitle,
                    :cardSubtitle,
                    :cardDescription,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homeaboutdetailDomain->getId(),
                ':cardImage' => $homeaboutdetailDomain->getCardImage(),
                ':cardTitle' => $homeaboutdetailDomain->getCardTitle(),
                ':cardSubtitle' => $homeaboutdetailDomain->getCardSubtitle(),
                ':cardDescription' => $homeaboutdetailDomain->getCardDescription(),
                ':createdDate' => $homeaboutdetailDomain->getCreatedDate(),
                ':status' => $homeaboutdetailDomain->getStatus()
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

     public function getAllHomeAboutDetailDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE status LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_about_detail
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homeaboutdetailDomainArray'] = array();
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
                home_about_detail
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
            $result['homeaboutdetailDomainArray'][] = $this->instantiateHomeAboutDetailDomain($row);
        }
        return $result;
    }

    public function getAllHomeAboutDetailDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_about_detail
                '.$where.'
                order by id ASC
                LIMIT 3
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateHomeAboutDetailDomain($row);
        }
        return $result;
    }

    public function getHomeAboutDetailDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_about_detail
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

        return $this->instantiateHomeAboutDetailDomain($row);
    }

    public function update_had(HomeAboutDetailDomain $homeaboutdetailDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_about_detail SET
                    card_image = :cardImage,
                    card_title = :cardTitle,
                    card_subtitle = :cardSubtitle,
                    card_description = :cardDescription,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homeaboutdetailDomain->getId(),
                ':cardImage' => $homeaboutdetailDomain->getCardImage(),
                ':cardTitle' => $homeaboutdetailDomain->getCardTitle(),
                ':cardSubtitle' => $homeaboutdetailDomain->getCardSubtitle(),
                ':cardDescription' => $homeaboutdetailDomain->getCardDescription(),
                ':createdDate' => $homeaboutdetailDomain->getCreatedDate(),
                ':status' => $homeaboutdetailDomain->getStatus()
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

    public function deletehadById($id)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                DELETE FROM
                    home_about_detail
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

    private function instantiateHomeAboutDetailDomain(array $row)
    {
        $homeaboutdetailDomain = new HomeAboutDetailDomain(
            $row['id'],
            $row['card_image'],
            $row['card_title'],
            $row['card_subtitle'],
            $row['card_description'],
            $row['created_date'],
            $row['status']
        );

        return $homeaboutdetailDomain;
    }
}
