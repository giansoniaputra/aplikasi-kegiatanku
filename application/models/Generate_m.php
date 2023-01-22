<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generate_m extends CI_Model
{
    function tampil_data($user)
    {
        $this->db->where('user', $user);
        return $this->db->get('referensi_kegiatan')->result();
    }
}
