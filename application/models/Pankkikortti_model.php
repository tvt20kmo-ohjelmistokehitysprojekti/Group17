<?php
/**
 *
 */
class Pankkikortti_model extends CI_model
{
  
  function get_Tunnusluku($KortinID)
  {
    $this->db->select('Tunnusluku');
    $this->db->from('Pankkikortti');
    $this->db->where('KortinID',$KortinID);
    return $this->db->get()->row('Tunnusluku');
  }
  function get_Tilinumero($KortinID)
  {
    $this->db->select('Tili');
    $this->db->from('Pankkikortti');
    $this->db->where('KortinID',$KortinID);
    return $this->db->get()->row('Tili');
  }
  function get_pankkikortti($id){
    $this->db->select('*');
    $this->db->from('Pankkikortti');
    if($id !== NULL) {
      $this->db->where('KortinID',$id);
    }
    return $this->db->get()->result_array();
  }
  function add_pankkikortti($add_data){
    $this->db->insert('Pankkikortti',$add_data);
    if($this->db->insert_id()!==NULL){
      return $this->db->insert_id(); 
    }
    else {
      return FALSE;
    }  
  }
  function update_pankkikortti($id, $update_data){
    $this->db->where('KortinID',$id);
    $this->db->update('Pankkikortti',$update_data);
    if($this->db->affected_rows()>0){
      return TRUE; 
    }
    else {
      return FALSE;
    }
  }

  function delete_pankkikortti($id){
    $this->db->where('KortinID',$id);
    $this->db->delete('Pankkikortti');
    if($this->db->affected_rows()>0){
      return TRUE; 
    }
    else {
      return FALSE;
    }
  }


}