<?php

use Domain\HomePackageCategoryDomain,
	DataSource\HomePackageDataSource,
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
		$this->homepackageDataSource = New HomePackageDataSource($this->mysqli);
	}

	public function index()
	{
		if ($this->request->getPost('process') == 'add_homepackagecategory')
		{
			$this->addProcess();
			return;
		}
        
		$this->renderAdd();
	}

	private function addProcess()
	{
		$data = $this->request->getPost();

		$category = $this->request->getPost('package_category');

        $dataPost = array(
			'category' => $this->request->getPost('package_category'),
		);

        $now = date_create('now')->format('Y-m-d H:i:s');
		
		$homepackagecategoryDomain = new HomePackageCategoryDomain(
			null,
			$category
		);
		$this->homepackageDataSource->insert_hpc($homepackagecategoryDomain);

		$sessionAdminMessage['type'] = 'success';
		$sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
		$this->session->set('sessionAdminMessage', $sessionAdminMessage);

		$this->redirect('setting-home-package');
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
        $this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homepackage');
        $this->headerBar = $this->menuBarRenderer->renderHeaderBar();
		
		$this->breadcrumbArray = array(
			array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
			array('Home Package Category',$this->urlBuilder->build('setting-home-package','',FALSE),''),
		    array('Add','','')
		);

		$this->overideViewVariable(array(
			'homepackagecategoryDomain' => $this->homepackagecategoryDomain,
		));

		$this->load->view('setting_home_package_category/add', $this->viewVariable);
	}
}