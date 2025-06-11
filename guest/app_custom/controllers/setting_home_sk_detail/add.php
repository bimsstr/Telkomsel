<?php

use Domain\HomeSKDetailDomain,
    Domain\HomeSKDomain,
    DataSource\HomeSKDataSource,
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
        $this->homeskDataSource = New HomeSKDataSource($this->mysqli);
    }

    public function index()
    {
        if ($this->request->getPost('process') == 'add_homeskdetail')
        {
            $this->addProcess();
            return;
        }
        
        $this->renderAdd();
    }

    private function addProcess()
    {
        $data = $this->request->getPost();

        $category = $this->request->getPost('sk_category');
        $description = $this->request->getPost('sk_description');
        $status = $this->request->getPost('sk_status');
        $now = date_create('now')->format('Y-m-d H:i:s');
        
        $homeskdetailDomain = new HomeSKDetailDomain(
            null,
            $category,
            $description,
            $now,
            $status
        );
        $this->homeskDataSource->insert_skd($homeskdetailDomain);

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting-home-sk');
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
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homesk');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();
        
        $this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Syarat dan Ketentuan',$this->urlBuilder->build('setting-home-sk','',FALSE),''),
            array('Add','','')
        );

        //DATA
        $homeskDomainArray = $this->homeskDataSource->getAllHomeSKDomain();

        $this->overideViewVariable(array(
            'homeskdetailDomain' => $this->homeskdetailDomain,
            'homeskDomainArray' => $homeskDomainArray,
        ));

        $this->load->view('setting_home_sk_detail/add', $this->viewVariable);
    }
}
