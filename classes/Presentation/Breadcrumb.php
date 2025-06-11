<?php

namespace Presentation;

class Breadcrumb extends RootPresentation
{
    public function renderBreadcrumb(array $item)
    {
        //array(
//            array(
//                'Display text', 'url'
//            )
//        )
// jika url kosong maka status berada di halaman tsb

        $data = '<ol class="breadcrumb default square rsaquo sm">';

        for ($i = 0; $i < count($item); $i++)
        {
            if ($item[$i][1] == '')
            {
                $data .= '<li>'.$item[$i][0].'</li>';
            }
            else
            {
                $data .= '<li><a href="'.$item[$i][1].'">'.$item[$i][0].'</a></li>';
            }

            if (($i+1) < count($item))
            {
                $data .= ' ';
            }

        } // for

        $data .= '</ol>';
        return $data;
    }

    public function renderAdminBreadcrumb(array $item)
    {
        $data = '<ol class="breadcrumb default square rsaquo sm">';

        for ($i = 0; $i < count($item); $i++)
        {
            $data .= '<li>';
            if ($item[$i][1] != '') {
                $data .= '<a href="'.$item[$i][1].'">';
            }
            if ($item[$i][2] != '') {
                $data .= '<i class="'.$item[$i][2].'"></i> ';
            }

            $data .= $item[$i][0];

            if ($i+1 < count($item)) {
                $data .= ' <i></i>';
            }
            if ($item[$i][1] != '') {
                $data .= '</a>';
            }

            $data .= '</li>';
        }

        $data .= '</ol>';
        return $data;
    }
}

?>