<?php

class Avisos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('FireBasePush');
    }

    public function concluir() {
        $this->load->model("Avisos_Model", "aviso");

        $this->aviso->concluir($this->input->post('id'));

        echo json_encode(['mensagem' => 'Registro atualizado com sucesso!', 'id' => $this->input->post('id'), 'html' => $this->obtemAvisos()]);
    }

    public function imagemAviso() {
        $avisos = $this->bd->getBy('avisos', array(
                    'id' => $this->input->post('id')
                ))[0];

        $urlImagem = base_url('assets/uploads/');

        $html = '<img src="' . $urlImagem . $avisos->imagem . '" width="80%" alt="alt"/>';

        echo json_encode($html);
    }

    public function avisosAjax() {
        echo json_encode(['mensagem' => 'Registro atualizado com sucesso!', 'html' => $this->obtemAvisos()]);
    }

    public function obtemAvisos() {
        $avisos = $this->bd->getBy('avisos', array(
            'situacao' => 1
        ));

        $html = "";
        $urlImagem = base_url('assets/uploads/');
        if (!empty($avisos)) {
            foreach ($avisos as $av) {
                $html .= '<div class="col-md-3 aviso-' . $av->id . '" style="margin-bottom: 3%">
                            <div class="card border-left-primary shadow py-2" style="border-radius: 20px">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-uppercase mb-1">
                                                 ' . $av->aviso . '
                                            </div>
                                            <div class="mb-0 font-weight-bold text-gray-800">
                                                CRIADO POR: ' . $av->criado . '
                                            </div>
                                            <a href="#" class="btn btn-primary btn-circle btn-copiar-texto"
                                               data-texto="' . $av->aviso . '">
                                                <i class="fa-regular fa-copy"></i>
                                            </a>
                                            <a href="#" class="btn btn-success btn-circle btn-concluir"
                                               data-id="' . $av->id . '">
                                                <i class="fas fa-check"></i>
                                            </a>';

                if (!empty($av->imagem)) {
                    $html .= '                  <a href="#" class="btn btn-info btn-circle btn-img"
                                                   data-id="' . $av->id . '">
                                                    <i class="fa-solid fa-image"></i>
                                                </a>';
                }
                $html .= '                              
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
        } else {
            $html = '<div class="col-md-3">
                        <div class="alert alert-info" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i> Nenhum aviso cadastrado
                        </div>
                    </div>';
        }

        return $html;
    }

    public function avisa() {
        
        if (empty(session('usuario'))) {
            redirect();
        }
        
        $avisos = $this->bd->getBy('avisos', array(
            'situacao' => 1
        ));
        $this->load->view('avisos', ['avisos' => $avisos]);
    }
    
    public function reenviarAviso() {

        if ($this->input->post('op') == 1) {
         
        $this->firebasepush->notifica('AVISO', $this->input->post('texto'), '');    

        } else {
            
            $this->db->update('avisos', array(
                'situacao' => 0
            ), array(
                'id' => $this->input->post('id')
            ));
            
            echo json_encode(['mensagem' => 'Registro atualizado com sucesso!', 'id' => $this->input->post('id')]);
        }
    }
    
    private function kids() {

        $this->form_validation->set_rules('responsavel', 'responsável', 'max_length[30]');
        $this->form_validation->set_rules('crianca', 'criança', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('sala', 'sala', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('form-erro', validation_errors());
            redirect('avisos');
        } else {

            $ministerio = $this->bd->getBy('ministerios', ['id' => session('usuario')->id_ministerio]);

            $responsavel = $this->input->post('responsavel');
            $nome_crianca = $this->input->post('crianca');
            $local = $this->input->post('sala');

            $mensagem = $ministerio[0]->template;

            $mensagem = str_replace('responsavel', strtoupper($responsavel), $mensagem);
            $mensagem = str_replace('nome_crianca', strtoupper($nome_crianca), $mensagem);
            $mensagem = str_replace('local', strtoupper($local), $mensagem);
            
            $this->bd->create('avisos',
                    array(
                        'aviso' => $mensagem,
                        'ministerio' => $ministerio[0]->nome,
                        'criado' => session('usuario')->nome,
                        'situacao' => 1,
            ));

            $this->firebasepush->notifica($ministerio[0]->nome, $mensagem, base_url('assets/img/aviso-kids.jpg'));

            $this->session->set_flashdata('success', '<i class="fa-solid fa-circle-check"></i> Aviso enviado com sucesso');

            redirect('avisos');
        }
    }

    public function uploadImagem() {
        $config['upload_path'] = './assets/uploads/'; // Caminho da pasta onde a imagem será salva
        $config['allowed_types'] = 'jpeg|jpg|png|gif'; // Tipos de imagem permitidos
        $config['max_size'] = 2048; // Tamanho máximo em kilobytes
        $config['file_name'] = time(); // Renomeia o arquivo para um timestamp

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('imagem')) {
            // Falha no upload
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);

            redirect('avisos');
        } else {
            // Sucesso no upload
            $data = array('upload_data' => $this->upload->data());
            $nomeImagem = $data['upload_data']['file_name']; // Obtém o nome do arquivo

            return $nomeImagem;
        }
    }

    private function diaconia() {
        $this->form_validation->set_rules('placaCarro', 'placa do carro', 'required|trim|max_length[8]');
        $this->form_validation->set_rules('corCarro', 'cor do carro', 'trim|max_length[10]');
        $this->form_validation->set_rules('modeloCarro', 'modelo do carro', 'trim|max_length[20]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('form-erro', validation_errors());
            redirect('avisos');
        } else {
            $imagem = "";
            if (!empty($_FILES['imagem']['name'])) {
                $imagem = $this->uploadImagem();
            }
            $ministerio = $this->bd->getBy('ministerios', ['id' => session('usuario')->id_ministerio]);

            $modeloCarro = mb_strtoupper($this->input->post('modeloCarro'));
            $corCarro = mb_strtoupper($this->input->post('corCarro'));
            $placaCarro = mb_strtoupper($this->input->post('placaCarro'));

            // RECUPERA O TEMPLATE DA MENSAGEM

            $mensagem = str_replace('modelo', $modeloCarro, $ministerio[0]->template);
            $mensagem = str_replace('cor', $corCarro, $mensagem);
            $mensagem = str_replace('placa', $placaCarro, $mensagem);
            // INSERE A MENSAGEM PARA SER EXIBIDA NA TELA DOS AVISOS DE QUEM ESTÁ SERVINDO NA PROJEÇÃO

            $this->bd->create('avisos',
                    array(
                        'aviso' => $mensagem,
                        'ministerio' => $ministerio[0]->nome,
                        'criado' => session('usuario')->nome,
                        'situacao' => 1,
                        'imagem' => $imagem
            ));

            $this->firebasepush->notifica($ministerio[0]->nome, $mensagem, base_url('assets/img/aviso.jpg'));

            $this->session->set_flashdata('success', '<i class="fa-solid fa-circle-check"></i> Aviso enviado com sucesso');

            redirect('avisos');
        }
    }

    public function cadastrarAviso() {
        if (session('usuario')->id_ministerio == 1) {
            $this->diaconia();
        } else {
            $this->kids();
        }
    }
}
