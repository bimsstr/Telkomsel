<?php

namespace Domain;

class HomeFaqDomain extends RootDomain
{
	private $id;
    private $category;
    private $pertanyaan;
    private $jawaban;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $category,
        $pertanyaan,
        $jawaban,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
        $this->category = $category;
        $this->pertanyaan = $pertanyaan;
        $this->jawaban = $jawaban;
        $this->createdDate = $createdDate;
        $this->status = $status;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setPertanyaan($pertanyaan)
    {
        $this->pertanyaan = $pertanyaan;
    }

    public function getPertanyaan()
    {
        return $this->pertanyaan;
    }

    public function setJawaban($jawaban)
    {
        $this->jawaban = $jawaban;
    }

    public function getJawaban()
    {
        return $this->jawaban;
    }

    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
?>