<?php

namespace DataSource;

use DateTime,
    Driver\MySQLi,
    Driver\Exception\StatementException,
    Domain\HomeFaqDomain,
    Domain\HomeFaqCategoryDomain;

class HomeFaqDataSource extends RootDataSource
{
    public function insert(HomeFaqDomain $homefaqDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_faq
                VALUES(
                    :id,
                    :category,
                    :pertanyaan,
                    :jawaban,
                    :createdDate,
                    :status
                )
            ');
            $statement->execute(array(
                ':id' => $homefaqDomain->getId(),
                ':category' => $homefaqDomain->getCategory(),
                ':pertanyaan' => $homefaqDomain->getPertanyaan(),
                ':jawaban' => $homefaqDomain->getJawaban(),
                ':createdDate' => $homefaqDomain->getCreatedDate(),
                ':status' => $homefaqDomain->getStatus()
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

    public function getAllHomeFaqDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';
        if ($keyword != '') {
            $where = ' WHERE status LIKE :keyword1';
        }

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_faq
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homefaqDomainArray'] = array();
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
                home_faq
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
            $result['homefaqDomainArray'][] = $this->instantiateHomeFaqDomain($row);
        }
        return $result;
    }

    public function getAllHomeFaqDomain()
    {
        $status = 'active';
        $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_faq
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
            if(!(isset($result[$row['category']]))){

                $result[$row['category']] = array();
            }

            $result[$row['category']][] = $this->instantiateHomeFaqDomain($row);
        }
        return $result;
    }

    public function getHomeFaqDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_faq
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

        return $this->instantiateHomeFaqDomain($row);
    }


    public function update(HomeFaqDomain $homefaqDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
             $statement = $this->mysqli->buildStatement('
                UPDATE home_faq SET
                    category = :category,
                    pertanyaan = :pertanyaan,
                    jawaban = :jawaban,
                    created_date = :createdDate,
                    status = :status
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homefaqDomain->getId(),
                ':category' => $homefaqDomain->getCategory(),
                ':pertanyaan' => $homefaqDomain->getPertanyaan(),
                ':jawaban' => $homefaqDomain->getJawaban(),
                ':createdDate' => $homefaqDomain->getCreatedDate(),
                ':status' => $homefaqDomain->getStatus()
            ));
            $statement->close();
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
                    home_faq
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

    private function instantiateHomeFaqDomain(array $row)
    {
         $homefaqDomain = new HomeFaqDomain(
            $row['id'],
            $row['category'],
            $row['pertanyaan'],
            $row['jawaban'],
            $row['created_date'],
            $row['status']
        );

        return $homefaqDomain;
    }

    public function insert_faqc(HomeFaqCategoryDomain $homefaqcategoryDomain)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                INSERT INTO
                    home_faq_category
                VALUES(
                    :id,
                    :category
                )
            ');
            $statement->execute(array(
                ':id' => $homefaqcategoryDomain->getId(),
                ':category' => $homefaqcategoryDomain->getCategory()
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

    public function getAllHomeFaqCategoryDomainByLimit($limit, $offset, $keyword = "")
    {
        $where = '';

        $statement = $this->mysqli->buildStatement('
            SELECT
                count(id) jumlahData
            FROM
                home_faq_category
            '.$where.'
        ');
        $statement->execute(array(
            ':keyword1' => '%'.$keyword.'%',
            ':keyword2' => '%'.$keyword.'%'
        ));

        $result['jumlahData'] = 0;
        $result['homefaqcategoryDomainArray'] = array();
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
                home_faq_category
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
            $result['homefaqcategoryDomainArray'][] = $this->instantiateHomeFaqCategoryDomain($row);
        }
        return $result;
    }

    public function getAllHomeFaqCategoryDomain()
    {
        $status = 'active';
        $where = '';
        // $where = 'WHERE status = "'.$status.'"';
        
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_faq_category
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
            $result[] = $this->instantiateHomeFaqCategoryDomain($row);
        }
        return $result;
    }

    public function getHomeFaqCategoryDomainById($id)
    {
        $statement = $this->mysqli->buildStatement('
            SELECT
                *
            FROM
                home_faq_category
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

        return $this->instantiateHomeFaqCategoryDomain($row);
    }


    public function update_faqc(HomeFaqCategoryDomain $homefaqcategoryDomain, $withTransaction = TRUE)
    {
        if ($withTransaction)
        {
            $this->mysqli->query('START TRANSACTION');
        }

        try
        {
            $statement = $this->mysqli->buildStatement('
                UPDATE home_faq_category SET
                    category = :category
                WHERE
                    id = :id
            ');
            $statement->execute(array(
                ':id' => $homefaqcategoryDomain->getId(),
                ':category' => $homefaqcategoryDomain->getCategory()
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

    public function delete_faqc_ById($id)
    {
        try
        {
            $statement = $this->mysqli->buildStatement('
                DELETE FROM
                    home_faq_category
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

    private function instantiateHomeFaqCategoryDomain(array $row)
    {
         $homefaqcategoryDomain = new HomeFaqCategoryDomain(
            $row['id'],
            $row['category']
        );

        return $homefaqcategoryDomain;
    }
}
