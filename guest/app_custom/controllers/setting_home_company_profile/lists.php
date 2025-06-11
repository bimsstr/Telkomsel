<?php

use DataSource\HomeCompanyProfileDataSource,
	Domain\HomeCompanyProfileDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationError;


class Lists extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";
	
	protected function initialize()
	{
		$this->homecompanyprofileDataSource = New HomeCompanyProfileDataSource($this->mysqli);
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
		$homecompanyprofileDomainArray = $this->homecompanyprofileDataSource->getAllHomeCompanyProfileDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


		$path = array('homecompanyprofile');
		$sumData = $homecompanyprofileDomainArray['jumlahData'];
		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;

		$this->headerBar = $this->htmlHeaderFooter->addJsDeleteCode();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homecp');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		//----data

		// breadcrumb
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home Company Profile','','')
    	);
		// end breadcrumb

		$this->overideViewVariable(array(
    	    'keyword' => $keyword,
    	    'homecompanyprofileDomainArray' => $homecompanyprofileDomainArray['homecompanyprofileDomainArray'],
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $homecompanyprofileDomainArray['jumlahData'],
    	    'no' => $limit
    	));

		$this->load->view('setting_home_company_profile/lists', $this->viewVariable);
	}
}
?>