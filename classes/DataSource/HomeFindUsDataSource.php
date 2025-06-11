<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\HomeFindUsDomain;
    // Domain\HomePackageDetailDomain;

class HomeFindUsDataSource extends RootDataSource
{
    public function insert(HomeFindUsDomain $homefindusDomain)
    {
        try
        {
             $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_find_us
                VALUES(
                    :id,
                    :title,
                    :description,
                    :appstore,
                    :playstore,
                    :image,
                    :imageBackground,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homefindusDomain->getId(),
                ':title' => $homefindusDomain->getTitle(),
                ':description' => $homefindusDomain->getDescription(),
                ':appstore' => $homefindusDomain->getAppstore(),
                ':playstore' => $homefindusDomain->getPlaystore(),
                ':image' => $homefindusDomain->getImage(),
                ':imageBackground' => $homefindusDomain->getImageBackground(),
                ':createdDate' => $homefindusDomain->getCreatedDate(),
                ':status' => $homefindusDomain->getStatus()
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

    public function getAllHomeFindUsDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE status LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_find_us
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homefindusDomainArray'] = array();
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
                home_find_us
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
            $result['homefindusDomainArray'][] = $this->instantiateHomeFindUsDomain($row);
        }
        return $result;
    }

    public function getAllHomeFindUsDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_find_us
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
            $result[] = $this->instantiateHomeFindUsDomain($row);
        }
        return $result;
    }

    public function getHomeFindUsDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_find_us
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

        return $this->instantiateHomeFindUsDomain($row);
    }


    public function update(HomeFindUsDomain $homefindusDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_find_us SET
                    title = :title,
                    description = :description,
                    appstore = :appstore,
                    playstore = :playstore,
                    image = :image,
                    image_background = :imageBackground,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homefindusDomain->getId(),
                ':title' => $homefindusDomain->getTitle(),
                ':description' => $homefindusDomain->getDescription(),
                ':appstore' => $homefindusDomain->getAppstore(),
                ':playstore' => $homefindusDomain->getPlaystore(),
                ':image' => $homefindusDomain->getImage(),
                ':imageBackground' => $homefindusDomain->getImageBackground(),
                ':createdDate' => $homefindusDomain->getCreatedDate(),
                ':status' => $homefindusDomain->getStatus()
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
                    home_find_us
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

    private function instantiateHomeFindUsDomain(array $row)
    {
         $homefindusDomain = new HomeFindUsDomain(
            $row['id'],
            $row['title'],
            $row['description'],
            $row['appstore'],
            $row['playstore'],
            $row['image'],
            $row['image_background'],
            $row['created_date'],
            $row['status']
        );

        return $homefindusDomain;
    }
}
