<?php

use DataSource\HomeKPDataSource,
	Domain\HomeKPDomain,
	Domain\HomeKPTitleDomain,
	Domain\HomeKPDetailDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationError;


class Lists extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";
	
	protected function initialize()
	{
		$this->homekpDataSource = New HomeKPDataSource($this->mysqli);
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
		$homekpDomainArray = $this->homekpDataSource->getAllHomeKPDomainByLimit( $limit, $this->maxDataPerPage, $keyword);
		$homekptitleDomainArray = $this->homekpDataSource->getAllHomeKPTitleDomainByLimit( $limit, $this->maxDataPerPage, $keyword);
		$homekpdetailDomainArray = $this->homekpDataSource->getAllHomeKPDetailDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


		$path = array('homekp');
		$sumData = $homekptitleDomainArray['jumlahData'];
		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;

		$this->headerBar = $this->htmlHeaderFooter->addJsDeleteCode();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homekp');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		//----data

		// breadcrumb
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home Kebijakan Privasi','','')
    	);
		// end breadcrumb

		$this->overideViewVariable(array(
    	    'keyword' => $keyword,
    	    'homekpDomainArray' => $homekpDomainArray['homekpDomainArray'],
    	    'homekptitleDomainArray' => $homekptitleDomainArray['homekptitleDomainArray'],
    	    'homekpdetailDomainArray' => $homekpdetailDomainArray['homekpdetailDomainArray'],
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $homekptitleDomainArray['jumlahData'],
    	    'no' => $limit
    	));

		$this->load->view('setting_home_kp/lists', $this->viewVariable);
	}
}
?>
