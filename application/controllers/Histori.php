<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Histori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Histori_m');
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
            $this->load->view('histori/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('pesan', '<small><div class="alert alert-danger" role="alert">Silahkan Login Terlebih Dahulu</div></small>');
            return redirect(base_url() . 'auth/');
        }
    }

    public function data_table()
    {
        $tanggal = $this->input->post('tanggal');
        $user = $this->input->post('user');

        $query = $this->Histori_m->tampil_data($tanggal, $user);
        $cek = $this->db->affected_rows($query) > 0;
        $i = 1;
        foreach ($query as $row) {
            if ($cek) {
                if ($row->status == 1) {
                    $status = '<span class="badge badge-success">Terlaksana</span>';
                } else {
                    $status = '<span class="badge badge-danger">Tidak Terlaksana</span>';
                }
                echo '
                    <tr>
                        <td>' . $i++ . '</td>
                        <td>' . $row->nama_kegiatan . '</td>
                        <td>' . tanggal_hari($row->tanggal, true) . '</td>
                        <td>' . $status . '</td>
                    </tr>
                ';
            }
        }
    }

    public function delete_data()
    {
        $id = $this->input->post("id");
        $tanggal = $this->input->post("tanggal");
        $tanggal2 = $this->input->post("tanggal2");
        $user = $this->input->post("user");

        $this->db->where('id', $id);
        $this->db->delete('generate_jadwal');
        // $i = 1;
        // $next_agenda = $this->Histori_m->tampil_data_next($tanggal, $user);
        // foreach ($next_agenda as $row) {
        //     echo '
        //         <tr>
        //             <td>' . $i . '</td>
        //             <td>' . $row->nama_kegiatan . '</td>
        //             <td>
        //                 ' . $row->tanggal . '
        //                 <input type="hidden" value="' . $row->id . '" id="id' . $i . '">
        //                 <input type="hidden" value="' . $tanggal . '" id="tanggal' . $i . '">
        //                 <input type="hidden" value="' . $row->tanggal . '" id="tanggal_n' . $i . '">
        //                 <input type="hidden" value="' . $user . '" id="user' . $i . '">
        //             </td>
        //             <td class="text-center"><button type="button" class="border-0 bg-transparent" id="delete' . $i++ . '"><i class="fa fa-trash text-danger"></button></td>
        //         </tr>
        //         ';
        // }
    }

    public function edit_kegiatan()
    {
        $id = $this->input->post('id', TRUE);
        $nama_kegiatan = htmlspecialchars($this->input->post('nama_kegiatan', TRUE));
        $tanggal = htmlspecialchars($this->input->post('tanggal', TRUE));
        $tingkat = htmlspecialchars($this->input->post('tingkat', TRUE));

        $data = [
            'nama_kegiatan' => $nama_kegiatan,
            'tanggal' => $tanggal,
            'tingkat' => $tingkat,
        ];

        $this->db->where('id', $id);
        $this->db->update('referensi_kegiatan', $data);

        $this->session->set_flashdata('Pesan', 'Di Ubah');
        return redirect(base_url() . 'generate');
    }
}
