<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\HomeTitleDomain;

class HomeTitleDataSource extends RootDataSource
{
    public function insert(HomeTitleDomain $hometitleDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_title
                VALUES(
                    :id,
                    :imageTitle,
                    :subtitle,
                    :videoUrl,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $hometitleDomain->getId(),
                ':imageTitle' => $hometitleDomain->getImageTitle(),
                ':subtitle' => $hometitleDomain->getSubtitle(),
                ':videoUrl' => $hometitleDomain->getVideoUrl(),
                ':status' => $hometitleDomain->getStatus()
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

    public function getAllHomeTitleDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = 'WHERE id LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_title
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
        ));

        $result['jumlahData'] = 0;
        $result['hometitleDomainArray'] = array();
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
                home_title
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
            $result['hometitleDomainArray'][] = $this->instantiateHomeTitleDomain($row);
        }

        return $result;
    }

    public function getAllHomeTitleDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_title
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
            $result[] = $this->instantiateHomeTitleDomain($row);
        }
        return $result;
    }
    
    public function getHomeTitleDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_title
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

        return $this->instantiateHomeTitleDomain($row);
    }
    
    public function update(HomeTitleDomain $hometitleDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }
        try{
            $statement = $this->mysqli->buildStatement('
                UPDATE home_title SET
                    image_title = :imageTitle,
                    subtitle = :subtitle,
                    video_url = :videoUrl,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $hometitleDomain->getId(),
                ':imageTitle' => $hometitleDomain->getImageTitle(),
                ':subtitle' => $hometitleDomain->getSubtitle(),
                ':videoUrl' => $hometitleDomain->getVideoUrl(),
                ':status' => $hometitleDomain->getStatus()
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
                    home_title
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

    private function instantiateHomeTitleDomain(array $row)
    {
        $hometitleDomain = new HomeTitleDomain(
            $row['id'],
            $row['image_title'],
            $row['subtitle'],
            $row['video_url'],
            $row['status']
        );

        return $hometitleDomain;
    }
}
