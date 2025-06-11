<?php

namespace Domain;

class RegisterDomain extends RootDomain
{
 	private $id;
    private $createdDate;
    private $username;
    private $email;
    private $nama;
    private $noHp1;
    private $noHp2;
    private $alamat;
    private $provinsi;
    private $paket;
    private $kodePromo;
    private $catatan;
    private $status;
    private $adminUsername;
    private $namaUsaha;
    private $jamAktif;
    private $data;

    public function __construct(
        $id,
        $createdDate,
        $username,
        $email,
        $nama,
        $noHp1,
        $noHp2,
        $alamat,
        $provinsi,
        $paket,
        $kodePromo,
        $catatan,
        $status,
        $adminUsername,
        $namaUsaha,
        $jamAktif,
        $data
    )
    {
        $this->id = $id;
        $this->createdDate = $createdDate;
        $this->username = $username;
        $this->email = $email;
        $this->nama = $nama;
        $this->noHp1 = $noHp1;
        $this->noHp2 = $noHp2;
        $this->alamat = $alamat;
        $this->provinsi = $provinsi;
        $this->paket = $paket;
        $this->kodePromo = $kodePromo;
        $this->catatan = $catatan;
        $this->status = $status;
        $this->adminUsername = $adminUsername;
        $this->namaUsaha = $namaUsaha;
        $this->jamAktif = $jamAktif;
        $this->data = $data;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function setNoHp1($noHp1)
    {
        $this->noHp1 = $noHp1;
    }

    public function getNoHp1()
    {
        return $this->noHp1;
    }

    public function setNoHp2($noHp2)
    {
        $this->noHp2 = $noHp2;
    }

    public function getNoHp2()
    {
        return $this->noHp2;
    }

    public function setAlamat($alamat)
    {
        $this->alamat = $alamat;
    }

    public function getAlamat()
    {
        return $this->alamat;
    }

    public function setProvinsi($provinsi)
    {
        $this->provinsi = $provinsi;
    }

    public function getProvinsi()
    {
        return $this->provinsi;
    }

    public function setPaket($paket)
    {
        $this->paket = $paket;
    }

    public function getPaket()
    {
        return $this->paket;
    }

    public function setKodePromo($kodePromo)
    {
        $this->kodePromo = $kodePromo;
    }

    public function getKodePromo()
    {
        return $this->kodePromo;
    }

    public function setCatatan($catatan)
    {
        $this->catatan = $catatan;
    }

    public function getCatatan()
    {
        return $this->catatan;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setAdminUsername($adminUsername)
    {
        $this->adminUsername = $adminUsername;
    }

    public function getAdminUsername()
    {
        return $this->adminUsername;
    }

    public function setNamaUsaha($namaUsaha)
    {
        $this->namaUsaha = $namaUsaha;
    }

    public function getNamaUsaha()
    {
        return $this->namaUsaha;
    }

    public function setJamAktif($jamAktif)
    {
        $this->jamAktif = $jamAktif;
    }

    public function getJamAktif()
    {
        return $this->jamAktif;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
?>