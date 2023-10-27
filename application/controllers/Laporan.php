<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        error_reporting(0);
        $data['title'] = "Cetak Laporan Sparepart";

        $this->form_validation->set_rules('transaksi', 'Transaksi', 'required|in_list[barang_masuk,barang_keluar]');
        $this->form_validation->set_rules('tanggal', 'Periode Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            // $this->template->load('templates/dashboard', 'laporan/form', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/laporan/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            $table = $input['transaksi'];
            $tanggal = $input['tanggal'];
            $pecah = explode(' - ', $tanggal);
            $mulai = date('Y-m-d', strtotime($pecah[0]));
            $akhir = date('Y-m-d', strtotime(end($pecah)));

            $query = '';
            if ($table == 'barang_masuk') {
                $query = $this->admin->getBarangMasuk(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            } else {
                $query = $this->admin->getBarangKeluar(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            }

            $this->_cetak($query, $table, $tanggal);
        }
    }

    public function aki()
    {
        error_reporting(0);
        $data['title'] = "Cetak Laporan Transaksi Aki";

        $this->form_validation->set_rules('transaksi', 'Transaksi', 'required|in_list[aki_masuk,aki_keluar]');
        $this->form_validation->set_rules('tanggal', 'Periode Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            // $this->template->load('templates/dashboard', 'laporan/form', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/laporan/lap_aki', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            $table = $input['transaksi'];
            $tanggal = $input['tanggal'];
            $pecah = explode(' - ', $tanggal);
            $mulai = date('Y-m-d', strtotime($pecah[0]));
            $akhir = date('Y-m-d', strtotime(end($pecah)));

            $query = '';
            if ($table == 'aki_masuk') {
                $query = $this->admin->getAkiMasuk(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            } else {
                $query = $this->admin->getAkiKeluar(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            }

            $this->_cetakAki($query, $table, $tanggal);
        }
    }

    public function ban()
    {
        error_reporting(0);
        $data['title'] = "Cetak Laporan Transaksi Ban";

        $this->form_validation->set_rules('transaksi', 'Transaksi', 'required|in_list[ban_masuk,ban_keluar]');
        $this->form_validation->set_rules('tanggal', 'Periode Tanggal', 'required');

        if ($this->form_validation->run() == false) {
            // $this->template->load('templates/dashboard', 'laporan/form', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/laporan/lap_ban', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $input = $this->input->post(null, true);
            $table = $input['transaksi'];
            $tanggal = $input['tanggal'];
            $pecah = explode(' - ', $tanggal);
            $mulai = date('Y-m-d', strtotime($pecah[0]));
            $akhir = date('Y-m-d', strtotime(end($pecah)));

            $query = '';
            if ($table == 'ban_masuk') {
                $query = $this->admin->getBanMasuk(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            } else {
                $query = $this->admin->getBanKeluar(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            }

            $this->_cetakBan($query, $table, $tanggal);
        }
    }

    private function _cetak($data, $table_, $tanggal)
    {
        $this->load->library('CustomPDF');
        $table = $table_ == 'barang_masuk' ? 'Sparepart Masuk' : 'Sparepart Keluar';

        $pdf = new FPDF();
        $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(190, 7, 'Laporan ' . $table, 0, 1, 'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(190, 4, 'Tanggal : ' . $tanggal, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);

        if ($table_ == 'barang_masuk') :
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Tgl Masuk', 1, 0, 'C');
            $pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(55, 7, 'Nama Barang', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Supplier', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Jumlah Masuk', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(25, 7, $d['tanggal_masuk'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['id_barang_masuk'], 1, 0, 'C');
                $pdf->Cell(55, 7, $d['nama_barang'], 1, 0, 'L');
                $pdf->Cell(40, 7, $d['nama_supplier'], 1, 0, 'L');
                $pdf->Cell(30, 7, $d['jumlah_masuk'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Ln();
            }
        else :
            $pdf->Cell(7, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Tgl Keluar', 1, 0, 'C');
            $pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Nama Barang', 1, 0, 'C');
            $pdf->Cell(27, 7, 'Jumlah Keluar', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Supplier', 1, 0, 'C');
            $pdf->Cell(25, 7, 'User', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(7, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(25, 7, $d['tanggal_keluar'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['id_barang_keluar'], 1, 0, 'C');
                $pdf->Cell(40, 7, $d['nama_barang'], 1, 0, 'L');
                $pdf->Cell(27, 7, $d['jumlah_keluar'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Cell(40, 7, $d['nama_supplier'], 1, 0, 'L');
                $pdf->Cell(25, 7, $d['nama'], 1, 0, 'L');
                $pdf->Ln();
            }
        endif;

        $file_name = $table . ' ' . $tanggal;
        $pdf->Output('I', $file_name);
    }

    private function _cetakAki($data, $table_, $tanggal)
    {
        $this->load->library('CustomPDF');
        $table = $table_ == 'aki_masuk' ? 'Aki Masuk' : 'Aki Keluar';

        $pdf = new FPDF();
        $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(190, 7, 'Laporan ' . $table, 0, 1, 'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(190, 4, 'Tanggal : ' . $tanggal, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 8);

        if ($table_ == 'aki_masuk') :
            $pdf->Cell(5, 5, 'No.', 1, 0, 'C');
            $pdf->Cell(16, 5, 'Tgl Masuk', 1, 0, 'C');
            $pdf->Cell(27, 5, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(35, 5, 'Supplier', 1, 0, 'C');
            $pdf->Cell(15, 5, 'Merk Aki', 1, 0, 'C');
            $pdf->Cell(21, 5, 'Jumlah Masuk', 1, 0, 'C');
            $pdf->Cell(12, 5, 'Harga', 1, 0, 'C');
            $pdf->Cell(20, 5, 'Jumlah Harga', 1, 0, 'C');
            $pdf->Cell(15, 5, 'Kondisi', 1, 0, 'C');
            $pdf->Cell(15, 5, 'User', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell(5, 5, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(16, 5, $d['tanggal_masuk'], 1, 0, 'C');
                $pdf->Cell(27, 5, $d['id_aki_masuk'], 1, 0, 'C');
                $pdf->Cell(35, 5, $d['nama_supplier'], 1, 0, 'L');
                $pdf->Cell(15, 5, $d['merk'], 1, 0, 'L');
                $pdf->Cell(21, 5, $d['jumlah_masuk'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Cell(12, 5, $d['harga'], 1, 0, 'L');
                $pdf->Cell(20, 5, $d['total_harga'], 1, 0, 'L');
                $pdf->Cell(15, 5, $d['kondisi'], 1, 0, 'L');
                $pdf->Cell(15, 5, $d['nama'], 1, 0, 'L');
                $pdf->Ln();
            }
        else :
            $pdf->Cell(5, 5, 'No.', 1, 0, 'C');
            $pdf->Cell(20, 5, 'Tgl Keluar', 1, 0, 'C');
            $pdf->Cell(32, 5, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(17, 5, 'Merk', 1, 0, 'C');
            $pdf->Cell(21, 5, 'Nama Supplier', 1, 0, 'C');
            $pdf->Cell(21, 5, 'Jumlah Keluar', 1, 0, 'C');
            $pdf->Cell(12, 5, 'Armada', 1, 0, 'C');
            $pdf->Cell(14, 5, 'Supir', 1, 0, 'C');
            $pdf->Cell(14, 5, 'Montir', 1, 0, 'C');
            $pdf->Cell(20, 5, 'User', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(5, 5, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(20, 5, $d['tanggal_keluar'], 1, 0, 'C');
                $pdf->Cell(32, 5, $d['id_aki_keluar'], 1, 0, 'C');
                $pdf->Cell(17, 5, $d['merk'], 1, 0, 'L');
                $pdf->Cell(21, 5, $d['nama_supplier'], 1, 0, 'L');
                $pdf->Cell(21, 5, $d['jumlah_keluar'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Cell(12, 5, $d['nama_armada'], 1, 0, 'L');
                $pdf->Cell(14, 5, $d['nama_supir'], 1, 0, 'L');
                $pdf->Cell(14, 5, $d['nama_montir'], 1, 0, 'L');
                $pdf->Cell(20, 5, $d['nama'], 1, 0, 'L');
                $pdf->Ln();
            }
        endif;

        $file_name = $table . ' ' . $tanggal;
        $pdf->Output('I', $file_name);
    }
    
    private function _cetakBan($data, $table_, $tanggal)
    {
        $this->load->library('CustomPDF');
        $table = $table_ == 'ban_masuk' ? 'Ban Masuk' : 'Ban Keluar';

        $pdf = new FPDF();
        $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(190, 7, 'Laporan ' . $table, 0, 1, 'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(190, 4, 'Tanggal : ' . $tanggal, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 8);

        if ($table_ == 'ban_masuk') :
            $pdf->Cell(5, 5, 'No.', 1, 0, 'C');
            $pdf->Cell(16, 5, 'Tgl Masuk', 1, 0, 'C');
            $pdf->Cell(27, 5, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(33, 5, 'Supplier', 1, 0, 'C');
            $pdf->Cell(17, 5, 'Merk', 1, 0, 'C');
            $pdf->Cell(22, 5, 'Jumlah Masuk', 1, 0, 'C');
            $pdf->Cell(13, 5, 'Harga', 1, 0, 'C');
            $pdf->Cell(20, 5, 'Jumlah Harga', 1, 0, 'C');
            $pdf->Cell(30, 5, 'User', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell(5, 5, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(16, 5, $d['tanggal_masuk'], 1, 0, 'C');
                $pdf->Cell(27, 5, $d['id_ban_masuk'], 1, 0, 'C');
                $pdf->Cell(33, 5, $d['nama_supplier'], 1, 0, 'L');
                $pdf->Cell(17, 5, $d['merk'], 1, 0, 'L');
                $pdf->Cell(22, 5, $d['jumlah_masuk'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Cell(13, 5, $d['harga'], 1, 0, 'L');
                $pdf->Cell(20, 5, $d['total_harga'], 1, 0, 'L');
                $pdf->Cell(30, 5, $d['nama'], 1, 0, 'L');
                $pdf->Ln();
            }
        else :
            $pdf->Cell(5, 5, 'No.', 1, 0, 'C');
            $pdf->Cell(16, 5, 'Tgl Keluar', 1, 0, 'C');
            $pdf->Cell(26, 5, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(15, 5, 'Merk', 1, 0, 'C');
            $pdf->Cell(22, 5, 'Jumlah Keluar', 1, 0, 'C');
            $pdf->Cell(17, 5, 'Tgl Pasang', 1, 0, 'C');
            $pdf->Cell(15, 5, 'Armada', 1, 0, 'C');
            $pdf->Cell(15, 5, 'Supir', 1, 0, 'C');
            $pdf->Cell(15, 5, 'Montir', 1, 0, 'C');
            $pdf->Cell(13, 5, 'User', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell(5, 5, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(16, 5, $d['tanggal_keluar'], 1, 0, 'C');
                $pdf->Cell(26, 5, $d['id_ban_keluar'], 1, 0, 'C');
                $pdf->Cell(15, 5, $d['merk'], 1, 0, 'L');
                $pdf->Cell(22, 5, $d['jumlah_keluar'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Cell(17, 5, $d['tgl_pasang'], 1, 0, 'L');
                $pdf->Cell(15, 5, $d['nama_armada'], 1, 0, 'L');
                $pdf->Cell(15, 5, $d['nama_supir'], 1, 0, 'L');
                $pdf->Cell(15, 5, $d['nama_montir'], 1, 0, 'L');

                $pdf->Cell(13, 5, $d['nama'], 1, 0, 'L');
                $pdf->Ln();
            }
        endif;

        $file_name = $table . ' ' . $tanggal;
        $pdf->Output('I', $file_name);
    }
}