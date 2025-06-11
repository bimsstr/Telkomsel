<?php

class _Blank extends RootController
{
	protected function initialize()
	{

	}

	public function index()
	{
		$this->renderHome();
	}

	private function renderHome()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			$(".show-notification").click(function(e){
				e.preventDefault();
				$("body").pgNotification({
					style: "simple",
					message: "This notification looks so perfect!",
					position: "top-left",
					timeout: 0,
					type: "error"
				}).show();
			});
		');
		
		$this->htmlHeaderFooter->addCssAsset(array(
		
		));
		
		$this->htmlHeaderFooter->addJsAsset(array(
		
		));

		$this->htmlHeaderFooter->setDescription('Bisnis tiket pesawat dan loket ppob modal minimal untung maksimal bersama '.$this->perusahaan.'.');
        $this->htmlHeaderFooter->setKeywords(strtolower($this->perusahaan).',peluang bisnis,bisnis tiket,bisnis keagenan,bisnis,tiket pesawat,modal minimal,untung maksimal,loket,ppob');
        $this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader($this->perusahaan.' - Bisnis Tiket & Loket');
        $this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar('home');
        $this->footerBar = $this->menuBarRenderer->renderFooterBar();

		// breadcrumb
		$this->breadcrumbArray = array(
			array('', $this->urlBuilder->getBaseUrl(), '', 'home'),
		    array('Blank', '#', '', '')
		);

		$this->overideViewVariable();

		$this->load->view('others/_blank', $this->viewVariable);
	}
}