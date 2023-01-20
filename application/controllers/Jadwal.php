<?php

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_m');
        $this->load->library('session');
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'title' => 'Kegiatan Hari Ini',
            'tanggal' => date('Y-m-d')
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('jadwal/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function update()
    {
        $id = $this->input->post('id');

        $data = [
            'status' => 1
        ];
        $this->db->where('id', $id);
        $this->db->update('generate_jadwal', $data);
        $this->session->set_flashdata('pesan', 'Selesai');
    }

    public function back_update()
    {
        $id = $this->input->post('id');

        $data = [
            'status' => 0
        ];
        $this->db->where('id', $id);
        $this->db->update('generate_jadwal', $data);
    }

    public function tambah_kegiatan()
    {
        $nama_kegiatan = $this->input->post('nama_kegiatan', TRUE);
        $tanggal = $this->input->post('tanggal', TRUE);
        $tingkat = $this->input->post('tingkat', TRUE);

        $data = [
            'nama_kegiatan' => $nama_kegiatan,
            'tanggal' => $tanggal,
            'tingkat' => $tingkat,
            'status' => 0
        ];

        $this->db->insert('generate_jadwal', $data);

        $this->session->set_flashdata('Pesan', 'Ditambahkan');
        return redirect(base_url() . 'jadwal');
    }
}
