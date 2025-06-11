<?php

/*
    This source codes may not be redistribute or modified in any kind of form
    without permission from KrevatifSoftware Development (http://krevatif.com).

    Created by: Arya Dwi Anggara, arya@krevatif.com
    Indonesian airlines schedule grabber
    Created, Sept 2011
*/

namespace Utilities;

class Convert
{
    /**
     * function to convert an alphabet into numeric
     *
     * @param string alphabet a will return 1, aa will return 27;
     *
     * return string alphabet
     **/
    public function AlphaToNum($data) {
        $alphabet = array( 'a', 'b', 'c', 'd', 'e',
                           'f', 'g', 'h', 'i', 'j',
                           'k', 'l', 'm', 'n', 'o',
                           'p', 'q', 'r', 's', 't',
                           'u', 'v', 'w', 'x', 'y',
                           'z'
                           );
        $alpha_flip = array_flip($alphabet);
        $return_value = 0;
        $length = strlen($data);
        for ($i = 0; $i < $length; $i++) {
            $return_value +=
                ($alpha_flip[$data[$i]] + 1) * pow(26, ($length - $i - 1));
        }
        return $return_value;
    }

    /**
     * function to convert an integer into alphabet
     *
     * @param int $int is integer value start from 1 will return a, 27 will return aa;
     *
     * return string alphabet
     **/

    public function NumToAlpha($int)
    {
        $alphabet = array('a', 'b', 'c', 'd', 'e',
                           'f', 'g', 'h', 'i', 'j',
                           'k', 'l', 'm', 'n', 'o',
                           'p', 'q', 'r', 's', 't',
                           'u', 'v', 'w', 'x', 'y',
                           'z');
        $string = "";
        do{
            $angka = $int%27;
            $string .= $alphabet[($angka > 0 ? ($angka-1) : 0) ];
            $int = $int - 26;
        }while($int > 0);
        return $string;
    }

	public function distanceOfTimeInWords($fromTime, $toTime = 0, $showLessThanAMinute = false) {
		$distanceInSeconds = round(abs($toTime - $fromTime));
		$distanceInMinutes = round($distanceInSeconds / 60);

		if ( $distanceInMinutes <= 1 ) {
			if ( !$showLessThanAMinute ) {
				return ($distanceInMinutes == 0) ? 'less than a minute' : '1 minute';
			} else {
				if ( $distanceInSeconds < 5 ) {
					return 'less than 5 seconds';
				}
				if ( $distanceInSeconds < 10 ) {
					return 'less than 10 seconds';
				}
				if ( $distanceInSeconds < 20 ) {
					return 'less than 20 seconds';
				}
				if ( $distanceInSeconds < 40 ) {
					return 'about half a minute';
				}
				if ( $distanceInSeconds < 60 ) {
					return 'less than a minute';
				}

				return '1 minute';
			}
		}
		if ( $distanceInMinutes < 45 ) {
			return $distanceInMinutes . ' minutes';
		}
		if ( $distanceInMinutes < 90 ) {
			return 'about 1 hour';
		}
		if ( $distanceInMinutes < 1440 ) {
			return 'about ' . round(floatval($distanceInMinutes) / 60.0) . ' hours';
		}
		if ( $distanceInMinutes < 2880 ) {
			return '1 day';
		}
		if ( $distanceInMinutes < 43200 ) {
			return 'about ' . round(floatval($distanceInMinutes) / 1440) . ' days';
		}
		if ( $distanceInMinutes < 86400 ) {
			return 'about 1 month';
		}
		if ( $distanceInMinutes < 525600 ) {
			return round(floatval($distanceInMinutes) / 43200) . ' months';
		}
		if ( $distanceInMinutes < 1051199 ) {
			return 'about 1 year';
		}

		return 'over ' . round(floatval($distanceInMinutes) / 525600) . ' years';
	}


