<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lapangan extends CI_Controller
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

    public function index()
    {
        $data['lapangan'] = $this->lapangan_model->get_all_lapangan('asc')->result_array();
        $this->load->view('lapangan/data', $data);
    }

    public function detail($id_lapangan = '')
    {
        $data['lapangan'] = $this->lapangan_model->get_lapangan($id_lapangan)->row_array();
        $data['jadwal'] = $this->jadwal_model->get_all_jadwal($id_lapangan)->result_array();
        $this->load->view('lapangan/detail', $data);
    }

    public function tambah()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_lapangan', 'Nama Lapangan', 'required');
        $this->form_validation->set_rules('harga_sewa', 'Harga Sewa', 'required|numeric');
        $this->form_validation->set_rules('foto', 'Foto', 'callback_validasi_file');

        $this->form_validation->set_message('required', 'Isi dulu %s');
        $this->form_validation->set_message('numeric', '%s harus angka');

        if ($this->form_validation->run()) {
            $upload = $this->upload->data();
            $file_name = $upload['file_name'];
            $params = array(
                'nama_lapangan' => $this->input->post('nama_lapangan', TRUE),
                'harga_sewa' => $this->input->post('harga_sewa', TRUE),
                'kontak' => $this->input->post('kontak', TRUE),
                'foto' => $file_name,
            );
            $this->lapangan_model->add_lapangan($params);

            $this->session->set_flashdata('success', '<div class="alert bg-success" role="alert">Data berhasil disimpan</div>');
            redirect('lapangan/tambah');
        } else {
            $this->load->view('lapangan/tambah');
        }
    }

    public function ubah($id_lapangan = '')
    {
        $data['lapangan'] = $this->lapangan_model->get_lapangan($id_lapangan)->row_array();

        if (isset($data['lapangan']['id_lapangan'])) {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('nama_lapangan', 'Nama Lapangan', 'required');
            $this->form_validation->set_rules('harga_sewa', 'Harga Sewa', 'required|numeric');
            $foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : "";
            if (!empty($foto)) {
                $this->form_validation->set_rules('foto', 'Foto', 'callback_validasi_file');
            }

            $this->form_validation->set_message('required', 'Isi dulu %s');
            $this->form_validation->set_message('numeric', '%s harus angka');

            if ($this->form_validation->run()) {
                $file_name = $data['lapangan']['foto'];
                if (!empty($foto)) {
                    if (!empty($file_name)) {
                        unlink('./assets/images/lapangan/' . $file_name);
                    }
                    $upload = $this->upload->data();
                    $file_name = $upload['file_name'];
                }
                $params = array(
                    'nama_lapangan' => $this->input->post('nama_lapangan', TRUE),
                    'harga_sewa' => $this->input->post('harga_sewa', TRUE),
                    'kontak' => $this->input->post('kontak', TRUE),
                    'foto' => $file_name,
                );
                $this->lapangan_model->update_lapangan($id_lapangan, $params);

                $this->session->set_flashdata('success', '<div class="alert bg-success" role="alert">Data berhasil disimpan</div>');
                redirect('lapangan/ubah/' . $id_lapangan);
            } else {
                $this->load->view('lapangan/ubah', $data);
            }
        } else {
            redirect('lapangan');
        }
    }

    public function hapus($id_lapangan = '')
    {
        $lapangan = $this->lapangan_model->get_lapangan($id_lapangan);

        if ($lapangan->num_rows() > 0) {
            $result = $lapangan->row_array();
            $file_name = $result['foto'];
            if (!empty($file_name)) {
                unlink('./assets/images/lapangan/' . $file_name);
            }
            $this->lapangan_model->delete_lapangan($id_lapangan);
        }
        redirect('lapangan');
    }

    public function validasi_file()
    {
        $config['upload_path'] = './assets/images/lapangan/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['overwrite'] = FALSE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validasi_file', $this->upload->display_errors());
            return FALSE;
        }
    }
}


/* End of file Lapangan.php */
/* Location: ./application/controllers/Lapangan.php */