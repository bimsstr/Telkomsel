<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_title extends CI_Controller { // Nama kelas HARUS "Home_title" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen judul halaman depan:
        // $this->load->model('Home_title_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-title
        
        // Di sini Anda akan meletakkan logika untuk menampilkan atau mengelola judul-judul utama halaman depan.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home Title</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_title/home_title_view'); // Misalnya, file di views/setting_home_title/home_title_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit($id)
    // {
    //     // Logika untuk mengedit judul halaman depan dengan ID tertentu
    //     echo "<h1>Halaman Edit Home Title ID: " . $id . "</h1>";
    // }
}

/* End of file Home_title.php */
/* Location: ./application/controllers/setting_home_title/Home_title.php */