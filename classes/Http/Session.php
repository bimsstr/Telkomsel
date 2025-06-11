<?php

namespace Http;

class Session
{
    protected $started = FALSE;

    public function start()
    {
        if ($this->started)
        {
            return TRUE;
        }

        $this->started = session_start();
        return $this->started;
    }

    public function writeClose()
    {
        session_write_close();
        $this->started = FALSE;
    }

    public function close()
    {
        if ($this->started == FALSE)
        {
            return;
        }

        session_write_close();
        $this->started = FALSE;
    }

    public function destroy()
    {
        $_SESSION = array();
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );

        $result = session_destroy();
        $this->started = !$result;
        return $result;
    }


    public function get($index = NULL, $default = NULL)
    {
        if ($this->started)
        {
            if ($index == NULL)
            {
                return $_SESSION;
            }

            if (array_key_exists($index, $_SESSION))
            {
                return $_SESSION[$index];
            }
        }

        return $default;
    }

    public function set($index, $value)
    {
        if ($this->started)
        {
            $_SESSION[$index] = $value;
        }
    }

    public function remove($index = NULL)
    {
        if ($this->started)
        {
            if ($index == NULL)
            {
                $_SESSION = array();
                return;
            }

            unset($_SESSION[$index]);
        }
    }

    public function isIndexSet($index)
    {
        if ($this->started)
        {
            return isset($_SESSION[$index]);
        }

        return FALSE;
    }

	public function getSessionId()
	{
		return session_id();
	}
}