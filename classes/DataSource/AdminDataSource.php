<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\AdminDomain,
    DataSource\AdminDataSource;

class AdminDataSource extends RootDataSource
{
    public function insert(AdminDomain $adminDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    admin
                VALUES(
                    :id,
                    :username,
                    :password,
                    :fullname,
                    :position,
                    :address,
                    :phone,
                    :email,
                    :about,
                    :image,
                    :createdDate,
                    :star,
                    :tier,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $adminDomain->getId(),
                ':username' => $adminDomain->getUsername(),
                ':password' => $adminDomain->getPassword(),
                ':fullname' => $adminDomain->getFullname(),
                ':position' => $adminDomain->getPosition(),
                ':address' => $adminDomain->getAddress(),
                ':phone' => $adminDomain->getPhone(),
                ':email' => $adminDomain->getEmail(),
                ':about' => $adminDomain->getAbout(),
                ':image' => $adminDomain->getImage(),
                ':createdDate' => $adminDomain->getCreatedDate(),
                ':star' => $adminDomain->getStar(),
                ':tier' => $adminDomain->getTier(),
                ':status' => $adminDomain->getStatus()
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

    public function getAdminDomainByUsername($username)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                admin
            WHERE
                username = :username
            LIMIT 1
        ');
        $statement->execute(array(
            ':username' => $username
        ));
        $row = $statement->fetchAssociativeArray();
        $statement->close();

        if (!(is_array($row)))
        {
            return FALSE;
        }

        return $this->instantiateAdminDomain($row);
    }


    public function getAllAdminDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE fullname LIKE :keyword1 OR phone LIKE :keyword2 OR username LIKE :keyword3';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                admin
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%',
            ':keyword3' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['adminDomainArray'] = array();
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
                admin
            '.$where.'
            ORDER BY tier DESC
            LIMIT
                :limit, :offset

        ');
        $statement->execute(array(
            ':limit' => $limit,
            ':offset' => $offset,
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%',
            ':keyword3' => '%'.$keyword.'%'
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result['adminDomainArray'][] = $this->instantiateAdminDomain($row);
        }

        return $result;
    }

    public function getAdminDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                admin
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

        return $this->instantiateAdminDomain($row);
    }

    public function getAllAdminDomain()
    {
        $status_produk = 'active';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                admin
            order by id ASC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateAdminDomain($row);
        }
        return $result;
    }

    public function getAllAdminDomainbyStar()
    {
        $status = 'active';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                admin
            WHERE status = "active"
            order by star DESC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateAdminDomain($row);
        }
        return $result;
    }

    public function getAllAdminDomainbyTier()
    {
        $tier  = 'sales';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                admin
            where tier = "'.$tier.'" AND status = "active" AND image != "null"
            ORDER BY RAND()
            LIMIT 15;
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateAdminDomain($row);
        }
        return $result;
    }

    public function getAdminPhone($usernamesales)
    {
        $tier  = 'sales';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                admin
            where tier = "'.$tier.'" and username = "'.$usernamesales.'" 
            ORDER BY star desc
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateAdminDomain($row);
        }
        return $result;
    }

    public function getAllAdminDomainbyTierAndStar()
    {
        $tier  = 'sales';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                admin
            where tier = "'.$tier.'" AND status = "active" AND image != "null" 
            ORDER BY star desc
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateAdminDomain($row);
        }
        return $result;
    }

    public function getAllAdminDomainbyTierAndName()
    {
        $tier  = 'sales';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                admin
            where tier = "'.$tier.'" AND status = "active" AND image != "null"
            ORDER BY fullname ASC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateAdminDomain($row);
        }
        return $result;
    }
    
    public function getAllAdminDomainbyTiernya($limit, $offset, $keyword = "")
    {
        $where = 'WHERE tier = "sales"';
        if ($keyword != '') {
            $where = ' WHERE fullname LIKE :keyword1 OR email LIKE :keyword2 ';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                admin
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['adminDomainArray'] = array();
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
                admin
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
            $result['adminDomainArray'][] = $this->instantiateAdminDomain($row);
        }

        return $result;
    }

    public function update(AdminDomain $adminDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }
        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE admin SET
                    username = :username,
                    password = :password,
                    fullname = :fullname,
                    position = :position,
                    address = :address,
                    phone = :phone,
                    email = :email,
                    about = :about,
                    image = :image,
                    created_date = :createdDate,
                    star = :star,
                    tier = :tier,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $adminDomain->getId(),
                ':username' => $adminDomain->getUsername(),
                ':password' => $adminDomain->getPassword(),
                ':fullname' => $adminDomain->getFullname(),
                ':position' => $adminDomain->getPosition(),
                ':address' => $adminDomain->getAddress(),
                ':phone' => $adminDomain->getPhone(),
                ':email' => $adminDomain->getEmail(),
                ':about' => $adminDomain->getAbout(),
                ':image' => $adminDomain->getImage(),
                ':createdDate' => $adminDomain->getCreatedDate(),
                ':star' => $adminDomain->getStar(),
                ':tier' => $adminDomain->getTier(),
                ':status' => $adminDomain->getStatus()
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
                    admin
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
    
    public function deleteByUsername($usernamesales)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                DELETE FROM
                    home_package_afiliasi
                WHERE
                    package_by = :package_by
            ');
            $statement->execute(array(
                ':package_by' => $usernamesales
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

    private function instantiateAdminDomain(array $row)
    {
        $adminDomain = new AdminDomain(
            $row['id'],
            $row['username'],
            $row['password'],
            $row['fullname'],
            $row['position'],
            $row['address'],
            $row['phone'],
            $row['email'],
            $row['about'],
            $row['image'],
            $row['created_date'],
            $row['star'],
            $row['tier'],
            $row['status']
        );

        return $adminDomain;
    }

    public function registerAdmin(AdminDomain $adminDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    admin
                VALUES(
                    :id,
                    :username,
                    :password,
                    :fullname,
                    :position,
                    :address,
                    :phone,
                    :email,
                    :about,
                    :image,
                    :createdDate,
                    :star,
                    :tier,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $adminDomain->getId(),
                ':username' => $adminDomain->getUsername(),
                ':password' => $adminDomain->getPassword(),
                ':fullname' => $adminDomain->getFullname(),
                ':position' => $adminDomain->getPosition(),
                ':address' => $adminDomain->getAddress(),
                ':phone' => $adminDomain->getPhone(),
                ':email' => $adminDomain->getEmail(),
                ':about' => $adminDomain->getAbout(),
                ':image' => $adminDomain->getImage(),
                ':createdDate' => $adminDomain->getCreatedDate(),
                ':star' => $adminDomain->getStar(),
                ':tier' => $adminDomain->getTier(),
                ':status' => $adminDomain->getStatus()
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
}
