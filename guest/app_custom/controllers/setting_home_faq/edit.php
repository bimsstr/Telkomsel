<?php

use Domain\HomeFaqDomain,
    Domain\HomeFaqCategoryDomain,
    DataSource\HomeFaqDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';

    protected function initialize()
    {
        $this->homefaqDataSource = New HomeFaqDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

    	$homefaqDomain = $this->homefaqDataSource->getHomeFaqDomainById($id);

    	if(!($homefaqDomain instanceof HomeFaqDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-faq');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homefaq")
        {
            $this->processEdit($homefaqDomain);
            return;
        }

        $this->renderEdit($homefaqDomain);


    }

    private function processEdit(HomeFaqDomain $homefaqDomain)
    {
        $data = $this->request->getPost();

        //DATA
        $category = $this->request->getPost('faq_category');
        $pertanyaan = $this->request->getPost('faq_pertanyaan');
        $jawaban = $this->request->getPost('faq_jawaban');
        $status = $this->request->getPost('faq_status');
        $now = date_create('now')->format('Y-m-d H:i:s');
        

        $homefaqDomain->setCategory($category);
        $homefaqDomain->setPertanyaan($pertanyaan);
        $homefaqDomain->setJawaban($jawaban);
        $homefaqDomain->setCreatedDate($now);
        $homefaqDomain->setStatus($status);

        if($this->homefaqDataSource->update($homefaqDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('setting-home-faq/edit');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-faq');
            return;
    }

    private function renderEdit(HomeFaqDomain $homefaqDomain, ValidationErrors $validationErrors = NULL)
    {
        if ($validationErrors == NULL)
        {
            $validationErrors = new ValidationErrors();
        }

        $this->htmlHeaderFooter->addCssAsset(array(
 
        ));

        $this->htmlHeaderFooter->addJsAsset(array(
          'js/bundles/ckeditor-full/ckeditor.js' => FALSE,
          'js/admin.js' => FALSE
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
        $homefaqDomainArray = $this->homefaqDataSource->getAllHomeFaqDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


        $path = array('homefaq');
        $sumData = $homefaqDomainArray['jumlahData'];

        $this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
        $pagination = $this->pagination;
		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homefaq');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home FAQ',$this->urlBuilder->build('setting-home-faq','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

        //DATA
        $homefaqcategoryDomainArray = $this->homefaqDataSource->getAllHomeFaqCategoryDomain();

		$this->overideViewVariable(array(
			'homefaqDomain' => $homefaqDomain,
            'homefaqcategoryDomainArray' => $homefaqcategoryDomainArray,
        ));

        $this->load->view('setting_home_faq/edit', $this->viewVariable);
    }
}
?>