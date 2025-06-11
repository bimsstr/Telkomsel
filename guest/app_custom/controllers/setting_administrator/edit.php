<?php

use Domain\AdminDomain,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\RandomStringGenerator,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';

    private $randomStringGenerator;

    protected function initialize()
    {
    	$this->randomStringGenerator = new RandomStringGenerator();
    }

    public function index()
    {
    	$id = $this->request->getGet('id');
    	$adminDomain = $this->adminDataSource->getAdminDomainById($id);

    	if(!($adminDomain instanceof AdminDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-administrator');
    		return;
    	}

        if($this->request->getPost('process') == "edit_admin")
        {
            $this->processEdit($adminDomain);
            return;
        }

        $this->renderEdit($adminDomain);
    }

    private function processEdit(AdminDomain $adminDomain)
    {
        $data = $this->request->getPost();

        //FILE
        $admin_image = $this->request->getFiles('admin_image');

        //DATA
        $adm_name = $this->request->getPost('admin_name');
        $adm_position = $this->request->getPost('admin_position');
        $adm_email = $this->request->getPost('admin_email');
        $adm_phone = $this->request->getPost('admin_phone');
        $adm_address = $this->request->getPost('admin_address');
        $adm_about = $this->request->getPost('admin_about');
        $adm_tier = $this->request->getPost('admin_tier');
        $adm_stat_aktif = $this->request->getPost('admin_status');

        if($this->request->getPost('admin_password') != '')
        {
            $adminDomain->setPassword($this->randomStringGenerator->encryptStringAgent( $this->request->getPost('admin_password') , $adminDomain->getUsername() ));
        }
        
        $fileName1 = $adminDomain->getImage();

        //HANDLE IMAGE COMPANY PROFILE
        if ($admin_image['name'] != '') {

            $exten1 = $admin_image['type'];

            if($exten1 == 'image/jpeg'){
                $ext1 = '.jpg';
            }
            if($exten1 == 'image/png'){
                $ext1 = '.png';
            }

            $admin_image['name'] = "imgadmin".date('Y-m-d')."_".date('His').$ext1;

            if ($admin_image['type'] != 'image/jpeg' AND $admin_image['type'] != "image/png") {

                $sessionAdminMessage['type'] = 'error';
                $sessionAdminMessage['message'] = 'File yang diupload harus format jpg/png!';
                $this->session->set('sessionAdminMessage', $sessionAdminMessage);
                $this->redirect('setting-administrator/edit');
                return;
            }
            $old_img_thumbs = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'profile'.DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.$adminDomain->getImage());
            $old_img = $this->asset->getOutsideFile('images'.DIRECTORY_SEPARATOR.'profile'.DIRECTORY_SEPARATOR.$adminDomain->getImage());
            if (file_exists($old_img_thumbs) && file_exists($old_img)) {
                    unlink($old_img_thumbs);
                    unlink($old_img);
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
                $this->redirect('setting-administrator/edit');
                return;
            }
                $fileName1 = $fileName1.".".$ext1;
            } 
        }

        $dataPost = array(
            'fullname' => $this->request->getPost('admin_name'),
            'position' => $this->request->getPost('admin_position'),
            'address' => $this->request->getPost('admin_address'),
            'phone' => $this->request->getPost('admin_phone'),
            'email' => $this->request->getPost('admin_email'),
            'about' => $this->request->getPost('admin_about'),
            'status' => $this->request->getPost('admin_status'),
        );

        $now = date_create('now')->format('Y-m-d H:i:s');

    	$adminDomain->setFullname($dataPost['fullname']);
        $adminDomain->setPosition($dataPost['position']);
        $adminDomain->setAddress($dataPost['address']);
        $adminDomain->setPhone($dataPost['phone']);
        $adminDomain->setEmail($dataPost['email']);
        $adminDomain->setAbout($dataPost['about']);
        $adminDomain->setImage($fileName1);
        $adminDomain->setCreatedDate($now);
        $adminDomain->setStar(null);
        $adminDomain->setTier($adm_tier);
        $adminDomain->setStatus($dataPost['status']);

    	$this->adminDataSource->update($adminDomain);

        $sessionMessage['type'] = 'success';
        $sessionMessage['message'] = "Admin has been edited";
        $this->session->set('sessionAdminMessage', $sessionMessage);

        $this->redirect('setting-administrator');
        return;
    }

    private function renderEdit(AdminDomain $adminDomain, ValidationErrors $validationErrors = NULL)
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


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Administrator',$this->urlBuilder->build('setting-administrator','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

		$this->overideViewVariable(array(
			'adminDomain' => $adminDomain,
			// 'privilegeGroupDomainArray' => $privilegeGroupDomainArray
        ));

        $this->load->view('setting_administrator/edit', $this->viewVariable);
    }
}
?>