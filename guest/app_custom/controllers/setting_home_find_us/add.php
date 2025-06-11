<?php

use Domain\HomeFindUsDomain,
    DataSource\HomeFindUsDataSource,
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
        $this->homefindusDataSource = New HomeFindUsDataSource($this->mysqli);
    }

    public function index()
    {
        if ($this->request->getPost('process') == 'add_homefindus')
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
        $fu_image = $this->request->getFiles('fu_image');
        $fu_image_bg = $this->request->getFiles('fu_image_bg');

        //DATA
        $fu_title = $this->request->getPost('fu_title');
        $fu_description = $this->request->getPost('fu_description');
        $fu_appstore = $this->request->getPost('appstore_status');
        $fu_playstore = $this->request->getPost('playstore_status');
        $fu_status = $this->request->getPost('fu_status');

        
        if ($fu_image['name'] != '') {
            $exten = $fu_image['type'];

            if($exten == 'image/jpeg'){
                $ext = '.jpg';
            }

            if($exten == 'image/png'){
                $ext = '.png';
            }

            $fu_image['name'] = "imgfindus".date('Y-m-d')."_".date('His').$ext;
             if ($fu_image['type'] != 'image/jpeg' AND $fu_image['type'] != "image/png") {
                 $sessionAdminMessage['type'] = 'error';
                 $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                 $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                 $this->redirect('setting-home-find-us/add');
                 return;
             }
        }

        $fileTemp1 = array(
                    'name' => $fu_image['name'],
                    'type' => $fu_image['type'],
                    'tmp_name' => $fu_image['tmp_name'],
                    'error' => $fu_image['error'],
                    'size' => $fu_image['size']
        );

        $handle1 = new Upload($fileTemp1);
        $ext1 = $handle1->file_src_name_ext;
        $handle1->file_new_name_body1 = "imgfindus".date('Y-m-d')."_".date('His');
        $fileName1 = $handle1->file_new_name_body1;

        if ($handle1->uploaded) {
            if (!($handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'find_us')))) {
                $handle1->file_new_name_body = $fileName1;
                $handle1->image_resize         = true;
                $handle1->image_x              = 200;
                $handle1->image_ratio_y        = true;
                $handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'find_us'.DIRECTORY_SEPARATOR.'thumbs'));
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
                 $this->redirect('setting-home-find-us/add');
                 return;
            }

            $fileName1 = $fileName1.".".$ext1;
        } 



        //upload image BG

        if ($fu_image_bg['name'] != '') {
            $exten = $fu_image_bg['type'];

            if($exten == 'image/jpeg'){
                $ext = '.jpg';
            }

            if($exten == 'image/png'){
                $ext = '.png';
            }

            $fu_image_bg['name'] = "imgfindusbg".date('Y-m-d')."_".date('His').$ext;
             if ($fu_image_bg['type'] != 'image/jpeg' AND $fu_image_bg['type'] != "image/png") {
                 $sessionAdminMessage['type'] = 'error';
                 $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                 $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                 $this->redirect('setting-home-find-us/add');
                 return;
             }
        }

        $fileTemp2 = array(
                    'name' => $fu_image_bg['name'],
                    'type' => $fu_image_bg['type'],
                    'tmp_name' => $fu_image_bg['tmp_name'],
                    'error' => $fu_image_bg['error'],
                    'size' => $fu_image_bg['size']
        );

        $handle2 = new Upload($fileTemp2);
        $ext2 = $handle2->file_src_name_ext;
        $handle2->file_new_name_body2 = "imgfindusbg".date('Y-m-d')."_".date('His');
        $fileName2 = $handle2->file_new_name_body2;

        if ($handle2->uploaded) {
            if (!($handle2->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'find_us'.DIRECTORY_SEPARATOR.'bg')))) {
                $handle2->file_new_name_body = $fileName2;
                $handle2->image_resize         = true;
                $handle2->image_x              = 200;
                $handle2->image_ratio_y        = true;
                $handle2->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'find_us'.DIRECTORY_SEPARATOR.'bg'.DIRECTORY_SEPARATOR.'thumbs'));
                if ($handle2->processed) {
                        echo 'image resized';
                        $handle2->clean();
                } else {
                    echo 'error : ' . $handle2->error;
                }
            }else{
                 $sessionAdminMessage['type'] = 'error';
                 $sessionAdminMessage['message'] = 'Maaf telah terjadi kesalahan!';
                 $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                 $this->redirect('setting-home-find-us/add');
                 return;
            }

            $fileName2 = $fileName2.".".$ext2;
        } 

        $dataPost = array(
            'title' => $this->request->getPost('fu_title'),
            'description' => $this->request->getPost('fu_description'),
            'app_store' => $this->request->getPost('appstore_status'),
            'play_store' => $this->request->getPost('playstore_status'),
            'status' => $this->request->getPost('fu_status')
        );

        $now = date_create('now')->format('Y-m-d H:i:s');

        $homefindusDomain = new HomeFindUsDomain(
            null,
            $fu_title,
            $fu_description,
            $fu_appstore,
            $fu_playstore,
            $fileName1,
            $fileName2,
            $now,
            $fu_status
        );
        $this->homefindusDataSource->insert($homefindusDomain);

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting-home-find-us');
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
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homefindus');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();
        
        $this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Find Us',$this->urlBuilder->build('setting-home-find-us','',FALSE),''),
            array('Add','','')
        );

        $this->overideViewVariable(array(
            'homefindusDomain' => $this->homefindusDomain
        ));

        $this->load->view('setting_home_find_us/add', $this->viewVariable);
    }
}