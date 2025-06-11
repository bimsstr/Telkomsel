<?php

namespace Domain;

class HomeSalesDetailDomain extends RootDomain
{
    private $id;
    private $nama;
    private $posisi;
    private $image;
    private $phone;
    private $waText;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $nama,
        $posisi,
        $image,
        $phone,
        $waText,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->posisi = $posisi;
        $this->image = $image;
        $this->phone = $phone;
        $this->waText = $waText;
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

    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function setPosisi($posisi)
    {
        $this->posisi = $posisi;
    }

    public function getPosisi()
    {
        return $this->posisi;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setWaText($waText)
    {
        $this->waText = $waText;
    }

    public function getWaText()
    {
        return $this->waText;
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