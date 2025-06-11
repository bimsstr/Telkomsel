<?php

use Domain\HomeKPTitleDomain,
    DataSource\HomeKPDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';

    protected function initialize()
    {
        $this->homekpDataSource = New HomeKPDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

    	$homekptitleDomain = $this->homekpDataSource->getHomeKPTitleDomainById($id);

    	if(!($homekptitleDomain instanceof HomeKPTitleDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-kp');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homekptitle")
        {
            $this->processEdit($homekptitleDomain);
            return;
        }

        $this->renderEdit($homekptitleDomain);


    }

    private function processEdit(HomeKPTitleDomain $homekptitleDomain)
    {
        $data = $this->request->getPost();
        //DATA
        $kp_description = $this->request->getPost('kp_description');
        $kp_status = $this->request->getPost('kp_status');
        $now = date_create('now')->format('Y-m-d H:i:s');

        $homekptitleDomain->setDescription($kp_description);
        $homekptitleDomain->setCreatedDate($now);
        $homekptitleDomain->setStatus($kp_status);

        if($this->homekpDataSource->update_kpt($homekptitleDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('setting-home-kp-title/edit');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-kp');
            return;
    }

    private function renderEdit(HomeKPTitleDomain $homekptitleDomain, ValidationErrors $validationErrors = NULL)
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
        $homekptitleDomainArray = $this->homekpDataSource->getAllHomeKPTitleDomainByLimit( $limit, $this->maxDataPerPage, $keyword);

        $path = array('homekp');
        $sumData = $homekptitleDomainArray['jumlahData'];

        $this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
        $pagination = $this->pagination;

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homekp');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Kebijakan Privasi',$this->urlBuilder->build('setting-home-kp','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

        //DATA
        $homekptitleDomainArray = $this->homekpDataSource->getAllHomeKPTitleDomain();

		$this->overideViewVariable(array(
			'homekptitleDomain' => $homekptitleDomain,
            'homekptitleDomainArray' => $homekptitleDomainArray
        ));

        $this->load->view('setting_home_kp_title/edit', $this->viewVariable);
    }
}
?>
