<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil_kami extends CI_Controller { // Nama kelas HARUS "Profil_kami" sesuai dengan nama file dan rute di routes.php

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen profil kami:
        // $this->load->model('Profil_kami_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-profil-kami
        
        // Di sini Anda akan meletakkan logika untuk menampilkan halaman profil kami,
        // atau form untuk mengelola konten profil tersebut.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home Profil Kami</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_profil_kami/profil_kami_view'); // Misalnya, file di views/setting_home_profil_kami/profil_kami_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit()
    // {
    //     // Logika untuk mengedit konten halaman profil kami
    //     echo "<h1>Halaman Edit Home Profil Kami</h1>";
    // }
}

/* End of file Profil_kami.php */
/* Location: ./application/controllers/setting_home_profil_kami/Profil_kami.php */