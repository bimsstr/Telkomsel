<?php

use Domain\AdminDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationErrors;

class Dashboard extends AdminController
{
	protected $requiredAdminStatus = 'LoggedIn';



	protected function initialize()
	{
	}

	public function index()
	{

		$this->renderDashboard();
	}

	private function renderDashboard()
	{
		$this->htmlHeaderFooter->addJsCustomCode('
			 $(".clickable-row").click(function() {
		        window.location = $(this).data("href");
		    });
    	');

    	$this->htmlHeaderFooter->addJsAsset(array(
		    'js/admin.js' => FALSE,
		));


		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
// 		$this->menuBarRenderer instanceof AdminMenuBarRenderer
// 		if ($this->menuBarRenderer instanceof AdminMenuBarRenderer) { // Pastikan objeknya ada
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('Dashboard');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
// 		echo "Mencoba menjalankan renderHeaderBar...<br>";

//   } else {
//             // Jika tidak ada menuBarRenderer (karena tidak login), atur ke string kosong atau nilai default
//             $this->sideBar = '';
//             $this->headerBar = '';
//         }
    
	


		$this->breadcrumbArray = array(
			array('Dashboard', '', '')
		);

		$this->overideViewVariable(array(
			'transacToday' => $transacToday,
			'transacAllMonth' => $transacAllMonth,
			'transacPaidMonth' => $transacPaidMonth,
			'transacFullPaidMonth' => $transacFullPaidMonth,
			'transacSuccessToday' => $transacSuccessToday,
			'transacSuccessMonth' => $transacSuccessMonth,
			'arrayTransacPaid' => $arrayTransacPaid
		)
		);

		$this->load->view('dashboard', $this->viewVariable);
	}
}