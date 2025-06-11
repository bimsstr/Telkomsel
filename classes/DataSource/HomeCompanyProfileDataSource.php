<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\HomeCompanyProfileDomain;

class HomeCompanyProfileDataSource extends RootDataSource
{
    public function insert(HomeCompanyProfileDomain $homecompanyprofileDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_company_profile
                VALUES(
                    :id,
                    :title,
                    :subtitle,
                    :description,
                    :youtubeChannel,
                    :youtubeUrl,
                    :image,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homecompanyprofileDomain->getId(),
                ':title' => $homecompanyprofileDomain->getTitle(),
                ':subtitle' => $homecompanyprofileDomain->getSubtitle(),
                ':description' => $homecompanyprofileDomain->getDescription(),
                ':youtubeChannel' => $homecompanyprofileDomain->getYoutubeChannel(),
                ':youtubeUrl' => $homecompanyprofileDomain->getYoutubeUrl(),
                ':image' => $homecompanyprofileDomain->getImage(),
                ':createdDate' => $homecompanyprofileDomain->getCreatedDate(),
                ':status' => $homecompanyprofileDomain->getStatus()
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

    public function getAllHomeCompanyProfileDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE status LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_company_profile
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homecompanyprofileDomainArray'] = array();
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
                home_company_profile
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
            $result['homecompanyprofileDomainArray'][] = $this->instantiateHomeCompanyProfileDomain($row);
        }
        return $result;
    }

    public function getAllHomeCompanyProfileDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_company_profile
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
            $result[] = $this->instantiateHomeCompanyProfileDomain($row);
        }
        return $result;
    }

    public function getHomeCompanyProfileDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_company_profile
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

        return $this->instantiateHomeCompanyProfileDomain($row);
    }


    public function update(HomeCompanyProfileDomain $homecompanyprofileDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_company_profile SET
                    title = :title,
                    subtitle = :subtitle,
                    description = :description,
                    youtube_channel = :youtubeChannel,
                    youtube_url = :youtubeUrl,
                    image = :image,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homecompanyprofileDomain->getId(),
                ':title' => $homecompanyprofileDomain->getTitle(),
                ':subtitle' => $homecompanyprofileDomain->getSubtitle(),
                ':description' => $homecompanyprofileDomain->getDescription(),
                ':youtubeChannel' => $homecompanyprofileDomain->getYoutubeChannel(),
                ':youtubeUrl' => $homecompanyprofileDomain->getYoutubeUrl(),
                ':image' => $homecompanyprofileDomain->getImage(),
                ':createdDate' => $homecompanyprofileDomain->getCreatedDate(),
                ':status' => $homecompanyprofileDomain->getStatus()
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
                    home_company_profile
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

    private function instantiateHomeCompanyProfileDomain(array $row)
    {
         $homecompanyprofileDomain = new HomeCompanyProfileDomain(
            $row['id'],
            $row['title'],
            $row['subtitle'],
            $row['description'],
            $row['youtube_channel'],
            $row['youtube_url'],
            $row['image'],
            $row['created_date'],
            $row['status']
        );

        return $homecompanyprofileDomain;
    }
}
