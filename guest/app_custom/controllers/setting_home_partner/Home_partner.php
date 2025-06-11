<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_partner extends CI_Controller { // Nama kelas HARUS "Home_partner" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen partner:
        // $this->load->model('Home_partner_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-partner
        
        // Di sini Anda akan meletakkan logika untuk menampilkan daftar partner,
        // atau form untuk mengelola partner.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home Partner</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_partner/home_partner_view'); // Misalnya, file di views/setting_home_partner/home_partner_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function add()
    // {
    //     // Logika untuk menambahkan partner baru
    //     echo "<h1>Halaman Tambah Partner</h1>";
    // }

    // public function edit($id)
    // {
    //     // Logika untuk mengedit partner dengan ID tertentu
    //     echo "<h1>Mengedit Partner ID: " . $id . "</h1>";
    // }
}

/* End of file Home_partner.php */
/* Location: ./application/controllers/setting_home_partner/Home_partner.php */