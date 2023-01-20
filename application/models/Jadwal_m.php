<?php

class Jadwal_m extends CI_Model
{
    function tampil_kegiatan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $this->db->where('status', 0);
        $this->db->where('tanggal', $tanggal);
        return $this->db->get('generate_jadwal')->result();
    }

    function tampil_kegiatan_selesai()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $this->db->where('status', 1);
        $this->db->where('tanggal', $tanggal);
        return $this->db->get('generate_jadwal')->result();
    }
}
