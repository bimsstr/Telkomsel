<?php

namespace Domain;

class HomeAboutDomain extends RootDomain
{
	private $id;
    private $bigQuotation;
    private $bigAbout;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $bigQuotation,
        $bigAbout,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
        $this->bigQuotation = $bigQuotation;
        $this->bigAbout = $bigAbout;
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

    public function setBigQuotation($bigQuotation)
    {
        $this->bigQuotation = $bigQuotation;
    }

    public function getBigQuotation()
    {
        return $this->bigQuotation;
    }

    public function setBigAbout($bigAbout)
    {
        $this->bigAbout = $bigAbout;
    }

    public function getBigAbout()
    {
        return $this->bigAbout;
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