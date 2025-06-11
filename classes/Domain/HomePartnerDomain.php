<?php

namespace Domain;

class HomePartnerDomain extends RootDomain
{
    private $id;
    private $image;
    private $description;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $image,
        $description,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
        $this->image = $image;
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

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
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