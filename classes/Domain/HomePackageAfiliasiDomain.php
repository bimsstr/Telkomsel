<?php

namespace Domain;

class HomePackageAfiliasiDomain extends RootDomain
{
    private $id;
    private $packageBy;
    private $packageCategory;
    private $packageName;
    private $packageSpeed;
    private $packagePrice;
    private $packageImage;
    private $packageDescription;
    private $packageKeterangan;
    private $showLandingPage;
    private $createdDate;
    private $packageStatus;

    public function __construct(
        $id,
        $packageBy,
        $packageCategory,
        $packageName,
        $packageSpeed,
        $packagePrice,
        $packageImage,
        $packageDescription,
        $packageKeterangan,
        $showLandingPage,
        $createdDate,
        $packageStatus
    )
    {
        $this->id = $id;
        $this->packageBy = $packageBy;
        $this->packageCategory = $packageCategory;
        $this->packageName = $packageName;
        $this->packageSpeed = $packageSpeed;
        $this->packagePrice = $packagePrice;
        $this->packageImage = $packageImage;
        $this->packageDescription = $packageDescription;
        $this->packageKeterangan = $packageKeterangan;
        $this->showLandingPage = $showLandingPage;
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

    public function setPackageBy($packageBy)
    {
        $this->packageBy = $packageBy;
    }

    public function getPackageBy()
    {
        return $this->packageBy;
    }

    public function setPackageCategory($packageCategory)
    {
        $this->packageCategory = $packageCategory;
    }

    public function getPackageCategory()
    {
        return $this->packageCategory;
    }

    public function setPackageName($packageName)
    {
        $this->packageName = $packageName;
    }

    public function getPackageName()
    {
        return $this->packageName;
    }

    public function setPackageSpeed($packageSpeed)
    {
        $this->packageSpeed = $packageSpeed;
    }

    public function getPackageSpeed()
    {
        return $this->packageSpeed;
    }

    public function setPackagePrice($packagePrice)
    {
        $this->packagePrice = $packagePrice;
    }

    public function getPackagePrice()
    {
        return $this->packagePrice;
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

    public function setPackageKeterangan($packageKeterangan)
    {
        $this->packageKeterangan = $packageKeterangan;
    }

    public function getPackageKeterangan()
    {
        return $this->packageKeterangan;
    }

    public function setShowLandingPage($showLandingPage)
    {
        $this->showLandingPage = $showLandingPage;
    }

    public function getShowLandingPage()
    {
        return $this->showLandingPage;
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