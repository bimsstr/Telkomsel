<?php

use Domain\HomeAboutDomain,
  Domain\HomeAboutDetailDomain,
	DataSource\HomeAboutDataSource,
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
		$this->homeaboutDataSource = New HomeAboutDataSource($this->mysqli);
	}

	public function index()
	{
		if ($this->request->getPost('process') == 'add_homeaboutdetail')
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
		$card_image = $this->request->getFiles('card_image');

		//DATA
        $card_title = $this->request->getPost('card_title');
		$card_subtitle = $this->request->getPost('card_subtitle');
		$card_description = $this->request->getPost('card_description');
		$card_status = $this->request->getPost('card_status');

		
		if ($card_image['name'] != '') {
			$exten = $card_image['type'];

			if($exten == 'image/jpeg'){
				$ext = '.jpg';
			}

			if($exten == 'image/png'){
				$ext = '.png';
			}

        $card_image['name'] = "imgcard".date('Y-m-d')."_".date('His').$ext;
             if ($card_image['type'] != 'image/jpeg' AND $card_image['type'] != "image/png") {
                 $sessionAdminMessage['type'] = 'error';
                 $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                 $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                 $this->redirect('setting-home-about-detail/add');
                 return;
             }
        }

      $fileTemp1 = array(
                    'name' => $card_image['name'],
                    'type' => $card_image['type'],
                    'tmp_name' => $card_image['tmp_name'],
                    'error' => $card_image['error'],
                    'size' => $card_image['size']
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
                 $this->redirect('setting-home-about-detail/add');
                 return;
            }

            $fileName1 = $fileName1.".".$ext1;
       } 

		$dataPost = array(
    'card_title' => $this->request->getPost('card_title'),
    'card_subtitle' => $this->request->getPost('card_subtitle'),
    'card_description' => $this->request->getPost('card_description'),
    'status' => $this->request->getPost('card_status')
		);
    $now = date_create('now')->format('Y-m-d H:i:s');

		$homeaboutdetailDomain = new HomeAboutDetailDomain(
			null,
			$fileName1,
			$card_title,
			$card_subtitle,
			$card_description,
			$now,
			$card_status
		);
		$this->homeaboutDataSource->insert_had($homeaboutdetailDomain);

		$sessionAdminMessage['type'] = 'success';
		$sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
		$this->session->set('sessionAdminMessage', $sessionAdminMessage);

		$this->redirect('setting-home-about');
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
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

      $('#imgInp').change(function(){
            readURL1(this);
	        });
    ");

        $this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
        $this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
        $this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homeabout');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home About Detail',$this->urlBuilder->build('setting-home-about','',FALSE),''),
		    array('Add','','')
		);

		$this->overideViewVariable(array(
			'homeaboutdetailDomain' => $this->homeaboutdetailDomain
		));

		$this->load->view('setting_home_about_detail/add', $this->viewVariable);
	}
}