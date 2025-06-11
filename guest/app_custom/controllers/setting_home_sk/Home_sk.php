<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_sk extends CI_Controller { // Nama kelas HARUS "Home_sk" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen Syarat & Ketentuan:
        // $this->load->model('Home_sk_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-sk
        
        // Di sini Anda akan meletakkan logika untuk menampilkan halaman Syarat & Ketentuan,
        // atau form untuk mengelola konten tersebut.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home Syarat & Ketentuan (SK)</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_sk/home_sk_view'); // Misalnya, file di views/setting_home_sk/home_sk_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit()
    // {
    //     // Logika untuk mengedit konten Syarat & Ketentuan
    //     echo "<h1>Halaman Edit Home Syarat & Ketentuan (SK)</h1>";
    // }
}

/* End of file Home_sk.php */
/* Location: ./application/controllers/setting_home_sk/Home_sk.php */