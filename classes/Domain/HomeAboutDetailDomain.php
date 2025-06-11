<?php

namespace Domain;

class HomeAboutDetailDomain extends RootDomain
{
    private $id;
    private $cardImage;
    private $cardTitle;
    private $cardSubtitle;
    private $cardDescription;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $cardImage,
        $cardTitle,
        $cardSubtitle,
        $cardDescription,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
        $this->cardImage = $cardImage;
        $this->cardTitle = $cardTitle;
        $this->cardSubtitle = $cardSubtitle;
        $this->cardDescription = $cardDescription;
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

    public function setCardImage($cardImage)
    {
        $this->cardImage = $cardImage;
    }

    public function getCardImage()
    {
        return $this->cardImage;
    }

    public function setCardTitle($cardTitle)
    {
        $this->cardTitle = $cardTitle;
    }

    public function getCardTitle()
    {
        return $this->cardTitle;
    }

    public function setCardSubtitle($cardSubtitle)
    {
        $this->cardSubtitle = $cardSubtitle;
    }

    public function getCardSubtitle()
    {
        return $this->cardSubtitle;
    }

    public function setCardDescription($cardDescription)
    {
        $this->cardDescription = $cardDescription;
    }

    public function getCardDescription()
    {
        return $this->cardDescription;
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