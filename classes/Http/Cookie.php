<?php
namespace Http;

class Cookie
{
    public function setCookie($cookieName, $cookieValue, $time = 0, $path = "/", $domain, $httpsAccess = 1)
    {
        return setcookie($cookieName, $cookieValue, time()+$time, "/" , $domain, $httpsAccess); // jangan lopa di set authenticate buat domain
    }

    public function removeCookie($cookieName)
    {
        setcookie($cookieName, "", time()-1000);
    }

    public function getCookie($cookieName)
    {
        if($this->isCookie($cookieName))
        {
            return $_COOKIE[$cookieName];
        }
        else
        {
            return;
        }
    }

    public function isCookie($cookieName)
    {
        return isset($_COOKIE[$cookieName]);
    }
}
?>