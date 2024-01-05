<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ValidasiTKK extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      $this->load->model(['M_mahasiswa', 'M_tkkperiode']);
   }

   public function index()
   {
      $status_aktif = 1;
      $status_kelulusan = 'l';
      $data['TahapAktif'] = $this->M_tkkperiode->ambil_baris_tkk_tahap($status_aktif)->row_array();
      $kode_tkk_tahap = $data['TahapAktif']['kode_tkk_tahap'];
      $dataTKKaktif = $this->M_tkkperiode->dataTKK_aktif($kode_tkk_tahap)->result();
      $cekKelulusan = $this->M_tkkperiode->cekKelulusan($kode_tkk_tahap)->row_array();
      $jumlahMahasiswaLulus = $this->M_tkkperiode->dataMahasiswaLulus($kode_tkk_tahap);
      $jumlahMahasiswaTidakLulus = $this->M_tkkperiode->dataMahasiswaTidakLulus($kode_tkk_tahap);

      $dataTKKlulus = $this->M_tkkperiode->dataTKK_lulus($kode_tkk_tahap, $status_kelulusan)->result_array();

      $data = [
         'dataTKKaktif' => $dataTKKaktif,
         'cekKelulusan' => $cekKelulusan,
         'jumlahMahasiswaLulus' => $jumlahMahasiswaLulus,
         'jumlahMahasiswaTidakLulus' => $jumlahMahasiswaTidakLulus,
         'dataTKKlulus' => $dataTKKlulus
      ];
      $this->template->load('admin/templates/View_template', 'admin/master/View_validasitkk', $data);
   }

   public function filter()
   {
      $filter = $this->input->post('filter');
      $status = $this->input->post('status');
      $status_aktif = 1;
      $status_kelulusan = 'l';
      $data['TahapAktif'] = $this->M_tkkperiode->ambil_baris_tkk_tahap($status_aktif)->row_array();
      $kode_tkk_tahap = $data['TahapAktif']['kode_tkk_tahap'];
      $cekKelulusan = $this->M_tkkperiode->cekKelulusan($kode_tkk_tahap)->row_array();
      $jumlahMahasiswaLulus = $this->M_tkkperiode->dataMahasiswaLulus($kode_tkk_tahap);
      $jumlahMahasiswaTidakLulus = $this->M_tkkperiode->dataMahasiswaTidakLulus($kode_tkk_tahap);

      $dataTKKlulus = $this->M_tkkperiode->dataTKK_lulus($kode_tkk_tahap, $status_kelulusan)->result_array();

      if ($filter == 1) {
         if ($status == "tg") {
            $dataTKKaktif = $this->M_tkkperiode->dataTKK_filter($kode_tkk_tahap, $status)->result();
         } elseif ($status == "tl") {
            $dataTKKaktif = $this->M_tkkperiode->dataTKK_filter($kode_tkk_tahap, $status)->result();
         } elseif ($status == "l") {
            $dataTKKaktif = $this->M_tkkperiode->dataTKK_filter($kode_tkk_tahap, $status)->result();
         } else {
            $dataTKKaktif = $this->M_tkkperiode->dataTKK_aktif($kode_tkk_tahap)->result();
         }
      } elseif ($filter == 2) {
         $dataTKKaktif = $this->M_tkkperiode->dataTKK_filterNULL($kode_tkk_tahap, $status)->result();
      } else {
         if ($status == "tg") {
            $dataTKKaktif = $this->M_tkkperiode->dataTKK_filter($kode_tkk_tahap, $status)->result();
         } elseif ($status == "tl") {
            $dataTKKaktif = $this->M_tkkperiode->dataTKK_filter($kode_tkk_tahap, $status)->result();
         } elseif ($status == "l") {
            $dataTKKaktif = $this->M_tkkperiode->dataTKK_filter($kode_tkk_tahap, $status)->result();
         } else {
            $dataTKKaktif = $this->M_tkkperiode->dataTKK_aktif($kode_tkk_tahap)->result();
         }
      }
      $data = [
         'dataTKKaktif' => $dataTKKaktif,
         'cekKelulusan' => $cekKelulusan,
         'jumlahMahasiswaLulus' => $jumlahMahasiswaLulus,
         'jumlahMahasiswaTidakLulus' => $jumlahMahasiswaTidakLulus,
         'dataTKKlulus' => $dataTKKlulus
      ];

      $this->template->load('admin/templates/View_template', 'admin/master/View_validasitkk', $data);
   }

   public function excelMahasiswa()
   {
      // Load PhpSpreadsheet library
      require_once APPPATH . 'third_party/PhpSpreadsheet/vendor/autoload.php';

      // Create a new Spreadsheet object
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Add your data to the spreadsheet
      // $data = $this->your_model->getData(); // Adjust this line based on your model
      $filter = $this->input->post('filter_data');
      $status_aktif = 1;
      $TahapAktif = $this->M_tkkperiode->ambil_baris_tkk_tahap($status_aktif)->row_array();
      $kode_tkk_tahap = $TahapAktif['kode_tkk_tahap'];
      if ($filter == 1) {
         $data = $this->M_tkkperiode->dataTKK_filter($kode_tkk_tahap)->result_array();
      } elseif ($filter == 2) {
         $data = $this->M_tkkperiode->dataTKK_filterNULL($kode_tkk_tahap)->result_array();
      } else {
         $data = $this->M_tkkperiode->dataTKK_aktif($kode_tkk_tahap)->result_array();
      }

      $sheet->setCellValue('A1', 'Nomor');
      $sheet->setCellValue('B1', 'kode_tkk_daftar');
      $sheet->setCellValue('C1', 'nim');
      $sheet->setCellValue('D1', 'nama');
      $sheet->setCellValue('E1', 'fakultas');
      $sheet->setCellValue('F1', 'prodi');
      $sheet->setCellValue('G1', 'kode_dosen');
      $sheet->setCellValue('H1', 'nilai_n1');
      $sheet->setCellValue('I1', 'status_lulus');

      $row = 2;
      $no = 1;
      foreach ($data as $item) {
         $sheet->setCellValue('A' . $row, $no++);
         $sheet->setCellValue('B' . $row, $item['kode_tkk_daftar']);
         $sheet->setCellValue('C' . $row, $item['nim']);
         $sheet->setCellValue('D' . $row, $item['nama']);
         $sheet->setCellValue('E' . $row, $item['fakultas']);
         $sheet->setCellValue('F' . $row, $item['prodi']);
         $sheet->setCellValue('G' . $row, $item['kode_dosen']);
         $sheet->setCellValue('H' . $row, $item['nilai_n1']);
         $sheet->setCellValue('I' . $row, $item['status_lulus']);
         // Add other columns as needed
         $row++;
      }

      $fileName = 'Data-Mahasiswa-TKK-Tahap-Ke-' . $TahapAktif['tahap_ke'] . '-Semester-' . $TahapAktif['semester'] . '-TA-' . $TahapAktif['tahun_akademik'];
      // Set headers for download
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
      header('Cache-Control: max-age=0');

      // Create Excel file
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
   }

   public function excelDosen()
   {
      // Load PhpSpreadsheet library
      require_once APPPATH . 'third_party/PhpSpreadsheet/vendor/autoload.php';

      // Create a new Spreadsheet object
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Add your data to the spreadsheet
      // $data = $this->your_model->getData(); // Adjust this line based on your model
      $filter = $this->input->post('filter_data');
      $status_aktif = 1;
      $dosen = $this->M_mahasiswa->datadosen($status_aktif)->result_array();
      // $this->template->load('admin/templates/View_template', 'admin/master/View_validasitkk', $dosen);

      $sheet->setCellValue('A1', 'Nomor');
      $sheet->setCellValue('B1', 'Kode Dosen');
      $sheet->setCellValue('C1', 'NIP');
      $sheet->setCellValue('D1', 'Nama Dosen');
      $sheet->setCellValue('E1', 'Jabatan');
      $sheet->setCellValue('F1', 'No Telpon');
      $sheet->setCellValue('G1', 'Jenis Kelamin');

      $row = 2;
      $no = 1;
      foreach ($dosen as $item) {
         $sheet->setCellValue('A' . $row, $no++);
         $sheet->setCellValue('B' . $row, $item['kode_dosen']);
         $sheet->setCellValue('C' . $row, $item['nip']);
         $sheet->setCellValue('D' . $row, $item['nama']);
         $sheet->setCellValue('E' . $row, $item['jabatan']);
         $sheet->setCellValue('F' . $row, $item['notelp']);
         $sheet->setCellValue('G' . $row, $item['jk']);
         // Add other columns as needed
         $row++;
      }

      // Set headers for download
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Data-Dosen.xlsx"');
      header('Cache-Control: max-age=0');

      // Create Excel file
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
   }

   public function importValidasi()
   {
      // Load library PhpSpreadsheet
      require_once APPPATH . 'third_party/PhpSpreadsheet/vendor/autoload.php';

      // Cek apakah berkas Excel telah diunggah
      if ($_FILES['excel_file']['error'] == 0) {
         // Tentukan path untuk menyimpan berkas Excel yang diunggah
         $file_name = time() . $_FILES['excel_file']['name'];
         $upload_path = FCPATH . 'application/uploads/';
         $file_path = $upload_path . $file_name;

         // Pindahkan berkas yang diunggah ke lokasi yang ditentukan
         print_r($_FILES['excel_file']['tmp_name']);
         if (file_exists($_FILES['excel_file']['tmp_name'])) {
            // Move the uploaded file
            move_uploaded_file($_FILES['excel_file']['tmp_name'], $file_path);
         } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				File tidak ditemukan !! </div>');
            redirect('ValidasiTKK');
            die();
         }

         // Mendapatkan objek spreadsheet dari file Excel
         $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_path);

         // Mendapatkan data dari spreadsheet
         $data = $spreadsheet->getActiveSheet()->toArray();

         // Proses data dan lakukan update di database
         foreach ($data as $row) {
            // Sesuaikan dengan struktur tabel dan kolom di database Anda
            $update_data = array(
               'kode_dosen' => $row[6]
            );

            // Klausa WHERE
            $where_condition = array('kode_tkk_daftar' => $row[1]);

            // Panggil model untuk melakukan update
            $this->M_mahasiswa->update_dataDosen($update_data, $where_condition);
         }
         $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
				Data berhasil di-update </div>');
         redirect('ValidasiTKK');
      } else {
         $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Data gagal di-update </div>');
         redirect('ValidasiTKK');
      }
   }

   public function importNilai()
   {
      // Load library PhpSpreadsheet
      require_once APPPATH . 'third_party/PhpSpreadsheet/vendor/autoload.php';

      // Cek apakah berkas Excel telah diunggah
      if ($_FILES['excel_file2']['error'] == 0) {
         // Tentukan path untuk menyimpan berkas Excel yang diunggah
         $file_name = time() . $_FILES['excel_file2']['name'];
         $upload_path = FCPATH . 'application/uploads/';
         $file_path = $upload_path . $file_name;

         // Pindahkan berkas yang diunggah ke lokasi yang ditentukan
         print_r($_FILES['excel_file2']['tmp_name']);
         if (file_exists($_FILES['excel_file2']['tmp_name'])) {
            // Move the uploaded file
            move_uploaded_file($_FILES['excel_file2']['tmp_name'], $file_path);
         } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				File tidak ditemukan !! </div>');
            redirect('ValidasiTKK');
            die();
         }

         // Mendapatkan objek spreadsheet dari file Excel
         $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_path);

         // Mendapatkan data dari spreadsheet
         $data = $spreadsheet->getActiveSheet()->toArray();

         // Proses data dan lakukan update di database
         foreach ($data as $row) {
            // Sesuaikan dengan struktur tabel dan kolom di database Anda
            $update_data = array(
               'status_lulus' => $row[8],
               'nilai_n1' => $row[7]
            );

            // Klausa WHERE
            $where_condition = array('kode_tkk_daftar' => $row[1]);

            // Panggil model untuk melakukan update
            $this->M_mahasiswa->update_dataDosen($update_data, $where_condition);
         }
         $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
				Data berhasil di-update </div>');
         redirect('ValidasiTKK');
      } else {
         $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Data gagal di-update </div>');
         redirect('ValidasiTKK');
      }
   }

   public function searchAutoComplete()
   {
      $term = $this->input->get('keyword'); // Ambil nilai yang diketikkan oleh pengguna

      $result = $this->M_mahasiswa->cariDosen($term);
      // Format data sebagai JSON
      echo json_encode($result);
   }

   public function tambah_penguji()
   {
      $post = $this->input->post(null, TRUE);
      $this->M_mahasiswa->edit_penguji($post);
      if ($this->db->affected_rows() > 0) {
         $this->session->set_flashdata('success', 'Penguji Berhasil Diperbaharui !');
      }
      redirect('ValidasiTKK');
   }

   public function BuatSertifikat()
   {
      $status_aktif = 1;
      $status_kelulusan = 'l';
      $data['TahapAktif'] = $this->M_tkkperiode->ambil_baris_tkk_tahap($status_aktif)->row_array();
      $kode_tkk_tahap = $data['TahapAktif']['kode_tkk_tahap'];
      $dataTKKlulus = $this->M_tkkperiode->dataTKK_lulus($kode_tkk_tahap, $status_kelulusan)->result_array();
      $data = [
         'dataTKKlulus' => $dataTKKlulus
      ];
      $tanggal_expired = $this->input->post('tanggal_expired');
      foreach ($dataTKKlulus as $key => $item) {
         $this->M_tkkperiode->editSertifikat(
            $item['kode_tkk_daftar'],
            [
               'no_sertifikat' => $this->fungsi->generateRandomString(40),
               'tanggal_expired' => $tanggal_expired
            ]
         );
      }
      if ($this->db->affected_rows() > 0) {
         $this->session->set_flashdata('success', 'Data Berhasil Diubah !');
      }
      redirect('ValidasiTKK');
   }
}
