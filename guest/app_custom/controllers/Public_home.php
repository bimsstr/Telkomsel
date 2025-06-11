<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_home extends CI_Controller { // <-- Penting: extend CI_Controller, BUKAN AdminController

    public function index()
    {
        // Ini adalah tempat Anda akan memuat view untuk halaman utama publik Anda
        // Pastikan Anda memiliki file view ini, misalnya di:
        // public_html/guest/app_custom/views/public_home_view.php
        $this->load->view('Dashboard'); // Ganti 'public_home_view' dengan nama view yang benar
    }
}