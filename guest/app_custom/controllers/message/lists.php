<?php

use DataSource\MessageDataSource,
	Domain\MessageDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationError;


class Lists extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";
	
	protected function initialize()
	{
		$this->messageDataSource = New MessageDataSource($this->mysqli);
	}

	public function index()
	{
		$this->renderLists();
	}

	private function renderLists()
	{
        $this->htmlHeaderFooter->addJsAsset(array(
          'js/jquery-datatable.js' => FALSE,
          'js/admin.js' => FALSE,
        ));

		$keyword = $this->request->getGet('keyword_product');
		$currentPage = $this->request->getGet('p', 1 , 'page');
		$limit = ($currentPage - 1) * $this->maxDataPerPage;
		$messageDomainArray = $this->messageDataSource->getAllMessageDomainByLimit( $limit, $this->maxDataPerPage, $keyword);
		$unreademailcountArray = $this->messageDataSource->countUnreadEmail();

		$path = array('message');
		$sumData = $messageDomainArray['jumlahData'];
		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;

		$this->headerBar = $this->htmlHeaderFooter->addJsDeleteCode();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('message');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		//----data

		// breadcrumb
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Email','','')
    	);
		// end breadcrumb

		$this->overideViewVariable(array(
    	    'keyword' => $keyword,
    	    'messageDomainArray' => $messageDomainArray['messageDomainArray'],
    	    'unreademailcountArray' => $unreademailcountArray,
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $messageDomainArray['jumlahData'],
    	    'no' => $limit
    	));

		$this->load->view('message/lists', $this->viewVariable);
	}
}
?>