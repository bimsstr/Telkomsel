<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_about extends CI_Controller { // Nama kelas HARUS "Home_about" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen konten "About":
        // $this->load->model('Home_about_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-about
        
        // Di sini Anda akan meletakkan logika untuk menampilkan halaman "About",
        // atau form untuk mengedit konten "About".

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home About</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_about/home_about_view'); // Misalnya, file di views/setting_home_about/home_about_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit()
    // {
    //     // Logika untuk mengedit konten halaman "About"
    //     echo "<h1>Halaman Edit Home About</h1>";
    // }
}

/* End of file Home_about.php */
/* Location: ./application/controllers/setting_home_about/Home_about.php */