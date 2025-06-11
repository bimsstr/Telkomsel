<?php

use DataSource\HomeFaqDataSource,
	Domain\HomeFaqDomain,
	Domain\HomeFaqCategoryDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationError;


class Lists extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";
	
	protected function initialize()
	{
		$this->homefaqDataSource = New HomeFaqDataSource($this->mysqli);
	}

	public function index()
	{
		$this->renderLists();
	}

	private function renderLists()
	{
        $this->htmlHeaderFooter->addJsAsset(array(
          'js/jquery-datatable.js' => FALSE,
          'js/admin.js' => FALSE
        ));

		$keyword = $this->request->getGet('keyword_product');
		$currentPage = $this->request->getGet('p', 1 , 'page');
		$limit = ($currentPage - 1) * $this->maxDataPerPage;
		$homefaqDomainArray = $this->homefaqDataSource->getAllHomeFaqDomainByLimit( $limit, $this->maxDataPerPage, $keyword);
		$homefaqcategoryDomainArray = $this->homefaqDataSource->getAllHomeFaqCategoryDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


		$path = array('homefaq');
		$sumData = $homefaqDomainArray['jumlahData'];
		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;


		$this->headerBar = $this->htmlHeaderFooter->addJsDeleteCode();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homefaq');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		//----data

		// breadcrumb
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home FAQ','','')
    	);
		// end breadcrumb

		$this->overideViewVariable(array(
    	    'keyword' => $keyword,
    	    'homefaqDomainArray' => $homefaqDomainArray['homefaqDomainArray'],
    	    'homefaqcategoryDomainArray' => $homefaqcategoryDomainArray['homefaqcategoryDomainArray'],
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $homefaqDomainArray['jumlahData'],
    	    'no' => $limit
    	));

		$this->load->view('setting_home_faq/lists', $this->viewVariable);
	}
}
?>
