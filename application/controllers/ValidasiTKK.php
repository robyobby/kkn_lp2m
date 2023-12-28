<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
      $filter = $this->input->post('filter_data');
      $status_aktif = 1;
      $data['TahapAktif'] = $this->M_tkkperiode->ambil_baris_tkk_tahap($status_aktif)->row_array();
      $kode_tkk_tahap = $data['TahapAktif']['kode_tkk_tahap'];
      // if ($filter == 1) {
      //    $data['dataTKKaktif'] = $this->M_tkkperiode->dataTKK_filter($kode_tkk_tahap)->result_array();
      // } elseif ($filter == 2) {
      //    $data['dataTKKaktif'] = $this->M_tkkperiode->dataTKK_filterNULL($kode_tkk_tahap)->result_array();
      // } else {
      //    $data['dataTKKaktif'] = $this->M_tkkperiode->dataTKK_aktif($kode_tkk_tahap)->result_array();
      // }
      $data['dataTKKaktif'] = $this->M_tkkperiode->dataTKK_aktif($kode_tkk_tahap)->result_array();

      require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
      require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

      $object = new PHPExcel();
      $object->getProperties()->setCreator("Data Mahasiswa TKK");
      $object->getProperties()->setLastModifiedBy("Data Mahasiswa TKK");
      $object->getProperties()->setTitle("Data Mahasiswa TKK");

      $object->setActiveSheetIndex(0);

      $object->getActiveSheet()->setCellValue('A1', 'Nomor');
      $object->getActiveSheet()->setCellValue('B1', 'Kode Mahasiswa');
      $object->getActiveSheet()->setCellValue('C1', 'NIM');
      $object->getActiveSheet()->setCellValue('D1', 'Nama');
      $object->getActiveSheet()->setCellValue('E1', 'Fakultas');
      $object->getActiveSheet()->setCellValue('F1', 'Prodi');
      $object->getActiveSheet()->setCellValue('G1', 'JK');
      $object->getActiveSheet()->setCellValue('H1', 'Kode Dosen');
      $object->getActiveSheet()->setCellValue('I1', 'Kode TKK Tahap');

      $baris = 2;
      $no = 1;

      foreach ($data['dataTKKaktif'] as $tkk) {
         $object->getActiveSheet()->setCellValue('A' . $baris, $no++);
         $object->getActiveSheet()->setCellValue('B' . $baris, $tkk->kode_mahasiswa);
         $object->getActiveSheet()->setCellValue('C' . $baris, $tkk->nim);
         $object->getActiveSheet()->setCellValue('D' . $baris, $tkk->nama);
         $object->getActiveSheet()->setCellValue('E' . $baris, $tkk->fakultas);
         $object->getActiveSheet()->setCellValue('F' . $baris, $tkk->prodi);
         $object->getActiveSheet()->setCellValue('G' . $baris, $tkk->jk);
         $object->getActiveSheet()->setCellValue('H' . $baris, $tkk->kode_dosen);
         $object->getActiveSheet()->setCellValue('I' . $baris, $tkk->$kode_tkk_tahap);

         $baris++;
      }

      $filename = 'Mahasiswa_TKK_Tahap ke-' . $data['TahapAktif']['tahap_ke'] . 'Semester ' . $data['TahapAktif']['semester'] . 'T.A ' . $data['TahapAktif']['tahun_akademik'] . 'xls';

      $object->getActiveSheet()->setTitle("Data Mahasiswa TKK");
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="' . $filename . '"');
      header('Cache-Control: max-age=0');

      $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
      $writer->save('php://output');

      exit;
   }
}
