<?php
/**
 *
 */
class Tilitapahtuma_model extends CI_model
{
  function get_tilitapahtuma($id){
    $this->db->select('*');
    $this->db->from('Tilitapahtuma');
    if($id !== NULL) {
      $this->db->where('TapahtumaID',$id);
    }
    return $this->db->get()->result_array();
  }
  function add_tilitapahtuma($add_data){
    $this->db->insert('Tilitapahtuma',$add_data);
    if($this->db->insert_id()!==NULL){
      return $this->db->insert_id(); 
    }
    else {
      return FALSE;
    }  
  }
  function update_tilitapahtuma($id, $update_data){
    $this->db->where('TapahtumaID',$id);
    $this->db->update('Tilitapahtuma',$update_data);
    if($this->db->affected_rows()>0){
      return TRUE; 
    }
    else {
      return FALSE;
    }
  }

  function delete_tilitapahtuma($id){
    $this->db->where('TapahtumaID',$id);
    $this->db->delete('Tilitapahtuma');
    if($this->db->affected_rows()>0){
      return TRUE; 
    }
    else {
      return FALSE;
    }
  }


}