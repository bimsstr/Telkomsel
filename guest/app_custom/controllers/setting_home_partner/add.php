<?php

use Domain\HomePartnerDomain,
    DataSource\HomePartnerDataSource,
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
        $this->homepartnerDataSource = New HomePartnerDataSource($this->mysqli);
    }

    public function index()
    {
        if ($this->request->getPost('process') == 'add_homepartner')
        {
            $this->addProcess();
            return;
        }

        $this->renderAdd();
    }

    private function addProcess()
    {
        $data = $this->request->getPost();

        //FILE
        $partner_image = $this->request->getFiles('partner_image');

        //DATA
        $partner_description = $this->request->getPost('partner_description');
        $partner_status = $this->request->getPost('partner_status');

        
        if ($partner_image['name'] != '') {
            $exten = $partner_image['type'];

            if($exten == 'image/jpeg'){
                $ext = '.jpg';
            }

            if($exten == 'image/png'){
                $ext = '.png';
            }

            $partner_image['name'] = "imgpartner".date('Y-m-d')."_".date('His').$ext;
             if ($partner_image['type'] != 'image/jpeg' AND $partner_image['type'] != "image/png") {
                 $sessionAdminMessage['type'] = 'error';
                 $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                 $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                 $this->redirect('setting-home-partner/add');
                 return;
             }
        }

        $fileTemp1 = array(
                    'name' => $partner_image['name'],
                    'type' => $partner_image['type'],
                    'tmp_name' => $partner_image['tmp_name'],
                    'error' => $partner_image['error'],
                    'size' => $partner_image['size']
        );

        $handle1 = new Upload($fileTemp1);
        $ext1 = $handle1->file_src_name_ext;
        $handle1->file_new_name_body1 = "imgpartner".date('Y-m-d')."_".date('His');
        $fileName1 = $handle1->file_new_name_body1;

        if ($handle1->uploaded) {
            if (!($handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'partner')))) {
                $handle1->file_new_name_body = $fileName1;
                $handle1->image_resize         = true;
                $handle1->image_x              = 200;
                $handle1->image_ratio_y        = true;
                $handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'partner'.DIRECTORY_SEPARATOR.'thumbs'));
                if ($handle1->processed) {
                        echo 'image resized';
                        $handle1->clean();
                } else {
                    echo 'error : ' . $handle1->error;
                }
            }else{
                 $sessionAdminMessage['type'] = 'error';
                 $sessionAdminMessage['message'] = 'Maaf telah terjadi kesalahan!';
                 $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                 $this->redirect('setting-home-partner/add');
                 return;
            }

            $fileName1 = $fileName1.".".$ext1;
        } 

        $now = date_create('now')->format('Y-m-d H:i:s');

        $homepartnerDomain = new HomePartnerDomain(
            null,
            $fileName1,
            $partner_description,
            $now,
            $partner_status
        );
        $this->homepartnerDataSource->insert($homepartnerDomain);

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting-home-partner');
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

        $this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
        $this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
        $this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homepartner');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();
        
        $this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Partner',$this->urlBuilder->build('setting-home-partner','',FALSE),''),
            array('Add','','')
        );

        $this->overideViewVariable(array(
            'homepartnerDomain' => $this->homepartnerDomain
        ));

        $this->load->view('setting_home_partner/add', $this->viewVariable);
    }
}