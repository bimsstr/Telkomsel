<?php

namespace Domain;

class HomeFindUsDomain extends RootDomain
{
    private $id;
    private $title;
    private $description;
    private $appstore;
    private $playstore;
    private $image;
    private $imageBackground;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $title,
        $description,
        $appstore,
        $playstore,
        $image,
        $imageBackground,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->appstore = $appstore;
        $this->playstore = $playstore;
        $this->image = $image;
        $this->imageBackground = $imageBackground;
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

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setAppstore($appstore)
    {
        $this->appstore = $appstore;
    }

    public function getAppstore()
    {
        return $this->appstore;
    }

    public function setPlaystore($playstore)
    {
        $this->playstore = $playstore;
    }

    public function getPlaystore()
    {
        return $this->playstore;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImageBackground($imageBackground)
    {
        $this->imageBackground = $imageBackground;
    }

    public function getImageBackground()
    {
        return $this->imageBackground;
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