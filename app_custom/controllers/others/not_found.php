<?php

class Not_Found extends RootController
{
    protected function initialize()
    {

    }

    public function index()
    {
        $this->renderHome();
    }

    private function renderHome()
    {
        $this->htmlHeader = $this->htmlHeaderFooter->renderHtmlHeader('Halaman tidak ditemukan');
        $this->htmlFooter = $this->htmlHeaderFooter->renderHtmlFooter();

        //----data
        // end data

        // breadcrumb
        $this->breadcrumbArray = array();
        // end breadcrumb

        $this->overideViewVariable();

        set_status_header(404);
        $this->load->view('not_found', $this->viewVariable);
    }
}