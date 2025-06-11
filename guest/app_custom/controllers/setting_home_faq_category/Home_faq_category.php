<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_faq_category extends CI_Controller { // Nama kelas HARUS "Home_faq_category" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen kategori FAQ:
        // $this->load->model('Home_faq_category_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-faq-category
        
        // Di sini Anda akan meletakkan logika untuk menampilkan daftar kategori FAQ,
        // atau form untuk mengelola kategori.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home FAQ Category</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_faq_category/home_faq_category_view'); // Misalnya, file di views/setting_home_faq_category/home_faq_category_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function add()
    // {
    //     // Logika untuk menambahkan kategori FAQ baru
    //     echo "<h1>Halaman Tambah Kategori FAQ</h1>";
    // }

    // public function edit($id)
    // {
    //     // Logika untuk mengedit kategori FAQ dengan ID tertentu
    //     echo "<h1>Mengedit Kategori FAQ ID: " . $id . "</h1>";
    // }
}

/* End of file Home_faq_category.php */
/* Location: ./application/controllers/setting_home_faq_category/Home_faq_category.php */