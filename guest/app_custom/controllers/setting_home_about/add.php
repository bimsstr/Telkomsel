<?php

use Domain\HomeAboutDomain,
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
		if ($this->request->getPost('process') == 'add_homeabout')
		{
			$this->addProcess();
			return;
		}
        
		$this->renderAdd();
	}

	private function addProcess()
	{
		$data = $this->request->getPost();

		$ha_bigquotation = $this->request->getPost('homeabout_bigquotation');
		$ha_bigabout = $this->request->getPost('homeabout_bigabout');
		$ha_status = $this->request->getPost('homeabout_status');
		

        $dataPost = array(
			'big_quotation' => $this->request->getPost('homeabout_bigquotation'),
			'big_about' => $this->request->getPost('homeabout_bigabout'),
            'status' => $this->request->getPost('homeabout_status'),
		);

        $now = date_create('now')->format('Y-m-d H:i:s');
		
		$homeaboutDomain = new HomeAboutDomain(
			null,
			$ha_bigquotation,
			$ha_bigabout,
			$now,
			$ha_status
		);
		$this->homeaboutDataSource->insert($homeaboutDomain);

		$sessionAdminMessage['type'] = 'success';
		$sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
		$this->session->set('sessionAdminMessage', $sessionAdminMessage);

		$this->redirect('setting_home_about');
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#imgInp').change(function(){
            readURL(this);
	   });
    ");


        $this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
        $this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
        $this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homeabout');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home About',$this->urlBuilder->build('setting-home-about','',FALSE),''),
		    array('Add','','')
		);

		$this->overideViewVariable(array(
			'homeaboutDomain' => $this->homeaboutDomain,
		));

		$this->load->view('setting_home_about/add', $this->viewVariable);
	}
}