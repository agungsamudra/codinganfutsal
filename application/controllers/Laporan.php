<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Laporan extends CI_Controller
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
        $this->load->helper('form');
        $this->load->view('laporan/index');
    }

    public function lihat($tgl1, $tgl2)
    {
        $data['pemesanan'] = $this->pemesanan_model->get_all_pemesanan_by_tgl($tgl1, $tgl2)->result_array();
        $data['tgl1'] = $tgl1;
        $data['tgl2'] = $tgl2;
        $this->load->view('laporan/lihat', $data);
    }

    public function pdf($tgl1 = '', $tgl2 = '')
    {
        $data['pemesanan'] = $this->pemesanan_model->get_all_pemesanan_by_tgl($tgl1, $tgl2)->result_array();
        $data['tgl1'] = $tgl1;
        $data['tgl2'] = $tgl2;
        $html = $this->load->view('laporan/cetak', $data, TRUE);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("laporan-pemesanan.pdf", array("Attachment" => FALSE));
    }
}


/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */