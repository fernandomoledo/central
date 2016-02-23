<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_usuario extends CI_Model {
	function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
    	  $this->db2 = $this->load->database('oracle', TRUE);  
    }

   
  public function get_login($username = ""){
      $sql = "select * from portal p where p.login = '$username'";
      $res = $this->db2->query($sql);
      return $res->row_array();
   }
}
