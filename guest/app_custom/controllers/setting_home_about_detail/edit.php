<?php

use Domain\HomeAboutDetailDomain,
    DataSource\HomeAboutDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';
    private $homeaboutDataSource;

    protected function initialize()
    {
        $this->homeaboutDataSource = New HomeAboutDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

        $homeaboutdetailDomain = $this->homeaboutDataSource->getHomeAboutDetailDomainById($id);

        if(!($homeaboutdetailDomain instanceof HomeAboutDetailDomain))
        {
            $sessionMessage['type'] = 'warning';
            $sessionMessage['message'] = $this->lang->getInternalErrorMessage();
            $this->session->set('sessionAdminMessage', $sessionMessage);

            $this->redirect('setting-home-about');
            return;
        }

        if($this->request->getPost('process') == "edit_homeaboutdetail")
        {
            $this->processEdit($homeaboutdetailDomain);
            return;
        }

        $this->renderEdit($homeaboutdetailDomain);
    }

    private function processEdit(HomeAboutDetailDomain $homeaboutdetailDomain)
    {
        $data = $this->request->getPost();

        $card_title = $this->request->getPost('card_title');
        $card_subtitle = $this->request->getPost('card_subtitle');
        $card_description = $this->request->getPost('card_description');
        $card_status = $this->request->getPost('card_status');
        $fileArray = $this->request->getFiles('card_image');
        $now = date_create('now')->format('Y-m-d H:i:s');

        $fileName1 = $homeaboutdetailDomain->getCardImage();

        if ($fileArray['name'] != '') {
                $exten1 = $fileArray['type'];

                if($exten1 == 'image/jpeg'){
                    $ext1 = '.jpg';
                }
                if($exten1 == 'image/png'){
                    $ext1 = '.png';
                }

                $fileArray['name'] = "imgcard".date('Y-m-d')."_".date('His').$ext1;

                if ($fileArray['type'] != 'image/jpeg' AND $fileArray['type'] != "image/png") {
                    $sessionAdminMessage['type'] = 'error';
                    $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                    $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                    $this->redirect('setting-home-about-detail/edit');
                    return;
                }
                $old_img_thumbs = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'card_image'.DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.$homeaboutdetailDomain->getCardImage());
                $old_img = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'card_image'.DIRECTORY_SEPARATOR.$homeaboutdetailDomain->getCardImage());
                if (file_exists($old_img_thumbs) && file_exists($old_img)) {

                    unlink($old_img_thumbs);
                    unlink($old_img);
                }

                $fileTemp1 = array(
                    'name' => $fileArray['name'],
                    'type' => $fileArray['type'],
                    'tmp_name' => $fileArray['tmp_name'],
                    'error' => $fileArray['error'],
                    'size' => $fileArray['size']
                );


                $handle1 = new Upload($fileTemp1);
                $ext1 = $handle1->file_src_name_ext;
                $handle1->file_new_name_body1 = "imgcard".date('Y-m-d')."_".date('His');
                $fileName1 = $handle1->file_new_name_body1;

                if ($handle1->uploaded) {
                    if (!($handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'card_image')))) {
                        $handle1->file_new_name_body = $fileName1;
                        $handle1->image_resize         = true;
                        $handle1->image_x              = 200;
                        $handle1->image_ratio_y        = true;
                        $handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'card_image'.DIRECTORY_SEPARATOR.'thumbs'));
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
                    $this->redirect('setting-home-title/edit');
                    return;
                }
                    $fileName1 = $fileName1.".".$ext1;
                } 
            }

        $homeaboutdetailDomain->setCardTitle($card_title);
        $homeaboutdetailDomain->setCardSubtitle($card_subtitle);
        $homeaboutdetailDomain->setCardDescription($card_description);
        $homeaboutdetailDomain->setCardImage($fileName1);
        $homeaboutdetailDomain->setCreatedDate($now);
        $homeaboutdetailDomain->setStatus($card_status);

        if($this->homeaboutDataSource->update_had($homeaboutdetailDomain) == FALSE)
        {
            $sessionAdminMessage['type'] = 'error';
            $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-about-detail/edit');
            return;
        }

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting-home-about');
        return;
    }

    private function renderEdit(HomeAboutDetailDomain $homeaboutdetailDomain, ValidationErrors $validationErrors = NULL)
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

        $this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
        $this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
        $this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homeabout');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();


        // breadcrumb
        $this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home About Detail',$this->urlBuilder->build('setting-home-about','',FALSE),''),
            array('Edit','','','')
        );
        // end breadcrumb

        $this->overideViewVariable(array(
            'homeaboutdetailDomain' => $homeaboutdetailDomain,
        ));

        $this->load->view('setting_home_about_detail/edit', $this->viewVariable);
    }
}
?>