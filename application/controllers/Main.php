<?php
defined('BASEPATH')or exit('No direct script access are allowed');
/**
 *
 */
class Main extends CI_Controller
{

  public function index()
  {
      $this->load->view('starter');
  }
}
