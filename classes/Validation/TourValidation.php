<?php

namespace Validation;

use Utilities\ValidationErrors;

class TourValidation extends RootValidation
{
    public function validateForInsertUpdateTourData($data)
    {
        if ($this->isNotEmpty($data['title']) == FALSE)
        {

            $this->validationErrors->add('title', $this->lang->getRequiredErrorMessage("title"));
        }

        if ($this->isNotEmpty($data['destinasi']) == FALSE)
        {

            $this->validationErrors->add('destinasi', $this->lang->getRequiredErrorMessage("destinasi"));
        }

        if ($this->isNotEmpty($data['durasi_day']) == FALSE)
        {

            $this->validationErrors->add('durasi_day', $this->lang->getRequiredErrorMessage("durasi day"));
        }

        if ($this->isNotEmpty($data['durasi_night']) == FALSE)
        {

            $this->validationErrors->add('durasi_night', $this->lang->getRequiredErrorMessage("durasi night"));
        }

        if ($this->isNotEmpty($data['tipe_tour']) == FALSE)
        {

            $this->validationErrors->add('tipe_tour', $this->lang->getRequiredErrorMessage("tipe tour"));
        }

    	if ($data['tipe_tour'] == 'opentrip')
    	{
    		if ($this->isNotEmpty($data['tanggalOpenTrip']) == FALSE)
    		{

    			$this->validationErrors->add('tanggalOpenTrip', $this->lang->getRequiredErrorMessage("tanggal open trip"));
    		}
    	}

        if ($data['kategori'] == NULL)
        {
            $this->validationErrors->add('kategori', $this->lang->getRequiredErrorMessage("kategori"));
        }

        $stringDescription = str_replace("<p><br></p>","",$data['highlight']);

        if ($this->isNotEmpty($stringDescription) == FALSE)
        {
            $this->validationErrors->add('highlight', $this->lang->getRequiredErrorMessage('highlight'));
        }

        return !($this->validationErrors->hasError());
    }

	public function validateForUpdateTourDataHarga($data)
	{
		if ($this->isNotEmpty($data['harga_publish']) == FALSE)
		{

			$this->validationErrors->add('harga_publish', $this->lang->getRequiredErrorMessage("harga_publish"));
		}

		return !($this->validationErrors->hasError());
	}

	public function validateForInsertHighSession($data)
	{
		if ($this->isNotEmpty($data['destinasi']) == FALSE)
		{

			$this->validationErrors->add('destinasi', $this->lang->getRequiredErrorMessage("Destinasi"));
		}

		if ($this->isNotEmpty($data['list_tgl_high_ses']) == FALSE)
		{

			$this->validationErrors->add('list_tgl_high_ses', $this->lang->getRequiredErrorMessage("Tanggal high session"));
		}

		return !($this->validationErrors->hasError());
	}
}