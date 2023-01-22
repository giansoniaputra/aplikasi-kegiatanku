<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        if ($this->session->userdata('email')) {
            return redirect(base_url() . 'jadwal/');
        } else {
            $this->rules_login();
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'title' => 'CI3 | Login',
                    'name' => set_value('name'),
                    'email' => set_value('email'),
                ];
                $this->load->view('templates/auth-header', $data);
                $this->load->view('auth/login');
                $this->load->view('templates/auth-footer');
            } else {
                $this->_login();
            }
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $session = [
                        'email' => $user['email'],
                        'image' => $user['image'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($session);
                    redirect('dashboard/');
                } else {
                    $this->session->set_flashdata('pesan', '<small><div class="alert alert-danger" role="alert">Password Tidak Sesuai</div></small>');
                    redirect('auth/');
                }
            } else {
                $this->session->set_flashdata('pesan', '<small><div class="alert alert-danger" role="alert">Email Belum di Aktivasi</div></small>');
                redirect('auth/');
            }
        } else {
            $this->session->set_flashdata('pesan', '<small><div class="alert alert-danger" role="alert">Email Tidak Terdaftar</div></small>');
            redirect('auth/');
        }
    }

    public function register()
    {
        $this->rules_register();
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'CI3 | Registration',
                'name' => set_value('name'),
                'email' => set_value('email'),
            ];
            $this->load->view('templates/auth-header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth-footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('users', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Terdaftar</div>');
            redirect('auth/');
        }
    }

    public function rules_register()
    {
        $this->form_validation->set_rules('name', 'Nama', 'trim|required', ['required' => '%s tidak boleh kosong']);
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[users.email]',
            [
                'required' => '%s tidak boleh kosong',
                'valid_email' => '%s harus berupa email yang Valid',
                'is_unique' => '%s sudah terdaftar'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[6]|matches[password2]',
            [
                'required' => '%s tidak boleh kosong',
                'min_length' => '%s minimal berjumlah 6 karakter',
                'matches' => 'Konfirmasi %s tidak sesuai'
            ]
        );
        $this->form_validation->set_rules(
            'password2',
            'Password',
            'required|trim|matches[password1]',
            [
                'required' => '%s tidak boleh kosong',
                'min_length' => '%s minimal berjumlah 6 karakter',
                'matches' => 'Konfirmasi %s tidak sesuai'
            ]
        );
    }

    public function rules_login()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => '%s tidak boleh kosong',
            'valid_email' => 'Masukan %s yang Valid'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => '%s tidak boleh kosong']);
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kamu Sudah Keluar</div>');
        redirect('auth/');
    }

    // public function do_upload()
    // {
    //     $config['upload_path']          = './uploads/';
    //     $config['allowed_types']        = 'gif|jpg|png';
    //     $config['max_size']             = 100;
    //     $config['max_width']            = 1024;
    //     $config['max_height']           = 768;

    //     $this->load->library('upload', $config);

    //     if (!$this->upload->do_upload('userfile')) {
    //         $error = array('error' => $this->upload->display_errors());

    //         $this->load->view('upload_form', $error);
    //     } else {
    //         $data = array('upload_data' => $this->upload->data());

    //         $this->load->view('upload_success', $data);
    //     }
    // }
}
