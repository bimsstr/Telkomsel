<?php


class Not_found extends RootController
{


	protected function initialize()
	{

	}

	public function index()
	{
		$this->htmlHeaderFooter->addJsCustomCode('

		');

		$this->htmlHeaderFooter->addCssAsset(array(

		));

		$this->htmlHeaderFooter->addJsAsset(array(

		));

		$this->htmlHeaderFooter->setDescription();
		$this->htmlHeaderFooter->setKeywords();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar('home');
		$this->footerBar = $this->menuBarRenderer->renderFooterBar();

		$this->overideViewVariable();

		$this->load->view('not_found', $this->viewVariable);
	}

}