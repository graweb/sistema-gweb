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
		<h1 style="text-align:center">Relatório de Usuários</h1></td>
		<h5 style="text-align:right">Gerado em: <?php echo date('d/m/Y h:i:s');?></h5></td>
		<table class="table">
			<thead>
				<tr>
					<th style="width:20px">CÓDIGO</th>
					<th style="width:60px">CLIENTE</th>
					<th style="width:45px">NOME</th>
					<th style="width:45px">USUÁRIO</th>
					<th style="width:40px">SITUAÇÃO</th>
					<th style="width:30px">DATA CADASTRO</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					foreach ($gerarPdfUsuarios as $relUsu) {
						$dataHora = date('d/m/Y', strtotime($relUsu->data_cadastro));
						switch ($relUsu->situacao) {
						    case 1:
						        $situacao = "ATIVO";
						        break;
						    case 0:
						        $situacao = "INATIVO";
						        break;
						}
						echo '<tr>';
						echo '<td>' . $relUsu->id_usuario . '</td>';
						echo '<td>' . $relUsu->nome_cliente . '</td>';
						echo '<td>' . $relUsu->nome . '</td>';
						echo '<td>' . $relUsu->usuario . '</td>';
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