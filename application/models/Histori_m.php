<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Histori_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function tampil_data($tanggal, $user)
    {
        $this->db->where('tanggal', $tanggal);
        $this->db->where('user', $user);
        return $this->db->get('generate_jadwal')->result();
    }

    function tampil_data_next($tanggal, $user)
    {
        $this->db->where('tanggal >', $tanggal);
        $this->db->where('user', $user);
        return $this->db->get('generate_jadwal')->result();
    }
}
