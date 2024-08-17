<?php

//

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function logar()
    {
        $this->form_validation->set_rules('usuario', 'usuario', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('senha', 'senha', 'required|max_length[30]');

        if ($this->form_validation->run() === FALSE) {
            $errors = $this->form_validation->error_array();
            echo json_encode(['status' => 'erro-form', 'errors' => $errors]);
        } else {

            $usuario = $this->bd->getBy(
                'usuarios',
                [
                    'usuario' => $this->input->post('usuario', TRUE),
                    'senha' => md5($this->input->post('senha', TRUE)),
                ]
            );
            if (empty($usuario)) {
                echo json_encode(['status' => false, 'mensagem' => 'Por favor, verifique o seu usuário ou senha']);
            } else {
                $this->session->set_userdata('usuario', $usuario);
                echo json_encode(['status' => true, 'mensagem' => 'Login realizado com sucesso']);
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(); // Assumindo que você tem um controlador chamado 'Login'.
    }
}
