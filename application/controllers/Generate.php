<?php

class Generate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'title' => 'Generate Kegiatan',
            'tanggal' => date('Y-m-d')
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('generate/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
