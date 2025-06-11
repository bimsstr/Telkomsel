<?php

use Domain\HomeProfilKamiTitleDomain,
DataSource\HomeProfilKamiDataSource,
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
		$this->homeprofilkamiDataSource = New HomeProfilKamiDataSource($this->mysqli);
	}

	public function index()
	{
		if ($this->request->getPost('process') == 'add_homeprofilkamititle')
		{
			$this->addProcess();
			return;
		}

		$this->renderAdd();
	}

	private function addProcess(){
		$data = $this->request->getPost();

		//FILE
		$image_base = $this->request->getFiles('pkt_image_base');

        //DATA
        $title = $this->request->getPost('pkt_title');
        $subtitle = $this->request->getPost('pkt_subtitle');
        $status = $this->request->getPost('pkt_status');
        $now = date_create('now')->format('Y-m-d H:i:s');


        if ($image_base['name'] != '') {
         $exten = $image_base['type'];

         if($exten == 'image/jpeg'){
            $ext = '.jpg';
        }

        if($exten == 'image/png'){
            $ext = '.png';
        }

        $image_base['name'] = "imgbase".date('Y-m-d')."_".date('His').$ext;
        if ($image_base['type'] != 'image/jpeg' AND $image_base['type'] != "image/png") {
            $sessionAdminMessage['type'] = 'error';
            $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);
            $this->redirect('setting-home-profil-kami-title/add');
            return;
        }
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
    $this->redirect('setting-home-profil-kami-title/add');
    return;
}
$fileName1 = $fileName1.".".$ext1;
} 

$homeprofilkamititleDomain = new HomeProfilKamiTitleDomain(
 null,
 $title,
 $subtitle,
 $fileName1,
 $now,
 $status
);
$this->homeprofilkamiDataSource->insert_pkt($homeprofilkamititleDomain);

$sessionAdminMessage['type'] = 'success';
$sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
$this->session->set('sessionAdminMessage', $sessionAdminMessage);

$this->redirect('setting-home-profil-kami');
return;
}

private function renderAdd(ValidationErrors $validationErrors = NULL)
{
    if ($validationErrors == NULL){
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

                $('#imgInp1').change(function(){
                    readURL1(this);
                });

                $('#imgInp2').change(function(){
                    readURL2(this);
                });

                $('#imgInp3').change(function(){
                    readURL3(this);
                });

                $('#imgInp4').change(function(){
                    readURL4(this);
                });

                $('#imgInp5').change(function(){
                    readURL5(this);
                });
    ");

    $this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
    $this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
    $this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
    $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('profilkami');
    $this->headerBar = $this->menuBarRenderer->renderHeaderBar();

    $this->breadcrumbArray = array(
        array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
        array('Home Profil Kami Title',$this->urlBuilder->build('setting-home-profil-kami','',FALSE),''),
        array('Add','','')
    );     

    $this->overideViewVariable(array(
        'homeprofilkamititleDomain' => $this->homeprofilkamititleDomain
    ));

    $this->load->view('setting_home_profil_kami_title/add', $this->viewVariable);
    }
}