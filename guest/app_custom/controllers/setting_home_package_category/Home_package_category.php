<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_package_category extends CI_Controller { // Nama kelas HARUS "Home_package_category" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen kategori paket:
        // $this->load->model('Home_package_category_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-package-category
        
        // Di sini Anda akan meletakkan logika untuk menampilkan daftar kategori paket,
        // atau form untuk mengelola kategori paket.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home Package Category</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_package_category/home_package_category_view'); // Misalnya, file di views/setting_home_package_category/home_package_category_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function add()
    // {
    //     // Logika untuk menambahkan kategori paket baru
    //     echo "<h1>Halaman Tambah Kategori Paket</h1>";
    // }

    // public function edit($id)
    // {
    //     // Logika untuk mengedit kategori paket dengan ID tertentu
    //     echo "<h1>Mengedit Kategori Paket ID: " . $id . "</h1>";
    // }
}

/* End of file Home_package_category.php */
/* Location: ./application/controllers/setting_home_package_category/Home_package_category.php */