<?php

use DataSource\HomeProfilKamiDataSource,
	Domain\HomeProfilKamiDomain,
	Domain\HomeProfilKamiTitleDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationError;


class Lists extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";
	
	protected function initialize()
	{
		$this->homeprofilkamiDataSource = New HomeProfilKamiDataSource($this->mysqli);
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
		$homeprofilkamiDomainArray = $this->homeprofilkamiDataSource->getAllHomeProfilKamiDomainByLimit( $limit, $this->maxDataPerPage, $keyword);
		$homeprofilkamititleDomainArray = $this->homeprofilkamiDataSource->getAllHomeProfilKamiTitleDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


		$path = array('homeprofilkami');
		$sumData = $homeprofilkamiDomainArray['jumlahData'];
		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;

		$this->headerBar = $this->htmlHeaderFooter->addJsDeleteCode();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('profilkami');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		//----data

		// breadcrumb
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home Profil Kami','','')
    	);
		// end breadcrumb

		$this->overideViewVariable(array(
    	    'keyword' => $keyword,
    	    'homeprofilkamiDomainArray' => $homeprofilkamiDomainArray['homeprofilkamiDomainArray'],
    	    'homeprofilkamititleDomainArray' => $homeprofilkamititleDomainArray['homeprofilkamititleDomainArray'],
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $homeprofilkamiDomainArray['jumlahData'],
    	    'no' => $limit
    	));

		$this->load->view('setting_home_profil_kami/lists', $this->viewVariable);
	}
}
?>
