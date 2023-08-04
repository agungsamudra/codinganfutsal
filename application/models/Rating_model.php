<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Rating_model extends CI_Model
{

    public function get_rating($id_lapangan)
    {
        $this->db->select_avg('rating');
        $this->db->where('id_lapangan', $id_lapangan);
        return $this->db->get('rating');
    }

    public function get_ulasan($id_lapangan)
    {
        $this->db->select('rating.*,pemesan.*,DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal');
        $this->db->join('pemesan', 'pemesan.id_pemesan=rating.id_pemesan', 'left');
        $this->db->where('id_lapangan', $id_lapangan);
        return $this->db->get('rating');
    }

    public function add_rating($params)
    {
        return $this->db->insert('rating', $params);
    }
}

/* End of file Rating_model.php */
/* Location: ./application/models/Rating_model.php */