<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_kp_title extends CI_Controller { // Nama kelas HARUS "Home_kp_title" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen judul KP:
        // $this->load->model('Home_kp_title_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-kp-title
        
        // Di sini Anda akan meletakkan logika untuk menampilkan atau mengelola judul-judul yang terkait dengan KP.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home KP Title</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_kp_title/home_kp_title_view'); // Misalnya, file di views/setting_home_kp_title/home_kp_title_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit($id)
    // {
    //     // Logika untuk mengedit judul KP dengan ID tertentu
    //     echo "<h1>Halaman Edit Home KP Title ID: " . $id . "</h1>";
    // }
}

/* End of file Home_kp_title.php */
/* Location: ./application/controllers/setting_home_kp_title/Home_kp_title.php */