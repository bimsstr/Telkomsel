<?php

namespace Presentation;

use Utilities\ValidationErrors;

class ValidationErrorsRenderer extends RootPresentation
{
    protected $validationErrors;

    public function __construct(ValidationErrors $validationErrors)
    {
        $this->validationErrors = $validationErrors;
    }

	public function setValidationErrors(ValidationErrors $validationErrors)
	{
		$this->valdiationErrors = $validationErrors;
	}

    public function hasError()
    {
        return $this->validationErrors->hasError();
    }

    public function renderFormErrorMessageToHtml($class = 'formErrorMessage')
    {
        if ($this->validationErrors->hasErrors() == FALSE)
        {
            return '';
        }

        return
            '<div class="'. $class .'">
                Ada kesalahan dalam formulir, mohon diperbaiki.
            </div>';
    }

    public function renderToHtml($fieldName)
    {
     $message = $this->validationErrors->get($fieldName);

        if (empty($message))
        {
            return '';
        }

        $renderedField = '<p class="color_red">'.$message[0].'</p>';

        return $renderedField;
    }

    public function renderToString($fieldName)
    {
        $errors = $this->validationErrors->get($fieldName);

        if (empty($errors))
        {
            return NULL;
        }

        return $errors[0];
    }

    public function renderHeaderErrors()
    {
        $errorArray = $this->validationErrors->getAll();
        $html = '';

        if (count($errorArray) > 0)
        {
            $html .= '<div class="error alert">
				        <div class="left alert-content">
					        Ups! Terjadi kesalahan
					        <ul>';
			foreach ($errorArray as $error)
            {
			    $html .= '<li>'.$error[0].'</li>';
            }

			$html .= '</ul>
                    </div>
			    </div>';
        }

        return $html;
    }

    public function renderHeaderAdminErrors()
    {


        $errorArray = $this->validationErrors->getAll();
        $html = '';

        if (count($errorArray) > 0)
        {
            $html .= '<div class="alert alert-success">
                        <button class="close" data-dismiss="alert" type="button">กั</button>
					        Ups! Terjadi kesalahan
					        <ul>';
            foreach ($errorArray as $error)
            {
                $html .= '<li>'.$error[0].'</li>';
            }

            $html .= '</div>';
        }

        return $html;
    }

    public function renderToAdminHtml($fieldName)
    {
        $message = $this->validationErrors->get($fieldName);
        if (empty($message))
        {
            return '';
        }

        $renderedField = '<h6 class="label label-danger">'.$message[0].'</h6>';

        return $renderedField;
    }

	public function renderForAjaxRequest()
	{
		$arrayMessage = $this->validationErrors->getAll();
		$return = array();
		foreach($arrayMessage as $key => $val) :
			$return[] = array("field" => $key, "message" => $val[0]);
		endforeach;

		return $return;
	}
}