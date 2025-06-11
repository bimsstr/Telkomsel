<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\HomeContactUsDomain,
    Domain\HomeContactUsTitleDomain;

class HomeContactUsDataSource extends RootDataSource
{
    public function insert(HomeContactUsDomain $homecontactusDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_contact_us
                VALUES(
                    :id,
                    :name,
                    :address,
                    :callCenter,
                    :smsCenter,
                    :apiKey,
                    :latitude,
                    :longitude,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homecontactusDomain->getId(),
                ':name' => $homecontactusDomain->getName(),
                ':address' => $homecontactusDomain->getAddress(),
                ':callCenter' => $homecontactusDomain->getCallCenter(),
                ':smsCenter' => $homecontactusDomain->getSmsCenter(),
                ':apiKey' => $homecontactusDomain->getApiKey(),
                ':latitude' => $homecontactusDomain->getLatitude(),
                ':longitude' => $homecontactusDomain->getLongitude(),
                ':createdDate' => $homecontactusDomain->getCreatedDate(),
                ':status' => $homecontactusDomain->getStatus()
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

    public function getAllHomeContactUsDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE status LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_contact_us
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homecontactusDomainArray'] = array();
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
                home_contact_us
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
            $result['homecontactusDomainArray'][] = $this->instantiateHomeContactUsDomain($row);
        }
        return $result;
    }

    public function getAllHomeContactUsDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_contact_us
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
            $result[] = $this->instantiateHomeContactUsDomain($row);
        }
        return $result;
    }

    public function getHomeContactUsDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_contact_us
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

        return $this->instantiateHomeContactUsDomain($row);
    }


    public function update(HomeContactUsDomain $homecontactusDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_contact_us SET
                    name = :name,
                    address = :address,
                    call_center = :callCenter,
                    sms_center = :smsCenter,
                    api_key = :apiKey,
                    latitude = :latitude,
                    longitude = :longitude,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homecontactusDomain->getId(),
                ':name' => $homecontactusDomain->getName(),
                ':address' => $homecontactusDomain->getAddress(),
                ':callCenter' => $homecontactusDomain->getCallCenter(),
                ':smsCenter' => $homecontactusDomain->getSmsCenter(),
                ':apiKey' => $homecontactusDomain->getApiKey(),
                ':latitude' => $homecontactusDomain->getLatitude(),
                ':longitude' => $homecontactusDomain->getLongitude(),
                ':createdDate' => $homecontactusDomain->getCreatedDate(),
                ':status' => $homecontactusDomain->getStatus()
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
                    home_contact_us
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

    private function instantiateHomeContactUsDomain(array $row)
    {
         $homecontactusDomain = new HomeContactUsDomain(
            $row['id'],
            $row['name'],
            $row['address'],
            $row['call_center'],
            $row['sms_center'],
            $row['api_key'],
            $row['latitude'],
            $row['longitude'],
            $row['created_date'],
            $row['status']
        );

        return $homecontactusDomain;
    }


    //HOME CONTACT US TITLE
    public function insert_hcut(HomeContactUsTitleDomain $homecontactustitleDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_contact_us_title
                VALUES(
                    :id,
                    :image,
                    :title,
                    :subtitle,
                    :iconAddress,
                    :iconCallcenter,
                    :iconSmscenter,
                    :iconLivechat,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homecontactustitleDomain->getId(),
                ':image' => $homecontactustitleDomain->getImage(),
                ':title' => $homecontactustitleDomain->getTitle(),
                ':subtitle' => $homecontactustitleDomain->getSubtitle(),
                ':iconAddress' => $homecontactustitleDomain->getIconAddress(),
                ':iconCallcenter' => $homecontactustitleDomain->getIconCallcenter(),
                ':iconSmscenter' => $homecontactustitleDomain->getIconSmscenter(),
                ':iconLivechat' => $homecontactustitleDomain->getIconLivechat(),
                ':createdDate' => $homecontactustitleDomain->getCreatedDate(),
                ':status' => $homecontactustitleDomain->getStatus()
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

    public function getAllHomeContactUsTitleDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE status LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_contact_us_title
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homecontactustitleDomainArray'] = array();
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
                home_contact_us_title
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
            $result['homecontactustitleDomainArray'][] = $this->instantiateHomeContactUsTitleDomain($row);
        }
        return $result;
    }

    public function getAllHomeContactUsTitleDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_contact_us_title
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
            $result[] = $this->instantiateHomeContactUsTitleDomain($row);
        }
        return $result;
    }

    public function getHomeContactUsTitleDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_contact_us_title
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

        return $this->instantiateHomeContactUsTitleDomain($row);
    }


    public function update_hcut(HomeContactUsTitleDomain $homecontactustitleDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_contact_us_title SET
                    image = :image,
                    title = :title,
                    subtitle = :subtitle,
                    icon_address = :iconAddress,
                    icon_callcenter = :iconCallcenter,
                    icon_smscenter = :iconSmscenter,
                    icon_livechat = :iconLivechat,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homecontactustitleDomain->getId(),
                ':image' => $homecontactustitleDomain->getImage(),
                ':title' => $homecontactustitleDomain->getTitle(),
                ':subtitle' => $homecontactustitleDomain->getSubtitle(),
                ':iconAddress' => $homecontactustitleDomain->getIconAddress(),
                ':iconCallcenter' => $homecontactustitleDomain->getIconCallcenter(),
                ':iconSmscenter' => $homecontactustitleDomain->getIconSmscenter(),
                ':iconLivechat' => $homecontactustitleDomain->getIconLivechat(),
                ':createdDate' => $homecontactustitleDomain->getCreatedDate(),
                ':status' => $homecontactustitleDomain->getStatus()
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

    public function delete_hcut_ById($id)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                DELETE FROM
                    home_contact_us_title
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

    private function instantiateHomeContactUsTitleDomain(array $row)
    {
         $homecontactustitleDomain = new HomeContactUsTitleDomain(
            $row['id'],
            $row['image'],
            $row['title'],
            $row['subtitle'],
            $row['icon_address'],
            $row['icon_callcenter'],
            $row['icon_smscenter'],
            $row['icon_livechat'],
            $row['created_date'],
            $row['status']
        );

        return $homecontactustitleDomain;
    }
}