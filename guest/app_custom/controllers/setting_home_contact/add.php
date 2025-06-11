<?php

use Domain\HomeContactDomain,
    DataSource\HomeContactDataSource,
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
        $this->homecontactDataSource = New HomeContactDataSource($this->mysqli);
    }

    public function index()
    {
        if ($this->request->getPost('process') == 'add_homecontact')
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
        $hc_image = $this->request->getFiles('hc_image');

        //DATA
        $hc_description = $this->request->getPost('hc_description');
        $hc_address = $this->request->getPost('hc_address');
        $hc_telephone = $this->request->getPost('hc_telephone');
        $hc_email = $this->request->getPost('hc_email');
        $hc_fb = $this->request->getPost('hc_fb');
        $hc_fb_status = $this->request->getPost('hc_fb_status');
        $hc_ig = $this->request->getPost('hc_ig');
        $hc_ig_status = $this->request->getPost('hc_ig_status');
        $hc_twitter = $this->request->getPost('hc_twitter');
        $hc_twitter_status = $this->request->getPost('hc_twitter_status');
        $hc_status = $this->request->getPost('hc_status');
        
        if ($hc_image['name'] != '') {
            $exten = $hc_image['type'];

            if($exten == 'image/jpeg'){
                $ext = '.jpg';
            }

            if($exten == 'image/png'){
                $ext = '.png';
            }

            $hc_image['name'] = "imgcontact".date('Y-m-d')."_".date('His').$ext;
             if ($hc_image['type'] != 'image/jpeg' AND $hc_image['type'] != "image/png") {
                 $sessionAdminMessage['type'] = 'error';
                 $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                 $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                 $this->redirect('setting-home-contact/add');
                 return;
             }
        }

        $fileTemp1 = array(
                    'name' => $hc_image['name'],
                    'type' => $hc_image['type'],
                    'tmp_name' => $hc_image['tmp_name'],
                    'error' => $hc_image['error'],
                    'size' => $hc_image['size']
        );

        $handle1 = new Upload($fileTemp1);
        $ext1 = $handle1->file_src_name_ext;
        $handle1->file_new_name_body1 = "imgcontact".date('Y-m-d')."_".date('His');
        $fileName1 = $handle1->file_new_name_body1;

        if ($handle1->uploaded) {
            if (!($handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'logo')))) {
                $handle1->file_new_name_body = $fileName1;
                $handle1->image_resize         = true;
                $handle1->image_x              = 200;
                $handle1->image_ratio_y        = true;
                $handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR.'thumbs'));
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
                 $this->redirect('setting-home-contact/add');
                 return;
            }

            $fileName1 = $fileName1.".".$ext1;
        } 

        $now = date_create('now')->format('Y-m-d H:i:s');

        $homecontactDomain = new HomeContactDomain(
            null,
            $fileName1,
            $hc_description,
            $hc_address,
            $hc_telephone,
            $hc_email,
            $hc_fb,
            $hc_fb_status,
            $hc_ig,
            $hc_ig_status,
            $hc_twitter,
            $hc_twitter_status,
            $now,
            $hc_status
        );
        $this->homecontactDataSource->insert($homecontactDomain);

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting-home-contact');
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
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homecontact');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();
        
        $this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Contact',$this->urlBuilder->build('setting-home-contact','',FALSE),''),
            array('Add','','')
        );

        $this->overideViewVariable(array(
            'homecontactDomain' => $this->homecontactDomain
        ));

        $this->load->view('setting_home_contact/add', $this->viewVariable);
    }
}