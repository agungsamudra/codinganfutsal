<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('pengguna_model');
    }

    public function index()
    {
        $data['pengguna'] = $this->pengguna_model->get_all_pengguna()->result_array();
        $this->load->view('pengguna/data', $data);
    }

    public function tambah()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[pengguna.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', 'Isi dulu %s');
        $this->form_validation->set_message('is_unique', '%s sudah digunakan');

        if ($this->form_validation->run()) {
            $params = array(
                'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                'username' => $this->input->post('username', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
                'level' => $this->input->post('level', TRUE),
            );
            $this->pengguna_model->add_pengguna($params);

            $this->session->set_flashdata('success', '<div class="alert bg-success" role="alert">Data berhasil disimpan</div>');
            redirect('pengguna/tambah');
        } else {
            $this->load->view('pengguna/tambah');
        }
    }

    public function ubah($id_pengguna = '')
    {
        $data['pengguna'] = $this->pengguna_model->get_pengguna($id_pengguna)->row_array();

        if (isset($data['pengguna']['id_pengguna'])) {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
            if ($data['pengguna']['username'] == $this->input->post('username', TRUE)) {
                $this->form_validation->set_rules('username', 'Username', 'required');
            } else {
                $this->form_validation->set_rules('username', 'Username', 'required|is_unique[pengguna.username]');
            }
            $this->form_validation->set_rules('level', 'Level', 'required');

            $this->form_validation->set_message('required', 'Isi dulu %s');
            $this->form_validation->set_message('is_unique', '%s sudah digunakan');

            if ($this->form_validation->run()) {
                $params = array(
                    'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'level' => $this->input->post('level', TRUE),
                );
                $this->pengguna_model->update_pengguna($id_pengguna, $params);

                $this->session->set_flashdata('success', '<div class="alert bg-success" role="alert">Data berhasil disimpan</div>');
                redirect('pengguna/ubah/' . $id_pengguna);
            } else {
                $this->load->view('pengguna/ubah', $data);
            }
        } else {
            redirect('pengguna');
        }
    }

    public function hapus($id_pengguna = '')
    {
        $pengguna = $this->pengguna_model->get_pengguna($id_pengguna);

        if ($pengguna->num_rows() > 0) {
            $this->pengguna_model->delete_pengguna($id_pengguna);
        }
        redirect('pengguna');
    }
}


/* End of file Pengguna.php */
/* Location: ./application/controllers/Pengguna.php */