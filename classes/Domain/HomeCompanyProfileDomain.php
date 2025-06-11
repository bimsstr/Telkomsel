<?php

namespace Domain;

class HomeCompanyProfileDomain extends RootDomain
{
	private $id;
    private $title;
    private $subtitle;
    private $description;
    private $youtubeChannel;
    private $youtubeUrl;
    private $image;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $title,
        $subtitle,
        $description,
        $youtubeChannel,
        $youtubeUrl,
        $image,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->description = $description;
        $this->youtubeChannel = $youtubeChannel;
        $this->youtubeUrl = $youtubeUrl;
        $this->image = $image;
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

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setYoutubeChannel($youtubeChannel)
    {
        $this->youtubeChannel = $youtubeChannel;
    }

    public function getYoutubeChannel()
    {
        return $this->youtubeChannel;
    }

    public function setYoutubeUrl($youtubeUrl)
    {
        $this->youtubeUrl = $youtubeUrl;
    }

    public function getYoutubeUrl()
    {
        return $this->youtubeUrl;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
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