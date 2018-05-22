<?php
defined('BASEPATH')or exit('Tidak baik untuk kesehatan');
/**
 *
 */
class Migrate extends CI_Controller
{
    public function table($ver='')
    {
        if (empty($ver)){
          http_response_code(500);
          exit;
        }

        $this->load->library('migration');
        if ($this->migration->version($ver) === false) {
            show_error($this->migration->error_string());
        } else {
            echo "Berhasil";
        }
    }

    public function seeder()
    {
        $this->load->database();
        $this->load->helper('security');
        $nama = 'Pelatih';
        $username = 'pelatih';
        $password = do_hash(do_hash('1234', 'md5'));
        $level = 2;
        $this->db->insert('ms_admin',[
          'nama' => $nama,
          'username' => $username,
          'password' => $password,
          'level' => $level
        ]);
        echo "sudah";
    }

}
