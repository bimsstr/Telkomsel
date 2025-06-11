<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller { // Nama kelas HARUS "Message" sesuai dengan nama file

    public function __construct()
    {
        parent::__construct();
        // Anda mungkin perlu memuat model, helper, atau library di sini
        // Jika ada model untuk pesan, bisa dimuat di sini:
        // $this->load->model('Message_model');
    }

    public function index()
    {
        // Ini adalah method default yang akan dipanggil ketika Anda mengakses
        // indihomefiberjogja.com/guest/message
        
        // Di sini Anda akan meletakkan logika untuk menampilkan daftar pesan,
        // atau form pengiriman pesan, dll.

        // Untuk tujuan pengujian awal, kita akan tampilkan pesan sederhana:
        echo "<h1>Ini halaman Message</h1>";

        // Jika Anda memiliki view file, Anda akan memuatnya di sini:
        // $this->load->view('message/message_list_view'); // Misalnya, file di views/message/message_list_view.php
    }

    // Anda bisa menambahkan method lain di sini sesuai kebutuhan, misalnya:
    // public function send()
    // {
    //     // Logika untuk mengirim pesan
    //     echo "<h1>Halaman Kirim Pesan</h1>";
    // }

    // public function view($id)
    // {
    //     // Logika untuk melihat detail pesan dengan ID tertentu
    //     echo "<h1>Melihat Pesan ID: " . $id . "</h1>";
    // }
}

/* End of file Message.php */
/* Location: ./application/controllers/message/Message.php */