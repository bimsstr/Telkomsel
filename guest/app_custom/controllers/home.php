<?php

use Domain\AdminDomain;

class Home extends AdminController
{
    protected function initialize()
    {

    }

    public function index()
    {
        if ($this->adminDomain instanceof AdminDomain)
        {

        	if ($this->adminDomain->getStatus() == 'active') {
                $this->redirect('dashboard');
        	}
        	else {
        		$this->redirect('incoming');
        	}
            return;
        }

        $this->redirect('login');
    }
}