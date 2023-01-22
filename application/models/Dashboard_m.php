<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_m extends CI_Model
{
    function tampil_data($tanggal, $user)
    {
        $ref = strtotime('2023-01-15') - strtotime('2023-01-01');
        $tgl = strtotime($tanggal) + $ref;

        $this->db->where('tanggal >', $tanggal);
        $this->db->where('tanggal <=', date('Y-m-d', $tgl));
        $this->db->where('user', $user);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('generate_jadwal')->result();
    }
}
