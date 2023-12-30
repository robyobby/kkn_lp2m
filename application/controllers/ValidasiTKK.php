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
      $data['TahapAktif'] = $this->M_tkkperiode->ambil_baris_tkk_tahap($status_aktif)->row_array();
      $kode_tkk_tahap = $data['TahapAktif']['kode_tkk_tahap'];
      $data['dataTKKaktif'] = $this->M_tkkperiode->dataTKK_aktif($kode_tkk_tahap)->result_array();
      $this->template->load('admin/templates/View_template', 'admin/master/View_validasitkk', $data);
   }

   public function filter()
   {
      $filter = $this->input->post('filter');
      $status_aktif = 1;
      $data['TahapAktif'] = $this->M_tkkperiode->ambil_baris_tkk_tahap($status_aktif)->row_array();
      $kode_tkk_tahap = $data['TahapAktif']['kode_tkk_tahap'];
      if ($filter == 1) {
         $data['dataTKKaktif'] = $this->M_tkkperiode->dataTKK_filter($kode_tkk_tahap)->result_array();
         $this->template->load('admin/templates/View_template', 'admin/master/View_validasitkk', $data);
      } elseif ($filter == 2) {
         $data['dataTKKaktif'] = $this->M_tkkperiode->dataTKK_filterNULL($kode_tkk_tahap)->result_array();
         $this->template->load('admin/templates/View_template', 'admin/master/View_validasitkk', $data);
      } else {
         $data['dataTKKaktif'] = $this->M_tkkperiode->dataTKK_aktif($kode_tkk_tahap)->result_array();
         $this->template->load('admin/templates/View_template', 'admin/master/View_validasitkk', $data);
      }
   }

   public function excelMahasiswa()
   {
      // Load PhpSpreadsheet library
      require_once APPPATH . 'third_party/PhpSpreadsheet/vendor/autoload.php';

      // Create a new Spreadsheet object
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Add your data to the spreadsheet
      $data = $this->your_model->getData(); // Adjust this line based on your model
      $row = 1;

      foreach ($data as $item) {
         $sheet->setCellValue('A' . $row, $item->id);
         $sheet->setCellValue('B' . $row, $item->nama);
         // Add other columns as needed
         $row++;
      }

      // Set headers for download
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="export.xlsx"');
      header('Cache-Control: max-age=0');

      // Create Excel file
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
   }
   
}