	function convertToRp($data, $prefix = 'Rp', $postfix = '')
	{
		if (is_int($data))
		{
			$jum = strlen($data);
			$rp = '';
			$i = -3;
			while($jum>0)
			{
				$rp = '.' . substr($data, $i, $jum>3 ? 3 : $jum) . $rp;
				$jum = $jum - 3;
				$i = $jum>3 ? $i - 3 : $i - $jum;
			}

			return $prefix .' '. substr($rp, 1) . $postfix;
		}
		else
		{
			$tempArray = explode('.', $data);
			$postfix = $tempArray[1] > 0 ? ','.$tempArray[1] : '';

			$jum = strlen($tempArray[0]);
			$rp = '';
			$i = -3;
			while($jum>0)
			{
				$rp = '.' . substr($tempArray[0], $i, $jum>3 ? 3 : $jum) . $rp;
				$jum = $jum - 3;
				$i = $jum>3 ? $i - 3 : $i - $jum;
			}
			return $prefix .' '. substr($rp, 1) . $postfix;
		}
	}

    /**
     * fungsi untuk memecah suatu penjumlahan angka biner menjadi array biner
     *
     * @param $angka, angka total dari penjumlahan angka biner
     *
     * @return array kosong jika false,
     *          array biner jika true.
     */
    public function convertBinerToArray($angka)
    {
        if ($angka === FALSE)
        {
            return FALSE;
        }

        $result = array();

        while ($angka > 0)
        {
            $divider = 1;
            while ($divider <= $angka)
            {
                $divider *= 2;
            }
            $divider = $divider == 1 ? 1 : ($divider/2);
            $result = array_merge((array)$divider, $result);
            $angka -= $divider;
        }

        return $result;
    }

    public function convertToGetUrl($query)
    {
        if (is_string($query))
        {
            $query = trim($query);
            $query = ltrim($query, '?');
            return $query;
        }

        if (is_array($query))
        {
            //$queryString = http_build_query($query, '', '&amp;', PHP_QUERY_RFC3986);
            $queryString = http_build_query($query, '', '&amp;');
            return $queryString;
        }
    }

