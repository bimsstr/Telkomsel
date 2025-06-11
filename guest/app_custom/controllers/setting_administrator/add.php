<?php

use Domain\AdminDomain,
	Validation\GeneralValidation,
	Presentation\ValidationErrorsRenderer,
	Utilities\RandomStringGenerator,
	Utilities\ValidationErrors,
	Utilities\Upload;

class Add extends AdminController
{
	protected $requiredAdminStatus = 'LoggedIn';
	private $randomStringGenerator;

	protected function initialize()
	{
		$this->randomStringGenerator = new RandomStringGenerator();
	}

	public function index()
	{
		if ($this->request->getPost('process') == 'add_admin')
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
        $admin_image = $this->request->getFiles('admin_image');

        //DATA
		$adm_username = $this->request->getPost('admin_username');
		$adm_password = $this->request->getPost('admin_password');
		$adm_name = $this->request->getPost('admin_name');
		$adm_position = $this->request->getPost('admin_position');
		$adm_email = $this->request->getPost('admin_email');
		$adm_phone = $this->request->getPost('admin_phone');
		$adm_address = $this->request->getPost('admin_address');
		$adm_about = $this->request->getPost('admin_about');
		$adm_stat_aktif = $this->request->getPost('admin_status');
        $adm_tier = $this->request->getPost('admin_tier');
  
		if ($admin_image['name'] != '') {
            $exten = $admin_image['type'];

            if($exten == 'image/jpeg'){
                $ext = '.jpg';
            }

            if($exten == 'image/png'){
                $ext = '.png';
            }

            $admin_image['name'] = "imgadmin".date('Y-m-d')."_".date('His').$ext;
             if ($admin_image['type'] != 'image/jpeg' AND $admin_image['type'] != "image/png") {
                 $sessionAdminMessage['type'] = 'error';
                 $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                 $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                 $this->redirect('setting-administrator/add');
                 return;
             }
        }

        $fileTemp1 = array(
                    'name' => $admin_image['name'],
                    'type' => $admin_image['type'],
                    'tmp_name' => $admin_image['tmp_name'],
                    'error' => $admin_image['error'],
                    'size' => $admin_image['size']
        );

        $handle1 = new Upload($fileTemp1);
        $ext1 = $handle1->file_src_name_ext;
        $handle1->file_new_name_body1 = "imgadmin".date('Y-m-d')."_".date('His');
        $fileName1 = $handle1->file_new_name_body1;

        if ($handle1->uploaded) {
            if (!($handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'profile')))) {
                $handle1->file_new_name_body = $fileName1;
                $handle1->image_resize         = true;
                $handle1->image_x              = 200;
                $handle1->image_ratio_y        = true;
                $handle1->process($this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'profile'.DIRECTORY_SEPARATOR.'thumbs'));
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
                 $this->redirect('setting-administrator/add');
                 return;
            }

            $fileName1 = $fileName1.".".$ext1;
        } 

        $dataPost = array(
			'username' => $this->request->getPost('admin_username'),
			'password' => $this->request->getPost('admin_password'),
			'fullname' => $this->request->getPost('admin_name'),
			'position' => $this->request->getPost('admin_position'),
			'address' => $this->request->getPost('admin_address'),
			'phone' => $this->request->getPost('admin_phone'),
			'email' => $this->request->getPost('admin_email'),
			'about' => $this->request->getPost('admin_about'),
			'status' => $this->request->getPost('admin_status'),
            'tier' => $this->request->getPost('admin_tier'),
		);

		$now = date_create('now')->format('Y-m-d H:i:s');
		
		$adminDomain = new AdminDomain(
			null,
			$dataPost['username'],
			$this->randomStringGenerator->encryptStringAgent($dataPost['password'], $dataPost['username']),
			$dataPost['fullname'],
			$dataPost['position'],
			$dataPost['address'],
			$dataPost['phone'],
			$dataPost['email'],
			$dataPost['about'],
			$fileName1,
			$now,
            null,
            $dataPost['tier'],
			$dataPost['status']
		);
		$this->adminDataSource->insert($adminDomain);

		$sessionAdminMessage['type'] = 'success';
		$sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
		$this->session->set('sessionAdminMessage', $sessionAdminMessage);

		$this->redirect('setting-administrator');
		return;
	}

	private function renderAdd(ValidationErrors $validationErrors = NULL)
	{
		if ($validationErrors == NULL)
		{
			$validationErrors = new ValidationErrors();
		}
		
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

        $this->htmlHeaderFooter->addJsAsset(array(
            'js/admin.js' => FALSE,
        ));
    	
		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('administrator');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Administrator',$this->urlBuilder->build('setting-administrator','',FALSE),''),
		    array('Add','','')
		);

		$this->overideViewVariable(array(

		));

		$this->load->view('setting_administrator/add', $this->viewVariable);
	}
}