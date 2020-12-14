<?php
/**
 *
 */
class Tilitapahtuma_model extends CI_model
{
  function nostaRahaa($first_id, $amount){
    $call_procedure="Call Otto(?,?)";
    $data=array('TilinumeroID'=>$first_id,'Saldo'=>$amount);
    $this->db->query($call_procedure, $data);
    
    return $this->db->affected_rows();

  }
  /*function raise($id, $amount){​​
    $raise_call = "CALL Otto(?, ?)";
    $data = array('id' => $id, 'amount' => $amount);
    $this->db->query($raise_call, $data);
    $result=$this->db->affected_rows();
    if ($result !== 0) {​​
      return TRUE;
    }​​
    else {​​
      return FALSE;
    }​​
}​​*/

function tietynTilintapahtuma($Tapahtumatili){
  $this->db->select('Tapahtumatyyppi, Saldonmuutos'); //muuta tämä oikeaan tietokantaan alkamaan isolla SaldonMuutos tai Saldonmuutos lokaaliin
  $this->db->from('Tilitapahtuma');
  $this->db->where('Tapahtuma_tili',$Tapahtumatili);
  
  return $this->db->get()->result_array('Tapahtuma_tili');
}
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