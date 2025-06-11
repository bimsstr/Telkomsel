<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_kp_detail extends CI_Controller { // Nama kelas HARUS "Home_kp_detail" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen detail KP:
        // $this->load->model('Home_kp_detail_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-kp-detail
        
        // Di sini Anda akan meletakkan logika untuk menampilkan detail halaman KP,
        // atau form untuk mengedit detail tersebut.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home KP Detail</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_kp_detail/home_kp_detail_view'); // Misalnya, file di views/setting_home_kp_detail/home_kp_detail_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit($id)
    // {
    //     // Logika untuk mengedit detail KP dengan ID tertentu
    //     echo "<h1>Halaman Edit Home KP Detail ID: " . $id . "</h1>";
    // }
}

/* End of file Home_kp_detail.php */
/* Location: ./application/controllers/setting_home_kp_detail/Home_kp_detail.php */