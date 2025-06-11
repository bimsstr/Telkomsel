<?php

namespace Validation;

use Utilities\ValidationErrors;

class SettingValidation extends RootValidation
{
    public function validateForInsertFAQ($data)
    {
        if ($this->isNotEmpty($data['admin-username']) == FALSE)
        {
            $this->validationErrors->add('admin-username', $this->lang->getRequiredErrorMessage("Admin Username"));
        }

        if ($this->isNotEmpty($data['title']) == FALSE)
        {
            $this->validationErrors->add('title', $this->lang->getRequiredErrorMessage('title'));
        }

    	if ($this->isNotEmpty($data['category']) == FALSE)
    	{
    		$this->validationErrors->add('category', $this->lang->getRequiredErrorMessage('category'));
    	}

        $stringDescription = str_replace("<p><br></p>","",$data['description']);

        if ($this->isNotEmpty($stringDescription) == FALSE)
        {
            $this->validationErrors->add('description', $this->lang->getRequiredErrorMessage('description'));
        }

        return !($this->validationErrors->hasError());
    }

	public function validateForInsertSyaratKetentuan($data)
	{
		if ($this->isNotEmpty($data['admin-username']) == FALSE)
		{
			$this->validationErrors->add('admin-username', $this->lang->getRequiredErrorMessage("Admin Username"));
		}

		if ($this->isNotEmpty($data['title']) == FALSE)
		{
			$this->validationErrors->add('title', $this->lang->getRequiredErrorMessage('title'));
		}

		$stringDescription = str_replace("<p><br></p>","",$data['description']);

		if ($this->isNotEmpty($stringDescription) == FALSE)
		{
			$this->validationErrors->add('description', $this->lang->getRequiredErrorMessage('description'));
		}

		return !($this->validationErrors->hasError());
	}

    public function validateForInsertCategory($data)
    {
        if ($this->isNotEmpty($data['admin-username']) == FALSE)
        {
            $this->validationErrors->add('admin-username',$this->lang->getRequiredErrorMessage());
        }

        if ($this->isNotEmpty($data['name-category']) == FALSE)
        {
            $this->validationErrors->add('name-category', $this->lang->getRequiredErrorMessage('Name Category'));
        }

        return !($this->validationErrors->hasError());
    }

    public function validateForInsertHomeSlider($data, $fileArray,$tipe=NULL)
    {
        if ($this->isNotEmpty($data['admin-username']) == FALSE)
        {
            $this->validationErrors->add('admin-username',$this->lang->getRequiredErrorMessage());
        }

        if ($this->isNotEmpty($data['title']) == FALSE)
        {
            $this->validationErrors->add('title', $this->lang->getRequiredErrorMessage('title'));
        }

        if ($this->isNotEmpty($data['status_active']) == FALSE)
        {
            $this->validationErrors->add('status_active', $this->lang->getRequiredErrorMessage('status active'));
        }

        // if ($this->isNotEmpty($data['url']) == FALSE)
        // {
        //     $this->validationErrors->add('url', $this->lang->getRequiredErrorMessage('url'));
        // }

    	if ($this->isNotEmpty($data['sub_title'][0]) == '')
    	{
    	    $this->validationErrors->add('sub_title', $this->lang->getRequiredErrorMessage('sub_title'));
    	}

        if ($fileArray['error'] == 4 && $fileArray['size'] == 0 && $tipe==NULL) {
             $this->validationErrors->add('image', $this->lang->getRequiredErrorMessage('image'));
        }

        return !($this->validationErrors->hasError());
    }

    public function validateForInsertSearchSlider($data, $fileArray,$tipe=NULL)
    {
        if ($this->isNotEmpty($data['admin-username']) == FALSE)
        {
            $this->validationErrors->add('admin-username',$this->lang->getRequiredErrorMessage());
        }

        if ($this->isNotEmpty($data['status_active']) == FALSE)
        {
            $this->validationErrors->add('status_active', $this->lang->getRequiredErrorMessage('status active'));
        }

        if ($fileArray['error'] == 4 && $fileArray['size'] == 0 && $tipe==NULL) {
             $this->validationErrors->add('image', $this->lang->getRequiredErrorMessage('image'));
        }

        return !($this->validationErrors->hasError());
    }

    public function validateForInsertDestination($data, $fileArray,$tipe=NULL)
    {
        if ($this->isNotEmpty($data['name']) == FALSE)
        {
            $this->validationErrors->add('name',$this->lang->getRequiredErrorMessage());
        }

        if ($fileArray['error'] == 4 && $fileArray['size'] == 0 && $tipe==NULL) {
             $this->validationErrors->add('image', $this->lang->getRequiredErrorMessage('image'));
        }

        return !($this->validationErrors->hasError());
    }

    public function validateForInsertPortofolio($data, $fileArray,$tipe=NULL)
    {
        if ($this->isNotEmpty($data['title']) == FALSE)
        {
            $this->validationErrors->add('title',$this->lang->getRequiredErrorMessage());
        }

        if ($fileArray['error'] == 4 && $fileArray['size'] == 0 && $tipe==NULL) {
             $this->validationErrors->add('image', $this->lang->getRequiredErrorMessage('image'));
        }

        return !($this->validationErrors->hasError());
    }
}