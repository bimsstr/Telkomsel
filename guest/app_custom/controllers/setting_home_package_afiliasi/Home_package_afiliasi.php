<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_package_affiliasi extends CI_Controller { // Nama kelas HARUS "Home_package_affiliasi" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen paket afiliasi:
        // $this->load->model('Home_package_affiliasi_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-package-affiliasi
        
        // Di sini Anda akan meletakkan logika untuk menampilkan daftar paket afiliasi,
        // atau form untuk mengelola paket afiliasi.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home Package Afiliasi</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_package_affiliasi/home_package_affiliasi_view'); // Misalnya, file di views/setting_home_package_affiliasi/home_package_affiliasi_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function add()
    // {
    //     // Logika untuk menambahkan paket afiliasi baru
    //     echo "<h1>Halaman Tambah Paket Afiliasi</h1>";
    // }

    // public function edit($id)
    // {
    //     // Logika untuk mengedit paket afiliasi dengan ID tertentu
    //     echo "<h1>Mengedit Paket Afiliasi ID: " . $id . "</h1>";
    // }
}

/* End of file Home_package_affiliasi.php */
/* Location: ./application/controllers/setting_home_package_affiliasi/Home_package_affiliasi.php */