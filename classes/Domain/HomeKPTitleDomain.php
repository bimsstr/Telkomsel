<?php

namespace Domain;

class HomeKPTitleDomain extends RootDomain
{
	private $id;
    private $description;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $description,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
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