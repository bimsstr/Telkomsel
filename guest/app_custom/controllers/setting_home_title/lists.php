<?php

use Presentation\ValidationErrorsRenderer,
	Utilities\ValidationError,
	DataSource\HomeTitleDataSource,
	Domain\HomeTitleDomain;


class Lists extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";
	private $hometitleDataSource;

	protected function initialize()
	{
		$this->hometitleDataSource = New HomeTitleDataSource($this->mysqli);
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
		$hometitleDomainArray = $this->hometitleDataSource->getAllHomeTitleDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


		$path = array('hometitle');
		$sumData = $hometitleDomainArray['jumlahData'];
		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;

		$this->headerBar = $this->htmlHeaderFooter->addJsDeleteCode();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('hometitle');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		//----data

		// breadcrumb
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home Title','','')
    	);
		// end breadcrumb

		$this->overideViewVariable(array(
    	    'keyword' => $keyword,
    	    'hometitleDomainArray' => $hometitleDomainArray['hometitleDomainArray'],
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $hometitleDomainArray['jumlahData'],
    	    'no' => $limit
    	));

		$this->load->view('setting_home_title/lists', $this->viewVariable);
	}
}
?>