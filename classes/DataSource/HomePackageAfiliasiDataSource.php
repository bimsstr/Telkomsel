<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\HomePackageDomain,
    Domain\HomePackageBlogDomain,
    Domain\HomePackageCategoryDomain,
    Domain\HomePackageAfiliasiDomain;

class HomePackageAfiliasiDataSource extends RootDataSource
{
    public function insert(HomePackageDomain $homepackageDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_package
                VALUES(
                    :id,
                    :title,
                    :subtitle,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homepackageDomain->getId(),
                ':title' => $homepackageDomain->getTitle(),
                ':subtitle' => $homepackageDomain->getSubtitle(),
                ':createdDate' => $homepackageDomain->getCreatedDate(),
                ':status' => $homepackageDomain->getStatus()
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

    public function getAllHomePackageDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE status LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_package
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homepackageDomainArray'] = array();
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
                home_package
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
            $result['homepackageDomainArray'][] = $this->instantiateHomePackageDomain($row);
        }
        return $result;
    }

    public function getAllHomePackageDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package
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
            $result[] = $this->instantiateHomePackageDomain($row);
        }
        return $result;
    }

    public function getHomePackageDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package
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

        return $this->instantiateHomePackageDomain($row);
    }


    public function update(HomePackageDomain $homepackageDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_package SET
                    title = :title,
                    subtitle = :subtitle,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homepackageDomain->getId(),
                ':title' => $homepackageDomain->getTitle(),
                ':subtitle' => $homepackageDomain->getSubtitle(),
                ':createdDate' => $homepackageDomain->getCreatedDate(),
                ':status' => $homepackageDomain->getStatus()
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
                    home_package
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
    
    private function instantiateHomePackageDomain(array $row)
    {
         $homepackageDomain = new HomePackageDomain(
            $row['id'],
            $row['title'],
            $row['subtitle'],
            $row['created_date'],
            $row['status']
        );

        return $homepackageDomain;
    }

    // HOME HOME PACKAGE CATEGORY

    public function insert_hpc(HomePackageCategoryDomain $homepackagecategoryDomain)
    {
        try
        {
             $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_package_category
                VALUES(
                    :id,
                    :category
                )
            ');
            $statement->execute(array(
                ':id' => $homepackagecategoryDomain->getId(),
                ':category' => $homepackagecategoryDomain->getCategory()
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

     public function getAllHomePackageCategoryDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_package_category
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homepackagecategoryDomainArray'] = array();
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
                home_package_category
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
            $result['homepackagecategoryDomainArray'][] = $this->instantiateHomePackageCategoryDomain($row);
        }
        return $result;
    }

    public function getAllHomePackageCategoryDomain()
    {
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_category
                order by id DESC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateHomePackageCategoryDomain($row);
        }
        return $result;
    }

    public function getHomePackageCategoryDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_category
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

        return $this->instantiateHomePackageCategoryDomain($row);
    }

    public function update_hpc(HomePackageCategoryDomain $homepackagecategoryDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_package_category SET
                    category = :category
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homepackagecategoryDomain->getId(),
                ':category' => $homepackagecategoryDomain->getCategory()
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

    public function delete_hpc_ById($id)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                DELETE FROM
                    home_package_category
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

    private function instantiateHomePackageCategoryDomain(array $row)
    {
        $homepackagecategoryDomain = new HomePackageCategoryDomain(
            $row['id'],
            $row['category']
        );

        return $homepackagecategoryDomain;
    }


    // HOME HOME PACKAGE AFILIASI

    public function insert_hpa(HomePackageAfiliasiDomain $homepackageafiliasiDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_package_afiliasi
                VALUES(
                    :id,
                    :packageBy,
                    :packageCategory,
                    :packageName,
                    :packageSpeed,
                    :packagePrice,
                    :packageImage,
                    :packageDescription,
                    :packageKeterangan,
                    :showLandingPage,
                    :createdDate,
                    :packageStatus
                )
            ');
            $statement->execute(array(
                ':id' => $homepackageafiliasiDomain->getId(),
                ':packageBy' => $homepackageafiliasiDomain->getPackageBy(),
                ':packageCategory' => $homepackageafiliasiDomain->getPackageCategory(),
                ':packageName' => $homepackageafiliasiDomain->getPackageName(),
                ':packageSpeed' => $homepackageafiliasiDomain->getPackageSpeed(),
                ':packagePrice' => $homepackageafiliasiDomain->getPackagePrice(),
                ':packageImage' => $homepackageafiliasiDomain->getPackageImage(),
                ':packageDescription' => $homepackageafiliasiDomain->getPackageDescription(),
                ':packageKeterangan' => $homepackageafiliasiDomain->getPackageKeterangan(),
                ':showLandingPage' => $homepackageafiliasiDomain->getShowLandingPage(),
                ':createdDate' => $homepackageafiliasiDomain->getCreatedDate(),
                ':packageStatus' => $homepackageafiliasiDomain->getPackageStatus()
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

     public function getAllHomePackageAfiliasiDomainByLimit($limit, $offset, $keyword = "", $usernamesales)
    {
        $where = 'where package_by = "'.$usernamesales.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_package_afiliasi
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homepackageafiliasiDomainArray'] = array();
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
                home_package_afiliasi
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
            $result['homepackageafiliasiDomainArray'][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }

    public function getAllHomePackageAfiliasiDomainByLimitForShow($limit, $offset, $keyword = "")
    {
        $where = 'where package_status = "active" AND show_landing_page = "yes"';
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
                '.$where.'
                order by id ASC
                LIMIT 3
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }

    public function getAllHomePackageAfiliasiDomain()
    {
        $status = 'active';
        $where = 'WHERE package_status = "'.$status.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
                '.$where.'
                order by package_price ASC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }

    public function getAllPackageAfiliasi($usernamesales)
    {
        $status = 'active';
        $where = 'WHERE package_by = "'.$usernamesales.'" AND package_status = "'.$status.'" AND show_landing_page="yes"' ;

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
                '.$where.'
                order by package_price ASC
                LIMIT 3
        ');
        $statement->execute(array(
            ':usernamesales' => $usernamesales,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }
    
    public function getAllPackageAfiliasiComplete($usernamesales)
    {
        $status = 'active';
        $where = 'WHERE package_by = "'.$usernamesales.'" AND package_status = "'.$status.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
                '.$where.'
                order by package_price ASC
        ');
        $statement->execute(array(
            ':usernamesales' => $usernamesales,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }
 
    public function getAllHomePackageAfiliasiDomainByPriceLow($usernamesales)
    {
        $status = 'active';
        $where = 'WHERE package_status = "'.$status.'" AND package_by = "'.$usernamesales.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
                '.$where.'
                order by package_price ASC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }

    public function getAllHomePackageAfiliasiDomainByPriceHigh($usernamesales)
    {
        $status = 'active';
        $where = 'WHERE package_status = "'.$status.'" AND package_by = "'.$usernamesales.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
                '.$where.'
                order by package_price DESC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }

    public function getAllHomePackageAfiliasiDomainByKeterangan($usernamesales)
    {
        $status = 'active';
        $where = 'WHERE package_status = "'.$status.'" AND package_by = "'.$usernamesales.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
                '.$where.'
                order by package_keterangan DESC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }
    
    public function getAllHomePackageAfiliasiDomainByCategory($usernamesales)
    {
        $status = 'active';
        $where = 'WHERE package_status = "'.$status.'" AND package_by = "'.$usernamesales.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
                '.$where.'
                order by package_category ASC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }
    
    public function getHomePackageAfiliasiDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
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

        return $this->instantiateHomePackageAfiliasiDomain($row);
    }

    public function update_hpa(HomePackageAfiliasiDomain $homepackageafiliasiDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
             $statement = $this->mysqli->buildStatement('
                UPDATE home_package_afiliasi SET
                    package_by = :packageBy,
                    package_category = :packageCategory,
                    package_name = :packageName,
                    package_speed = :packageSpeed,
                    package_price = :packagePrice,
                    package_image = :packageImage,
                    package_description = :packageDescription,
                    package_keterangan = :packageKeterangan,
                    show_landing_page = :showLandingPage,
                    created_date = :createdDate,
                    package_status = :packageStatus
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homepackageafiliasiDomain->getId(),
                ':packageBy' => $homepackageafiliasiDomain->getPackageBy(),
                ':packageCategory' => $homepackageafiliasiDomain->getPackageCategory(),
                ':packageName' => $homepackageafiliasiDomain->getPackageName(),
                ':packageSpeed' => $homepackageafiliasiDomain->getPackageSpeed(),
                ':packagePrice' => $homepackageafiliasiDomain->getPackagePrice(),
                ':packageImage' => $homepackageafiliasiDomain->getPackageImage(),
                ':packageDescription' => $homepackageafiliasiDomain->getPackageDescription(),
                ':packageKeterangan' => $homepackageafiliasiDomain->getPackageKeterangan(),
                ':showLandingPage' => $homepackageafiliasiDomain->getShowLandingPage(),
                ':createdDate' => $homepackageafiliasiDomain->getCreatedDate(),
                ':packageStatus' => $homepackageafiliasiDomain->getPackageStatus()
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

    public function delete_hpa_ById($id)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                DELETE FROM
                    home_package_afiliasi
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

    private function instantiateHomePackageAfiliasiDomain(array $row)
    {
        $homepackageafiliasiDomain = new HomePackageAfiliasiDomain(
            $row['id'],
            $row['package_by'],
            $row['package_category'],
            $row['package_name'],
            $row['package_speed'],
            $row['package_price'],
            $row['package_image'],
            $row['package_description'],
            $row['package_keterangan'],
            $row['show_landing_page'],
            $row['created_date'],
            $row['package_status']
        );

        return $homepackageafiliasiDomain;
    }

    // HOME HOME PACKAGE BLOG

    public function insert_hpb(HomePackageBlogDomain $homepackageblogDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_package_blog
                VALUES(
                    :id,
                    :packageCategory,
                    :packageImage,
                    :packageDescription,
                    :packageSk,
                    :createdDate,
                    :packageStatus
                )
            ');
            $statement->execute(array(
                ':id' => $homepackageblogDomain->getId(),
                ':packageCategory' => $homepackageblogDomain->getPackageCategory(),
                ':packageImage' => $homepackageblogDomain->getPackageImage(),
                ':packageDescription' => $homepackageblogDomain->getPackageDescription(),
                ':packageSk' => $homepackageblogDomain->getPackageSk(),
                ':createdDate' => $homepackageblogDomain->getCreatedDate(),
                ':packageStatus' => $homepackageblogDomain->getPackageStatus()
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

     public function getAllHomePackageBlogDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_package_blog
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homepackageblogDomainArray'] = array();
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
                home_package_blog
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
            $result['homepackageblogDomainArray'][] = $this->instantiateHomePackageBlogDomain($row);
        }
        return $result;
    }

    public function getAllHomePackageBlogDomain()
    {
        $status = 'active';
        $where = 'WHERE package_status = "'.$status.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_blog
                '.$where.'
                order by id ASC
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageBlogDomain($row);
        }
        return $result;
    }



    public function getHomePackageBlogDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_blog
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

        return $this->instantiateHomePackageBlogDomain($row);
    }

    public function update_hpb(HomePackageBlogDomain $homepackageblogDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_package_blog SET
                    package_category = :packageCategory,
                    package_image = :packageImage,
                    package_description = :packageDescription,
                    package_sk = :packageSk,
                    created_date = :createdDate,
                    package_status = :packageStatus
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homepackageblogDomain->getId(),
                ':packageCategory' => $homepackageblogDomain->getPackageCategory(),
                ':packageImage' => $homepackageblogDomain->getPackageImage(),
                ':packageDescription' => $homepackageblogDomain->getPackageDescription(),
                ':packageSk' => $homepackageblogDomain->getPackageSk(),
                ':createdDate' => $homepackageblogDomain->getCreatedDate(),
                ':packageStatus' => $homepackageblogDomain->getPackageStatus()
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

    public function delete_hpb_ById($id)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                DELETE FROM
                    home_package_blog
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

    private function instantiateHomePackageBlogDomain(array $row)
    {
        $homepackageblogDomain = new HomePackageBlogDomain(
            $row['id'],
            $row['package_category'],
            $row['package_image'],
            $row['package_description'],
            $row['package_sk'],
            $row['created_date'],
            $row['package_status']
        );

        return $homepackageblogDomain;
    }


    public function getPackageStreamix()
    {
        $status = 'active';
        $where = 'WHERE package_category ="Streamix" AND package_status = "'.$status.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
                '.$where.'
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }

    public function getPackageBlogStreamix()
    {        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_blog
                WHERE package_category = "Streamix" AND package_status = "Active"
                LIMIT 1
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateHomePackageBlogDomain($row);
        }
        return $result;

    }


    public function getPackagePhoenix()
    {
        $status = 'active';
        $where = 'WHERE package_category ="Phoenix" AND package_status = "'.$status.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
                '.$where.'
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }

    public function getPackageBlogPhoenix()
    {        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_blog
                WHERE package_category = "Phoenix" AND package_status = "Active"
                LIMIT 1
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateHomePackageBlogDomain($row);
        }
        return $result;

    }

    public function getPackageValue()
    {
        $status = 'active';
        $where = 'WHERE package_category ="Indihome Value" AND package_status = "'.$status.'"';

        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_afiliasi
                '.$where.'
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();

        $result = array();
        foreach ($rows as $row)
        {
            if(!(isset($result[$row['package_name']]))){

                $result[$row['package_name']] = array();
            }

            $result[$row['package_name']][] = $this->instantiateHomePackageAfiliasiDomain($row);
        }
        return $result;
    }

    public function getPackageBlogValue()
    {        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_package_blog
                WHERE package_category = "Indihome Value" AND package_status = "Active"
                LIMIT 1
        ');
        $statement->execute(array(
            ':status' => $status,
        ));

        $rows = $statement->fetchAllAssociative();
        $statement->close();
        foreach ($rows as $row)
        {
            $result[] = $this->instantiateHomePackageBlogDomain($row);
        }
        return $result;

    }
}