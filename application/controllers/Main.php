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
    $this->load->model('Auth_model');
    $this->load->library('session');
    $this->load->helper('converting');
  }
  private $sql_target = "SELECT p.nama_spesialis,t.* FROM ms_target t JOIN tb_pengukuran p ON t.flag_untuk = p.id";
  private $sql_penilaian = "SELECT id,nama,passing,servis,block,smash,receive,kekuatan,
    kelincahan,daya_lentur,daya_ledak_otot,daya_tahan,kecepatan FROM tb_nilai";

  public function index()
  {
      $this->Auth_model->is_login();
      $this->load->database();
      $data['css'] = '
      <link rel="stylesheet" href="'.base_url().'assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
      ';
      $data['js'] = '
      <script src="'.base_url().'assets/plugins/block-ui/jquery.blockui.min.js"></script>
      <script src="'.base_url().'javascript/main.js"></script>
      <script src="'.base_url().'assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
      ';
      $data['target'] = $this->db->query($this->sql_target)->result_array();
      $data['pengukuran'] = $this->db->get('tb_pengukuran')->result();
      $data['page'] = 'main2';
      $data['modal'] = $this->session->flashdata('modal');
      // $data['page'] = 'login';
      $this->load->view('starter',$data);
  }

  public function formasi()
  {
      $this->Auth_model->is_login();
      $data['page'] = 'formasi';
      $data['js'] = '<script src="'.base_url().'javascript/formasi.js"></script>';
      $this->load->view('starter',$data);
  }

  public function login()
  {
    if (isset($_SESSION['username']) && isset($_SESSION['session'])) {
      redirect('/');
    }
    $data['gagal'] = $this->session->flashdata('gagal');
    $data['page'] = 'login';
    $this->load->view('starter',$data);
  }

  public function create_nilai()
  {
      $this->Auth_model->is_login();
      $data = [
        'nama' => strtoupper($this->input->post('nama')),
        'lahir' => tgl_db($this->input->post('lahir')),
        'tinggi_bdn' => $this->input->post('tinggi_bdn'),
        'berat_bdn' => $this->input->post('berat_bdn'),
        // 'posisi_awal' => $this->input->post('posisi_awal'),
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

  public function update_info($id='')
  {
    $this->Auth_model->is_login();
    $data = [
      'nama' => strtoupper($this->input->post('nama')),
      'lahir' => tgl_db($this->input->post('lahir')),
      'tinggi_bdn' => $this->input->post('tinggi_bdn'),
      'berat_bdn' => $this->input->post('berat_bdn'),
    ];
    $this->db->where('id',$id);
    $this->db->update('tb_nilai',$data);
    echo true;
  }

  public function login_process()
  {
      if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(500);exit;
      }
      $arr = [
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
      ];
      $this->Auth_model->looking($arr);
  }

  public function logout_process()
  {
      session_destroy();
      redirect('/login');
  }

  public function target_update()
  {
      $this->Auth_model->is_login();
      if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(500);exit;
      }
      $target = $_POST['target'];
      $db_target = $this->db->query($this->sql_target)->result_array();
      for ($i=0; $i < sizeof($target); $i++) {
        $data = [];
        foreach ($target[$i] as $key => $value) {
          if ($key=='nama_spesialis') {
            continue;
          }
          $data[$key] = $value;
        }
        $this->update('ms_target',['id'=>$db_target[$i]['id']],$data);
      }
  }

  public function penilaian_update()
  {
    $this->Auth_model->is_login();
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      http_response_code(500);exit;
    }
    $penilaian = $_POST['penilaian'];
    $db_target = $this->db->query($this->sql_penilaian)->result_array();
    for ($i=0; $i < sizeof($penilaian); $i++) {
      $data = [];
      foreach ($penilaian[$i] as $key => $value) {
        $data[$key] = $value;
      }
      $this->update('tb_nilai',['id'=>$db_target[$i]['id']],$data);
    }
  }

  public function penilaian_delete($id='')
  {
      $this->Auth_model->is_login();
      if ($id=='') {
        http_response_code(500);exit;
      }
      $this->db->where('id',$id);
      $this->db->delete('tb_nilai');

      $this->db->where('id_nilai',$id);
      $this->db->delete('tb_prefrensi');
  }

  private function update($tb,$where,$data)
  {
    $this->db->where($where);
    $this->db->update($tb,$data);
  }

  public function detail_pemain($id='')
  {
      if (empty($id)) {
        http_response_code(500);
        exit;
      }
      $getPemain = $this->db->query("SELECT nama,lahir,tinggi_bdn,berat_bdn FROM tb_nilai WHERE id=$id")->row();
      $outDetail = [
        'nama' => $getPemain->nama,
        'lahir' => $getPemain->lahir,
        'tinggi_bdn' => $getPemain->tinggi_bdn,
        'berat_bdn' => $getPemain->berat_bdn,
        'umur' => $this->hitung_umur($getPemain->lahir),
      ];
      echo json_encode($outDetail);
  }

  private function hitung_umur($lahir='')
  {

      $tglLahir = empty($lahir) ? date('Y-m-d') : $lahir;
      // $tglLahir = "1995-08-10";
      $now = date('m')*date('d');
      $exTglLahir = explode('-',$tglLahir);
      $mulTglLahir = $exTglLahir[1]*$exTglLahir[2];
      $divUmur = date('Y') - $exTglLahir[0];
      $umur = $now >= $mulTglLahir ? $divUmur : $divUmur-1;
      return $umur;
  }
}
