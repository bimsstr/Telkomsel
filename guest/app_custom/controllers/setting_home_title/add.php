<?php

use Domain\HomeTitleDomain,
	DataSource\HomeTitleDataSource,
	Presentation\ValidationErrorsRenderer,
	Validation\GeneralValidation,
	Validation\SettingValidation,
	Utilities\Upload,
	Utilities\ValidationErrors;

class Add extends AdminController
{
	protected $requiredAdminStatus = 'LoggedIn';
	private $hometitleDataSource;

	protected function initialize()
	{
		$this->hometitleDataSource = New HomeTitleDataSource($this->mysqli);
	}

	public function index()
	{
		if ($this->request->getPost('process') == 'add_hometitle')
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
		$image_title = $this->request->getFiles('ht_image_title');

		//DATA
		$subtitle = $this->request->getPost('ht_subtitle');
    $videourl = $this->request->getPost('ht_videourl');
		$status = $this->request->getPost('ht_status');

		

    if ($image_title['name'] != '') {
			$exten = $image_title['type'];

			if($exten == 'image/jpeg'){
				$ext = '.jpg';
			}

			if($exten == 'image/png'){
				$ext = '.png';
			}

			$image_title['name'] = "imgtitle".date('Y-m-d')."_".date('His').$ext;
        if ($image_title['type'] != 'image/jpeg' AND $image_title['type'] != "image/png") {
          $sessionAdminMessage['type'] = 'error';
          $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
          $this->session->set('sessionAdminMessage', $sessionAdminMessage);
          $this->redirect('setting-home-title/add');
          return;
      }
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
        $this->redirect('setting-home-title/add');
        return;
        }
      $fileName3 = $fileName3.".".$ext3;
    } 


		$dataPost = array(
			'subtitle' => $this->request->getPost('ht_subtitle'),
			'status' => $this->request->getPost('ht_status')
		);

	
		$hometitleDomain = new HomeTitleDomain(
			null,
			$fileName3,
			$subtitle,
			$videourl,
			$status
		);
		$this->hometitleDataSource->insert($hometitleDomain);

		$sessionAdminMessage['type'] = 'success';
		$sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
		$this->session->set('sessionAdminMessage', $sessionAdminMessage);

		$this->redirect('setting-home-title');
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
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('hometitle');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home Title',$this->urlBuilder->build('setting-home-title','',FALSE),''),
		    array('Add','','')
		);

		$this->overideViewVariable(array(
			'hometitleDomain' => $this->hometitleDomain
		));

		$this->load->view('setting_home_title/add', $this->viewVariable);
	}
}