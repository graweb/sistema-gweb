<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios_excel_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    // TODOS AS DEMANDAS POR DATA EXCEL
    public function demandasPorDataExcel()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_demanda_excel'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_demanda_excel'));

        switch ($this->input->post('tipo_relatorio_por_data_excel')) {
            case 1:
                $this->db->select('tb_incidentes.cod_incidente, tb_usuarios.usuario, tb_incidentes.assunto, 
                tb_incidentes.situacao, tb_incidentes.data_hora');
                $this->db->from('tb_incidentes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
                $this->db->where('tb_incidentes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_incidentes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                $this->db->order_by('tb_incidentes.cod_incidente', 'asc');
                return $this->db->get()->result();
                break;
            case 2:
                $this->db->select('tb_requisicoes.cod_requisicao, tb_usuarios.usuario, tb_requisicoes.assunto, 
                    tb_requisicoes.situacao, tb_requisicoes.data_hora');
                $this->db->from('tb_requisicoes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
                $this->db->where('tb_requisicoes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_requisicoes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                $this->db->order_by('tb_requisicoes.cod_requisicao', 'asc');
                return $this->db->get()->result();
                break;
        }
    }

    // TODOS AS DEMANDAS POR ANALISTA
    public function demandasPorAnalistaExcel()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_por_analista_excel'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_por_analista_excel'));

        switch ($this->input->post('tipo_relatorio_por_analista_excel')) {
            case 1:
                $this->db->select('tb_incidentes.cod_incidente, tb_usuarios.usuario, tb_incidentes.assunto, 
                tb_incidentes.situacao, tb_incidentes.data_hora');
                $this->db->from('tb_incidentes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
                $this->db->where('tb_incidentes.id_usuario_concluido_cancelado', $this->input->post('id_analista_demanda_excel'));
                $this->db->where('tb_incidentes.situacao', $this->input->post('situacao_por_analista_excel'));
                $this->db->where('tb_incidentes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_incidentes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                $this->db->order_by('tb_incidentes.cod_incidente', 'asc');
                return $this->db->get()->result();
                break;
            case 2:
                $this->db->select('tb_requisicoes.cod_requisicao, tb_usuarios.usuario, tb_requisicoes.assunto, 
                    tb_requisicoes.situacao, tb_requisicoes.data_hora');
                $this->db->from('tb_requisicoes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
                $this->db->where('tb_requisicoes.id_usuario_concluido_cancelado', $this->input->post('id_analista_demanda_excel'));
                $this->db->where('tb_requisicoes.situacao', $this->input->post('situacao_por_analista_excel'));
                $this->db->where('tb_requisicoes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_requisicoes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                $this->db->order_by('tb_requisicoes.cod_requisicao', 'asc');
                return $this->db->get()->result();
                break;
        }
    }

    // TODOS AS DEMANDAS POR USUÁRIO
    public function demandasPorUsuarioExcel()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_por_usuario_excel'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_por_usuario_excel'));

        switch ($this->input->post('tipo_relatorio_por_usuario_excel')) {
            case 1:
                $this->db->select('tb_incidentes.cod_incidente, tb_usuarios.usuario, tb_incidentes.assunto, 
                tb_incidentes.situacao, tb_incidentes.data_hora');
                $this->db->from('tb_incidentes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
                $this->db->where('tb_incidentes.id_usuario', $this->input->post('id_usuario_demanda_excel'));
                $this->db->where('tb_incidentes.situacao', $this->input->post('situacao_por_usuario_excel'));
                $this->db->where('tb_incidentes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_incidentes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
            case 2:
                $this->db->select('tb_requisicoes.cod_requisicao, tb_usuarios.usuario, tb_requisicoes.assunto, 
                    tb_requisicoes.situacao, tb_requisicoes.data_hora');
                $this->db->from('tb_requisicoes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
                $this->db->where('tb_requisicoes.id_usuario', $this->input->post('id_usuario_demanda_excel'));
                $this->db->where('tb_requisicoes.situacao', $this->input->post('situacao_por_usuario_excel'));
                $this->db->where('tb_requisicoes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_requisicoes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
        }
    }

    // TODOS AS DEMANDAS POR SITUAÇÃO
    public function demandasPorSituacaoExcel()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_por_situacao_excel'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_por_situacao_excel'));

        switch ($this->input->post('tipo_relatorio_por_situacao_excel')) {
            case 1:
                $this->db->select('tb_incidentes.cod_incidente, tb_usuarios.usuario, tb_incidentes.assunto, 
                tb_incidentes.situacao, tb_incidentes.data_hora');
                $this->db->from('tb_incidentes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
                $this->db->where('tb_incidentes.situacao', $this->input->post('situacao_por_situacao_excel'));
                $this->db->where('tb_incidentes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_incidentes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
            case 2:
                $this->db->select('tb_requisicoes.cod_requisicao, tb_usuarios.usuario, tb_requisicoes.assunto, 
                    tb_requisicoes.situacao, tb_requisicoes.data_hora');
                $this->db->from('tb_requisicoes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
                $this->db->where('tb_requisicoes.situacao', $this->input->post('situacao_por_situacao_excel'));
                $this->db->where('tb_requisicoes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_requisicoes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
        }
    }

    // TODOS AS DEMANDAS QUE TIVERAM A PESQUISA DE SATISFAÇÃO PREENCHIDA
    public function demandasPesqSatisfPreenchidaExcel()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_pesq_satis_preenchida_excel'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_pesq_satis_preenchida_excel'));

        switch ($this->input->post('tipo_relatorio_pesq_satis_preenchida_excel')) {
            case 1:
                $this->db->select('tb_incidentes.cod_incidente, tb_usuarios.usuario, tb_incidentes.assunto, 
                tb_incidentes.situacao, tb_incidentes.data_hora');
                $this->db->from('tb_incidentes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
                $this->db->where('tb_incidentes.respondeu_pesq', 1);
                $this->db->where('tb_incidentes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_incidentes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
            case 2:
                $this->db->select('tb_requisicoes.cod_requisicao, tb_usuarios.usuario, tb_requisicoes.assunto, 
                    tb_requisicoes.situacao, tb_requisicoes.data_hora');
                $this->db->from('tb_requisicoes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
                $this->db->where('tb_requisicoes.respondeu_pesq', 1);
                $this->db->where('tb_requisicoes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_requisicoes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
        }
    }
    
    // TODOS AS DEMANDAS QUE GERARAM MUDANÇAS
    public function demandasQueGeraramMudancasExcel()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_gerou_mudanca_excel'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_gerou_mudanca_excel'));

        switch ($this->input->post('tipo_relatorio_gerou_mudanca_excel')) {
            case 1:
                $this->db->select('tb_incidentes.cod_incidente, tb_usuarios.usuario, tb_incidentes.assunto, 
                tb_incidentes.situacao, tb_incidentes.data_hora');
                $this->db->from('tb_incidentes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
                $this->db->where('tb_incidentes.gerou_mudanca', 1);
                $this->db->where('tb_incidentes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_incidentes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
            case 2:
                $this->db->select('tb_requisicoes.cod_requisicao, tb_usuarios.usuario, tb_requisicoes.assunto, 
                    tb_requisicoes.situacao, tb_requisicoes.data_hora');
                $this->db->from('tb_requisicoes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
                $this->db->where('tb_requisicoes.gerou_mudanca', 1);
                $this->db->where('tb_requisicoes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_requisicoes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
        }
    }

    // TODOS AS DEMANDAS QUE GERARAM PROBLEMAS
    public function demandasQueGeraramProblemasExcel()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_gerou_problema_excel'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_gerou_problema_excel'));

        switch ($this->input->post('tipo_relatorio_gerou_problema_excel')) {
            case 1:
                $this->db->select('tb_incidentes.cod_incidente, tb_usuarios.usuario, tb_incidentes.assunto, 
                tb_incidentes.situacao, tb_incidentes.data_hora');
                $this->db->from('tb_incidentes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
                $this->db->where('tb_incidentes.gerou_problema', 1);
                $this->db->where('tb_incidentes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_incidentes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
            case 2:
                $this->db->select('tb_requisicoes.cod_requisicao, tb_usuarios.usuario, tb_requisicoes.assunto, 
                    tb_requisicoes.situacao, tb_requisicoes.data_hora');
                $this->db->from('tb_requisicoes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
                $this->db->where('tb_requisicoes.gerou_problema', 1);
                $this->db->where('tb_requisicoes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_requisicoes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
        }
    }

    // RELATÓRIO DOS CLIENTES
    public function gerarExcelClientes()
    {
        switch ($this->input->post('tipo_relatorio_cliente_excel')) {
            case 0:
                return $this->db->get('tb_clientes')->result();
                break;
            case 1:
                $this->db->where('situacao', 1);
                return $this->db->get('tb_clientes')->result();
                break;
            case 2:
                $this->db->where('situacao', 0);
                return $this->db->get('tb_clientes')->result();
                break;
        }
    }

    // RELATÓRIO DE NÍVEL DE ATENDIMENTO
    public function gerarExcelNivelAtendimento()
    {
        switch ($this->input->post('tipo_relatorio_nivel_atendimento_excel')) {
            case 0:
                return $this->db->get('tb_nivel_atendimento')->result();
                break;
            case 1:
                $this->db->where('situacao', 1);
                return $this->db->get('tb_nivel_atendimento')->result();
                break;
            case 2:
                $this->db->where('situacao', 0);
                return $this->db->get('tb_nivel_atendimento')->result();
                break;
        }
    }

    // RELATÓRIO DE ACORDO DE NÍVEL DE SERVIÇO
    public function gerarExcelAcordoNivelServico()
    {
        $this->db->select('tb_acordo_nivel_servico.*, tb_clientes.nome_cliente');
        $this->db->from('tb_acordo_nivel_servico');
        $this->db->join('tb_clientes','tb_clientes.id_cliente = tb_acordo_nivel_servico.id_cliente');
        $this->db->where('tb_acordo_nivel_servico.id_cliente', $this->input->post('id_cliente_rel_acordo_nivel_de_servico_excel'));
        return $this->db->get()->result();
    }

    // GERAR O RELATÓRIO DE FLUXO DE MUDANÇA
    public function gerarExcelFluxoMudanca()
    {
        switch ($this->input->post('situacao_fluxo_mudanca_excel')) {
            case 0:
                return $this->db->get('tb_fluxo_mudanca')->result();
                break;
            case 1:
                $this->db->where('situacao', 1);
                return $this->db->get('tb_fluxo_mudanca')->result();
                break;
            case 2:
                $this->db->where('situacao', 0);
                return $this->db->get('tb_fluxo_mudanca')->result();
                break;
        }
    }

    // GERAR O RELATÓRIO DE DEPARTAMENTO
    public function gerarExcelDepartamentos()
    {
        switch ($this->input->post('situacao_departamentos_excel')) {
            case 0:
                return $this->db->get('tb_departamentos')->result();
                break;
            case 1:
                $this->db->where('situacao', 1);
                return $this->db->get('tb_departamentos')->result();
                break;
            case 2:
                $this->db->where('situacao', 0);
                return $this->db->get('tb_departamentos')->result();
                break;
        }
    }

    // RELATÓRIO DE USUÁRIOS
    public function gerarExcelUsuarios()
    {
        $this->db->select('tb_usuarios.*, tb_clientes.nome_cliente');
        $this->db->from('tb_usuarios');
        $this->db->join('tb_clientes','tb_clientes.id_cliente = tb_usuarios.id_cliente');
        $this->db->where('tb_usuarios.id_cliente', $this->input->post('id_cliente_rel_usuarios_excel'));
        return $this->db->get()->result();
    }
}