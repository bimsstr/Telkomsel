<?php

use Domain\HomePackageAfiliasiDomain,
    Domain\HomePackageCategoryDomain,
    DataSource\HomePackageAfiliasiDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';

    protected function initialize()
    {
        $this->homepackageafiliasiDataSource = New HomePackageAfiliasiDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

    	$homepackageafiliasiDomain = $this->homepackageafiliasiDataSource->getHomePackageAfiliasiDomainById($id);

    	if(!($homepackageafiliasiDomain instanceof HomePackageAfiliasiDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-company-profile');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homepackageafiliasi")
        {
            $this->processEdit($homepackageafiliasiDomain);
            return;
        }

        $this->renderEdit($homepackageafiliasiDomain);


    }

    private function processEdit(HomePackageAfiliasiDomain $homepackageafiliasiDomain)
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

        $fileName1 = $homepackageafiliasiDomain->getPackageImage();

        //HANDLE IMAGE PACKAGE
        if ($package_image['name'] != '') {

            $exten1 = $package_image['type'];

            if($exten1 == 'image/jpeg'){
                $ext1 = '.jpg';
            }
            if($exten1 == 'image/png'){
                $ext1 = '.png';
            }

            $package_image['name'] = "imgpackage".date('Y-m-d')."_".date('His').$ext1;

            if ($package_image['type'] != 'image/jpeg' AND $package_image['type'] != "image/png") {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                $this->redirect('setting-home-package-afiliasi/edit');
                return;
            }
            $old_img_thumbs = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'afiliasi'.DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.$homepackageafiliasiDomain->getPackageImage());
            $old_img = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'afiliasi'.DIRECTORY_SEPARATOR.$homepackageafiliasiDomain->getPackageImage());
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
            $handle1->file_new_name_body1 = "imgpackage".date('Y-m-d')."_".date('His');
            $fileName1 = $handle1->file_new_name_body1;

            if ($handle1->uploaded) {
                if (!($handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'afiliasi')))) {
                    $handle1->file_new_name_body = $fileName1;
                    $handle1->image_resize         = true;
                    $handle1->image_x              = 200;
                    $handle1->image_ratio_y        = true;
                    $handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'afiliasi'.DIRECTORY_SEPARATOR.'thumbs'));
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
                $this->redirect('setting-home-package-afiliasi/edit');
                return;
            }
                $fileName1 = $fileName1.".".$ext1;
            } 
        }

        $now = date_create('now')->format('Y-m-d H:i:s');

        $homepackageafiliasiDomain->setPackageCategory($package_category);
        $homepackageafiliasiDomain->setPackageBy($this->adminDomain->getUsername());
        $homepackageafiliasiDomain->setPackageName($package_name);
        $homepackageafiliasiDomain->setPackageSpeed($package_speed);
        $homepackageafiliasiDomain->setPackagePrice($package_price);
        $homepackageafiliasiDomain->setPackageImage($fileName1);
        $homepackageafiliasiDomain->setPackageDescription($package_description);
        $homepackageafiliasiDomain->setPackageKeterangan($package_keterangan);
        $homepackageafiliasiDomain->setShowLandingPage($package_show);
        $homepackageafiliasiDomain->setCreatedDate($now);
        $homepackageafiliasiDomain->setPackageStatus($package_status);

        if($this->homepackageafiliasiDataSource->update_hpa($homepackageafiliasiDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('setting-home-package-afiliasi/edit');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-package-afiliasi');
            return;
    }

    private function renderEdit(HomePackageAfiliasiDomain $homepackageafiliasiDomain, ValidationErrors $validationErrors = NULL)
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

        $currentPage = $this->request->getGet('p', 1 , 'page');
        $limit = ($currentPage - 1) * $this->maxDataPerPage;
        $homepackageafiliasiDomainArray = $this->homepackageafiliasiDataSource->getAllHomePackageAfiliasiDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


        $path = array('setting-home-package-afiliasi');
        $sumData = $homepackageafiliasiDomainArray['jumlahData'];

        $this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
        $pagination = $this->pagination;

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('paket_afiliasi');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Package Afiliasi',$this->urlBuilder->build('setting-home-package','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb


        //DATA
        $homepackagecategoryDomainArray = $this->homepackageafiliasiDataSource->getAllHomePackageCategoryDomain();

		$this->overideViewVariable(array(
			'homepackageafiliasiDomain' => $homepackageafiliasiDomain,
            'homepackagecategoryDomainArray' => $homepackagecategoryDomainArray,
        ));

        $this->load->view('setting_home_package_afiliasi/edit', $this->viewVariable);
    }
}
?>