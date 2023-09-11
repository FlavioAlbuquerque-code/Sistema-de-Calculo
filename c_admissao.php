<?php
//Rendereiza a classe não permitindo o acesso direto via brawser
defined('BASEPATH') or exit('No direct script access allowed');

class C_admissao extends CI_Controller
{
	public function admissao()
	{
		$dados = array('titulo_pagina' => 'Cálculo Admissional', 'render' => 0);
		$this->load->view('interfaces/secretaria/admissao/v_admissao', $dados);
	}

	public function calculodepercentual($dependentes = 0, $categoria)
	{
		$diaatual = date("d");
		$m = date('m');
		$m = number_format($m, 0);
		$y = date('Y');
		$diasdomes = cal_days_in_month(CAL_GREGORIAN, ($m), ($y));
		$dependentes = $dependentes ? $dependentes : 0;
		$cat = $categoria;
		$d = $cat * ($dependentes / 10);
		$semDependente = $cat / $diasdomes * ($diasdomes - $diaatual + 1);
		$comDependente = ($cat + $d) / $diasdomes * ($diasdomes - $diaatual + 1);
		$dep = $comDependente - $semDependente;
		$dias = ($diasdomes - $diaatual + 1);
		$msalid = ($cat + $d);

		$dados = array(
			'cat' => $cat,
			'semDependente' => number_format($semDependente, 2, ',', '.'),
			'dep' => number_format($dep, 2, ',', '.'),
			'diaatual' => $diaatual,
			'm' => $m,
			'y' => $y,
			'diasdomes' => $diasdomes,
			'dias' => $dias,
			'comDependente' => number_format($comDependente, 2, ',', '.'),

			'titulo_pagina' => 'calculo de admissao',
			'render' => 1,
			'dependentes' => $dependentes,
			'msalid' => number_format($msalid, 2, ',', '.'));

		echo json_encode($dados);
		//$this->load->view('interfaces/secretaria/admissao/v_admissao', $dados);
	}
}
