<?php

function session($sessao) {
    $CI =& get_instance();
    $CI->load->library('session');
    return $CI->session->userdata($sessao)[0];
}

function calcularIdade($dataNascimento) {
    // Cria objetos DateTime para a data de nascimento e a data atual
    $dataNascimento = new DateTime($dataNascimento);
    $dataAtual = new DateTime();

    // Calcula o intervalo entre as duas datas
    $intervalo = $dataNascimento->diff($dataAtual);

    // Retorna a idade em anos
    return $intervalo->y;
}

function sala($idade) {

	if ($idade < 3) {
		return 'BABY';
	} else if ($idade >= 3 and $idade <= 6) {
		return 'KIDS 1';
	} else if ($idade >= 7) {
		return 'KIDS 2';
	}
}

function simNao($condicao) {
	if ($condicao == 'S') {
		return 'SIM';
	} else {
		return 'NÃO';
	}
}

if (!function_exists('tbl')) {

    function tbl($tbl, $condicao = NULL, $order = NULL) {
        $CI = &get_instance();
        if (!empty($condicao)) {
            $CI->db->where($condicao);
        }
        if (!empty($order)) {
            $CI->db->order_by($order[0],$order[1]);
        }
        return $CI->db->get($tbl)->result();
    }

}
