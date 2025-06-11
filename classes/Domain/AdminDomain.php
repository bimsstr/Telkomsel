<?php

namespace Domain;

class AdminDomain extends RootDomain
{
	private $id;
    private $username;
    private $password;
    private $fullname;
    private $position;
    private $address;
    private $phone;
    private $email;
    private $about;
    private $image;
    private $createdDate;
    private $star;
    private $tier;
    private $status;

    public function __construct(
        $id,
        $username,
        $password,
        $fullname,
        $position,
        $address,
        $phone,
        $email,
        $about,
        $image,
        $createdDate,
        $star,
        $tier,
        $status
    )
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->position = $position;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->about = $about;
        $this->image = $image;
        $this->createdDate = $createdDate;
        $this->star = $star;
        $this->tier = $tier;
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

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setAbout($about)
    {
        $this->about = $about;
    }

    public function getAbout()
    {
        return $this->about;
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

    public function setStar($star)
    {
        $this->star = $star;
    }

    public function getStar()
    {
        return $this->star;
    }

    public function setTier($tier)
    {
        $this->tier = $tier;
    }

    public function getTier()
    {
        return $this->tier;
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