<?php

use Domain\HomePackageCategoryDomain,
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

    	$homepackagecategoryDomain = $this->homepackageDataSource->getHomePackageCategoryDomainById($id);

    	if(!($homepackagecategoryDomain instanceof HomePackageCategoryDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-package');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homepackagecategory")
        {
            $this->processEdit($homepackagecategoryDomain);
            return;
        }

        $this->renderEdit($homepackagecategoryDomain);
    }

    private function processEdit(HomePackageCategoryDomain $homepackagecategoryDomain)
    {
        $data = $this->request->getPost();

        $category = $this->request->getPost('package_category');

        $dataPost = array(
            'category' => $this->request->getPost('package_category'),
        );
        
        $homepackagecategoryDomain->setCategory($dataPost['category']);

        if($this->homepackageDataSource->update_hpc($homepackagecategoryDomain) == FALSE)
        {
            $sessionAdminMessage['type'] = 'error';
            $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-package-category/edit');
            return;
        }

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting_home_package/lists');
        return;
    }

    private function renderEdit(HomePackageCategoryDomain $homepackagecategoryDomain, ValidationErrors $validationErrors = NULL)
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
        });
    ");

		$this->validationErrorsRenderer = new ValidationErrorsRenderer($validationErrors);
		$this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader();
		$this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homepackage');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home Package Category',$this->urlBuilder->build('setting-home-package','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

		$this->overideViewVariable(array(
			'homepackagecategoryDomain' => $homepackagecategoryDomain,
        ));

        $this->load->view('setting_home_package_category/edit', $this->viewVariable);
    }
}
?>