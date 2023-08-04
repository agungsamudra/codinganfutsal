<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Jadwal_model extends CI_Model
{
    public function get_all_jadwal($id_lapangan = '')
    {
        $this->db->where('jadwal.id_lapangan', $id_lapangan);
        $this->db->join('lapangan', 'lapangan.id_lapangan=jadwal.id_lapangan', 'left');
        return $this->db->get('jadwal');
    }

    public function get_jadwal($id_jadwal)
    {
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->join('lapangan', 'lapangan.id_lapangan=jadwal.id_lapangan', 'left');
        return $this->db->get('jadwal');
    }

    public function add_jadwal($params)
    {
        return $this->db->insert('jadwal', $params);
    }

    public function update_jadwal($id_jadwal, $params)
    {
        $this->db->where('id_jadwal', $id_jadwal);
        return $this->db->update('jadwal', $params);
    }

    public function delete_jadwal($id_jadwal)
    {
        $this->db->where('id_jadwal', $id_jadwal);
        return $this->db->delete('jadwal');
    }
}

/* End of file Jadwal_model.php */
/* Location: ./application/models/Jadwal_model.php */