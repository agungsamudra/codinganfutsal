<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('lapangan_model');
        $this->load->model('jadwal_model');
    }

    public function index($id_lapangan)
    {
        $data['jadwal'] = $this->jadwal_model->get_all_jadwal($id_lapangan)->result_array();
        $data['lapangan'] = $this->lapangan_model->get_lapangan($id_lapangan)->row_array();
        $this->load->view('jadwal/data', $data);
    }

    public function tambah($id_lapangan)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('jam', 'Jam', 'required');

        $this->form_validation->set_message('required', 'Isi dulu %s');

        if ($this->form_validation->run()) {
            $params = array(
                'id_lapangan' => $id_lapangan,
                'jam' => $this->input->post('jam', TRUE),
            );
            $this->jadwal_model->add_jadwal($params);

            $this->session->set_flashdata('success', '<div class="alert bg-success" role="alert">Data berhasil disimpan</div>');
            redirect('jadwal/tambah/' . $id_lapangan);
        } else {
            $data['id_lapangan'] = $id_lapangan;
            $this->load->view('jadwal/tambah', $data);
        }
    }

    public function ubah($id_lapangan, $id_jadwal = '')
    {
        $data['jadwal'] = $this->jadwal_model->get_jadwal($id_jadwal)->row_array();
        $data['id_lapangan'] = $id_lapangan;

        if (isset($data['jadwal']['id_jadwal'])) {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('jam', 'Jam', 'required');

            $this->form_validation->set_message('required', 'Isi dulu %s');

            if ($this->form_validation->run()) {
                $params = array(
                    'jam' => $this->input->post('jam', TRUE),
                );
                $this->jadwal_model->update_jadwal($id_jadwal, $params);

                $this->session->set_flashdata('success', '<div class="alert bg-success" role="alert">Data berhasil disimpan</div>');
                redirect('jadwal/ubah/' . $id_lapangan . '/' . $id_jadwal);
            } else {
                $this->load->view('jadwal/ubah', $data);
            }
        } else {
            redirect('jadwal/' . $id_lapangan);
        }
    }

    public function hapus($id_lapangan, $id_jadwal = '')
    {
        $jadwal = $this->jadwal_model->get_jadwal($id_jadwal);

        if ($jadwal->num_rows() > 0) {
            $this->jadwal_model->delete_jadwal($id_jadwal);
        }
        redirect('jadwal/' . $id_lapangan);
    }
}


/* End of file Jadwal.php */
/* Location: ./application/controllers/Jadwal.php */