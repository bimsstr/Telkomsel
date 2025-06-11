<?php

namespace Domain;

class HomeTitleDomain extends RootDomain
{
	private $id;
    private $imageTitle;
    private $subtitle;
    private $videoUrl;
    private $status;

    public function __construct(
        $id,
        $imageTitle,
        $subtitle,
        $videoUrl,
        $status
    )
    {
        $this->id = $id;
        $this->imageTitle = $imageTitle;
        $this->subtitle = $subtitle;
        $this->videoUrl = $videoUrl;
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

    public function setImageTitle($imageTitle)
    {
        $this->imageTitle = $imageTitle;
    }

    public function getImageTitle()
    {
        return $this->imageTitle;
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;
    }

    public function getVideoUrl()
    {
        return $this->videoUrl;
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