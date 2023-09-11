<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/menutop'); ?>
<?php $this->load->view('includes/menu'); ?>

<!DOCTYPE html>
<section class="content">
<html><div class="box box-danger">
<head>
<div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Seleção de Datas</h3>
        </div>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<div class="box-header with-border">
<body>
    <form id="dateSelectorForm"><br>
        <label for="startDate">Data de Início:</label>
        <input type="date" id="startDate" name="startDate">
        
        <label for="endDate">Data de Término:</label>
        <input type="date" id="endDate" name="endDate">
        
        <br><label><br>Quantos filhos de 6 a 24 anos? </label>
        <br>
        <input id="ipt-numerico" type="number" name="dependentes" min="0" max="10">
        <br>

        <fieldset>
            <legend>Selecione a Categoria</legend>
            <button class="btn btn-info btn-flat" name="cat" id="dep" value="646">
                Departamental-05
            </button>
            <button class="btn btn-success" name="cat" id="vinc" value="323">
                Vinculado-07
            </button>
        </fieldset>
    </form>

    <div class="content">
        <div id="resultado"></div>
    </div>

    <script>
        var jq = jQuery.noConflict();

        function calculocat33(dependentes = 0, categoria) {
            var startDate = jq("#startDate").val();
            var endDate = jq("#endDate").val();

            jq.ajax({
                url: '<?= base_url('index.php/secretaria/C_calculocat33/calculocat33') ?>/' + dependentes + '/' + categoria,
                type: 'GET',
                dataType: 'JSON',
                data: { startDate: startDate, endDate: endDate },
                success: function(data) {
                    var html = `
                        A Mensalidade da categoria selecionada é de R$ ${data.cat}
                        <br><br>Proporcional sem dependentes: R$ ${data.semDependente}
                        <br>Proporcional com dependentes: R$ ${data.comDependente}
                        <br>Valor dos dependentes: R$ ${data.dep}
						<br>Foi calculado com base em ${data.dias} Dias
                       
                        <font color='#00008B'><br><br/>Total a pagar Hoje  é R$ ${data.comDependente}
                    `;

                    jq("#resultado").html(html); //<br>Mensalidade total: R$ ${data.msalid} lembrar
                }
            });
        }

        jq(document).ready(function() {
            jq("#dep, #vinc").click(function(e) {
                e.preventDefault();
                var categoria = jq(this).val();
                var dependentes = jq("#ipt-numerico").val() || 0;

                calculocat33(dependentes, categoria);
            });
        });
    </script>
</body>
</div>
	</section>
</html>



<script type="text/javascript">
    var jq = jQuery.noConflict();
</script>
