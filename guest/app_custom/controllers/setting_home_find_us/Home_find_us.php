<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_find_us extends CI_Controller { // Nama kelas HARUS "Home_find_us" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen lokasi "Find Us":
        // $this->load->model('Home_find_us_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-find-us
        
        // Di sini Anda akan meletakkan logika untuk menampilkan informasi lokasi,
        // seperti alamat, peta, dll.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home Find Us</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_find_us/home_find_us_view'); // Misalnya, file di views/setting_home_find_us/home_find_us_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit()
    // {
    //     // Logika untuk mengedit informasi lokasi
    //     echo "<h1>Halaman Edit Home Find Us</h1>";
    // }
}

/* End of file Home_find_us.php */
/* Location: ./application/controllers/setting_home_find_us/Home_find_us.php */