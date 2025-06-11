<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends CI_Controller { // Nama kelas HARUS "Administrator" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen administrator:
        // $this->load->model('Administrator_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-administrator
        
        // Di sini Anda akan meletakkan logika untuk menampilkan daftar administrator,
        // form penambahan administrator, dll.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Setting Administrator</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_administrator/administrator_list_view'); // Misalnya, file di views/setting_administrator/administrator_list_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function add()
    // {
    //     // Logika untuk menambahkan administrator baru
    //     echo "<h1>Halaman Tambah Administrator</h1>";
    // }

    // public function edit($id)
    // {
    //     // Logika untuk mengedit administrator dengan ID tertentu
    //     echo "<h1>Mengedit Administrator ID: " . $id . "</h1>";
    // }
}

/* End of file Administrator.php */
/* Location: ./application/controllers/setting_administrator/Administrator.php */