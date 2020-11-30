<?php
/**
 *
 */
class Omistaja_model extends CI_model
{
  function get_omistaja($id){
    $this->db->select('*');
    $this->db->from('Omistaja');
    if($id !== NULL) {
      $this->db->where('OmistajaID',$id);
    }
    return $this->db->get()->result_array();
  }
  function add_omistaja($add_data){
    $this->db->insert('Omistaja',$add_data);
    if($this->db->insert_id()!==NULL){
      return $this->db->insert_id(); 
    }
    else {
      return FALSE;
    }  
  }
  
  function update_omistaja($id, $update_data){
    $this->db->where('OmistajaID',$id);
    $this->db->update('Omistaja',$update_data);
    if($this->db->affected_rows()>0){
      return TRUE; 
    }
    else {
      return FALSE;
    }
  }

  function delete_omistaja($id){
    $this->db->where('OmistajaID',$id);
    $this->db->delete('Omistaja');
    if($this->db->affected_rows()>0){
      return TRUE; 
    }
    else {
      return FALSE;
    }
  }


}