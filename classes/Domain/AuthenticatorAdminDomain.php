<?php

namespace Domain;

use Http\Session,
    Http\Cookie,
    Http\Request;

class AuthenticatorAdminDomain
{
    private $session;

    private $cookie;

    private $request;

    /**
     * @var
     */
    private $key;

    public function __construct(
        Session $session,
        Cookie $cookie,
        Request $request,
        $key
    )
    {
        $this->session = $session;
        $this->cookie = $cookie;
        $this->request = $request;
        $this->key = $key;
    }

    public function getCurrentlyLoggedById()
    {
        $this->session->start();

        if ($this->session->isIndexSet('id'.$this->key))
        {
            return $this->session->get('id'.$this->key);
        }
        else
        {
            return FALSE;
        }
    }

    public function createUserSession($id)
    {
        $this->session->start();
        $this->session->set('id'.$this->key, $id);
    }

    public function removeUserSession()
    {
        $this->session->start();
        $this->session->remove('id'.$this->key);
    }
}

