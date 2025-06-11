<?php

use Domain\HomeTitleDomain,
    DataSource\HomeTitleDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';
    private $hometitleDataSource;

    protected function initialize()
    {
        $this->hometitleDataSource = New HomeTitleDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

    	$hometitleDomain = $this->hometitleDataSource->getHomeTitleDomainById($id);

    	if(!($hometitleDomain instanceof HomeTitleDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-title');
    		return;
    	}

        if($this->request->getPost('process') == "edit_hometitle")
        {
            $this->processEdit($hometitleDomain);
            return;
        }

        $this->renderEdit($hometitleDomain);


    }

    private function processEdit(HomeTitleDomain $hometitleDomain)
    {
            $data = $this->request->getPost();

            //FILE
            $image_title = $this->request->getFiles('ht_image_title');

            //DATA
            $subtitle = $this->request->getPost('ht_subtitle');
            $videourl = $this->request->getPost('ht_videourl');
            $status = $this->request->getPost('ht_status');

            $fileName3 = $hometitleDomain->getImageTitle();

            // var_dump($fileName1);
            // var_dump($fileName2);
            // var_dump($fileName3);
            // exit();

            //HANDLE IMAGE BASE

            if ($image_title['name'] != '') {

                $exten3 = $image_title['type'];

                if($exten3 == 'image/jpeg'){
                    $ext3 = '.jpg';
                } 
                if($exten3 == 'image/png'){
                    $ext3 = '.png';
                }

                $image_title['name'] = "imgtitle".date('Y-m-d')."_".date('His').$ext3;
                if ($image_title['type'] != 'image/jpeg' AND $image_title['type'] != "image/png") {

                    $sessionAdminMessage['type'] = 'error';
                    $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                    $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                    $this->redirect('setting-home-title/edit');
                    return;
                }
                $old_img_title_thumbs = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'hometitle'.DIRECTORY_SEPARATOR.'image_title'.DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.$hometitleDomain->getImageTitle());
                $old_img_title = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'hometitle'.DIRECTORY_SEPARATOR.'image_title'.DIRECTORY_SEPARATOR.$hometitleDomain->getImageTitle());
                if (file_exists($old_img_title_thumbs) && file_exists($old_img_title)) {
                    unlink($old_img_title_thumbs);
                    unlink($old_img_title);
                }

                $fileTemp3 = array(
                    'name' => $image_title['name'],
                    'type' => $image_title['type'],
                    'tmp_name' => $image_title['tmp_name'],
                    'error' => $image_title['error'],
                    'size' => $image_title['size']
                );

                $handle3 = new Upload($fileTemp3);
                $ext3 = $handle3->file_src_name_ext;
                $handle3->file_new_name_body3 = "imgtitle".date('Y-m-d')."_".date('His');
                $fileName3 = $handle3->file_new_name_body3;

                if ($handle3->uploaded) {
                    if (!($handle3->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'hometitle'.DIRECTORY_SEPARATOR.'image_title')))) {
                        $handle3->file_new_name_body = $fileName3;
                        $handle3->image_resize         = true;
                        $handle3->image_x              = 200;
                        $handle3->image_ratio_y        = true;
                        $handle3->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'hometitle'.DIRECTORY_SEPARATOR.'image_title'.DIRECTORY_SEPARATOR.'thumbs'));
                    if ($handle3->processed) {
                        echo 'image resized';
                        $handle3->clean();
                    } else {
                        echo 'error : ' . $handle3->error;
                    }
                }else{
                 $sessionAdminMessage['type'] = 'error';
                 $sessionAdminMessage['message'] = 'Maaf telah terjadi kesalahan!';
                 $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                 $this->redirect('setting-home-title/edit');
                 return;
                }
                $fileName3 = $fileName3.".".$ext3;
                }
            }

            $hometitleDomain->setImageTitle($fileName3);
            $hometitleDomain->setSubtitle($subtitle);
            $hometitleDomain->setVideoUrl($videourl);
            $hometitleDomain->setStatus($status);

            if($this->hometitleDataSource->update($hometitleDomain) == FALSE)
            {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);

                $this->redirect('setting-home-title/edit');
                return;
            }

            $sessionAdminMessage['type'] = 'success';
            $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-title');
            return;
        
    }

    private function renderEdit(HomeTitleDomain $hometitleDomain, ValidationErrors $validationErrors = NULL)
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
        $hometitleDomainArray = $this->hometitleDataSource->getAllHomeTitleDomainByLimit( $limit, $this->maxDataPerPage, $keyword);


        $path = array('hometitle');
        $sumData = $hometitleDomainArray['jumlahData'];

        $this->initializePagination($this->maxDataPerPage, $sumData , $currentPage, $path, $this->request->getGet(), $this->urlBuilder, 'p');
        $pagination = $this->pagination;

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('hometitle');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Title',$this->urlBuilder->build('setting-home-title','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

		$this->overideViewVariable(array(
			'hometitleDomain' => $hometitleDomain,
        ));

        $this->load->view('setting_home_title/edit', $this->viewVariable);
    }
}
?>