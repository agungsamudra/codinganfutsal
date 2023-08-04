<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('home');
        }
        $this->load->helper('form');
        $this->load->view('login');
    }

    public function cek()
    {
        $this->load->library('form_validation');
        $this->load->model('pengguna_model');

        $this->form_validation->set_rules('username', 'Username', 'required', array('required' => "Isi dulu %s",));
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => "Isi dulu %s",));

        if ($this->form_validation->run()) {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $query = $this->pengguna_model->get_by_username($username);
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                if (password_verify($password, $result['password'])) {
                    $session_data = array(
                        'id_pengguna' => $result['id_pengguna'],
                        'username' => $result['username'],
                        'level' => $result['level'],
                        'logged_in' => TRUE,
                    );
                    $this->session->set_userdata($session_data);
                    redirect('home');
                } else {
                    $this->session->set_flashdata('error', '<div class="alert bg-danger" role="alert">Username dan Password salah</div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert bg-danger" role="alert">Username dan Password salah</div>');
                redirect('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function password()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password Lama', 'trim|required|callback_cek_password_lama', array('required' => 'Isi dulu %s',));
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'trim|required', array('required' => 'Isi dulu %s',));
        $this->form_validation->set_rules('ulangi', 'Ulangi Password Baru', 'trim|required|matches[password_baru]', array('required' => 'Isi dulu %s', 'matches' => '%s tidak sama',));

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('password');
        } else {
            $password_baru = $this->input->post('ulangi', TRUE);
            $params = array(
                'password' => password_hash($password_baru, PASSWORD_DEFAULT),
            );

            $this->load->model('pengguna_model');
            $this->pengguna_model->update_pengguna($this->session->userdata('id_pengguna'), $params);

            $this->session->set_flashdata('success', '<div class="alert bg-success" role="alert">Password berhasil diubah</div>');
            redirect('password');
        }
    }

    public function cek_password_lama($password = '')
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        if ($password != '') {
            $this->load->model('pengguna_model');
            $query = $this->pengguna_model->get_pengguna($this->session->userdata('id_pengguna'));
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                if (password_verify($password, $result['password'])) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('cek_password_lama', '{field} anda salah');
                    return FALSE;
                }
            }
        }
    }
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
