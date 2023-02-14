<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Generate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Generate_m');
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
                'title' => 'Question',
                'tanggal' => date('Y-m-d')
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('generate/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('pesan', '<small><div class="alert alert-danger" role="alert">Silahkan Login Terlebih Dahulu</div></small>');
            return redirect(base_url() . 'auth/');
        }
    }

    public function tambah_kegiatan()
    {
        $nama_kegiatan = htmlspecialchars($this->input->post('nama_kegiatan', TRUE));
        $tingkat = htmlspecialchars($this->input->post('tingkat', TRUE));
        $user = htmlspecialchars($this->input->post('user', TRUE));
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');

        $data = [
            'nama_kegiatan' => $nama_kegiatan,
            'tingkat' => $tingkat,
            'user' =>  $user
        ];
        $this->db->insert('referensi_kegiatan', $data);

        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('referensi_kegiatan')->row();
        $data2 = [
            'id_kegiatan' => $query->id,
            'nama_kegiatan' => $nama_kegiatan,
            'tanggal' => $tanggal,
            'tingkat' => $tingkat,
            'status' => 0,
            'user' =>  $user
        ];

        $this->db->insert('generate_jadwal', $data2);


        $this->session->set_flashdata('Pesan', 'Ditambahkan');
        return redirect(base_url() . 'generate');
    }

    public function edit_kegiatan()
    {
        $id = htmlspecialchars($this->input->post('id', TRUE));
        $nama_kegiatan = htmlspecialchars($this->input->post('nama_kegiatan', TRUE));
        $tingkat = htmlspecialchars($this->input->post('tingkat', TRUE));
        $user = htmlspecialchars($this->input->post('user', TRUE));

        $data = [
            'nama_kegiatan' => $nama_kegiatan,
            'tingkat' => $tingkat,
        ];

        $this->db->where('id', $id);
        $this->db->update('referensi_kegiatan', $data);


        $data2 = [
            'nama_kegiatan' => $nama_kegiatan,
            'tingkat' => $tingkat,
        ];

        $this->db->where('id_kegiatan', $id);
        $this->db->update('generate_jadwal', $data2);

        $this->session->set_flashdata('Pesan', 'Di Ubah');
        return redirect(base_url() . 'generate');
    }

    public function hapus_kegiatan()
    {
        $id = $this->input->get('id');


        $this->db->where('id', $id);
        $this->db->delete('referensi_kegiatan');

        $this->db->where('id_kegiatan', $id);
        $this->db->delete('generate_jadwal');
        $this->session->set_flashdata('Pesan', 'Di Hapus');
        return redirect(base_url() . 'generate');
    }
}
