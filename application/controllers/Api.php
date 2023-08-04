<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pemesan_model');
        $this->load->model('lapangan_model');
        $this->load->model('pemesanan_model');
        $this->load->model('rating_model');
        $this->load->model('jadwal_model');

        date_default_timezone_set("Asia/Jakarta");
    }

    public function ulasan_get()
    {
        $id = $this->get('id');

        $rating = $this->rating_model->get_ulasan($id)->result_array();
        if ($rating) {
            $this->response([
                'status' => true,
                'data' => $rating,
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Belum ada ulasan'
            ], 200);
        }
    }

    public function rating_post()
    {
        $params = array(
            'id_lapangan' => $this->post('id_lapangan'),
            'id_pemesan' => $this->post('id_pemesan'),
            'tanggal' => date('Y-m-d'),
            'rating' => $this->post('rating'),
            'ulasan' => $this->post('ulasan'),
        );
        $this->rating_model->add_rating($params);

        $params = array(
            'ulasan' => 1,
        );
        $this->pemesanan_model->update_pemesanan($this->post('id_pemesanan'), $params);

        $this->response([
            'status' => true,
            'message' => 'Rating dan ulasan berhasil dikirim'
        ], 200);
    }

    public function dp_post()
    {
        $target = "assets/images/dp/" . rand() . "_" . time() . ".jpeg";
        $file = $this->post('file');

        if (file_put_contents($target, base64_decode($file))) {
            $params = array(
                'dp' => $this->post('dp'),
                'file' => $target,
            );
            $this->pemesanan_model->update_pemesanan($this->post('id_pemesanan'), $params);

            $this->response([
                'status' => true,
                'message' => 'Bukti transfer berhasil dikirim'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Bukti transfer gagal dikirim'
            ], 200);
        }
    }

    public function lapangan_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $lapangan = $this->lapangan_model->get_all_lapangan()->result_array();
            if ($lapangan) {
                $this->response([
                    'status' => true,
                    'data' => $lapangan,
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Tidak ada lapangan'
                ], 200);
            }
        } else {
            $lapangan = $this->lapangan_model->get_lapangan($id)->row_array();
            $rating = $this->rating_model->get_rating($id)->row_array();
            $jadwal = $this->jadwal_model->get_all_jadwal($id)->result_array();
            if ($lapangan) {
                $this->response([
                    'status' => true,
                    'data' => $lapangan,
                    'rating' => empty($rating) ? 0 : floatval($rating['rating']),
                    'jadwal' => $jadwal,
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Tidak ada lapangan'
                ], 200);
            }
        }
    }

    public function jadwal_get()
    {
        $id_lapangan = $this->get('id');
        $tanggal = $this->get('tanggal');
        $tgl = explode('-', $tanggal);
        $tanggal = implode('-', array_reverse($tgl));

        $jadwal = $this->jadwal_model->get_all_jadwal($id_lapangan)->result_array();
        $pemesanan = $this->pemesanan_model->get_all_pemesanan_jadwal($tanggal, $id_lapangan)->result_array();

        if ($jadwal) {
            $this->response([
                'status' => true,
                'jadwal' => $jadwal,
                'pemesanan' => $pemesanan,
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada jadwal lapangan'
            ], 200);
        }
    }

    public function terlaris_get()
    {
        $lapangan = $this->lapangan_model->get_lapangan_terlaris()->result_array();
        $lapangan2 = $this->lapangan_model->get_all_lapangan()->result_array();
        if ($lapangan) {
            $this->response([
                'status' => true,
                'data_best' => $lapangan,
                'data_new' => $lapangan2,
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada lapangan'
            ], 200);
        }
    }

    public function pemesan_post()
    {
        $result = $this->pemesan_model->get_by_email($this->post('email'));
        if ($result->num_rows() > 0) {
            $this->response([
                'status' => false,
                'message' => 'Email sudah digunakan'
            ], 200);
        } else {
            $params = array(
                'nama_pemesan' => $this->post('nama_pemesan'),
                'alamat' => $this->post('alamat'),
                'no_hp' => $this->post('no_hp'),
                'email' => $this->post('email'),
                'password' => password_hash($this->post('password'), PASSWORD_DEFAULT),
            );
            $this->pemesan_model->add_pemesan($params);

            $this->response([
                'status' => true,
                'message' => 'Registrasi berhasil'
            ], 200);
        }
    }

    public function akun_post()
    {
        $result = $this->pemesan_model->cek_unik_email_lama($this->post('email'), $this->post('email_lama'));
        if ($result->num_rows() > 0) {
            $this->response([
                'status' => false,
                'message' => 'Email sudah digunakan'
            ], 200);
        } else {
            if (empty($this->post('password'))) {
                $params = array(
                    'nama_pemesan' => $this->post('nama_pemesan'),
                    'alamat' => $this->post('alamat'),
                    'no_hp' => $this->post('no_hp'),
                    'email' => $this->post('email'),
                );
            } else {
                $params = array(
                    'nama_pemesan' => $this->post('nama_pemesan'),
                    'alamat' => $this->post('alamat'),
                    'no_hp' => $this->post('no_hp'),
                    'email' => $this->post('email'),
                    'password' => password_hash($this->post('password'), PASSWORD_DEFAULT),
                );
            }
            $this->pemesan_model->update_pemesan($this->post('id_pemesan'), $params);

            $this->response([
                'status' => true,
                'message' => 'Profil berhasil diubah'
            ], 200);
        }
    }

    public function pemesan_get()
    {
        $id = $this->get('id');

        $pemesan = $this->pemesan_model->get_pemesan($id)->row_array();
        if ($pemesan) {
            $this->response([
                'status' => true,
                'data' => $pemesan,
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada data pemesan'
            ], 200);
        }
    }

    public function login_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');

        $query = $this->pemesan_model->get_by_email($email);

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            if (password_verify($password, $result['password'])) {
                $this->response([
                    'status' => true,
                    'data' => $result,
                    'message' => 'Login berhasil'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Username atau password salah'
                ], 200);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'User tidak terdaftar'
            ], 200);
        }
    }

    public function pemesanan_post()
    {
        $kode_pemesanan = date('YmdHis');
        $tanggal = date('Y-m-d');

        $tgl_booking = $this->post('tgl_booking');
        $tgl = explode('-', $tgl_booking);
        $tgl_booking = implode('-', array_reverse($tgl));

        $params = array(
            'kode_pemesanan' => $kode_pemesanan,
            'tanggal' => $tanggal,
            'id_pemesan' => $this->post('id_pemesan'),
            'id_lapangan' => $this->post('id_lapangan'),
            'tgl_booking' => $tgl_booking,
            'jam_booking' => $this->post('jam_booking'),
            'total' => $this->post('total'),
        );
        $id_pemesanan = $this->pemesanan_model->add_pemesanan($params);

        $params3 = array(
            'nama_pemesan' => $this->post('nama_pemesan'),
            'alamat' => $this->post('alamat'),
            'no_hp' => $this->post('no_hp'),
        );
        $this->pemesan_model->update_pemesan($this->post('id_pemesan'), $params3);
        $pemesan = $this->pemesan_model->get_pemesan($this->post('id_pemesan'))->row_array();

        $this->response([
            'status' => true,
            'id_pemesanan' => $id_pemesanan,
            'pemesan' => $pemesan,
            'message' => 'Data pemesanan berhasil dikirim',
        ], 200);
    }

    public function pemesanan_get()
    {
        $id_pemesan = $this->get('id');
        $pemesanan = $this->pemesanan_model->get_pemesanan($id_pemesan)->result_array();
        if ($pemesanan) {
            $this->response([
                'status' => true,
                'data' => $pemesanan,
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada pemesanan'
            ], 200);
        }
    }

    public function pemesanandetail_get()
    {
        $id_pemesanan = $this->get('id');
        $pemesanan_detail = $this->pemesanan_model->get_all_pemesanan_by_id($id_pemesanan)->row_array();
        if ($pemesanan_detail) {
            $this->response([
                'status' => true,
                'data' => $pemesanan_detail,
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Tidak ada detail pemesanan'
            ], 200);
        }
    }

    public function search_get()
    {
        $kata_kunci = $this->get('kata_kunci');
        $result = $this->lapangan_model->search_lapangan($kata_kunci)->result_array();

        if ($result) {
            $this->response([
                'status' => true,
                'data' => $result
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Lapangan tidak ditemukan'
            ], 200);
        }
    }
}


/* End of file Api.php */
/* Location: ./application/controllers/Api.php */