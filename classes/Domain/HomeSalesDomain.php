<?php

namespace Domain;

class HomeSalesDomain extends RootDomain
{
    private $id;
    private $title;
    private $subtitle;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $title,
        $subtitle,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->subtitle = $subtitle;
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

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
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