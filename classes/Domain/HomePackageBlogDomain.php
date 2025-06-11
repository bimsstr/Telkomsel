<?php

namespace Domain;

class HomePackageBlogDomain extends RootDomain
{
    private $id;
    private $packageCategory;
    private $packageImage;
    private $packageDescription;
    private $packageSk;
    private $createdDate;
    private $packageStatus;

    public function __construct(
        $id,
        $packageCategory,
        $packageImage,
        $packageDescription,
        $packageSk,
        $createdDate,
        $packageStatus
    )
    {
        $this->id = $id;
        $this->packageCategory = $packageCategory;
        $this->packageImage = $packageImage;
        $this->packageDescription = $packageDescription;
        $this->packageSk = $packageSk;
        $this->createdDate = $createdDate;
        $this->packageStatus = $packageStatus;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPackageCategory($packageCategory)
    {
        $this->packageCategory = $packageCategory;
    }

    public function getPackageCategory()
    {
        return $this->packageCategory;
    }

    public function setPackageImage($packageImage)
    {
        $this->packageImage = $packageImage;
    }

    public function getPackageImage()
    {
        return $this->packageImage;
    }

    public function setPackageDescription($packageDescription)
    {
        $this->packageDescription = $packageDescription;
    }

    public function getPackageDescription()
    {
        return $this->packageDescription;
    }

    public function setPackageSk($packageSk)
    {
        $this->packageSk = $packageSk;
    }

    public function getPackageSk()
    {
        return $this->packageSk;
    }

    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    public function setPackageStatus($packageStatus)
    {
        $this->packageStatus = $packageStatus;
    }

    public function getPackageStatus()
    {
        return $this->packageStatus;
    }
}
?>