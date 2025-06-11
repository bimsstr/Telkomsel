<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_kp extends CI_Controller { // Nama kelas HARUS "Home_kp" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen konten "KP":
        // $this->load->model('Home_kp_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-kp
        
        // Di sini Anda akan meletakkan logika untuk menampilkan halaman Home KP,
        // atau form untuk mengedit konten tersebut.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home KP</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_kp/home_kp_view'); // Misalnya, file di views/setting_home_kp/home_kp_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit()
    // {
    //     // Logika untuk mengedit konten halaman "KP"
    //     echo "<h1>Halaman Edit Home KP</h1>";
    // }
}

/* End of file Home_kp.php */
/* Location: ./application/controllers/setting_home_kp/Home_kp.php */