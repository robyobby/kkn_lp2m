<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dosen extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function ambil_datadosen()
  {
    $this->db->select('*');
    $this->db->From('master_dosen');
    $this->db->order_by('nama', 'ASC');
    $query = $this->db->get();
    return $query;
  }


  public function datadosen($kode_dosen)
  {
    $this->db->select('*');
    $this->db->From('master_dosen');
    $this->db->where('kode_dosen', $kode_dosen);
    $query = $this->db->get();
    return $query;
  }

  public function hapus($id)
  {
    $this->db->where('kode_dosen', $id);
    $this->db->delete('master_dosen');
  }

  public function edit($post)
  {
    $params['nama'] = $post['nama'];
    $params['email'] = $post['email'];
    $params['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
    $params['status_aktif'] = $post['status_aktif'];
    $this->db->where('kode_user', $post['kode_user']);
    $this->db->update('master_user', $params);
  }

  public function tambah_user($post)
  {
    $params['nama'] = $post['nama'];
    $params['email'] = $post['email'];
    $params['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
    $params['status_aktif'] = $post['status_aktif'];
    $this->db->insert('master_user', $params);
  }

  public function APIMahasiswa($userdata)
  {
    // echo $userdata['username'];
    // echo $userdata['password'];

    if (!empty($userdata)) {
      $str = http_build_query($userdata);
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'siakad.uin-antasari.ac.id/api/authentication/login/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $str,
        CURLOPT_HTTPHEADER => array(
          'X-API-KEY: DAjmDjSHlQ6BR8Ko846DEwOJP9uMG1DVhagWLrwO',
          'Authorization: Basic YWRtaW46MTIzNA==',
          'Cookie: ci_session=ina476lakj90u8cua2cvifpveh9f5q2o'
        ),
      ));
      $output = curl_exec($curl);
      curl_close($curl);
      $result = json_decode($output, true);
      // print_r($result);
      // exit;
      if (!empty($result)) {
        return $result;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}
