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

}
