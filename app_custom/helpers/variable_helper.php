<?php if(! defined('BASEPATH')) die('No Direct script access allowed');

/**
 * Melakukan
 *
 * @param
 * @return
 */
function getMonthFormat($month)
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
function getDayFormat($day)
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

/**
 * Melakukan
 *
 * @param .
 * @return .
 */
function getRandomWord()
{
    $data = array(
        'Sawo',
        'Jeruk',
        'Jambu',
        'Duku',
        'Belimbing',
        'Manggis',
        'Sirsak',
        'Salak',
        'Rambutan',
        'Nanas',
        'Pepaya',
        'Mangga',
        'Jagung',
        'Kacang',
        'kedelai',
        'Alpukat',
        'gandum',
        'Raspberi',
        'Brokoli',
        'Apel',
        'Blueberries',
        'Cokelat',
        'Bawang',
        'salmon',
        'Bayam',
        'Yogurt',
        'Cabai',
        'Jamur',
        'buncis',
        'Kangkung',
        'Kentang',
        'Kubis',
        'Lada',
        'Selada',
        'Serai',
        'Sawi',
        'Tomat',
        'Timun',
        'Wortel',
        'Anggur',
        'Arbei',
        'Bacang',
        'Belimbing',
        'Delima',
        'Durian',
        'Kedondong',
        'Kelapa',
        'Kelengkeng',
        'ketela',
        'Lemon',
        'Lobak',
        'Leci',
        'Manggis',
        'Markisa',
        'Mengkudu',
        'Nangka',
        'Pepaya',
        'Persik',
        'Pisang',
        'Rambutan',
        'Srikaya',
        'Stroberi',
        'Terong',
        'Zaitun'
    );

    $max = count($data);

    return strtolower($data[rand(0, ($max-1))]);
}

?>