<?php

use Presentation\ValidationErrorsRenderer,
	Utilities\ValidationError,
	DataSource\HomePackageAfiliasiDataSource,
	Domain\HomePackageDomain,
	Domain\HomePackageCategoryDomain,
	Domain\HomePackageAfiliasiDomain,
	Domain\HomePackageBlogDomain;


class Lists extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homepackageafiliasiDataSource = New HomePackageAfiliasiDataSource($this->mysqli);
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
		$usernamesales = $this->adminDomain->getUsername();
		$limit = ($currentPage - 1) * $this->maxDataPerPage;
		$homepackageDomainArray = $this->homepackageafiliasiDataSource->getAllHomePackageDomainByLimit( $limit, $this->maxDataPerPage, $keyword);
		$homepackagecategoryDomainArray = $this->homepackageafiliasiDataSource->getAllHomePackageCategoryDomainByLimit($limit, $this->maxDataPerPage, $keyword);
		$homepackageafiliasiDomainArray = $this->homepackageafiliasiDataSource->getAllHomePackageAfiliasiDomainByLimit($limit, $this->maxDataPerPage, $keyword,$usernamesales);
		$homepackageblogDomainArray = $this->homepackageafiliasiDataSource->getAllHomePackageBlogDomainByLimit($limit, $this->maxDataPerPage, $keyword);


		// var_dump($homepackageafiliasiDomainArray);
		// exit();

		$path = array('setting_home_package_afiliasi/lists');
		$sumData = $homepackageafiliasiDomainArray['jumlahData'];
		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;

		$this->headerBar = $this->htmlHeaderFooter->addJsDeleteCode();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homepackage');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		//----data

		// breadcrumb
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home Package','','')
    	);
		// end breadcrumb

		$this->overideViewVariable(array(
    	    'keyword' => $keyword,
    	    'homepackageDomainArray' => $homepackageDomainArray['homepackageDomainArray'],
    	    'homepackagecategoryDomainArray' => $homepackagecategoryDomainArray['homepackagecategoryDomainArray'],
    	    'homepackageafiliasiDomainArray' => $homepackageafiliasiDomainArray['homepackageafiliasiDomainArray'],
    	    'homepackageblogDomainArray' => $homepackageblogDomainArray['homepackageblogDomainArray'],
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $homepackageafiliasiDomainArray['jumlahData'],
    	    'no' => $limit
    	));


		$this->load->view('setting_home_package_afiliasi/lists', $this->viewVariable);
	}
}
?>