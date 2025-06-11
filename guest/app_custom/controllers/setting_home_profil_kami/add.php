<?php

use Domain\HomeProfilKamiDomain,
    DataSource\HomeProfilKamiDataSource,
    Presentation\ValidationErrorsRenderer,
    Validation\GeneralValidation,
    Validation\SettingValidation,
    Utilities\Upload,
    Utilities\ValidationErrors;

class Add extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';

    protected function initialize()
    {
        $this->homeprofilkamiDataSource = New HomeProfilKamiDataSource($this->mysqli);
    }

    public function index()
    {
        if ($this->request->getPost('process') == 'add_homeprofilkami')
        {
            $this->addProcess();
            return;
        }
        
        $this->renderAdd();
    }

    private function addProcess()
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
        
        $homeprofilkamiDomain = new HomeProfilKamiDomain(
            null,
            $pk_description,
            $pk_visi,
            $pk_misi,
            $pk_siup,
            $pk_ho,
            $pk_tdp,
            $now,
            $pk_status
        );
        $this->homeprofilkamiDataSource->insert($homeprofilkamiDomain);

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting-home-profil-kami');
        return;
    }

    private function renderAdd(ValidationErrors $validationErrors = NULL)
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#imgInp').change(function(){
            readURL(this);
       });
    ");

        $this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
        $this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
        $this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('profilkami');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();
        
        $this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Profil Kami',$this->urlBuilder->build('setting-home-profil-kami','',FALSE),''),
            array('Add','','')
        );

        $this->overideViewVariable(array(
            'homeprofilkamiDomain' => $this->homeprofilkamiDomain,
        ));

        $this->load->view('setting_home_profil_kami/add', $this->viewVariable);
    }
}
