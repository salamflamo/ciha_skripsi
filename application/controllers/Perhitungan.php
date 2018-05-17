<?php
defined('BASEPATH')or exit('No direct script access are allowed');
/**
 *
 */
class Perhitungan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function tampil()
    {
        $data = $this->db->get('ms_target')->result_array();
        // print_r($data);
        foreach ($data[0] as $key => $value) {
          echo $key." : ".$value."<br>";
        }
    }

}
