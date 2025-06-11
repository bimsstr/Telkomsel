<?php

namespace Utilities;

class RandomStringGenerator
{

    public function randomJam()
    {
        $jam = rand(0 , 23);
        $menit = rand(0 , 60);

        $jam = ($jam < 10) ? "0".$jam : $jam;
        $menit = ($menit < 10) ? "0".$menit : $menit;

        return $jam.":".$menit;
    }

    public function randomString($dgt)
    {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789ABCDEFGHJKLMNOPQRSTUVWXYZ";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '';

        while ($i < $dgt)
        {
            $num = rand() % 58;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }

        return $pass;
    }

    public function randomStringByAlphaUpperCase($dgt)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '';

        while ($i < $dgt)
        {
            $num = rand() % 26;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }

        return $pass;
    }

    /**
     * Melakukan
     *
     * @param .
     * @return .
     */
    public function encryptString($str, $salt)
    {
        $salt = str_replace(array('a','i','u'), array('q','w','r'), $salt);

        return substr(md5($salt.$str),5,20);
    }

	public function encryptStringAgent($str, $salt)
	{
		$salt = str_replace(array('i', 'e' , 'a' , 'o') , array('p', 's' , 'g', 'b') , $salt);

		return substr(md5($str.$salt),4,25);
	}
}