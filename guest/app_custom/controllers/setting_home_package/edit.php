<?php

use Domain\HomePackageDomain,
    DataSource\HomePackageDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';
    
    protected function initialize()
    {
        $this->homepackageDataSource = New HomePackageDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

    	$homepackageDomain = $this->homepackageDataSource->getHomePackageDomainById($id);

    	if(!($homepackageDomain instanceof HomePackageDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-package');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homepackagetitle")
        {
            $this->processEdit($homepackageDomain);
            return;
        }

        $this->renderEdit($homepackageDomain);
    }

    private function processEdit(HomePackageDomain $homepackageDomain)
    {
        $data = $this->request->getPost();

        $now = date_create('now')->format('Y-m-d H:i:s');
        $title = $this->request->getPost('homepackage_title');
        $subtitle = $this->request->getPost('homepackage_subtitle');
        $status = $this->request->getPost('homepackage_status');
        
        $homepackageDomain->setTitle($title);
        $homepackageDomain->setSubtitle($subtitle);
        $homepackageDomain->setCreatedDate($now);
        $homepackageDomain->setStatus($status);

        if($this->homepackageDataSource->update($homepackageDomain) == FALSE)
        {
            $sessionAdminMessage['type'] = 'error';
            $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-package/edit');
            return;
        }

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting_home_package/lists');
        return;
    }

    private function renderEdit(HomePackageDomain $homepackageDomain, ValidationErrors $validationErrors = NULL)
    {
        if ($validationErrors == NULL)
        {
            $validationErrors = new ValidationErrors();
        }

        $this->htmlHeaderFooter->addCssAsset(array(
 
        ));

        $this->htmlHeaderFooter->addJsAsset(array(
          'js/bundles/ckeditor-full/ckeditor.js' => FALSE
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
        });
    ");
        $this->htmlHeaderFooter->addJsAsset(array(
          'js/jquery-datatable.js' => FALSE,
          'js/admin.js' => FALSE,
        ));

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homepackage');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Package',$this->urlBuilder->build('setting-home-package','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

		$this->overideViewVariable(array(
			'homepackageDomain' => $homepackageDomain,
        ));

        $this->load->view('setting_home_package/edit', $this->viewVariable);
    }
}
?>