<?php

namespace Domain;

class MysqlErrorDomain extends RootDomain
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $createdDate;

    /**
     * @var
     */
    private $kode;

    /**
     * @var
     */
    private $pesan;

    /**
     * @var
     */
    private $query;

    /**
     * @var
     */
    private $param;

    /**
     * @var
     */
    private $status;

    /**
     * @var
     */
    private $solvedDate;

    /**
     * Melakukan
     *
     * @param
     * @return
     */
    function __construct(
        $id,
        $createdDate,
        $kode,
        $pesan,
        $query,
        $param,
        $status,
        $solvedDate
    )
    {
        $this->id = $id;
        $this->createdDate = $createdDate;
        $this->kode = $kode;
        $this->pesan = $pesan;
        $this->query = $query;
        $this->param = $param;
        $this->status = $status;
        $this->solvedDate = $solvedDate;
    }

    /**
     * Ambil .
     *
     * @return  $status.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Simpan .
     *
     * @param  $status.
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Ambil .
     *
     * @return  $solvedDate.
     */
    public function getSolvedDate()
    {
        return $this->solvedDate;
    }

    /**
     * Simpan .
     *
     * @param  $solvedDate.
     */
    public function setSolvedDate($solvedDate)
    {
        $this->solvedDate = $solvedDate;
    }

    /**
     * Ambil .
     *
     * @return  $id.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Simpan .
     *
     * @param  $id.
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Ambil .
     *
     * @return  $createdDate.
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Simpan .
     *
     * @param  $createdDate.
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * Ambil .
     *
     * @return  $kode.
     */
    public function getKode()
    {
        return $this->kode;
    }

    /**
     * Simpan .
     *
     * @param  $kode.
     */
    public function setKode($kode)
    {
        $this->kode = $kode;
    }

    /**
     * Ambil .
     *
     * @return  $pesan.
     */
    public function getPesan()
    {
        return $this->pesan;
    }

    /**
     * Simpan .
     *
     * @param  $pesan.
     */
    public function setPesan($pesan)
    {
        $this->pesan = $pesan;
    }

    /**
     * Ambil .
     *
     * @return  $query.
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Simpan .
     *
     * @param  $query.
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * Ambil .
     *
     * @return  $param.
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * Simpan .
     *
     * @param  $param.
     */
    public function setParam($param)
    {
        $this->param = $param;
    }
}
?>