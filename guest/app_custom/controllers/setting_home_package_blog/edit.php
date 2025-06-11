<?php

use Domain\HomePackageBlogDomain,
    Domain\HomePackageCategoryDomain,
    DataSource\HomePackageDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';

    protected function initialize()
    {
        $this->homepackageDataSource = New HomePackageDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

    	$homepackageblogDomain = $this->homepackageDataSource->getHomePackageBlogDomainById($id);

    	if(!($homepackageblogDomain instanceof HomePackageBlogDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-package-blog');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homepackageblog")
        {
            $this->processEdit($homepackageblogDomain);
            return;
        }

        $this->renderEdit($homepackageblogDomain);
    }

    private function processEdit(HomePackageBlogDomain $homepackageblogDomain)
    {
        $data = $this->request->getPost();
        //FILE
        $package_image = $this->request->getFiles('package_image');

        //DATA
        $package_category = $this->request->getPost('package_category');
        $package_description = $this->request->getPost('package_description');
        $package_sk = $this->request->getPost('package_sk');
        $package_status = $this->request->getPost('package_status');

        $fileName1 = $homepackageblogDomain->getPackageImage();

        //HANDLE IMAGE PACKAGE
        if ($package_image['name'] != '') {

            $exten1 = $package_image['type'];

            if($exten1 == 'image/jpeg'){
                $ext1 = '.jpg';
            }
            if($exten1 == 'image/png'){
                $ext1 = '.png';
            }

            $package_image['name'] = "imgpackageblog".date('Y-m-d')."_".date('His').$ext1;

            if ($package_image['type'] != 'image/jpeg' AND $package_image['type'] != "image/png") {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                $this->redirect('setting-home-package-blog/edit');
                return;
            }
            $old_img_thumbs = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'package_blog'.DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.$homepackageblogDomain->getPackageImage());
            $old_img = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'package_blog'.DIRECTORY_SEPARATOR.$homepackageblogDomain->getPackageImage());
            if (file_exists($old_img_thumbs) && file_exists($old_img)) {
                    unlink($old_img_thumbs);
                    unlink($old_img);
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
            $handle1->file_new_name_body1 = "imgpackageblog".date('Y-m-d')."_".date('His');
            $fileName1 = $handle1->file_new_name_body1;

            if ($handle1->uploaded) {
                if (!($handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'package_blog')))) {
                    $handle1->file_new_name_body = $fileName1;
                    $handle1->image_resize         = true;
                    $handle1->image_x              = 200;
                    $handle1->image_ratio_y        = true;
                    $handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'package_blog'.DIRECTORY_SEPARATOR.'thumbs'));
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
                $this->redirect('setting-home-package-blog/edit');
                return;
            }
                $fileName1 = $fileName1.".".$ext1;
            } 
        }

        $now = date_create('now')->format('Y-m-d H:i:s');

        $homepackageblogDomain->setPackageCategory($package_category);
        $homepackageblogDomain->setPackageDescription($package_description);
        $homepackageblogDomain->setPackageSK($package_sk);
        $homepackageblogDomain->setPackageImage($fileName1);
        $homepackageblogDomain->setCreatedDate($now);
        $homepackageblogDomain->setPackageStatus($package_status);

        if($this->homepackageDataSource->update_hpb($homepackageblogDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('setting-home-package-blog/edit');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-package');
            return;
    }

    private function renderEdit(HomePackageBlogDomain $homepackageblogDomain, ValidationErrors $validationErrors = NULL)
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
        $homepackageblogDomainArray = $this->homepackageDataSource->getAllHomePackageBlogDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


        $path = array('homepackageblog');
        $sumData = $homepackageblogDomainArray['jumlahData'];

        $this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
        $pagination = $this->pagination;

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homepackage');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Package Blog',$this->urlBuilder->build('setting-home-package','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb


        //DATA
        $homepackagecategoryDomainArray = $this->homepackageDataSource->getAllHomePackageCategoryDomain();

		$this->overideViewVariable(array(
			'homepackageblogDomain' => $homepackageblogDomain,
            'homepackagecategoryDomainArray' => $homepackagecategoryDomainArray,
        ));

        $this->load->view('setting_home_package_blog/edit', $this->viewVariable);
    }
}
?>