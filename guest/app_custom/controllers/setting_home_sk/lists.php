<?php

use DataSource\HomeSKDataSource,
	Domain\HomeSKDomain,
	Domain\HomeSKDetailDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationError;


class Lists extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";
	
	protected function initialize()
	{
		$this->homeskDataSource = New HomeSKDataSource($this->mysqli);
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
		$homeskDomainArray = $this->homeskDataSource->getAllHomeSKDomainByLimit( $limit, $this->maxDataPerPage, $keyword);
		$homeskdetailDomainArray = $this->homeskDataSource->getAllHomeSKDetailDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


		$path = array('setting_home_sk/lists');
		$sumData = $homeskDomainArray['jumlahData'];
		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;

		$this->headerBar = $this->htmlHeaderFooter->addJsDeleteCode();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homesk');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		//----data

		// breadcrumb
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home Syarat dan Ketentuan','','')
    	);
		// end breadcrumb

		$this->overideViewVariable(array(
    	    'keyword' => $keyword,
    	    'homeskDomainArray' => $homeskDomainArray['homeskDomainArray'],
    	    'homeskdetailDomainArray' => $homeskdetailDomainArray['homeskdetailDomainArray'],
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $homeskDomainArray['jumlahData'],
    	    'no' => $limit
    	));

		$this->load->view('setting_home_sk/lists', $this->viewVariable);
	}
}
?>
