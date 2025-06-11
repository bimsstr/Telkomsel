<?php

use Presentation\ValidationErrorsRenderer,
	Utilities\ValidationError,
	DataSource\HomeAboutDataSource,
	Domain\HomeAboutDomain,
	Domain\HomeAboutDetailDomain;;


class Lists extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";
	private $homeaboutDataSource;

	protected function initialize()
	{
		$this->homeaboutDataSource = New HomeAboutDataSource($this->mysqli);
	}

	public function index()
	{
		$this->renderLists_homeabout();
	}

	private function renderLists_homeabout()
	{
        $this->htmlHeaderFooter->addJsAsset(array(
          'js/jquery-datatable.js' => FALSE,
          'js/admin.js' => FALSE,
        ));

		$keyword = $this->request->getGet('keyword_product');
		$currentPage = $this->request->getGet('p', 1 , 'page');
		$limit = ($currentPage - 1) * $this->maxDataPerPage;
		$homeaboutDomainArray = $this->homeaboutDataSource->getAllHomeAboutDomainByLimit( $limit, $this->maxDataPerPage, $keyword);
		$homeaboutdetailDomainArray = $this->homeaboutDataSource->getAllHomeAboutDetailDomainByLimit($limit, $this->maxDataPerPage, $keyword);


		$path = array('homeabout');
		$sumData = $homeaboutDomainArray['jumlahData'];
		$sumData2 = $homeaboutdetailDomainArray['jumlahData'];
		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;

		$this->headerBar = $this->htmlHeaderFooter->addJsDeleteCode();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homeabout');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		//----data

		// breadcrumb
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home About','','')
    	);
		// end breadcrumb

		$this->overideViewVariable(array(
    	    'keyword' => $keyword,
    	    'homeaboutDomainArray' => $homeaboutDomainArray['homeaboutDomainArray'],
    	    'homeaboutdetailDomainArray' => $homeaboutdetailDomainArray['homeaboutdetailDomainArray'],
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $homeaboutDomainArray['jumlahData'],
    	    'jumlahData' => $homeaboutdetailDomainArray['jumlahData'],
    	    'no' => $limit
    	));

		$this->load->view('setting_home_about/lists', $this->viewVariable);
	}
}
?>