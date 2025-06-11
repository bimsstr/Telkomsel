<?php

use Domain\HomeSKDetailDomain,
    DataSource\HomeSKDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';

    protected function initialize()
    {
        $this->homeskDataSource = New HomeSKDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

    	$homeskdetailDomain = $this->homeskDataSource->getHomeSKDetailDomainById($id);

    	if(!($homeskdetailDomain instanceof HomeSKDetailDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-sk');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homeskdetail")
        {
            $this->processEdit($homeskdetailDomain);
            return;
        }

        $this->renderEdit($homeskdetailDomain);


    }

    private function processEdit(HomeSKDetailDomain $homeskdetailDomain)
    {
        $data = $this->request->getPost();
        // var_dump($data);
        // exit();
        //DATA
        $sk_category = $this->request->getPost('sk_category');
        $sk_description = $this->request->getPost('sk_description');
        $sk_status = $this->request->getPost('sk_status');
        $now = date_create('now')->format('Y-m-d H:i:s');

        $homeskdetailDomain->setCategory($sk_category);
        $homeskdetailDomain->setDescription($sk_description);
        $homeskdetailDomain->setStatus($sk_status);
        $homeskdetailDomain->setCreatedDate($now);

        if($this->homeskDataSource->update_skd($homeskdetailDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('setting-home-sk-detail/edit');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-sk');
            return;
    }

    private function renderEdit(HomeSKDetailDomain $homeskdetailDomain, ValidationErrors $validationErrors = NULL)
    {
        if ($validationErrors == NULL)
        {
            $validationErrors = new ValidationErrors();
        }

        $this->htmlHeaderFooter->addCssAsset(array(
 
        ));

        $this->htmlHeaderFooter->addJsAsset(array(
          'js/bundles/ckeditor-full/ckeditor.js' => FALSE,
          'js/admin.js' => FALSE,
        ));


        $this->htmlHeaderFooter->addJsCustomCode("
        $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload3').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

         function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload4').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#imgInp1').change(function(){
            readURL1(this);
            });

        $('#imgInp2').change(function(){
            readURL2(this);
            });

        $('#imgInp3').change(function(){
            readURL3(this);
            });
    ");

        $currentPage = $this->request->getGet('p', 1 , 'page');
        $limit = ($currentPage - 1) * $this->maxDataPerPage;
        $homeskdetailDomainArray = $this->homeskDataSource->getAllHomeSKDetailDomainByLimit( $limit, $this->maxDataPerPage, $keyword);

        $path = array('homesk');
        $sumData = $homeskdetailDomainArray['jumlahData'];

        $this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
        $pagination = $this->pagination;

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homesk');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Syarat dan Ketentuan',$this->urlBuilder->build('setting-home-sk','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

        //DATA
        $homeskDomainArray = $this->homeskDataSource->getAllHomeSKDomain();

		$this->overideViewVariable(array(
			'homeskdetailDomain' => $homeskdetailDomain,
            'homeskDomainArray' => $homeskDomainArray
        ));

        $this->load->view('setting_home_sk_detail/edit', $this->viewVariable);
    }
}
?>
