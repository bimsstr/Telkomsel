<?php

use Domain\HomeProfilKamiTitleDomain,
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

        $homeprofilkamititleDomain = $this->homeprofilkamiDataSource->getHomeProfilKamiTitleDomainById($id);

        if(!($homeprofilkamititleDomain instanceof HomeProfilKamiTitleDomain))
        {
          $sessionMessage['type'] = 'warning';
          $sessionMessage['message'] = $this->lang->getInternalErrorMessage();
          $this->session->set('sessionAdminMessage', $sessionMessage);

          $this->redirect('setting-home-profil-kami');
          return;
        }

        if($this->request->getPost('process') == "edit_homeprofilkamititle")
        {
            $this->processEdit($homeprofilkamititleDomain);
            return;
        }

    $this->renderEdit($homeprofilkamititleDomain);
    }

    private function processEdit(HomeProfilKamiTitleDomain $homeprofilkamititleDomain)
    {
        $data = $this->request->getPost();

        //FILE
        $image_base = $this->request->getFiles('pkt_image_base');

        //DATA
        $title = $this->request->getPost('pkt_title');
        $subtitle = $this->request->getPost('pkt_subtitle');
        $status = $this->request->getPost('pkt_status');
        $now = date_create('now')->format('Y-m-d H:i:s');

        $fileName1 = $homeprofilkamititleDomain->getImage();


        //HANDLE IMAGE BASE
        if ($image_base['name'] != '') {

        $exten1 = $image_base['type'];

        if($exten1 == 'image/jpeg'){
            $ext1 = '.jpg';
        }
        if($exten1 == 'image/png'){
            $ext1 = '.png';
        }

        $image_base['name'] = "imgbase".date('Y-m-d')."_".date('His').$ext1;

        if ($image_base['type'] != 'image/jpeg' AND $image_base['type'] != "image/png") {

            $sessionAdminMessage['type'] = 'error';
            $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);
            $this->redirect('setting-home-profil-kami-title/edit');
            return;
        }
        $old_img_base_thumbs = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'profil_kami'.DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.$homeprofilkamititleDomain->getImage());
        $old_img_base = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'profil_kami'.DIRECTORY_SEPARATOR.$homeprofilkamititleDomain->getImage());
        if (file_exists($old_img_base_thumbs) && file_exists($old_img_base)) {
            unlink($old_img_base_thumbs);
            unlink($old_img_base);
        }


        $fileTemp1 = array(
            'name' => $image_base['name'],
            'type' => $image_base['type'],
            'tmp_name' => $image_base['tmp_name'],
            'error' => $image_base['error'],
            'size' => $image_base['size']
        );

        $handle1 = new Upload($fileTemp1);
        $ext1 = $handle1->file_src_name_ext;
        $handle1->file_new_name_body1 = "imgbase".date('Y-m-d')."_".date('His');
        $fileName1 = $handle1->file_new_name_body1;

        if ($handle1->uploaded) {
            if (!($handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'profil_kami')))) {
                $handle1->file_new_name_body = $fileName1;
                $handle1->image_resize         = true;
                $handle1->image_x              = 200;
                $handle1->image_ratio_y        = true;
                $handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'profil_kami'.DIRECTORY_SEPARATOR.'thumbs'));
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
                $this->redirect('setting-home-profil-kami-title/edit');
                return;
            }
            $fileName1 = $fileName1.".".$ext1;
            } 
        }

        $homeprofilkamititleDomain->setTitle($title);
        $homeprofilkamititleDomain->setSubtitle($subtitle);
        $homeprofilkamititleDomain->setImage($fileName1);
        $homeprofilkamititleDomain->setCreatedDate($now);
        $homeprofilkamititleDomain->setStatus($status);

        if($this->homeprofilkamiDataSource->update_pkt($homeprofilkamititleDomain) == FALSE)
        {

        $sessionAdminMessage['type'] = 'error';
        $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting-home-profil-kami-title/edit');
        return;
        }

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting-home-profil-kami');
        return;
    }

    private function renderEdit(HomeProfilKamiTitleDomain $homeprofilkamititleDomain, ValidationErrors $validationErrors = NULL)
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

                    function readURL5(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#img-upload5').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    function readURL6(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#img-upload6').attr('src', e.target.result);
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
                    
                    $('#imgInp5').change(function(){
                        readURL5(this);
                    });

                    $('#imgInp6').change(function(){
                        readURL6(this);
                    });
    ");

    $currentPage = $this->request->getGet('p', 1 , 'page');
    $limit = ($currentPage - 1) * $this->maxDataPerPage;
    $homeprofilkamititleDomainArray = $this->homeprofilkamiDataSource->getAllHomeProfilKamiTitleDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


    $path = array('homeprofilkami');
    $sumData = $homeprofilkamititleDomainArray['jumlahData'];

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
        'homeprofilkamititleDomain' => $homeprofilkamititleDomain,
    ));

    $this->load->view('setting_home_profil_kami_title/edit', $this->viewVariable);
    }
}
?>