<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_about_detail extends CI_Controller { // Nama kelas HARUS "Home_about_detail" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk detail konten "About":
        // $this->load->model('Home_about_detail_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-about-detail
        
        // Di sini Anda akan meletakkan logika untuk menampilkan detail halaman "About",
        // atau form untuk mengedit detail tersebut.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home About Detail</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_about_detail/home_about_detail_view'); // Misalnya, file di views/setting_home_about_detail/home_about_detail_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit($id)
    // {
    //     // Logika untuk mengedit detail halaman "About" dengan ID tertentu
    //     echo "<h1>Halaman Edit Home About Detail ID: " . $id . "</h1>";
    // }
}

/* End of file Home_about_detail.php */
/* Location: ./application/controllers/setting_home_about_detail/Home_about_detail.php */