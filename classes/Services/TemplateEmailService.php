<?php

namespace Services;

use DateTime,
	Utilities\UrlBuilder,
	Utilities\Convert;

class TemplateEmailService
{
	private $asset;
	private $urlBuilder;
	private $convert;

	public function __construct($asset, UrlBuilder $urlBuilder)
	{
		$this->asset = $asset;
		$this->urlBuilder = $urlBuilder;
		$this->convert = new Convert();
	}

	private function getHeaderTemplateEmailTour()
	{
		$grahatourLogo = $this->asset->getFileExternal('email_template/images/logo.png');

		$data = file_get_contents($this->asset->getFileExternal('email_template/header-admin.html'));
		$data = str_replace('*|company-logo|*', $grahatourLogo, $data);

		return $data;
	}

	private function getFooterTemplateEmailTour()
	{
		$asitaLogo = $this->asset->getFileExternal('email_template/images/asita_logo.png');
		
		$data = file_get_contents($this->asset->getFileExternal('email_template/footer-admin.html'));
		$data = str_replace('*|asita-logo|*', $asitaLogo, $data);
		$data = str_replace('*|year|*', date('Y'), $data);

		return $data;
	}


	private function renderTemplateEmailTour($htmlTemplate, array $dataReplace = array())
	{
		$html = $this->getHeaderTemplateEmailTour();
		$html .= $this->replace($htmlTemplate, $dataReplace);
		$html .= $this->getFooterTemplateEmailTour();

		return $html;
	}

	private function replace($data, array $dataReplace)
	{
		foreach ($dataReplace as $key => $val)
		{
			$data = str_replace($key, $val, $data);
		}

		return $data;
	}


	public function getConfirmForAdmin(array $dataReplace, $dataPost)
	{
		//<span style="line-height:25px;">Issued Date :</span><br><span style="line-height:15px;font-size:15px;font-weight:bold;">*|issuedDate|*</span>
		$htmlTemplate = file_get_contents($this->asset->getFileExternal('email_template/konfirmasi-admin.html'));

		return $this->renderTemplateEmailTour($htmlTemplate, $dataReplace);
	}

	public function getPesanForCustumer(array $dataReplace, $dataPost)
	{
		//<span style="line-height:25px;">Issued Date :</span><br><span style="line-height:15px;font-size:15px;font-weight:bold;">*|issuedDate|*</span>
		$htmlTemplate = file_get_contents($this->asset->getFileExternal('email_template/pesan-custumer.html'));

		return $this->renderTemplateEmailTour($htmlTemplate, $dataReplace);
	}

	public function getConfirmForCustumer(array $dataReplace, $dataPost)
	{
		//<span style="line-height:25px;">Issued Date :</span><br><span style="line-height:15px;font-size:15px;font-weight:bold;">*|issuedDate|*</span>
		$htmlTemplate = file_get_contents($this->asset->getFileExternal('email_template/konfirmasi-customer.html'));

		return $this->renderTemplateEmailTour($htmlTemplate, $dataReplace);
	}
	
	public function getConfirmForCustumerNotes(array $dataReplace, $dataPost)
	{
		//<span style="line-height:25px;">Issued Date :</span><br><span style="line-height:15px;font-size:15px;font-weight:bold;">*|issuedDate|*</span>
		$htmlTemplate = file_get_contents($this->asset->getFileExternal('email_template/konfirmasi-customer-catatan.html'));

		return $this->renderTemplateEmailTour($htmlTemplate, $dataReplace);
	}

	public function getConfirmPaidForCustumer(array $dataReplace, $dataPost)
	{
		//<span style="line-height:25px;">Issued Date :</span><br><span style="line-height:15px;font-size:15px;font-weight:bold;">*|issuedDate|*</span>
		$htmlTemplate = file_get_contents($this->asset->getFileExternal('email_template/konfirmasi-paid-customer.html'));

		return $this->renderTemplateEmailTour($htmlTemplate, $dataReplace);
	}

	public function getConfirmFullPaidForCustumer(array $dataReplace, $dataPost)
	{
		//<span style="line-height:25px;">Issued Date :</span><br><span style="line-height:15px;font-size:15px;font-weight:bold;">*|issuedDate|*</span>
		$htmlTemplate = file_get_contents($this->asset->getFileExternal('email_template/konfirmasi-fullpaid-customer.html'));

		return $this->renderTemplateEmailTour($htmlTemplate, $dataReplace);
	}



}
?>