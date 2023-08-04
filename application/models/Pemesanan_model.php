<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pemesanan_model extends CI_Model
{

    public function add_pemesanan($params)
    {
        $this->db->insert('pemesanan', $params);
        return $this->db->insert_id();
    }

    public function get_all_pemesanan()
    {
        $this->db->order_by('id_pemesanan', 'desc');
        $this->db->join('pemesan', 'pemesan.id_pemesan=pemesanan.id_pemesan', 'left');
        $this->db->join('lapangan', 'lapangan.id_lapangan=pemesanan.id_lapangan', 'left');
        return $this->db->get('pemesanan');
    }

    public function get_all_pemesanan_jadwal($tanggal, $id_lapangan)
    {
        $this->db->where('id_lapangan', $id_lapangan);
        $this->db->where('tgl_booking', $tanggal);
        $this->db->where('status <>', 'Batal');
        $this->db->order_by('jam_booking', 'asc');
        return $this->db->get('pemesanan');
    }

    public function get_all_pemesanan_by_id($id_pemesanan)
    {
        $this->db->select('pemesan.*,lapangan.*,pemesanan.*,date_format(pemesanan.tanggal, "%d-%m-%Y") as tanggal,date_format(pemesanan.tgl_booking, "%d-%m-%Y") as tgl_booking');
        $this->db->join('pemesan', 'pemesan.id_pemesan=pemesanan.id_pemesan', 'left');
        $this->db->join('lapangan', 'lapangan.id_lapangan=pemesanan.id_lapangan', 'left');
        $this->db->where('id_pemesanan', $id_pemesanan);
        return $this->db->get('pemesanan');
    }

    public function get_pemesanan($id_pemesan)
    {
        $this->db->order_by('id_pemesanan', 'desc');
        $this->db->select('pemesan.*,lapangan.*,pemesanan.*,date_format(pemesanan.tanggal, "%d-%m-%Y") as tanggal,date_format(pemesanan.tgl_booking, "%d-%m-%Y") as tgl_booking');
        $this->db->join('pemesan', 'pemesan.id_pemesan=pemesanan.id_pemesan', 'left');
        $this->db->join('lapangan', 'lapangan.id_lapangan=pemesanan.id_lapangan', 'left');
        $this->db->where('pemesanan.id_pemesan', $id_pemesan);
        return $this->db->get('pemesanan');
    }

    public function delete_pemesanan($id_pemesanan)
    {
        $this->db->where('id_pemesanan', $id_pemesanan);
        return $this->db->delete('pemesanan');
    }

    public function get_all_pemesanan_by_tgl($tgl1, $tgl2)
    {
        $this->db->order_by('id_pemesanan', 'asc');
        $this->db->join('pemesan', 'pemesan.id_pemesan=pemesanan.id_pemesan', 'left');
        $this->db->join('lapangan', 'lapangan.id_lapangan=pemesanan.id_lapangan', 'left');
        $this->db->where('tanggal >=', $tgl1);
        $this->db->where('tanggal <=', $tgl2);
        $this->db->where('status', 'Lunas');
        return $this->db->get('pemesanan');
    }

    public function update_pemesanan($id_pemesanan, $params)
    {
        $this->db->where('id_pemesanan', $id_pemesanan);
        return $this->db->update('pemesanan', $params);
    }

    public function get_by_id($id_pemesanan)
    {
        $this->db->where('id_pemesanan', $id_pemesanan);
        $this->db->join('pemesan', 'pemesan.id_pemesan=pemesanan.id_pemesan', 'left');
        $this->db->join('lapangan', 'lapangan.id_lapangan=pemesanan.id_lapangan', 'left');
        return $this->db->get('pemesanan');
    }
}

/* End of file Pemesanan_model.php */
/* Location: ./application/models/Pemesanan_model.php */