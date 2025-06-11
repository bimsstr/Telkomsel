<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator_sales extends CI_Controller { // Nama kelas HARUS "Administrator_sales" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Misalnya, jika ada model untuk manajemen sales administrator:
        // $this->load->model('Administrator_sales_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/setting-administrator-sales
        
        // Di sini Anda akan meletakkan logika untuk menampilkan daftar sales administrator,
        // form penambahan sales administrator, dll.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Setting Administrator Sales</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('setting_administrator_sales/administrator_sales_list_view'); // Misalnya, file di views/setting_administrator_sales/administrator_sales_list_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function add()
    // {
    //     // Logika untuk menambahkan sales administrator baru
    //     echo "<h1>Halaman Tambah Administrator Sales</h1>";
    // }

    // public function edit($id)
    // {
    //     // Logika untuk mengedit sales administrator dengan ID tertentu
    //     echo "<h1>Mengedit Administrator Sales ID: " . $id . "</h1>";
    // }
}

/* End of file Administrator_sales.php */
/* Location: ./application/controllers/setting_administrator_sales/Administrator_sales.php */