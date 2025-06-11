<?php

use Domain\HomeContactDomain,
    DataSource\HomeContactDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';

    protected function initialize()
    {
        $this->homecontactDataSource = New HomeContactDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

    	$homecontactDomain = $this->homecontactDataSource->getHomeContactDomainById($id);

    	if(!($homecontactDomain instanceof HomeContactDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-contact');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homecontact")
        {
            $this->processEdit($homecontactDomain);
            return;
        }

        $this->renderEdit($homecontactDomain);


    }

    private function processEdit(HomeContactDomain $homecontactDomain)
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
        
        
        $fileName1 = $homecontactDomain->getLogo();

        //HANDLE IMAGE CONTACT
        if ($hc_image['name'] != '') {

            $exten1 = $hc_image['type'];

            if($exten1 == 'image/jpeg'){
                $ext1 = '.jpg';
            }
            if($exten1 == 'image/png'){
                $ext1 = '.png';
            }

            $hc_image['name'] = "imglogo".date('Y-m-d')."_".date('His').$ext1;

            if ($hc_image['type'] != 'image/jpeg' AND $hc_image['type'] != "image/png") {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                $this->redirect('setting-home-contact/edit');
                return;
            }
            $old_img_thumbs = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.$homecontactDomain->getLogo());
            $old_img = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR.$homecontactDomain->getLogo());
            if (file_exists($old_img_thumbs) && file_exists($old_img)) {
                    unlink($old_img_thumbs);
                    unlink($old_img);
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
            $handle1->file_new_name_body1 = "imglogo".date('Y-m-d')."_".date('His');
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
                $this->redirect('setting-home-contact/edit');
                return;
            }
                $fileName1 = $fileName1.".".$ext1;
            } 
        }

        $now = date_create('now')->format('Y-m-d H:i:s');

        $homecontactDomain->setDescription($hc_description);
        $homecontactDomain->setLogo($fileName1);
        $homecontactDomain->setAddress($hc_address);
        $homecontactDomain->setTelephone($hc_telephone);
        $homecontactDomain->setEmail($hc_email);
        $homecontactDomain->setFbUrl($hc_fb);
        $homecontactDomain->setFbStatus($hc_fb_status);
        $homecontactDomain->setIgUrl($hc_ig);
        $homecontactDomain->setIgStatus($hc_ig_status);
        $homecontactDomain->setTwitterUrl($hc_twitter);
        $homecontactDomain->setTwitterStatus($hc_twitter_status);
        $homecontactDomain->setCreatedDate($now);
        $homecontactDomain->setStatus($hc_status);

        if($this->homecontactDataSource->update($homecontactDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('setting-home-contact/edit');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-contact');
            return;
    }

    private function renderEdit(HomeContactDomain $homecontactDomain, ValidationErrors $validationErrors = NULL)
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
        $homecontactDomainArray = $this->homecontactDataSource->getAllHomeContactDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


        $path = array('homecontact');
        $sumData = $homecontactDomainArray['jumlahData'];

        $this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
        $pagination = $this->pagination;

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homecontact');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Contact',$this->urlBuilder->build('setting-home-contact','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

		$this->overideViewVariable(array(
			'homecontactDomain' => $homecontactDomain,
        ));

        $this->load->view('setting_home_contact/edit', $this->viewVariable);
    }
}
?>