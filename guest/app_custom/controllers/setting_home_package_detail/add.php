<?php

use Domain\HomePackageDetailDomain,
    Domain\HomePackageCategoryDomain,
    DataSource\HomePackageDataSource,
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
        $this->homepackageDataSource = New HomePackageDataSource($this->mysqli);
    }

    public function index()
    {
        if ($this->request->getPost('process') == 'add_homepackagedetail')
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
        $package_image = $this->request->getFiles('package_image');

        //DATA
        $package_category = $this->request->getPost('package_category');
        $package_name = $this->request->getPost('package_name');
        $package_speed = $this->request->getPost('package_speed');
        $package_price = $this->request->getPost('package_price');
        $package_description = $this->request->getPost('package_description');
        $package_keterangan = $this->request->getPost('package_keterangan');
        $package_show = $this->request->getPost('package_show');
        $package_status = $this->request->getPost('package_status');
        
        if ($package_image['name'] != '') {
            $exten = $package_image['type'];

            if($exten == 'image/jpeg'){
                $ext = '.jpg';
            }

            if($exten == 'image/png'){
                $ext = '.png';
            }

            $package_image['name'] = "imgpackage".date('Y-m-d')."_".date('His').$ext;
             if ($package_image['type'] != 'image/jpeg' AND $package_image['type'] != "image/png") {
                 $sessionAdminMessage['type'] = 'error';
                 $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                 $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                 $this->redirect('setting-home-package/add');
                 return;
             }
        }

        $fileTemp1 = array(
            'name' => $package_image['name'],
            'type' => $package_image['type'],
            'tmp_name' => $package_image['tmp_name'],
            'error' => $package_image['error'],
            'size' => $package_image['size']
        );

        $handle1 = new Upload($fileTemp1);
        $ext1 = $handle1->file_src_name_ext;
        $handle1->file_new_name_body1 = "imgpackage".date('Y-m-d')."_".date('His');
        $fileName1 = $handle1->file_new_name_body1;

        if ($handle1->uploaded) {
            if (!($handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'package')))) {
                $handle1->file_new_name_body = $fileName1;
                $handle1->image_resize         = true;
                $handle1->image_x              = 200;
                $handle1->image_ratio_y        = true;
                $handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'package'.DIRECTORY_SEPARATOR.'thumbs'));
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
                 $this->redirect('setting-home-package-detail/add');
                 return;
            }

            $fileName1 = $fileName1.".".$ext1;
        } 

        $now = date_create('now')->format('Y-m-d H:i:s');

        $homepackagedetailDomain = new HomePackageDetailDomain(
            null,
            $package_category,
            $package_name,
            $package_speed,
            $package_price,
            $fileName1,
            $package_description,
            $package_keterangan,
            $package_show,
            $now,
            $package_status
        );
        $this->homepackageDataSource->insert_hpd($homepackagedetailDomain);

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting-home-package');
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
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homepackage');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();
        
        $this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Package Detail',$this->urlBuilder->build('setting-home-package','',FALSE),''),
            array('Add','','')
        );

        //DATA
        $homepackagecategoryDomainArray = $this->homepackageDataSource->getAllHomePackageCategoryDomain();


        $this->overideViewVariable(array(
            'homepackagecategoryDomainArray' => $homepackagecategoryDomainArray,
        ));

        $this->load->view('setting_home_package_detail/add', $this->viewVariable);
    }
}