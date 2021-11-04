<html>
<head>
<title>Gweb - Gestão de Serviços</title>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<style type="text/css">
body {
	font-family: "Times New Roman", Georgia, Serif;
	font-size: 10px;
}

.table {
	width: 100%;
}

th {
	background-color: #CCCCCC;
	font-weight: bold;
	text-align: center;
}
</style>
<body>
	<div>
		<img src="<?php echo base_url()?>assets/images/logo.png" width="100px" height="40px" />
		<h1 style="text-align:center">Relatório de Demandas que Geraram Problema</h1></td>
		<h5 style="text-align:right">Gerado em: <?php echo date('d/m/Y h:i:s');?></h5></td>
		<table class="table">
			<thead>
				<tr>
					<th style="width:20px">CÓDIGO</th>
					<th style="width:50px">USUÁRIO</th>
					<th style="width:100px">ASSUNTO</th>
					<th style="width:30px">SITUAÇÃO</th>
					<th style="width:30px">DATA/HORA</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					foreach ($demandasQueGeraramProblemas as $gerouProb) {
						$dataHora = date('d/m/Y', strtotime($gerouProb->data_hora));
						switch ($gerouProb->situacao) {
						    case 1:
						        $situacao = "ABERTO";
						        break;
						    case 2:
						        $situacao = "EM ANÁLISE";
						        break;
						    case 3:
						        $situacao = "CONCLUÍDO";
						        break;
						    case 4:
						        $situacao = "CANCELADO";
						        break;
						}
						echo '<tr>';

						if($gerouProb->cod_incidente == null) {
							echo '<td style="text-align:center"> R - ' . $gerouProb->cod_requisicao . '</td>';
						} else {
							echo '<td style="text-align:center"> I - ' . $gerouProb->cod_incidente . '</td>';
						}

						echo '<td>' . $gerouProb->usuario . '</td>';
						echo '<td>' . $gerouProb->assunto . '</td>';
						echo '<td>' . $situacao . '</td>';
						echo '<td style="text-align:center">' . $dataHora . '</td>';
						echo '</tr>';
						$i++;
					}
				?>
			</tbody>
		</table>
		<hr></hr>
		<?php echo 'Nº Registros: ' . $i; ?>
	</div>
</body>
</html>