<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Login extends REST_Controller {
  public function index_get()  // kutsussa pelkkä login
  {
    $this->load->model('Pankkikortti_model');
      $KortinID = $this->input->get('KortinID');
      $Tunnusluku = $this->input->get('Tunnusluku');
      $oikeatunnusluku=$this->Pankkikortti_model->get_Tunnusluku($KortinID);
      if($oikeatunnusluku == $Tunnusluku)
      {
          $result = true;
      }
      else
      {
          $result = false;
      }
      echo json_encode($result);
  }
}
