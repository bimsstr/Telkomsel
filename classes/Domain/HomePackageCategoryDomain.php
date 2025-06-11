<?php

namespace Domain;

class HomePackageCategoryDomain extends RootDomain
{
    private $id;
    private $category;

    public function __construct(
        $id,
        $category
    )
    {
        $this->id = $id;
        $this->category = $category;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }
}
?>