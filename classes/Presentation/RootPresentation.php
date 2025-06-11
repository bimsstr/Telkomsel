<?php

namespace Presentation;

class RootPresentation
{
    public function clean($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}