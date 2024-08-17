<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 $dir = str_replace('\application\controllers', '', __DIR__);

require_once $dir . '/vendor/autoload.php';

use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tag;

/**
 *  @property form_validation $form_validation
 *  @property input $input
 *  @property bd $bd 
 */

class Impressao extends CI_Controller {

    public function index() {
        $modelo2col = 'A4263';
        $modelo1col = 'A4262';
        $etq = 2;

        if ($etq == 1) {
            $pimaco = new Pimaco($modelo1col);
            for ($i = 0; $i < 1; $i++) {
                $tag   = new Tag();
                $html  = '<style>p{font-family: arial; margin: 0px; padding: 0px;}</style>';
                $html .=   '<p><b>60 - GALILEU SOARES GARCIA</b></p>'
                        . '<p><b>DATA DE NASCIMENTO: 09/11/1995</b></p>'
                        . '<p>TRAVESSA 14 DE MARÇO, 221 - UMARIZAL - BELÉM/PA</p>'
                        . '<p><b>CEP:</b> 68700-050</p><br>' 
                        . '<p><b>DT NECESSIDADE:'. str_repeat('&nbsp;', 15).' VOLUMES:</b></p>'
                        . '<br><br><br><br><br><br><br>'
                        . '<p><b>DIETA (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) GELADEIRA (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) FRALDAS (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</b></p>';
                $tag->p($html);
                $tag->setSize(4.2);
                $pimaco->addTag($tag);
            }
        } else {
            
			$id = $this->input->get('id');
			$crianca = $this->bd->getById('criancas', $id);
			$responsavel = $this->bd->getById('criancas_responsavel', $crianca['id_responsavel']);
            $pimaco = new Pimaco($modelo2col);

            for ($i = 0; $i < 1; $i++) {
                $tag = new Tag();
                $tag->p("<style>"
                        . "p {"
                        . "font-family: "
                        . "arial; "
                        . "font-weight: bold;"
						. "font-size: 10pt;"
                        . "}"
                        . "</style>"
						. "<br>"	
                        . "<p style='margin-top: 0%'>NOME: ".$crianca['nome']."</p>"
						. "<p style='margin-top: 0%'>IDADE: ".$crianca['idade']." ANOS</p>"
						. "<p style='margin-top: 0%'>FONE: ".$responsavel['contato']."</p>"
                        
                );
                $tag->setSize(4.5);
                $pimaco->addTag($tag);
            }
        }
        $pimaco->output();
    }

    public function etiqueta() {
        $this->load->view('welcome');
    }

    function isPar($numero) {
        return $numero % 2 === 0;
    }
}
