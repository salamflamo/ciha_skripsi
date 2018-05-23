<?php
defined('BASEPATH')or exit('No direct script access are allowed');
/**
 *
 */
class Auth_model extends CI_Model
{

  function __construct()
  {
      parent::__construct();
      $this->load->database();
      $this->load->library('session');
      $this->load->helper('security');
  }

  public function looking($info=[])
  {
      if (empty($info)) {
        redirect('/login');
      } else {
        $username = isset($info['username']) ? $info['username'] : 'default';
        $password = isset($info['password']) ? $info['password'] : 'default';
        // mengambil informasi
        $sess = date('ymdhis').'default';
        $pswd = do_hash(do_hash($password, 'md5'));
        $session_id = do_hash(do_hash($sess,'md5'));
        $this->db->where(['username'=>$username,'status'=>1]);
        $hasil = $this->db->get('ms_admin')->row();
        if (empty($hasil)) {
          redirect('/login');
        } elseif ($hasil->password == $pswd) {
          // update database untuk session id
          $this->db->where('username',$username);
          $this->db->update('ms_admin',['session'=>$session_id]);
          $session = [
            'id_admin' => $hasil->id,
            'nama' => $hasil->nama,
            'username' => $hasil->username,
            'session' => $session_id,
            'level' => $hasil->level,
          ];
          $this->session->set_userdata($session);
          $this->session->set_flashdata('modal','show');
          redirect('/');
        } else {
          redirect('/login');
        }
      }
  }

  public function is_login()
  {
      if (isset($_SESSION['username']) && isset($_SESSION['session'])) {
        $this->db->where('username',$_SESSION['username']);
        $data_user = $this->db->get('ms_admin')->row();
        if ($data_user->session == $_SESSION['session']) {
          return true;
        } else {
          redirect('/logout');
        }
      } else {
        redirect('/login');
      }
  }

}
