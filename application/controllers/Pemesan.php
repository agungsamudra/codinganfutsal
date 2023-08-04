<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pemesan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('pemesan_model');
    }

    public function index()
    {
        $data['pemesan'] = $this->pemesan_model->get_all_pemesan('desc')->result_array();
        $this->load->view('pemesan/data', $data);
    }

    public function hapus($id_pemesan = '')
    {
        $pemesan = $this->pemesan_model->get_pemesan($id_pemesan);

        if ($pemesan->num_rows() > 0) {
            $this->pemesan_model->delete_pemesan($id_pemesan);
        }
        redirect('pemesan');
    }
}


/* End of file Pemesan.php */
/* Location: ./application/controllers/Pemesan.php */