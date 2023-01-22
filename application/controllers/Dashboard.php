<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_m');
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('email')) {
            $session['users'] = $this->db->get_where('users', array('email' => $this->session->userdata('email')))->row_array();
            $data = [
                'name' => $session['users']['name'],
                'email' => $session['users']['email'],
                'image' => $session['users']['image'],
                'title' => 'Histori Kegiatan',
                'tanggal' => date('Y-m-d')
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('dashboard/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('pesan', '<small><div class="alert alert-danger" role="alert">Silahkan Login Terlebih Dahulu</div></small>');
            return redirect(base_url() . 'auth/');
        }
    }
}
