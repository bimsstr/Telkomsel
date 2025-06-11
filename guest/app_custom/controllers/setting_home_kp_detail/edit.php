<?php

use Domain\HomeKPDetailDomain,
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

    	$homekpdetailDomain = $this->homekpDataSource->getHomeKPDetailDomainById($id);

    	if(!($homekpdetailDomain instanceof HomeKPDetailDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-kp');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homekpdetail")
        {
            $this->processEdit($homekpdetailDomain);
            return;
        }

        $this->renderEdit($homekpdetailDomain);


    }

    private function processEdit(HomeKPDetailDomain $homekpdetailDomain)
    {
        $data = $this->request->getPost();
        //DATA
        $kp_category = $this->request->getPost('kp_category');
        $kp_description = $this->request->getPost('kp_description');
        $kp_status = $this->request->getPost('kp_status');
        $now = date_create('now')->format('Y-m-d H:i:s');

        $homekpdetailDomain->setCategory($kp_category);
        $homekpdetailDomain->setDescription($kp_description);
        $homekpdetailDomain->setStatus($kp_status);
        $homekpdetailDomain->setCreatedDate($now);

        if($this->homekpDataSource->update_kpd($homekpdetailDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('setting-home-kp-detail/edit');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-kp');
            return;
    }

    private function renderEdit(HomeKPDetailDomain $homekpdetailDomain, ValidationErrors $validationErrors = NULL)
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
        $homekpdetailDomainArray = $this->homekpDataSource->getAllHomeKPDetailDomainByLimit( $limit, $this->maxDataPerPage, $keyword);

        $path = array('homekp');
        $sumData = $homekpdetailDomainArray['jumlahData'];

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
            array('Home Syarat dan Ketentuan',$this->urlBuilder->build('setting-home-kp','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

        //DATA
        $homekpDomainArray = $this->homekpDataSource->getAllHomeKPDomain();

		$this->overideViewVariable(array(
			'homekpdetailDomain' => $homekpdetailDomain,
            'homekpDomainArray' => $homekpDomainArray
        ));

        $this->load->view('setting_home_kp_detail/edit', $this->viewVariable);
    }
}
?>
