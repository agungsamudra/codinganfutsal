<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Lapangan_model extends CI_Model
{
    public function get_all_lapangan($sort = 'asc')
    {
        $this->db->order_by('id_lapangan', $sort);
        return $this->db->get('lapangan');
    }

    public function get_lapangan_terlaris()
    {
        $this->db->order_by('jml_tersewa', 'desc');
        $this->db->limit(2);
        return $this->db->get('lapangan');
    }

    public function get_lapangan($id_lapangan)
    {
        $this->db->where('id_lapangan', $id_lapangan);
        return $this->db->get('lapangan');
    }

    public function search_lapangan($kata_kunci = '')
    {
        if (!empty($kata_kunci)) {
            $this->db->like('nama_lapangan', $kata_kunci);
        }
        return $this->db->get('lapangan');
    }

    public function add_lapangan($params)
    {
        return $this->db->insert('lapangan', $params);
    }

    public function update_lapangan($id_lapangan, $params)
    {
        $this->db->where('id_lapangan', $id_lapangan);
        return $this->db->update('lapangan', $params);
    }

    public function delete_lapangan($id_lapangan)
    {
        $this->db->where('id_lapangan', $id_lapangan);
        return $this->db->delete('lapangan');
    }
}

/* End of file Lapangan_model.php */
/* Location: ./application/models/Lapangan_model.php */