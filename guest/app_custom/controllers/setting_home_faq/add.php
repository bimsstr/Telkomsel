<?php

use Domain\HomeFaqDomain,
    Domain\HomeFaqCategoryDomain,
    DataSource\HomeFaqDataSource,
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
        $this->homefaqDataSource = New HomeFaqDataSource($this->mysqli);
    }

    public function index()
    {
        if ($this->request->getPost('process') == 'add_homefaqdetail')
        {
            $this->addProcess();
            return;
        }
        
        $this->renderAdd();
    }

    private function addProcess()
    {
        $data = $this->request->getPost();

        $category = $this->request->getPost('faq_category');
        $pertanyaan = $this->request->getPost('faq_pertanyaan');
        $jawaban = $this->request->getPost('faq_jawaban');
        $status = $this->request->getPost('faq_status');
        $now = date_create('now')->format('Y-m-d H:i:s');
        
        $homefaqDomain = new HomeFaqDomain(
            null,
            $category,
            $pertanyaan,
            $jawaban,
            $now,
            $status
        );
        $this->homefaqDataSource->insert($homefaqDomain);

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting-home-faq');
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
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homefaq');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();
        
        $this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home FAQ',$this->urlBuilder->build('setting-home-faq','',FALSE),''),
            array('Add','','')
        );

        //DATA
        $homefaqcategoryDomainArray = $this->homefaqDataSource->getAllHomeFaqCategoryDomain();

        $this->overideViewVariable(array(
            'homefaqDomain' => $this->homefaqDomain,
            'homefaqcategoryDomainArray' => $homefaqcategoryDomainArray,
        ));

        $this->load->view('setting_home_faq/add', $this->viewVariable);
    }
}
