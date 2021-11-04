<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios_pdf_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    // TODOS AS DEMANDAS POR DATA
    public function demandasPorData()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_demanda'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_demanda'));

        switch ($this->input->post('tipo_relatorio_por_data')) {
            case 1:
                $this->db->select('tb_incidentes.cod_incidente, tb_usuarios.usuario, tb_incidentes.assunto, 
                tb_incidentes.situacao, tb_incidentes.data_hora');
                $this->db->from('tb_incidentes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
                $this->db->where('tb_incidentes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_incidentes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
            case 2:
                $this->db->select('tb_requisicoes.cod_requisicao, tb_usuarios.usuario, tb_requisicoes.assunto, 
                    tb_requisicoes.situacao, tb_requisicoes.data_hora');
                $this->db->from('tb_requisicoes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
                $this->db->where('tb_requisicoes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_requisicoes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
        }
    }

    // TODOS AS DEMANDAS POR ANALISTA
    public function demandasPorAnalista()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_por_analista'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_por_analista'));

        switch ($this->input->post('tipo_relatorio_por_analista')) {
            case 1:
                $this->db->select('tb_incidentes.cod_incidente, tb_usuarios.usuario, tb_incidentes.assunto, 
                tb_incidentes.situacao, tb_incidentes.data_hora');
                $this->db->from('tb_incidentes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
                $this->db->where('tb_incidentes.id_usuario_concluido_cancelado', $this->input->post('id_analista_demanda'));
                $this->db->where('tb_incidentes.situacao', $this->input->post('situacao_por_analista'));
                $this->db->where('tb_incidentes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_incidentes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
            case 2:
                $this->db->select('tb_requisicoes.cod_requisicao, tb_usuarios.usuario, tb_requisicoes.assunto, 
                    tb_requisicoes.situacao, tb_requisicoes.data_hora');
                $this->db->from('tb_requisicoes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
                $this->db->where('tb_requisicoes.id_usuario_concluido_cancelado', $this->input->post('id_analista_demanda'));
                $this->db->where('tb_requisicoes.situacao', $this->input->post('situacao_por_analista'));
                $this->db->where('tb_requisicoes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_requisicoes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
        }
    }

    // TODOS AS DEMANDAS POR USUÁRIO
    public function demandasPorUsuario()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_por_usuario'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_por_usuario'));

        switch ($this->input->post('tipo_relatorio_por_usuario')) {
            case 1:
                $this->db->select('tb_incidentes.cod_incidente, tb_usuarios.usuario, tb_incidentes.assunto, 
                tb_incidentes.situacao, tb_incidentes.data_hora');
                $this->db->from('tb_incidentes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
                $this->db->where('tb_incidentes.id_usuario', $this->input->post('id_usuario_demanda'));
                $this->db->where('tb_incidentes.situacao', $this->input->post('situacao_por_usuario'));
                $this->db->where('tb_incidentes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_incidentes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
            case 2:
                $this->db->select('tb_requisicoes.cod_requisicao, tb_usuarios.usuario, tb_requisicoes.assunto, 
                    tb_requisicoes.situacao, tb_requisicoes.data_hora');
                $this->db->from('tb_requisicoes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
                $this->db->where('tb_requisicoes.id_usuario', $this->input->post('id_usuario_demanda'));
                $this->db->where('tb_requisicoes.situacao', $this->input->post('situacao_por_usuario'));
                $this->db->where('tb_requisicoes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_requisicoes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
        }
    }

    // TODOS AS DEMANDAS POR SITUAÇÃO
    public function demandasPorSituacao()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_por_situacao'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_por_situacao'));

        switch ($this->input->post('tipo_relatorio_por_situacao')) {
            case 1:
                $this->db->select('tb_incidentes.cod_incidente, tb_usuarios.usuario, tb_incidentes.assunto, 
                tb_incidentes.situacao, tb_incidentes.data_hora');
                $this->db->from('tb_incidentes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
                $this->db->where('tb_incidentes.situacao', $this->input->post('situacao_por_situacao'));
                $this->db->where('tb_incidentes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_incidentes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
            case 2:
                $this->db->select('tb_requisicoes.cod_requisicao, tb_usuarios.usuario, tb_requisicoes.assunto, 
                    tb_requisicoes.situacao, tb_requisicoes.data_hora');
                $this->db->from('tb_requisicoes');
                $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
                $this->db->where('tb_requisicoes.situacao', $this->input->post('situacao_por_situacao'));
                $this->db->where('tb_requisicoes.data_hora >=', date('Y-m-d', strtotime($dataInicial)));
                $this->db->where('tb_requisicoes.data_hora <=', date('Y-m-d', strtotime($dataFinal)));
                return $this->db->get()->result();
                break;
        }
    }

    // TODOS AS DEMANDAS QUE TIVERAM A PESQUISA DE SATISFAÇÃO PREENCHIDA
    public function demandasPesqSatisfPreenchida()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_pesq_satis_preenchida'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_pesq_satis_preenchida'));

        switch ($this->input->post('tipo_relatorio_pesq_satis_preenchida')) {
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
    public function demandasQueGeraramMudancas()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_gerou_mudanca'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_gerou_mudanca'));

        switch ($this->input->post('tipo_relatorio_gerou_mudanca')) {
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
    public function demandasQueGeraramProblemas()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_gerou_problema'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_gerou_problema'));

        switch ($this->input->post('tipo_relatorio_gerou_problema')) {
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
    public function gerarPdfClientes()
    {
        switch ($this->input->post('tipo_relatorio_cliente')) {
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
    public function gerarPdfNivelAtendimento()
    {
        switch ($this->input->post('tipo_relatorio_nivel_atendimento')) {
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
    public function gerarPdfAcordoNivelServico()
    {
        $this->db->select('tb_acordo_nivel_servico.*, tb_clientes.nome_cliente');
        $this->db->from('tb_acordo_nivel_servico');
        $this->db->join('tb_clientes','tb_clientes.id_cliente = tb_acordo_nivel_servico.id_cliente');
        $this->db->where('tb_acordo_nivel_servico.id_cliente', $this->input->post('id_cliente_rel_acordo_nivel_de_servico'));
        return $this->db->get()->result();
    }

    // GERAR O RELATÓRIO DE FLUXO DE MUDANÇA
    public function gerarPdfFluxoMudanca()
    {
        switch ($this->input->post('situacao_fluxo_mudanca')) {
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
    public function gerarPdfDepartamentos()
    {
        switch ($this->input->post('situacao_departamentos')) {
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
    public function gerarPdfUsuarios()
    {
        $this->db->select('tb_usuarios.*, tb_clientes.nome_cliente');
        $this->db->from('tb_usuarios');
        $this->db->join('tb_clientes','tb_clientes.id_cliente = tb_usuarios.id_cliente');
        $this->db->where('tb_usuarios.id_cliente', $this->input->post('id_cliente_rel_usuarios'));
        return $this->db->get()->result();
    }

    // EXIBE A LISTA DOS TIPOS DE RELATÓRIOS EXISTENTES
    public function getJsonDemandas()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_relatorio';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        
        $this->db->limit($rows,$offset);
        $this->db->order_by($sort,$order);

        $criteria = $this->db->get('tb_relatorios');
        
        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();

        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_relatorio'=>$data['id_relatorio'],
                'descricao'=>$data['descricao'],
                'tipo'=>$data['tipo']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}