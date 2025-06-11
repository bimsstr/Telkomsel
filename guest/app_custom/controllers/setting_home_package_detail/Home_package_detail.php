<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_package_de extends CI_Controller { // Nama kelas HARUS "Home_package_de" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen detail paket:
        // $this->load->model('Home_package_detail_model'); // Ganti nama model sesuai kebutuhan
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-package-de
        
        // Di sini Anda akan meletakkan logika untuk menampilkan detail paket,
        // atau form untuk mengelola detail paket.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home Package Detail</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_package_de/home_package_detail_view'); // Misalnya, file di views/setting_home_package_de/home_package_detail_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function view($id)
    // {
    //     // Logika untuk melihat detail paket dengan ID tertentu
    //     echo "<h1>Melihat Detail Paket ID: " . $id . "</h1>";
    // }

    // public function edit($id)
    // {
    //     // Logika untuk mengedit detail paket dengan ID tertentu
    //     echo "<h1>Mengedit Detail Paket ID: " . $id . "</h1>";
    // }
}

/* End of file Home_package_de.php */
/* Location: ./application/controllers/setting_home_package_de/Home_package_de.php */