<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jadwal_m extends CI_Model
{
    function tampil_kegiatan($user)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $this->db->where('user', $user);
        $this->db->where('status', 0);
        $this->db->where('tanggal', $tanggal);
        return $this->db->get('generate_jadwal')->result();
    }

    function tampil_kegiatan_selesai($user)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $this->db->where('user', $user);
        $this->db->where('status', 1);
        $this->db->where('tanggal', $tanggal);
        return $this->db->get('generate_jadwal')->result();
    }



    function generate_jadwal($user)
    {
        $this->db->where('user', $user);
        return $this->db->get('referensi_kegiatan')->result();
    }

    function cek_jadwal($user)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('generate_jadwal');
        $this->db->join('referensi_kegiatan', 'generate_jadwal.id_kegiatan = referensi_kegiatan.id');
        $this->db->where('generate_jadwal.user', $user);
        $this->db->where('tanggal', $tanggal);
        return $this->db->get()->result();
    }

    function cek_kegiatan($id)
    {
        return $this->db->get_where('generate_jadwal', ['id' => $id])->row_array();
    }

    function cek_cp($user)
    {
        return $this->db->get_where('combat_point', ['user' => $user])->row_array();
    }
}
