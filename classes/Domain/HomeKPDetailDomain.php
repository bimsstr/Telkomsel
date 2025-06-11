<?php

namespace Domain;

class HomeKPDetailDomain extends RootDomain
{
	private $id;
    private $category;
    private $description;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $category,
        $description,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
        $this->category = $category;
        $this->description = $description;
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

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
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