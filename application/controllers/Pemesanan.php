<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pemesanan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('pemesanan_model');
    }

    public function index()
    {
        $data['pemesanan'] = $this->pemesanan_model->get_all_pemesanan()->result_array();
        $this->load->view('pemesanan/data', $data);
    }

    public function hapus($id_pemesanan = '')
    {
        $pemesanan = $this->pemesanan_model->get_all_pemesanan_by_id($id_pemesanan);

        if ($pemesanan->num_rows() > 0) {
            $this->pemesanan_model->delete_pemesanan($id_pemesanan);
        }
        redirect('pemesanan');
    }

    public function ubah($id_pemesanan = '')
    {
        $data['pemesanan'] = $this->pemesanan_model->get_by_id($id_pemesanan)->row_array();

        if (isset($data['pemesanan']['id_pemesanan'])) {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_message('required', 'Isi dulu %s');

            if ($this->form_validation->run()) {
                $params = array(
                    'status' => $this->input->post('status', TRUE),
                );
                $this->pemesanan_model->update_pemesanan($id_pemesanan, $params);

                redirect('pemesanan');
            } else {
                $this->load->view('pemesanan/ubah', $data);
            }
        } else {
            redirect('pemesanan');
        }
    }
}


/* End of file Pemesanan.php */
/* Location: ./application/controllers/Pemesanan.php */