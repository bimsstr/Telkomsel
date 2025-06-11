<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\HomeProfilKamiDomain,
    Domain\HomeProfilKamiTitleDomain;

class HomeProfilKamiDataSource extends RootDataSource
{
    public function insert(HomeProfilKamiDomain $homeprofilkamiDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_profil_kami
                VALUES(
                    :id,
                    :description,
                    :visi,
                    :misi,
                    :siup,
                    :ho,
                    :tdp,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homeprofilkamiDomain->getId(),
                ':description' => $homeprofilkamiDomain->getDescription(),
                ':visi' => $homeprofilkamiDomain->getVisi(),
                ':misi' => $homeprofilkamiDomain->getMisi(),
                ':siup' => $homeprofilkamiDomain->getSiup(),
                ':ho' => $homeprofilkamiDomain->getHo(),
                ':tdp' => $homeprofilkamiDomain->getTdp(),
                ':createdDate' => $homeprofilkamiDomain->getCreatedDate(),
                ':status' => $homeprofilkamiDomain->getStatus()
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

    public function getAllHomeProfilKamiDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE status LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_profil_kami
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homeprofilkamiDomainArray'] = array();
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
                home_profil_kami
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
            $result['homeprofilkamiDomainArray'][] = $this->instantiateHomeProfilKamiDomain($row);
        }
        return $result;
    }

    public function getAllHomeProfilKamiDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_profil_kami
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
            $result[] = $this->instantiateHomeProfilKamiDomain($row);
        }
        return $result;
    }

    public function getHomeProfilKamiDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_profil_kami
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

        return $this->instantiateHomeProfilKamiDomain($row);
    }


    public function update(HomeProfilKamiDomain $homeprofilkamiDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_profil_kami SET
                    description = :description,
                    visi = :visi,
                    misi = :misi,
                    siup = :siup,
                    ho = :ho,
                    tdp = :tdp,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homeprofilkamiDomain->getId(),
                ':description' => $homeprofilkamiDomain->getDescription(),
                ':visi' => $homeprofilkamiDomain->getVisi(),
                ':misi' => $homeprofilkamiDomain->getMisi(),
                ':siup' => $homeprofilkamiDomain->getSiup(),
                ':ho' => $homeprofilkamiDomain->getHo(),
                ':tdp' => $homeprofilkamiDomain->getTdp(),
                ':createdDate' => $homeprofilkamiDomain->getCreatedDate(),
                ':status' => $homeprofilkamiDomain->getStatus()
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
                    home_profil_kami
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

    private function instantiateHomeProfilKamiDomain(array $row)
    {
         $homeprofilkamiDomain = new HomeProfilKamiDomain(
            $row['id'],
            $row['description'],
            $row['visi'],
            $row['misi'],
            $row['siup'],
            $row['ho'],
            $row['tdp'],
            $row['created_date'],
            $row['status']
        );

        return $homeprofilkamiDomain;
    }

    //HANDLE PROFIL KAMI TITLE
    public function insert_pkt(HomeProfilKamiTitleDomain $homeprofilkamititleDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_profil_kami_title
                VALUES(
                    :id,
                    :title,
                    :subtitle,
                    :image,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homeprofilkamititleDomain->getId(),
                ':title' => $homeprofilkamititleDomain->getTitle(),
                ':subtitle' => $homeprofilkamititleDomain->getSubtitle(),
                ':image' => $homeprofilkamititleDomain->getImage(),
                ':createdDate' => $homeprofilkamititleDomain->getCreatedDate(),
                ':status' => $homeprofilkamititleDomain->getStatus()
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

    public function getAllHomeProfilKamiTitleDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE status LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_profil_kami_title
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homeprofilkamititleDomainArray'] = array();
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
                home_profil_kami_title
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
            $result['homeprofilkamititleDomainArray'][] = $this->instantiateHomeProfilKamiTitleDomain($row);
        }
        return $result;
    }

    public function getAllHomeProfilKamiTitleDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_profil_kami_title
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
            $result[] = $this->instantiateHomeProfilKamiTitleDomain($row);
        }
        return $result;
    }

    public function getHomeProfilKamiTitleDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_profil_kami_title
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

        return $this->instantiateHomeProfilKamiTitleDomain($row);
    }


    public function update_pkt(HomeProfilKamiTitleDomain $homeprofilkamititleDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_profil_kami_title SET
                    title = :title,
                    subtitle = :subtitle,
                    image = :image,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homeprofilkamititleDomain->getId(),
                ':title' => $homeprofilkamititleDomain->getTitle(),
                ':subtitle' => $homeprofilkamititleDomain->getSubtitle(),
                ':image' => $homeprofilkamititleDomain->getImage(),
                ':createdDate' => $homeprofilkamititleDomain->getCreatedDate(),
                ':status' => $homeprofilkamititleDomain->getStatus()
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

    public function delete_pkt_ById($id)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                DELETE FROM
                    home_profil_kami_title
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

    private function instantiateHomeProfilKamiTitleDomain(array $row)
    {
         $homeprofilkamititleDomain = new HomeProfilKamiTitleDomain(
            $row['id'],
            $row['title'],
            $row['subtitle'],
            $row['image'],
            $row['created_date'],
            $row['status']
        );

        return $homeprofilkamititleDomain;
    }
}
