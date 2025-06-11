<?php

namespace Domain;

class HomeContactDomain extends RootDomain
{
	private $id;
    private $logo;
    private $description;
    private $address;
    private $telephone;
    private $email;
    private $fbUrl;
    private $fbStatus;
    private $igUrl;
    private $igStatus;
    private $twitterUrl;
    private $twitterStatus;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $logo,
        $description,
        $address,
        $telephone,
        $email,
        $fbUrl,
        $fbStatus,
        $igUrl,
        $igStatus,
        $twitterUrl,
        $twitterStatus,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
        $this->logo = $logo;
        $this->description = $description;
        $this->address = $address;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->fbUrl = $fbUrl;
        $this->fbStatus = $fbStatus;
        $this->igUrl = $igUrl;
        $this->igStatus = $igStatus;
        $this->twitterUrl = $twitterUrl;
        $this->twitterStatus = $twitterStatus;
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

    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setFbUrl($fbUrl)
    {
        $this->fbUrl = $fbUrl;
    }

    public function getFbUrl()
    {
        return $this->fbUrl;
    }

    public function setFbStatus($fbStatus)
    {
        $this->fbStatus = $fbStatus;
    }

    public function getFbStatus()
    {
        return $this->fbStatus;
    }

    public function setIgUrl($igUrl)
    {
        $this->igUrl = $igUrl;
    }

    public function getIgUrl()
    {
        return $this->igUrl;
    }

    public function setIgStatus($igStatus)
    {
        $this->igStatus = $igStatus;
    }

    public function getIgStatus()
    {
        return $this->igStatus;
    }

    public function setTwitterUrl($twitterUrl)
    {
        $this->twitterUrl = $twitterUrl;
    }

    public function getTwitterUrl()
    {
        return $this->twitterUrl;
    }

    public function setTwitterStatus($twitterStatus)
    {
        $this->twitterStatus = $twitterStatus;
    }

    public function getTwitterStatus()
    {
        return $this->twitterStatus;
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