<?php

use Domain\HomeProfilKamiDomain,
    DataSource\HomeProfilKamiDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';

    protected function initialize()
    {
        $this->homeprofilkamiDataSource = New HomeProfilKamiDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

        $homeprofilkamiDomain = $this->homeprofilkamiDataSource->getHomeProfilKamiDomainById($id);

        if(!($homeprofilkamiDomain instanceof HomeProfilKamiDomain))
        {
            $sessionMessage['type'] = 'warning';
            $sessionMessage['message'] = $this->lang->getInternalErrorMessage();
            $this->session->set('sessionAdminMessage', $sessionMessage);

            $this->redirect('setting-home-profil-kami');
            return;
        }

        if($this->request->getPost('process') == "edit_homeprofilkami")
        {
            $this->processEdit($homeprofilkamiDomain);
            return;
        }

        $this->renderEdit($homeprofilkamiDomain);
    }

    private function processEdit(HomeProfilKamiDomain $homeprofilkamiDomain)
    {
        $data = $this->request->getPost();

        $pk_description = $this->request->getPost('pk_description');
        $pk_visi = $this->request->getPost('pk_visi');
        $pk_misi = $this->request->getPost('pk_misi');
        $pk_siup = $this->request->getPost('pk_siup');
        $pk_ho = $this->request->getPost('pk_ho');
        $pk_tdp = $this->request->getPost('pk_tdp');
        $pk_status = $this->request->getPost('pk_status');
        $now = date_create('now')->format('Y-m-d H:i:s');


        $homeprofilkamiDomain->setDescription($pk_description);
        $homeprofilkamiDomain->setVisi($pk_visi);
        $homeprofilkamiDomain->setMisi($pk_misi);
        $homeprofilkamiDomain->setSiup($pk_siup);
        $homeprofilkamiDomain->setHo($pk_ho);
        $homeprofilkamiDomain->setTdp($pk_tdp);
        $homeprofilkamiDomain->setCreatedDate($now);
        $homeprofilkamiDomain->setStatus($pk_status);
        
        if($this->homeprofilkamiDataSource->update($homeprofilkamiDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('setting-home-profil-kami/edit');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-profil-kami');
            return;
    }

    private function renderEdit(HomeProfilKamiDomain $homeprofilkamiDomain, ValidationErrors $validationErrors = NULL)
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
        $homeprofilkamiDomainArray = $this->homeprofilkamiDataSource->getAllHomeProfilKamiDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


        $path = array('homeprofilkami');
        $sumData = $homeprofilkamiDomainArray['jumlahData'];

        $this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
        $pagination = $this->pagination;

        $this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
        $this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
        $this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('profilkami');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();


        // breadcrumb
        $this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Profil Kami',$this->urlBuilder->build('setting-home-profil-kami','',FALSE),''),
            array('Edit','','','')
        );
        // end breadcrumb

        $this->overideViewVariable(array(
            'homeprofilkamiDomain' => $homeprofilkamiDomain,
        ));

        $this->load->view('setting_home_profil_kami/edit', $this->viewVariable);
    }
}
?>