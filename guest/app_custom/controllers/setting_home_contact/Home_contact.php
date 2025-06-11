<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_contact extends CI_Controller { // Nama kelas HARUS "Home_contact" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen kontak:
        // $this->load->model('Home_contact_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-contact
        
        // Di sini Anda akan meletakkan logika untuk menampilkan informasi kontak,
        // atau form untuk mengedit informasi kontak tersebut.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home Contact</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_contact/home_contact_view'); // Misalnya, file di views/setting_home_contact/home_contact_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit()
    // {
    //     // Logika untuk mengedit informasi kontak
    //     echo "<h1>Halaman Edit Home Contact</h1>";
    // }
}

/* End of file Home_contact.php */
/* Location: ./application/controllers/setting_home_contact/Home_contact.php */