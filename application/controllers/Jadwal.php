<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
        if ($this->session->userdata('email')) {
            $session['users'] = $this->db->get_where('users', array('email' => $this->session->userdata('email')))->row_array();
            $data = [
                'name' => $session['users']['name'],
                'email' => $session['users']['email'],
                'image' => $session['users']['image'],
                'title' => 'Question to Day',
                'tanggal' => date('Y-m-d')
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('jadwal/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('pesan', '<small><div class="alert alert-danger" role="alert">Silahkan Login Terlebih Dahulu</div></small>');
            return redirect(base_url() . 'auth/');
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $user = $this->input->post('user');

        $data = [
            'status' => 1
        ];
        $this->db->where('id', $id);
        $this->db->update('generate_jadwal', $data);
        $this->session->set_flashdata('pesan', 'Selesai');

        $cek = $this->Jadwal_m->cek_kegiatan($id);
        $cek_cp = $this->Jadwal_m->cek_cp($user);

        if ($cek["tingkat"] == 1) {
            $data_cp = [
                'quest_point' => $cek_cp["quest_point"] + 100,
            ];
            $this->db->where('user', $user);
            $this->db->update('combat_point', $data_cp);
        } else if ($cek["tingkat"] == 2) {
            $data_cp = [
                'quest_point' => $cek_cp["quest_point"] + 50,
            ];
            $this->db->where('user', $user);
            $this->db->update('combat_point', $data_cp);
        }
    }

    public function back_update()
    {
        $id = $this->input->post('id');
        $user = $this->input->post('user');

        $data = [
            'status' => 0
        ];
        $this->db->where('id', $id);
        $this->db->update('generate_jadwal', $data);

        $cek = $this->Jadwal_m->cek_kegiatan($id);
        $cek_cp = $this->Jadwal_m->cek_cp($user);

        if ($cek["tingkat"] == 1) {
            $data_cp = [
                'quest_point' => $cek_cp["quest_point"] - 100,
            ];
            $this->db->where('user', $user);
            $this->db->update('combat_point', $data_cp);
        } else if ($cek["tingkat"] == 2) {
            $data_cp = [
                'quest_point' => $cek_cp["quest_point"] - 50,
            ];
            $this->db->where('user', $user);
            $this->db->update('combat_point', $data_cp);
        }
    }

    public function tambah_kegiatan()
    {
        $nama_kegiatan = htmlspecialchars($this->input->post('nama_kegiatan', TRUE));
        $tanggal = htmlspecialchars($this->input->post('tanggal', TRUE));
        $tingkat = htmlspecialchars($this->input->post('tingkat', TRUE));
        $user = htmlspecialchars($this->input->post('user', TRUE));

        $data = [
            'id_kegiatan' => 0,
            'nama_kegiatan' => $nama_kegiatan,
            'tanggal' => $tanggal,
            'tingkat' => $tingkat,
            'status' => 0,
            'user' => $user
        ];

        $this->db->insert('generate_jadwal', $data);

        $this->session->set_flashdata('Pesan', 'Ditambahkan');
        return redirect(base_url() . 'jadwal');
    }

    public function generate()
    {
        $user = $this->input->get('user');
        $query = $this->Jadwal_m->generate_jadwal($user);
        $cek = $this->db->affected_rows($query) == 0;
        date_default_timezone_set('Asia/Jakarta');
        if ($cek) {
            $this->session->set_flashdata('Pesan_Error', 'Silahkan Tambahkan Minimal Satu Kegiatan Pada Menu Generate Kegiatan');
            return redirect(base_url() . 'jadwal');
        } else {
            foreach ($query as $row) {
                $data = [
                    'id_kegiatan' => $row->id,
                    'nama_kegiatan' => $row->nama_kegiatan,
                    'tanggal' => date('Y-m-d'),
                    'tingkat' => $row->tingkat,
                    'status' => 0,
                    'user' => $row->user
                ];
                $this->db->insert('generate_jadwal', $data);
            }
            $this->session->set_flashdata('Pesan', 'Di Generate');
            return redirect(base_url() . 'jadwal');
        }
    }
}