    public function getMonthFormat($month)
    {
        $monthArray = array(
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        foreach ($monthArray as $key => $value)
        {
            if ($key == $month)
            {
                return $value;
            }
        }
    }

    /**
     * Melakukan
     *
     * @param
     * @return
     */
    public function getDayFormat($day)
    {
        $dayArray = array(
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        );
        foreach ($dayArray as $key => $val)
        {
            if ($key == $day)
            {
                return $val;
            }
        }
    }

	public function getMonthFormatSmall($month)
	{
		$monthArray = array(
		    '01' => 'Jan',
		    '02' => 'Feb',
		    '03' => 'Mar',
		    '04' => 'Apr',
		    '05' => 'Mei',
		    '06' => 'Jun',
		    '07' => 'Jul',
		    '08' => 'Agt',
		    '09' => 'Sep',
		    '10' => 'Okt',
		    '11' => 'Nov',
		    '12' => 'Des'
		);

		foreach ($monthArray as $key => $value)
		{
			if ($key == $month)
			{
				return $value;
			}
		}
	}

	public function getTimezone($format = 'Asia/Jakarta'){
        switch($format):
            case 'Asia/Jakarta':
                return 'WIB';
                break;
            case 'Asia/Makassar':
                return 'WITA';
                break;
            case 'Asia/Jayapura':
                return 'WIT';
                break;
        endswitch;
    }

    /**
     * Convert::converArrayToBiner()
     *
     * @param mixed $binerNewPrivilegeArray
     * @return
     */
    public function converArrayToBiner(array $dataArray)
    {
        $total = 0;
        foreach ($dataArray as $data) {
            $total += $data;
        }

        return $total;
    }

    public function convertToNumber($data, $prefix='', $postfix='', $decimal=0, $decPoint=',', $tousand = '.' ){
        return $prefix. number_format($data, $decimal, $decPoint, $tousand). $postfix;
    }

	public function encrypt($data){
        return substr($data, 2,2).base64_encode($data);
    }

    public function decrypt($data){
        return base64_decode(substr($data,2));
    }

    public function convertTimeAgain($datetime){
        $now = strtotime(date('Y-m-d H:i:s'));
        $test = strtotime($datetime);
        $delta = $test - $now;

        $SECOND = 1;
        $MINUTE = 60 * $SECOND;
        $HOUR = 60 * $MINUTE;
        $DAY = 24 * $HOUR;
        $MONTH = 30 * $DAY;
        $YEAR = 12 * $MONTH;

        if ($delta < 0)
        {
            return "";
        }
        if ($delta < 10 * $MINUTE)
        {
            return "10 menit";
        }
        if ($delta < 59 * $MINUTE)
        {
            $minute = ((int) ($delta/$MINUTE));
            return $minute ." menit";
        }
        if ($delta < 90 * $MINUTE)
        {
            return "1 jam";
        }
        if ($delta < 24 * $HOUR)
        {
            $hour = ((int) ($delta/$HOUR));
            return $hour . " jam";
        }
        if ($delta < 30 * $DAY)
        {
            $day = ((int) ($delta/$DAY));
            return $day . " hari";
        }
    }

    public function convertTimeAgo($datetime){
        $now = strtotime(date('Y-m-d H:i:s'));
        $test = strtotime($datetime);
        $delta = $now - $test;

        $SECOND = 1;
        $MINUTE = 60 * $SECOND;
        $HOUR = 60 * $MINUTE;
        $DAY = 24 * $HOUR;
        $MONTH = 30 * $DAY;
        $YEAR = 12 * $MONTH;

        if ($delta < 0)
        {
            return "belum ada.";
        }
        if ($delta < 1 * $MINUTE)
        {
            return $delta == 1 ? "satu detik lalu" : $delta . " detik ago.";
        }
        if ($delta < 2 * $MINUTE)
        {
            return "satu menit lalu.";
        }
        if ($delta < 59 * $MINUTE)
        {
            $minute = ((int) ($delta/$MINUTE));
            return $minute ." menit lalu.";
        }
        if ($delta < 90 * $MINUTE)
        {
            return "sejam lalu.";
        }
        if ($delta < 24 * $HOUR)
        {
            $hour = ((int) ($delta/$HOUR));
            return $hour . " jam lalu.";
        }
        if ($delta < 48 * $HOUR)
        {
            return "kemarin.";
        }
        if ($delta < 30 * $DAY)
        {
            $day = ((int) ($delta/$DAY));
            return $day . " hari lalu.";
        }
        if ($delta < 12 * $MONTH)
        {
            $months = ((int) ($delta/$MONTH));
            return $months <= 1 ? "satu bulan lalu" : $months . " bulan lalu.";
        }
        else
        {
            $years = ((int) ($delta/$YEAR));
            return $years <= 1 ? "satu tahun lalu" : $years . " tahun lalu.";
        }
    }

	public function convertToDuration($duration)
	{
		$menit = $duration % 3600;
		$jam = floor($duration/3600);
		$menit = floor($menit/60);

		return ($jam > 0 ? $jam.'jam ' : '').($menit > 0 ? $menit.'menit' : '');
	}

	public function convertTimeToDuration($str)
	{
		$temp = explode(':', $str);

		return ((int)$temp[0] > 0 ? (int)$temp[0].'jam ' : '').((int)$temp[1] > 0 ? (int)$temp[1].'menit' : '');
	}

	public function convertToBigRp($nominal)
	{
		$cut = substr($nominal, 0,strlen($nominal)-3);

		return 'Rp <span class="pricebig">'.$this->convertToRb($cut).'</span><span class="priceup">.'.substr($nominal, strlen($nominal)-3).'</span>';
	}
	public function convertToRb($data)
	{
		if ($data == '') {
			$data = 0;
		}
		$jum = strlen($data);
		$rp = '';
		$i = -3;
		while($jum>0)
		{
			$rp = '.' . substr($data, $i, $jum>3 ? 3 : $jum) . $rp;
			$jum = $jum - 3;
			$i = $jum>3 ? $i - 3 : $i - $jum;
		}

		return substr($rp, 1);
	}

	public function wordLimiter($str, $limit = 100, $end_char = '&#8230;')
	{
		if (trim($str) == '')
		{
			return $str;
		}

		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

		if (strlen($str) == strlen($matches[0]))
		{
			$end_char = '';
		}

		return rtrim($matches[0]).$end_char;
	}
}

?>