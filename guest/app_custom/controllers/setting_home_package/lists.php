<?php

use Presentation\ValidationErrorsRenderer,
	Utilities\ValidationError,
	DataSource\HomePackageDataSource,
	Domain\HomePackageDomain,
	Domain\HomePackageCategoryDomain,
	Domain\HomePackageDetailDomain,
	Domain\HomePackageBlogDomain;


class Lists extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";

	protected function initialize()
	{
		$this->homepackageDataSource = New HomePackageDataSource($this->mysqli);
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
		$homepackageDomainArray = $this->homepackageDataSource->getAllHomePackageDomainByLimit( $limit, $this->maxDataPerPage, $keyword);
		$homepackagecategoryDomainArray = $this->homepackageDataSource->getAllHomePackageCategoryDomainByLimit($limit, $this->maxDataPerPage, $keyword);
		$homepackagedetailDomainArray = $this->homepackageDataSource->getAllHomePackageDetailDomainByLimit($limit, $this->maxDataPerPage, $keyword);
		$homepackageblogDomainArray = $this->homepackageDataSource->getAllHomePackageBlogDomainByLimit($limit, $this->maxDataPerPage, $keyword);


		$path = array('setting_home_package/lists');
		$sumData = $homepackagedetailDomainArray['jumlahData'];
		// $sumData2 = $homepackagedetailDomainArray['jumlahData'];
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
    	    'homepackagedetailDomainArray' => $homepackagedetailDomainArray['homepackagedetailDomainArray'],
    	    'homepackageblogDomainArray' => $homepackageblogDomainArray['homepackageblogDomainArray'],
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $homepackagedetailDomainArray['jumlahData'],
    	    // 'jumlahData' => $homewhyusdetailDomainArray['jumlahData'],
    	    'no' => $limit
    	));


		$this->load->view('setting_home_package/lists', $this->viewVariable);
	}
}
?>