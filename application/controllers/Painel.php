<?php

/**
 * Description of Painel
 *
 * @author galileu
 */
class Painel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('usuario'))) {
            redirect('cadastrar');
        }
    }

    public function tela() {
        $dados['criancas'] = $this->bd->getAll('criancas');
        $this->load->view('criancas_responsavel', $dados);
    }
  
}
