<?php

use DataSource\MessageDataSource,
	Domain\MessageDomain,
	Presentation\ValidationErrorsRenderer,
	Utilities\ValidationError;


class Read extends AdminController
{
	protected $requiredAdminStatus = "LoggedIn";
	
	protected function initialize()
	{
		$this->messageDataSource = New MessageDataSource($this->mysqli);
	}

	public function index()
	{
		$id = $this->request->getGet('id');

    	$messageDomain = $this->messageDataSource->getMessageDomainById($id);

    	if(!($messageDomain instanceof MessageDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('message');
    		return;
    	}

		$this->processEdit($messageDomain);


		if($this->request->getPost('process') == "edit_mailstatus")
        {
            $this->processEdit_Unread($messageDomain);
            return;
        }

		$this->renderLists($id);
	}

	private function processEdit(MessageDomain $messageDomain)
    {
        $data = $this->request->getPost();

        //Status
        $mail_status = "read";

        $messageDomain->setStatus($mail_status);

    	$this->messageDataSource->update_status($messageDomain);
    }

     function processEdit_Unread(MessageDomain $messageDomain)
    {
        $data = $this->request->getPost();

        //Status
        $mail_status = "unread";

        $messageDomain->setStatus($mail_status);

    	if($this->messageDataSource->update_status($messageDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('message/read');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('message');
            return;
    }

	private function renderLists($id)
	{
        $this->htmlHeaderFooter->addJsAsset(array(
          'js/jquery-datatable.js' => FALSE,
          'js/admin.js' => FALSE,
        ));

		$keyword = $this->request->getGet('keyword_product');
		$currentPage = $this->request->getGet('p', 1 , 'page');
		$limit = ($currentPage - 1) * $this->maxDataPerPage;
		$messageDomainArray = $this->messageDataSource->getAllMessageDomainByLimit( $limit, $this->maxDataPerPage, $id);
		$unreademailcountArray = $this->messageDataSource->countUnreadEmail();

		$path = array('message');
		$sumData = $messageDomainArray['jumlahData'];
		$this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
		$pagination = $this->pagination;

		$this->headerBar = $this->htmlHeaderFooter->addJsDeleteCode();
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('message');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		//----data

		// breadcrumb
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Email','','')
    	);
		// end breadcrumb

		$this->overideViewVariable(array(
    	    'keyword' => $keyword,
    	    'messageDomainArray' => $messageDomainArray['messageDomainArray'],
    	    'unreademailcountArray' => $unreademailcountArray,
    	    'pagination' => $pagination,
    	    'maxData' => $this->maxDataPerPage,
    	    'jumlahData' => $messageDomainArray['jumlahData'],
    	    'no' => $limit
    	));

		$this->load->view('message/read', $this->viewVariable);
	}
}
?>