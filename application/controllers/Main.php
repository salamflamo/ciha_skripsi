<?php
defined('BASEPATH')or exit('No direct script access are allowed');
/**
 *
 */
class Main extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function index()
  {
      $data['pengukuran'] = $this->db->get('tb_pengukuran')->result();
      $this->load->view('starter',$data);
  }

  public function create_nilai()
  {
      $data = [
        'nama' => $this->input->post('nama'),
        'posisi_awal' => $this->input->post('posisi_awal'),
        'passing' => $this->input->post('passing'),
        'servis' => $this->input->post('servis'),
        'block' => $this->input->post('block'),
        'smash' => $this->input->post('smash'),
        'receive' => $this->input->post('receive'),
        'kekuatan' => $this->input->post('kekuatan'),
        'kelincahan' => $this->input->post('kelincahan'),
        'daya_lentur' => $this->input->post('daya_lentur'),
        'daya_ledak_otot' => $this->input->post('daya_ledak_otot'),
        'daya_tahan' => $this->input->post('daya_tahan'),
        'kecepatan' => $this->input->post('kecepatan'),
        'flag_untuk' => $this->input->post('flag_untuk'),
      ];
      $this->db->insert('tb_nilai',$data);
      $simpan = $this->db->affected_rows();
      if ($simpan > 0) {
        echo 1;
      } else {
        echo 0;
      }
  }
}
