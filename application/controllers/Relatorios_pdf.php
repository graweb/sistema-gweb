<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios_pdf extends MY_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('relatorios_pdf_model', '', TRUE);
    }

    // TODAS AS DEMANDAS POR DATA
    public function demandasPorData()
    {
        // CARREGA AS INFRMAÇÕES
        $data['demandasMes'] = $this->relatorios_pdf_model->demandasPorData();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/demandasPorData', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de todos as Demandas do Mês - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // TODOS AS DEMANDAS POR ANALISTA
    public function demandasPorAnalista()
    {
        // CARREGA AS INFRMAÇÕES
        $data['demandasAnalista'] = $this->relatorios_pdf_model->demandasPorAnalista();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/demandasPorAnalista', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de todos as Demandas do Analista - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // TODOS AS DEMANDAS POR USUÁRIO
    public function demandasPorUsuario()
    {
        // CARREGA AS INFRMAÇÕES
        $data['demandasUsuario'] = $this->relatorios_pdf_model->demandasPorUsuario();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/demandasPorUsuario', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de todos as Demandas do Usuário - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // TODOS AS DEMANDAS POR SITUAÇÃO
    public function demandasPorSituacao()
    {
        // CARREGA AS INFRMAÇÕES
        $data['demandasSituacao'] = $this->relatorios_pdf_model->demandasPorSituacao();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/demandasPorSituacao', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de todos as Demandas por Situação - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // TODOS AS DEMANDAS QUE TIVERAM A PESQUISA DE SATISFAÇÃO PREENCHIDA
    public function demandasPesqSatisfPreenchida()
    {
        // CARREGA AS INFRMAÇÕES
        $data['demandasPesqSatisfPreenchida'] = $this->relatorios_pdf_model->demandasPesqSatisfPreenchida();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/demandasPesqSatisfPreenchida', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de todos as Demandas que tiveram a Pesquisa de Satisfação preenchida - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // TODOS AS DEMANDAS QUE TIVERAM A PESQUISA DE SATISFAÇÃO PREENCHIDA
    public function demandasQueGeraramMudancas()
    {
        // CARREGA AS INFRMAÇÕES
        $data['demandasQueGeraramMudancas'] = $this->relatorios_pdf_model->demandasQueGeraramMudancas();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/demandasQueGeraramMudancas', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de todos as Demandas que geraram Mudança - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // TODOS AS DEMANDAS QUE TIVERAM A PESQUISA DE SATISFAÇÃO PREENCHIDA
    public function demandasQueGeraramProblemas()
    {
        // CARREGA AS INFRMAÇÕES
        $data['demandasQueGeraramProblemas'] = $this->relatorios_pdf_model->demandasQueGeraramProblemas();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/demandasQueGeraramProblemas', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de todos as Demandas que geraram Mudança - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // RELATÓRIO DOS CLIENTES
    public function gerarPdfClientes()
    {
        // CARREGA AS INFRMAÇÕES
        $data['gerarPdfClientes'] = $this->relatorios_pdf_model->gerarPdfClientes();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/gerarPdfClientes', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de Clientes - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // RELATÓRIO DE NÍVEL DE ATENDIMENTO
    public function gerarPdfNivelAtendimento()
    {
        // CARREGA AS INFRMAÇÕES
        $data['gerarPdfNivelAtendimento'] = $this->relatorios_pdf_model->gerarPdfNivelAtendimento();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/gerarPdfNivelAtendimento', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de Nível de Atendimento - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // RELATÓRIO DE NÍVEL DE ACORDO DE NÍVEL DE SERVIÇO
    public function gerarPdfAcordoNivelServico()
    {
        // CARREGA AS INFRMAÇÕES
        $data['gerarPdfAcordoNivelServico'] = $this->relatorios_pdf_model->gerarPdfAcordoNivelServico();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/gerarPdfAcordoNivelServico', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de Acordo de Nível de Serviço - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // GERAR O RELATÓRIO DE FLUXO DE MUDANÇA
    public function gerarPdfFluxoMudanca()
    {
        // CARREGA AS INFRMAÇÕES
        $data['gerarPdfFluxoMudanca'] = $this->relatorios_pdf_model->gerarPdfFluxoMudanca();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/gerarPdfFluxoMudanca', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de Fluxo de Mudança - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // GERAR O RELATÓRIO DE DEPARTAMENTOS
    public function gerarPdfDepartamentos()
    {
        // CARREGA AS INFRMAÇÕES
        $data['gerarPdfDepartamentos'] = $this->relatorios_pdf_model->gerarPdfDepartamentos();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/gerarPdfDepartamentos', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de Departamentos - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // GERAR O RELATÓRIO DE USUÁRIOS
    public function gerarPdfUsuarios()
    {
        // CARREGA AS INFRMAÇÕES
        $data['gerarPdfUsuarios'] = $this->relatorios_pdf_model->gerarPdfUsuarios();
        
        //CARREGA A PÁGINA FORMATADA
        $html=$this->load->view('relatorios/imprimir_pdf/gerarPdfUsuarios', $data, true);
         
        //NOME DO ARQUIVO
        $pdfFilePath = "Relatório de Usuários - gerado em ". date('d/m/Y');
         
        //CARREGA A BIBLIOTECA
        $this->load->library('M_pdf');
         
        //GERA O ARQUIVO EM HTML
        $this->m_pdf->pdf->WriteHTML($html);
         
        //SAÍDA PARA DOWNLOAD
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }
}