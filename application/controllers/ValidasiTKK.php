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
      // print_r($data['dataTKKaktif']);
      // print_r($data['dataTKKaktif']['tahap_ke']);
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
      $this->template->load('admin/templates/View_template', 'admin/master/View_validasitkk', $data);

      $sheet->setCellValue('A1', 'Nomor');
      $sheet->setCellValue('B1', 'Kode Mahasiswa');
      $sheet->setCellValue('C1', 'NIM');
      $sheet->setCellValue('D1', 'Nama Mahasiswa');
      $sheet->setCellValue('E1', 'Fakultas');
      $sheet->setCellValue('F1', 'Program Studi');
      $sheet->setCellValue('G1', 'Kode Dosen');
      $sheet->setCellValue('H1', 'Kode TKK Daftar');

      $row = 2;
      $no = 1;
      foreach ($data as $item) {
         $sheet->setCellValue('A' . $row, $no++);
         $sheet->setCellValue('B' . $row, $item['kode_mahasiswa']);
         $sheet->setCellValue('C' . $row, $item['nim']);
         $sheet->setCellValue('D' . $row, $item['nama']);
         $sheet->setCellValue('E' . $row, $item['fakultas']);
         $sheet->setCellValue('F' . $row, $item['prodi']);
         $sheet->setCellValue('G' . $row, $item['kode_dosen']);
         $sheet->setCellValue('H' . $row, $item['kode_tkk_daftar']);
         // Add other columns as needed
         $row++;
      }
      
      $fileName = 'Data-Mahasiswa-TKK-Tahap-Ke-' . $TahapAktif['tahap_ke'] . '-Semester-' . $TahapAktif['semester'] . '-TA-' . $TahapAktif['tahun_akademik'];
      // Set headers for download
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="'.$fileName.'.xlsx"');
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

   public function importNilai(){
      $fileName = time().$_FILES['file']['name'];
      $config['upload_path'] = '././assets/'; //buat folder dengan nama assets di root folder
      $config['file_name'] = $fileName;
      $config['allowed_types'] = 'xls|xlsx|csv';
      $config['max_size'] = 10000;
      $this->load->library('upload');
      $this->upload->initialize($config);
      if(! $this->upload->do_upload('file') ){
         echo $this->upload->display_errors();
         return;
      }
      $media = $this->upload->data();
      $inputFileName = '././assets/'.$media['file_name'];
      $this->load->model(array('Nilai', 'RiwayatPenilaian', 'Jurusan', 'Semester'));
      
      try {
         $inputFileType = IOFactory::identify($inputFileName);
         $objReader = IOFactory::createReader($inputFileType);
         $objReader->setReadDataOnly(true);
         $objPHPExcel = $objReader->load($inputFileName);
      } catch(Exception $e) {
         die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
      }
      
      $sheet = $objPHPExcel->getSheet(0);
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();
      
      $count = array();
      $count['success'] = array();
      $count['failed'] = array();
      $successRows = array();
      // $semester = $this->Semester->getAjaran(null)->result_array();
      // $jurusan = $this->Jurusan->get(null)->result_array();
      for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array
         $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
         NULL,
         TRUE,
         FALSE);
         
         //Sesuaikan sama nama kolom tabel di database
         
         if(is_null($rowData[0][0]) && is_null($rowData[0][2])){
            continue;
         }
         // $semester_id = $this->getId($semester,'kode',$rowData[0][4]);
         // $prodi_id = $this->getId($jurusan,'uuid',$rowData[0][9]);
         if(is_null($rowData[0][9]) || is_null($rowData[0][6]) || is_null($rowData[0][10]) || is_null($rowData[0][0]) || is_null($rowData[0][2])){
            array_push($count['failed'], $row);
            continue;
         }
         
         //cek KKN atau bukan
         if ($this->session->userdata('id') == '19070') {
            if (stripos(trim($rowData[0][3]), 'KKN') !== false || stripos(trim($rowData[0][3]), 'Kuliah Kerja Nyata') !== false ) {
            } else {
                  array_push($count['failed'], $row . ' (Nama matkul bukan KKN atau Kuliah Kerja Nyata)');
                  continue;
            }
          } else if ($this->session->userdata('id') == '18994') {   //cek PPL
            if (stripos(trim($rowData[0][3]), 'PPL') !== false || stripos(trim($rowData[0][3]), 'Lapangan') !== false || stripos(trim($rowData[0][3]), 'Teaching') !== false || stripos(trim($rowData[0][3]), 'Mengajar') !== false || stripos(trim($rowData[0][3]), 'Tahtbiq') !== false) {
            } else {
                  array_push($count['failed'], $row . ' (Nama matkul tidak mengandung kata "PPL", "Lapangan", "Teaching", atau "Mengajar")');
                  continue;
            }
          } else if ($this->session->userdata('id') == '18974') {   //cek UPB
            if (stripos(trim($rowData[0][3]), 'BAHASA INGGRIS A') !== false || stripos(trim($rowData[0][3]), 'BAHASA INGGRIS B') !== false || stripos(trim($rowData[0][3]), 'BAHASA ARAB A') !== false || stripos(trim($rowData[0][3]), 'BAHASA ARAB B') !== false) {
            } else {
               array_push($count['failed'], $row . ' (Nama matkul tidak mengandung kata "BAHASA ARAB A", "BAHASA ARAB B", "BAHASA INGGRIS A", atau "BAHASA INGGRIS B")');
               continue;
            }
         }
         
         $nilai_indeks = $rowData[0][7];
         
         $id_jurusan = $this->Jurusan->get(['uuid' => $rowData[0][9]]);
         if ($id_jurusan->num_rows() == 0) {
            array_push($count['failed'], $row . ' (Kode jurusan tidak ditemukan)');
            continue;
         } else {
            $id_jurusan = $id_jurusan->row()->id;
            $id_semester = $this->Semester->getAjaran(['kode' => trim($rowData[0][4])]);
            if ($id_semester->num_rows() == 0) {
                  array_push($count['failed'], $row . ' (Kode semester tidak ditemukan)');
                  continue;
               } else {
                  $id_semester = $id_semester->row()->id;
                  $nilai_indeks = $this->Nilai->getIndeksByHuruf(['id_prodi' => $id_jurusan, 'id_semester' => $id_semester], $rowData[0][6]);
                  if ($nilai_indeks->num_rows() == 0) {
                      $nilai_indeks = $rowData[0][7]; // ngikut excel
                      //array_push($count['failed'], $row . ' (Data aspek nilai di jurusan dan semester nilai ini belum dibuat)');
                      // continue;
                  } else {
                     $nilai_indeks = $nilai_indeks->row()->bobot;
                  }
            }
         }
         
         $data = array(
            'nim_mhs' => trim($rowData[0][0]),
            'kode_matkul' => trim($rowData[0][2]),
            'nama_matkul' => trim($rowData[0][3]),
            'kode_semester' => trim($rowData[0][4]),
            'kelas' => $rowData[0][5],
            'huruf_indeks' => $rowData[0][6],
            'nilai_indeks' => $nilai_indeks,
            'nilai_akhir' => $rowData[0][8],
            'kode_prodi' => $rowData[0][9],
            'sks' => $rowData[0][10],
            'published' => 1
         );
         
          //sesuaikan nama dengan nama tabel
         $nilaiLama = $this->Nilai->get(array('kode_matkul'=>trim($rowData[0][2]),'nim_mhs'=>trim($rowData[0][0]),'kode_semester'=>trim($rowData[0][4])));
         if($nilaiLama->num_rows()>0){
            $this->Nilai->update(array('kode_matkul'=>trim($rowData[0][2]),'nim_mhs'=>trim($rowData[0][0]),'kode_semester'=>trim($rowData[0][4])),$data);
            try {
                  $nilaiLama = $nilaiLama->row();
                  $logData = array(
                     'id_penilaian' => $nilaiLama->id,
                     'id_pegawai' => $this->session->userdata('data')['id_pegawai'],
                     'nim_mhs' => $data['nim_mhs'],
                     'kode_matkul' => $data['kode_matkul'],
                     'kode_semester' => $data['kode_semester'],
                     'nama_matkul_lama' => $nilaiLama->nama_matkul,
                     'nama_matkul_baru' => $data['nama_matkul'],
                     'huruf_indeks_lama' => $nilaiLama->huruf_indeks,
                     'huruf_indeks_baru' => $data['huruf_indeks'],
                     'nilai_indeks_lama' => $nilaiLama->nilai_indeks,
                     'nilai_indeks_baru' => $data['nilai_indeks'],
                     'nilai_akhir_lama' => $nilaiLama->nilai_akhir,
                     'nilai_akhir_baru' => $data['nilai_akhir'],
                     'kode_prodi_lama' => $nilaiLama->kode_prodi,
                     'kode_prodi_baru' => $data['kode_prodi'],
                     'sks_lama' => $nilaiLama->sks,
                     'sks_baru' => $data['sks']
                  );
                  $this->RiwayatPenilaian->insert($logData);
            } catch (\Throwable $th) {
                  //throw $th;
            }              
         } else {
            $insert = $this->Nilai->insert($data);
            $logData = array(
                  'nim_mhs' => $data['nim_mhs'],
                  'kode_matkul' => $data['kode_matkul'],
                  'kode_semester' => $data['kode_semester'],
                  'nama_matkul_baru' => $data['nama_matkul'],
                  'huruf_indeks_baru' => $data['huruf_indeks'],
                  'nilai_indeks_baru' => $data['nilai_indeks'],
                  'nilai_akhir_baru' => $data['nilai_akhir'],
                  'kode_prodi_baru' => $data['kode_prodi'],
                  'sks_baru' => $data['sks']
            );
         }//log update nilai
         
         array_push($count['success'], $row);
         $logData['row'] = $row;
         array_push($successRows, $logData);
      }
      unlink($inputFileName);
      $response = array();
      $response['success'] = "Insert Berhasil : ".count($count['success']);
      $response['failed'] = "Insert Gagal : ".count($count['failed']);
      $response['success_rows'] = $successRows;
      if(count($count['failed'])>0){
         $response['failed'] .= " Line number : ".json_encode($count['failed']);
         $response['failed_rows'] = $count['failed'];
      }
      echo json_encode($response);
   }

   public function importNilaiKelasMatkul()
   {
      $cek = $this->session->userdata('status');
      if (!($cek == 'dosen' || $cek == 'admin' || $cek == 'dekan' || $cek == 'kaprodi')) {
            echo json_encode(array('status'=>'gagal','message'=>'Anda tidak memiliki akses!'));
      }

      $id_km = $_POST['id_km'];
      
      $this->load->model(array('Nilai', 'Kelas', 'RiwayatPenilaian', 'Jurusan'));

      $km = $this->Nilai->getWhere('t_kelas_matkul',array('id'=>$id_km))->row();
      $pm = $this->Nilai->getWhere('t_plot_matkul', array('id' => $km->id_plot))->row();

      if ($cek == 'dosen') {
            if ($this->session->userdata()['data']['id'] != $km->id_dosen) {
               echo json_encode(array('status'=>'gagal','message'=>'Bukan kelas Anda!'));
            }
      } elseif ($cek == 'dekan') {
         $id_fakultas = $this->Jurusan->get(['id' => $pm->id_jurusan])->row()->id_fakultas;
         if ($this->session->userdata()['data']['id_fakultas'] != $id_fakultas) {
            echo "<script>alert('Kelas ini bukan dari fakultas Anda!');</script>";
            return;
         }
      }

      if ($km->published == 1) {
            echo json_encode(array('status'=>'gagal','message'=>'Tidak bisa mengedit jika nilai telah dipublish. Harap unpublish nilai terlebih dahulu sebelum mengimpor nilai.'));
            return;
      }

      $fileName = time() . $_FILES['file']['name'];
        $config['upload_path'] = './././assets/temp/'; //buat folder dengan nama assets di root folder
      $config['file_name'] = $fileName;
      $config['allowed_types'] = 'xls|xlsx|csv';
      $config['max_size'] = 10000;
      $this->load->library('upload');
      $this->upload->initialize($config);

      if (!$this->upload->do_upload('file')) {
            echo json_encode(array('status'=>'gagal','message'=>$this->upload->display_errors()));
            return;
      }
      $media = $this->upload->data();
      $inputFileName = './././assets/temp/' . $media['file_name'];
      try {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($inputFileName);
      } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
      }

      $sheet = $objPHPExcel->getSheet(0);
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();

      $count = array();
      $count['success'] = array();
      $count['failed'] = array();

      $komponen = $this->Nilai->getKomponen(['id_kelas_matkul' => $id_km]);
      if ($komponen->num_rows() == 0) {
            echo json_encode(array('status'=>'gagal','message'=>'Komponen nilai untuk kelas ini belum ada! Harap isi komponen nilai terlebih dahulu.'));
            return;
      } else {
            $komponen = $komponen->result();
      }

      $nilai = $this->Nilai->getMahasiswa($id_km)->result_array();

      $data = array(
            'id_prodi' => $pm->id_jurusan,
            'id_semester' => $pm->id_semester
      );

      $config = $this->Nilai->getConfig($data);

      if ($config->num_rows() == 0) {
            echo json_encode(array('status'=>'gagal','message'=>'Aspek nilai untuk program studi dan semester ini belum ada! Harap lengkapi data aspek nilai terlebih dahulu (oleh Mikwa Fakultas/Pusat).'));
            return;
      } else {
            $config = $config->result();
      }

      $cariNIM = $nilai;

        for ($row = 2; $row <= $highestRow; $row++) {                  //  Read a row of data into an array
            $rowData = $sheet->rangeToArray(
               'A' . $row . ':' . $highestColumn . $row,
               NULL,
               TRUE,
               FALSE
            );

            if (is_null($rowData[0][0])) {
               array_push($count['failed'], $row);
               continue;
            }

            $nim = trim($rowData[0][0]);

            $id_pm = $id_penilaian = null;
            foreach ($cariNIM as $key => $value) {
               if ($value['nim'] == $nim) {
                  $id_pm = $value['id_pm'];
                  $id_penilaian = $value['id_penilaian'];
                  unset($cariNIM[$key]);
                  break;
               }
            }

            if (!$id_pm) {
               array_push($count['failed'], $row);
               continue;
            }

            if (!$id_penilaian) {
               $id_penilaian = $this->Nilai->insert(array('id_pilih_matkul'=>$id_pm));
            }

            $total = 0;

            for ($i=0; $i < count($komponen); $i++) {      // per kolom komponen nilai
               $id_komponen = $komponen[$i]->id;
               $nilai = trim($rowData[0][$i + 2]);

               if($nilai == "" || !($nilai >= 0 && $nilai <= 100)){
                  $nilai = 0;
               }

                //if($nilai != ""){
                  $detail = $this->Nilai->getDetail(array('id_penilaian'=>$id_penilaian,'id_komponen'=>$id_komponen));
                  if ($detail->num_rows()==0) {
                        $this->Nilai->insertDetail(array('id_penilaian'=>$id_penilaian,'id_komponen'=>$id_komponen,'nilai'=>$nilai));
                  } else {
                        $this->Nilai->updateDetail(array('id_penilaian'=>$id_penilaian,'id_komponen'=>$id_komponen),array('nilai'=>$nilai));
                  }
                    $total += $nilai * $komponen[$i]->bobot / 100;
                //} else {
                //    $this->Nilai->deleteDetail(array('id_penilaian'=>$id_penilaian,'id_komponen'=>$id_komponen));
                //}
            }

            foreach ($config as $key => $value) {
               if ($value->batas_atas >= $total && $total >= $value->batas_bawah) {
                  $indeks = $value->huruf;
               }
            }

            $this->Nilai->update(array('id'=>$id_penilaian),array('nilai_akhir'=>$total,'huruf_indeks'=>$indeks));
            
            array_push($count['success'], $row);
      }
      unlink($inputFileName);
      $response = array();
      $response['success'] = "Berhasil: " . count($count['success']) . ".";
      $response['failed'] = "Gagal: " . count($count['failed']) . ".";
      if (count($count['failed']) > 0) {
            $response['failed'] .= " Nomor Baris: " . json_encode($count['failed']);
      }
      echo json_encode(array('status'=>'berhasil','message'=>$response));
   }
}
