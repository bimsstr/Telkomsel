<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_faq extends CI_Controller { // Nama kelas HARUS "Home_faq" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen FAQ:
        // $this->load->model('Home_faq_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-faq
        
        // Di sini Anda akan meletakkan logika untuk menampilkan daftar FAQ,
        // atau form untuk mengelola FAQ.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home FAQ</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_faq/home_faq_view'); // Misalnya, file di views/setting_home_faq/home_faq_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function add()
    // {
    //     // Logika untuk menambahkan FAQ baru
    //     echo "<h1>Halaman Tambah FAQ</h1>";
    // }

    // public function edit($id)
    // {
    //     // Logika untuk mengedit FAQ dengan ID tertentu
    //     echo "<h1>Mengedit FAQ ID: " . $id . "</h1>";
    // }
}

/* End of file Home_faq.php */
/* Location: ./application/controllers/setting_home_faq/Home_faq.php */