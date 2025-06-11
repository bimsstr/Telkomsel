<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_company_profile extends CI_Controller { // Nama kelas HARUS "Home_company_profile" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen profil perusahaan:
        // $this->load->model('Home_company_profile_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-home-company-profile
        
        // Di sini Anda akan meletakkan logika untuk menampilkan halaman profil perusahaan,
        // atau form untuk mengedit konten profil tersebut.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Home Company Profile</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_home_company_profile/home_company_profile_view'); // Misalnya, file di views/setting_home_company_profile/home_company_profile_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function edit()
    // {
    //     // Logika untuk mengedit konten profil perusahaan
    //     echo "<h1>Halaman Edit Home Company Profile</h1>";
    // }
}

/* End of file Home_company_profile.php */
/* Location: ./application/controllers/setting_home_company_profile/Home_company_profile.php */