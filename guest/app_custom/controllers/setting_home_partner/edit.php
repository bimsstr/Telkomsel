<?php

use Domain\HomePartnerDomain,
    DataSource\HomePartnerDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';

    protected function initialize()
    {
        $this->homepartnerDataSource = New HomePartnerDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

    	$homepartnerDomain = $this->homepartnerDataSource->getHomePartnerDomainById($id);

    	if(!($homepartnerDomain instanceof HomePartnerDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-partner');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homepartner")
        {
            $this->processEdit($homepartnerDomain);
            return;
        }

        $this->renderEdit($homepartnerDomain);


    }

    private function processEdit(HomePartnerDomain $homepartnerDomain)
    {
        $data = $this->request->getPost();

        //FILE
        $partner_image = $this->request->getFiles('partner_image');

        //DATA
        $partner_description = $this->request->getPost('partner_description');
        $partner_status = $this->request->getPost('partner_status');

        $fileName1 = $homepartnerDomain->getImage();

        //HANDLE IMAGE PARTNER
        if ($partner_image['name'] != '') {

            $exten1 = $partner_image['type'];

            if($exten1 == 'image/jpeg'){
                $ext1 = '.jpg';
            }
            if($exten1 == 'image/png'){
                $ext1 = '.png';
            }

            $partner_image['name'] = "imgpartner".date('Y-m-d')."_".date('His').$ext1;

            if ($partner_image['type'] != 'image/jpeg' AND $partner_image['type'] != "image/png") {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                $this->redirect('setting-home-partner/edit');
                return;
            }
            $old_img_thumbs = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'partner'.DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.$homepartnerDomain->getImage());
            $old_img = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'partner'.DIRECTORY_SEPARATOR.$homepartnerDomain->getImage());
            if (file_exists($old_img_thumbs) && file_exists($old_img)) {
                    unlink($old_img_thumbs);
                    unlink($old_img);
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
                $this->redirect('setting-home-partner/edit');
                return;
            }
                $fileName1 = $fileName1.".".$ext1;
            } 
        }
        $now = date_create('now')->format('Y-m-d H:i:s');

        $homepartnerDomain->setImage($fileName1);
        $homepartnerDomain->setDescription($partner_description);
        $homepartnerDomain->setCreatedDate($now);
        $homepartnerDomain->setStatus($partner_status);
        
        if($this->homepartnerDataSource->update($homepartnerDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('setting-home-partner/edit');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-partner');
            return;
    }

    private function renderEdit(HomePartnerDomain $homepartnerDomain, ValidationErrors $validationErrors = NULL)
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
        $homepartnerDomainArray = $this->homepartnerDataSource->getAllHomePartnerDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


        $path = array('homepartner');
        $sumData = $homepartnerDomainArray['jumlahData'];

        $this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
        $pagination = $this->pagination;

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homepartner');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Partner',$this->urlBuilder->build('setting-home-partner','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

		$this->overideViewVariable(array(
			'homepartnerDomain' => $homepartnerDomain,
        ));

        $this->load->view('setting_home_partner/edit', $this->viewVariable);
    }
}
?>