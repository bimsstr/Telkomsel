<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil_kami_title extends CI_Controller { // Nama kelas HARUS "Profil_kami_title" sesuai dengan nama file dan rute di routes.php

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen judul profil kami:
        // $this->load->model('Profil_kami_title_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-profil-kami-title
        
        // Di sini Anda akan meletakkan logika untuk menampilkan atau mengelola judul-judul yang terkait dengan profil kami.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home Profil Kami Title</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_profil_kami_title/profil_kami_title_view'); // Misalnya, file di views/setting_home_profil_kami_title/profil_kami_title_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit($id)
    // {
    //     // Logika untuk mengedit judul profil kami dengan ID tertentu
    //     echo "<h1>Halaman Edit Home Profil Kami Title ID: " . $id . "</h1>";
    // }
}

/* End of file Profil_kami_title.php */
/* Location: ./application/controllers/setting_home_profil_kami_title/Profil_kami_title.php */