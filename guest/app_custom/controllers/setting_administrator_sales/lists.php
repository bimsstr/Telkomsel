<?php

use Presentation\ValidationErrorsRenderer,
	Utilities\ValidationErrors;

class Lists extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";

	protected function initialize()
	{
	}

	public function index()
	{
		$this->renderLists();
	}

	private function renderLists()
	{

		if ($validationErrors == NULL)
        {
            $validationErrors = new ValidationErrors();
        }

        $this->htmlHeaderFooter->addJsAsset(array(
			'js/jquery-datatable.js' => FALSE,
			'js/admin.js' => FALSE,
        ));

		$keyword = $this->request->getGet('keyword');
		$currentPage = $this->request->getGet('p', 1 , 'page');
		$limit = ($currentPage - 1) * $this->maxDataPerPage;
		$adminDomainArray = $this->adminDataSource->getAllAdminDomainbyTiernya( $limit, $this->maxDataPerPage, $keyword);

		$path = array('setting-administrator');
		$sumData = $adminDomainArray['jumlahData'];
		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;


		$this->headerBar = $this->htmlHeaderFooter->addJsDeleteCode();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('setting_admin_sales');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();

		//----data

		// breadcrumb
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array(' Administrator','','')
    	);
		// end breadcrumb

		$this->overideViewVariable(array(
    	    'keyword' => $keyword,
    	    'adminDomainArray' => $adminDomainArray['adminDomainArray'],
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $adminDomainArray['jumlahData'],
    	    'no' => $limit
    	));

		$this->load->view('setting_administrator_sales/lists', $this->viewVariable);
	}
}
?>