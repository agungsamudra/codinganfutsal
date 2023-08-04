<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pemesan_model extends CI_Model
{

    public function get_all_pemesan($sort = 'asc')
    {
        $this->db->order_by('id_pemesan', $sort);
        return $this->db->get('pemesan');
    }

    public function get_pemesan($id_pemesan)
    {
        $this->db->where('id_pemesan', $id_pemesan);
        return $this->db->get('pemesan');
    }

    public function add_pemesan($params)
    {
        return $this->db->insert('pemesan', $params);
    }

    public function update_pemesan($id_pemesan, $params)
    {
        $this->db->where('id_pemesan', $id_pemesan);
        return $this->db->update('pemesan', $params);
    }

    public function delete_pemesan($id_pemesan)
    {
        $this->db->where('id_pemesan', $id_pemesan);
        return $this->db->delete('pemesan');
    }

    public function cek_unik_email_lama($email, $email_lama)
    {
        $this->db->where('email', $email);
        $this->db->where('email <>', $email_lama);
        return $this->db->get('pemesan');
    }

    public function get_by_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('pemesan');
    }
}

/* End of file Pemesan_model.php */
/* Location: ./application/models/Pemesan_model.php */