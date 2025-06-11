<?php

namespace Domain;

class HomeProfilKamiDomain extends RootDomain
{
	private $id;
    private $description;
    private $visi;
    private $misi;
    private $siup;
    private $ho;
    private $tdp;
    private $createdDate;
    private $status;

    public function __construct(
        $id,
        $description,
        $visi,
        $misi,
        $siup,
        $ho,
        $tdp,
        $createdDate,
        $status
    )
    {
        $this->id = $id;
        $this->description = $description;
        $this->visi = $visi;
        $this->misi = $misi;
        $this->siup = $siup;
        $this->ho = $ho;
        $this->tdp = $tdp;
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

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setVisi($visi)
    {
        $this->visi = $visi;
    }

    public function getVisi()
    {
        return $this->visi;
    }

    public function setMisi($misi)
    {
        $this->misi = $misi;
    }

    public function getMisi()
    {
        return $this->misi;
    }

    public function setSiup($siup)
    {
        $this->siup = $siup;
    }

    public function getSiup()
    {
        return $this->siup;
    }

    public function setHo($ho)
    {
        $this->ho = $ho;
    }

    public function getHo()
    {
        return $this->ho;
    }

    public function setTdp($tdp)
    {
        $this->tdp = $tdp;
    }

    public function getTdp()
    {
        return $this->tdp;
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