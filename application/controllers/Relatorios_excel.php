<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios_excel extends CI_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('relatorios_excel_model', '', TRUE);
    }

    // TODAS AS DEMANDAS POR DATA EXCEL
	function demandasPorDataExcel()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "USUÁRIO", "ASSUNTO", "SITUAÇÃO", "DATA/HORA");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->demandasPorDataExcel();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y H:i:s', strtotime($linha->data_hora));
			switch ($linha->situacao) {
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

			if(empty($linha->cod_incidente)) {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_requisicao);
			} else {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_incidente);
			}
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->usuario);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->assunto);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de todas as Demandas por Data.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODAS AS DEMANDAS POR ANALISTA EXCEL
	function demandasPorAnalistaExcel()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "USUÁRIO", "ASSUNTO", "SITUAÇÃO", "DATA/HORA");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->demandasPorAnalistaExcel();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y H:i:s', strtotime($linha->data_hora));
			switch ($linha->situacao) {
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

			if(empty($linha->cod_incidente)) {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_requisicao);
			} else {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_incidente);
			}
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->usuario);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->assunto);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de todas as Demandas por Analista.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODAS AS DEMANDAS POR USUÁRIO EXCEL
	function demandasPorUsuarioExcel()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "USUÁRIO", "ASSUNTO", "SITUAÇÃO", "DATA/HORA");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->demandasPorUsuarioExcel();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y H:i:s', strtotime($linha->data_hora));
			switch ($linha->situacao) {
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

			if(empty($linha->cod_incidente)) {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_requisicao);
			} else {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_incidente);
			}
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->usuario);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->assunto);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de todas as Demandas por Usuário.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODAS AS DEMANDAS POR SITUAÇÃO EXCEL
	function demandasPorSituacaoExcel()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "USUÁRIO", "ASSUNTO", "SITUAÇÃO", "DATA/HORA");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->demandasPorSituacaoExcel();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y H:i:s', strtotime($linha->data_hora));
			switch ($linha->situacao) {
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

			if(empty($linha->cod_incidente)) {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_requisicao);
			} else {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_incidente);
			}
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->usuario);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->assunto);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de todas as Demandas por Situação.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODAS AS DEMANDAS QUE TIVERAM A PESQUISA DE SATISFAÇÂO PREENCHIDA EXCEL
	function demandasPesqSatisfPreenchidaExcel()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "USUÁRIO", "ASSUNTO", "SITUAÇÃO", "DATA/HORA");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->demandasPesqSatisfPreenchidaExcel();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y H:i:s', strtotime($linha->data_hora));
			switch ($linha->situacao) {
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

			if(empty($linha->cod_incidente)) {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_requisicao);
			} else {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_incidente);
			}
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->usuario);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->assunto);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de Demandas por Pesquisa de Satisfação preenchida.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODAS AS DEMANDAS QUE GERARAM MUDANÇA EXCEL
	function demandasQueGeraramMudancasExcel()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "USUÁRIO", "ASSUNTO", "SITUAÇÃO", "DATA/HORA");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->demandasQueGeraramMudancasExcel();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y H:i:s', strtotime($linha->data_hora));
			switch ($linha->situacao) {
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

			if(empty($linha->cod_incidente)) {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_requisicao);
			} else {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_incidente);
			}
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->usuario);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->assunto);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de Demandas que Geraram Mudança.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODAS AS DEMANDAS QUE GERARAM PROBLEMA EXCEL
	function demandasQueGeraramProblemasExcel()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "USUÁRIO", "ASSUNTO", "SITUAÇÃO", "DATA/HORA");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->demandasQueGeraramProblemasExcel();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y H:i:s', strtotime($linha->data_hora));
			switch ($linha->situacao) {
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

			if(empty($linha->cod_incidente)) {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_requisicao);
			} else {
				$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->cod_incidente);
			}
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->usuario);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->assunto);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de Demandas que Geraram Problema.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODOS OS CLIENTES EM EXCEL
	function gerarExcelClientes()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "NOME CLIENTE", "DOCUMENTO", "SITUAÇÃO", "DATA CADASTRO");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->gerarExcelClientes();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y', strtotime($linha->data_cadastro));
			switch ($linha->situacao) {
			    case 1:
			        $situacao = "ATIVO";
			        break;
			    case 0:
			        $situacao = "INATIVO";
			        break;
			}

			$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->id_cliente);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->nome_cliente);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->documento);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de Clientes.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODOS OS NÍVEL DE ATENDIMENTO EM EXCEL
	function gerarExcelNivelAtendimento()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "NÍVEL", "OBSERVAÇÕES", "SITUAÇÃO", "DATA CADASTRO");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->gerarExcelNivelAtendimento();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y', strtotime($linha->data_cadastro));
			switch ($linha->situacao) {
			    case 1:
			        $situacao = "ATIVO";
			        break;
			    case 0:
			        $situacao = "INATIVO";
			        break;
			}

			$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->id_nivel_atendimento);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->nivel);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->observacoes);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de Acordo de Nível de Atendimento.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODOS OS NÍVEL DE ACORDO DE NÍVEL DE SERVIÇO EXCEL
	function gerarExcelAcordoNivelServico()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "CLIENTE", "TAREFA", "SITUAÇÃO", "DATA CADASTRO");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->gerarExcelAcordoNivelServico();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y', strtotime($linha->data_cadastro));
			switch ($linha->situacao) {
			    case 1:
			        $situacao = "ATIVO";
			        break;
			    case 0:
			        $situacao = "INATIVO";
			        break;
			}

			$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->id_acordo_nivel_servico);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->nome_cliente);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->tarefa);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de Acordo de Nível de Serviço.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODOS OS FLUXO DE MUDANÇA EM EXCEL
	function gerarExcelFluxoMudanca()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "NOME", "DESCRIÇÃO", "SITUAÇÃO", "DATA CADASTRO");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->gerarExcelFluxoMudanca();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y', strtotime($linha->data_cadastro));
			switch ($linha->situacao) {
			    case 1:
			        $situacao = "ATIVO";
			        break;
			    case 0:
			        $situacao = "INATIVO";
			        break;
			}

			$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->id_fluxo_mudanca);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->nome);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->descricao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de Fluxo de Mudança.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODOS OS DEPARTAMENTOS EM EXCEL
	function gerarExcelDepartamentos()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "NOME", "DESCRIÇÃO", "SITUAÇÃO", "DATA CADASTRO");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->gerarExcelDepartamentos();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y', strtotime($linha->data_cadastro));
			switch ($linha->situacao) {
			    case 1:
			        $situacao = "ATIVO";
			        break;
			    case 0:
			        $situacao = "INATIVO";
			        break;
			}

			$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->id_departamento);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->nome_departamento);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->observacoes);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de Departamentos.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}

	// TODOS OS USUÁRIOS EM EXCEL
	function gerarExcelUsuarios()
	{
		$this->load->library("Excel");
		$objeto = new PHPExcel();
		$objeto->setActiveSheetIndex(0);
		$colunas = array("CÓDIGO", "CLIENTE", "NOME", "USUÁRIO", "SITUAÇÃO", "DATA CADASTRO");
		$coluna = 0;

		foreach($colunas as $campo)
		{
			$objeto->getActiveSheet()->setCellValueByColumnAndRow($coluna, 1, $campo);
			$coluna++;
		}

		$dadosRel = $this->relatorios_excel_model->gerarExcelUsuarios();
		$excel_linha = 2;

		foreach($dadosRel as $linha)
		{
			$dataHora = date('d/m/Y', strtotime($linha->data_cadastro));
			switch ($linha->situacao) {
			    case 1:
			        $situacao = "ATIVO";
			        break;
			    case 0:
			        $situacao = "INATIVO";
			        break;
			}

			$objeto->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_linha, $linha->id_usuario);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_linha, $linha->nome_cliente);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_linha, $linha->nome);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_linha, $linha->usuario);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_linha, $situacao);
			$objeto->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_linha, $dataHora);
			$excel_linha++;
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Relatório de Usuários.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		$gerar_arquivo = PHPExcel_IOFactory::createWriter($objeto, 'Excel2007');
		$gerar_arquivo->save('php://output');
	}
}