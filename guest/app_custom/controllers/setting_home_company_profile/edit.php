<?php

use Domain\HomeCompanyProfileDomain,
    DataSource\HomeCompanyProfileDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';

    protected function initialize()
    {
        $this->homecompanyprofileDataSource = New HomeCompanyProfileDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

    	$homecompanyprofileDomain = $this->homecompanyprofileDataSource->getHomeCompanyProfileDomainById($id);

    	if(!($homecompanyprofileDomain instanceof HomeCompanyProfileDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-company-profile');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homecp")
        {
            $this->processEdit($homecompanyprofileDomain);
            return;
        }

        $this->renderEdit($homecompanyprofileDomain);


    }

    private function processEdit(HomeCompanyProfileDomain $homecompanyprofileDomain)
    {
        $data = $this->request->getPost();

        //FILE
        $cp_image = $this->request->getFiles('cp_image');

        //DATA
        $cp_title = $this->request->getPost('cp_title');
        $cp_subtitle = $this->request->getPost('cp_subtitle');
        $cp_description = $this->request->getPost('cp_description');
        $cp_yt_channel = $this->request->getPost('cp_yt_channel');
        $cp_yt_video_url = $this->request->getPost('cp_yt_video_url');
        $cp_status = $this->request->getPost('cp_status');
        

        $fileName1 = $homecompanyprofileDomain->getImage();

        //HANDLE IMAGE COMPANY PROFILE
        if ($cp_image['name'] != '') {

            $exten1 = $cp_image['type'];

            if($exten1 == 'image/jpeg'){
                $ext1 = '.jpg';
            }
            if($exten1 == 'image/png'){
                $ext1 = '.png';
            }

            $cp_image['name'] = "imgcp".date('Y-m-d')."_".date('His').$ext1;

            if ($cp_image['type'] != 'image/jpeg' AND $cp_image['type'] != "image/png") {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                $this->redirect('setting-home-company-profile/edit');
                return;
            }
            $old_img_thumbs = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'company_profile'.DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.$homecompanyprofileDomain->getImage());
            $old_img = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'company_profile'.DIRECTORY_SEPARATOR.$homecompanyprofileDomain->getImage());
            if (file_exists($old_img_thumbs) && file_exists($old_img)) {
                    unlink($old_img_thumbs);
                    unlink($old_img);
            }

            $fileTemp1 = array(
                'name' => $cp_image['name'],
                'type' => $cp_image['type'],
                'tmp_name' => $cp_image['tmp_name'],
                'error' => $cp_image['error'],
                'size' => $cp_image['size']
            );

            $handle1 = new Upload($fileTemp1);
            $ext1 = $handle1->file_src_name_ext;
            $handle1->file_new_name_body1 = "imgcp".date('Y-m-d')."_".date('His');
            $fileName1 = $handle1->file_new_name_body1;

            if ($handle1->uploaded) {
                if (!($handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'company_profile')))) {
                    $handle1->file_new_name_body = $fileName1;
                    $handle1->image_resize         = true;
                    $handle1->image_x              = 200;
                    $handle1->image_ratio_y        = true;
                    $handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'company_profile'.DIRECTORY_SEPARATOR.'thumbs'));
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
                $this->redirect('setting-home-company-profile/edit');
                return;
            }
                $fileName1 = $fileName1.".".$ext1;
            } 
        }

        $now = date_create('now')->format('Y-m-d H:i:s');


        $homecompanyprofileDomain->setTitle($cp_title);
        $homecompanyprofileDomain->setSubtitle($cp_subtitle);
        $homecompanyprofileDomain->setDescription($cp_description);
        $homecompanyprofileDomain->setYoutubeChannel($cp_yt_channel);
        $homecompanyprofileDomain->setYoutubeUrl($cp_yt_video_url);
        $homecompanyprofileDomain->setCreatedDate($now);
        $homecompanyprofileDomain->setImage($fileName1);
        $homecompanyprofileDomain->setStatus($cp_status);

        if($this->homecompanyprofileDataSource->update($homecompanyprofileDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('setting-home-company-profile/edit');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-company-profile');
            return;
    }

    private function renderEdit(HomeCompanyProfileDomain $homecompanyprofileDomain, ValidationErrors $validationErrors = NULL)
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
        $homecompanyprofileDomainArray = $this->homecompanyprofileDataSource->getAllHomeCompanyProfileDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


        $path = array('homecompanyprofile');
        $sumData = $homecompanyprofileDomainArray['jumlahData'];

        $this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
        $pagination = $this->pagination;

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homecp');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Company Profile',$this->urlBuilder->build('setting-home-company-profile','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

		$this->overideViewVariable(array(
			'homecompanyprofileDomain' => $homecompanyprofileDomain,
        ));

        $this->load->view('setting_home_company_profile/edit', $this->viewVariable);
    }
}
?>