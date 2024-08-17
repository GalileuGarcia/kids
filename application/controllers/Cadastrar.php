<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  @property form_validation $form_validation
 *  @property input $input
 *  @property bd $bd 
 */
class Cadastrar extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function cadastro() {
        $dados['criancas'] = $this->bd->getAll('criancas');
        $this->load->view('cadastro_responsavel', $dados);
    }

    public function cadastraCrianca() {
        $this->form_validation->set_rules('nome', 'nome', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('sexo', 'sexo', 'required');
        $this->form_validation->set_rules('nome_responsavel', 'nome do responsável', 'required');
        $this->form_validation->set_rules('parentesco', 'parentesco', 'required');
        $this->form_validation->set_rules('telefone', 'telefone', 'required');
        $this->form_validation->set_rules('idade', 'idade', 'required');

        if ($this->form_validation->run() === FALSE) {
            $errors = $this->form_validation->error_array();
            echo json_encode(['status' => 'erro-form', 'errors' => $errors]);
        } else {

            $id = $this->input->post('id');

            $data = [
                'nome' => $this->input->post('nome_responsavel', TRUE),
                'id_parentesco' => $this->input->post('parentesco', TRUE),
                'contato' => $this->input->post('telefone', TRUE)
            ];

            if (empty($id)) {
                $responsavel = $this->bd->create('criancas_responsavel', $data);
            } else {
                $this->bd->update('criancas_responsavel', $data, $this->input->post('id_parentesco', TRUE));
                $responsavel = $this->input->post('id_parentesco');
            }
            $data = [
                'nome' => $this->input->post('nome', TRUE),
                'id_responsavel' => $responsavel,
                'sexo' => $this->input->post('sexo', TRUE),
                'necessidades_especiais' => $this->input->post('necessidades', TRUE),
                'descricao_necessidades_especiais' => $this->input->post('descricao_necessidades', TRUE),
                'necessidades_alimenticias' => $this->input->post('necessidades_alimenticias', TRUE),
                'descricao_necessidades_alimenticias' => $this->input->post('descricao_necessidades_alimenticias', TRUE),
                'foto' => $this->input->post('foto'),
                'idade' => $this->input->post('idade', TRUE),
            ];

            if (empty($id)) {
                $this->bd->create('criancas', $data);
            } else {
                $this->bd->update('criancas', $data, $id);
            }

            echo json_encode(['status' => true, 'mensagem' => 'Operação realizada com sucesso']);
        }
    }

    public function excluiCrianca() {
        $id_responsavel = $this->input->post('responsavel');
        $this->bd->delete('criancas_responsavel', $id_responsavel);

        $id_crianca = $this->input->post('id');
        $this->bd->delete('criancas', $id_crianca);

        echo json_encode(['status' => true, 'mensagem' => 'Operação realizada com sucesso']);
    }
}
