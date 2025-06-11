<?php

use Domain\HomeAboutDomain,
    DataSource\HomeAboutDataSource,
    Validation\GeneralValidation,
    Presentation\ValidationErrorsRenderer,
    Utilities\ValidationErrors,
    Utilities\Upload;

class Edit extends AdminController
{
    protected $requiredAdminStatus = 'LoggedIn';
    
    protected function initialize()
    {
        $this->homeaboutDataSource = New HomeAboutDataSource($this->mysqli);
    }

    public function index()
    {
        $id = $this->request->getGet('id');

    	$homeaboutDomain = $this->homeaboutDataSource->getHomeAboutDomainById($id);

    	if(!($homeaboutDomain instanceof HomeAboutDomain))
    	{
    		$sessionMessage['type'] = 'warning';
    		$sessionMessage['message'] = $this->lang->getInternalErrorMessage();
    		$this->session->set('sessionAdminMessage', $sessionMessage);

    		$this->redirect('setting-home-about');
    		return;
    	}

        if($this->request->getPost('process') == "edit_homeabout")
        {
            $this->processEdit($homeaboutDomain);
            return;
        }

        $this->renderEdit($homeaboutDomain);
    }

    private function processEdit(HomeAboutDomain $homeaboutDomain)
    {
        $data = $this->request->getPost();

        
        $now = date_create('now')->format('Y-m-d H:i:s');
        $ha_bigquote = $this->request->getPost('homeabout_bigquotation');
        $ha_bigabout = $this->request->getPost('homeabout_bigabout');
        $ha_status = $this->request->getPost('homeabout_status');
        
        $homeaboutDomain->setBigQuotation($ha_bigquote);
        $homeaboutDomain->setBigAbout($ha_bigabout);
        $homeaboutDomain->setCreatedDate($now);
        $homeaboutDomain->setStatus($ha_status);

        if($this->homeaboutDataSource->update($homeaboutDomain) == FALSE)
        {
            $sessionAdminMessage['type'] = 'error';
            $sessionAdminMessage['message'] = $this->lang->getInternalErrorMessage();
            $this->session->set('sessionAdminMessage', $sessionAdminMessage);

            $this->redirect('setting-home-about/edit');
            return;
        }

        $sessionAdminMessage['type'] = 'success';
        $sessionAdminMessage['message'] = $this->lang->getInsertSuccessMessage();
        $this->session->set('sessionAdminMessage', $sessionAdminMessage);

        $this->redirect('setting_home_about/lists');
        return;
    }

    private function renderEdit(HomeAboutDomain $homeaboutDomain, ValidationErrors $validationErrors = NULL)
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
		$this->sideBar = $this->menuBarRenderer->renderSideBarMenu('homeabout');
		$this->headerBar = $this->menuBarRenderer->renderHeaderBar();


		// breadcrumb
		$this->breadcrumbArray = array(
            array('',$this->urlBuilder->build('dashboard'),'fa fa-home'),
            array('Home About',$this->urlBuilder->build('setting-home-about','',FALSE),''),
			array('Edit','','','')
        );
        // end breadcrumb

		$this->overideViewVariable(array(
			'homeaboutDomain' => $homeaboutDomain,
        ));

        $this->load->view('setting_home_about/edit', $this->viewVariable);
    }
}
?>