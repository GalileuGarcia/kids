<?php

/**
 * Description of Avisos
 *
 * @author galileu
 */
class Avisos_Model extends CI_Model{
   
    public function get_dados() {
        $this->db->where('situacao', 1);
        return $this->db->get('avisos')->result();
    }
    
    public function concluir($id) {
        
        $this->db->update('avisos', array(
            'situacao' => 0
        ), array(
            'id' => $id
        ));
    }
}
