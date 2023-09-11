<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_calculocat33 extends CI_Controller
{
    public function admissao()
    {
        $dados = array('titulo_pagina' => 'Cálculo Convidado Especial Categoria 33', 'render' => 0);
        $this->load->view('interfaces/secretaria/admissao/v_calculoperiodico', $dados);
    }

    public function calculocat33($dependentes = 0, $categoria)
    {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        // Transformando as datas em objetos DateTime
        $startDateObj = new DateTime($startDate);
        $endDateObj = new DateTime($endDate);

        // Calculando a diferença em dias entre as datas
        $interval = $startDateObj->diff($endDateObj);
        $dias = $interval->days + 1;

        // Obter o número de dias no mês da data de início
        $diasNoMes = cal_days_in_month(CAL_GREGORIAN, $startDateObj->format('m'), $startDateObj->format('Y'));

        // Realize os cálculos com base em $categoria e $dias
        $cat = floatval($categoria);
        $d = $cat * ($dependentes / 10);

        $semDependente = ($cat / $diasNoMes) * $dias;
        $comDependente = (($cat + $d) / $diasNoMes) * $dias;
        $dep = $comDependente - $semDependente;
        $msalid = $cat + $d;

        $dados = array(
            'cat' => $cat,
            'semDependente' => number_format($semDependente, 2, '.', ''),
            'comDependente' => number_format($comDependente, 2, '.', ''),
            'dep' => number_format($dep, 2, '.', ''),
            'msalid' => number_format($msalid, 2, '.', ''),
            'dias' => $dias // Número de dias utilizados no cálculo
        );

        echo json_encode($dados);
    }


}
