<?php
$this->load->view('includes/header');
$this->load->view('includes/menutop');
$this->load->view('includes/menu');
?>
<section class="content">
<div class="box box-danger">
<div class="box box-danger">
        <div class="box-header with-border">
		<label>Quantos filhos de 6 a 24 anos? <br /> <input id="ipt-numerico" type="number" name="dependentes" min="0" max="10"><br></label>
		<fieldset>
			<legend>Selecione a Categoria</legend>


			<button class="btn btn-info btn-flat" name="cat" id="dep" value="646" for="dep">
				 Departamental-05
			</button> <button class="btn btn-success" name="cat" id="vinc" value="323" 
				 for="vinc">
					Vinculado-07
		</fieldset><br /></label>
	</div>
    <div class="box-header with-border">
	<div id="resultado">

	</div>
</div>

<script>
	var jq = jQuery.noConflict();

	function calculaPercentual(dependentes = 0, categoria) {

		jq.ajax({
			url: '<?= base_url('secretaria/C_admissao/calculodepercentual') ?>/' + dependentes + '/' + categoria,
			type: 'GET',
			dataType: 'JSON',
			beforeSend: function() {
				jq("#resultado").html('Calculando...');
			},
			success: function(data) {
				const {
					cat,
					semDependente,
					dep,
					diaatual,
					m,
					dias,
					y,
					diasdomes,
					comDependente,
					dependentes,
					msalid
				} = data;
				jq("#resultado").html('');
				html = `
					A Mensalidade da categoria selecionada é de R$ ${cat} 
					<br/><br/>O proporcional sem dependentes é R$ ${semDependente}
					<br/><br/>O sócio tem ${dependentes} dependentes que adciona R$ ${dep}

					<br/><br/>O calculo de hoje dia ${diaatual}/${m}/${y}
					<br/><br/>O mês atual tem ${diasdomes} dias
					<br/><br/>O proporcional é referente á ${dias} dias
					<font color='#FF0000'><br><br/>Total a pagar Hoje é R$ ${comDependente}

					<br/><br/> <font color='#00008B'><br><br/>Mensalidade do próximo mês é R$ ${msalid}`;

				jq("#resultado").html(html);
			}
		});
	}
	

	function executar(element) {
		jq(element).on("click", function() {
			var qtdDependentes = jq("#ipt-numerico").val() | 0;

			calculaPercentual(qtdDependentes, jq(this).val());

		});
	}

	jq(document).ready(function() {
		executar('#dep');
		executar('#vinc');
	});
</script>


<script type="text/javascript">
    var jq = jQuery.noConflict();
</script>
<div class="row no-print">
                            <div class="col-xs-12">
                                <a href="#" class="btn btn-default pull-right" id="btn-impressao"><i class="fa fa-print text-danger"></i><font style="vertical-align: inherit;"><font class="text-danger" style="vertical-align: inherit;"> Impressão</font></font></a>
                            </div>
                        </div>

                    </div>


					<script type='text/javascript'>

					jq("#btn-impressao").on("click", function(){
            var resultado = jq("#resultado").html('');
            if (resultado !== "#resultado") {
                abrir_relatorio("https://app.decn.org.br/sistemas/secretaria/C_admissao/admissao#/"+ resultado);
            } else {
                alert("Faça ao menos uma Busca!");
                jq("#campo-pesquisa").focus();
            }
        });
		</script>	
