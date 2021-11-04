<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fluxo_de_mudancas_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get(){
        return $this->db->get('tb_fluxo_mudanca')->result();
    }

    public function listarCombo()
    {
        $this->db->where('situacao',1);
        return json_encode($this->db->get('tb_fluxo_mudanca')->result());
    }

    public function pegarPorID($id){
        $this->db->where('id_fluxo_mudanca',$id);
        return $this->db->get('tb_fluxo_mudanca')->row();
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_fluxo_mudanca',array(
            'nome'=>$this->input->post('nome',true),
            'descricao'=>$this->input->post('descricao',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function cadastrarEtapa()
    {
        return $this->db->insert('tb_fluxo_mudanca_etapas',array(
            'id_fluxo_mudanca'=>$this->input->post('id_fluxo_mudanca',true),
            'id_usuario_responsavel'=>$this->input->post('id_usuario_responsavel',true),
            'etapa'=>$this->input->post('etapa',true),
            'ordem'=>$this->input->post('ordem',true)
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_fluxo_mudanca', $id);
        return $this->db->update('tb_fluxo_mudanca',array(
            'nome'=>$this->input->post('nome',true),
            'descricao'=>$this->input->post('descricao',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function atualizarEtapa($id)
    {
        $this->db->where('id_etapa', $id);
        return $this->db->update('tb_fluxo_mudanca_etapas',array(
            'id_usuario_responsavel'=>$this->input->post('id_usuario_responsavel',true),
            'etapa'=>$this->input->post('etapa',true),
            'ordem'=>$this->input->post('ordem',true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_fluxo_mudanca', $id);
        return $this->db->update('tb_fluxo_mudanca',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }

    public function removerEtapa($id)
    {
        return $this->db->delete('tb_fluxo_mudanca_etapas', array('id_etapa' => $id)); 
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_fluxo_mudanca';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        
        $id_fluxo_mudanca = isset($_POST['id_fluxo_mudanca']) ? strval($_POST['id_fluxo_mudanca']) : '';
        $nome = isset($_POST['nome']) ? strval($_POST['nome']) : '';
        
        $this->db->select('*');
        $this->db->from('tb_fluxo_mudanca');
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_fluxo_mudanca', $id_fluxo_mudanca);
        $this->db->like('nome', $nome);

        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_fluxo_mudanca'=>$data['id_fluxo_mudanca'],
                'nome'=>$data['nome'],
                'descricao'=>$data['descricao'],
                'situacao'=>$data['situacao']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }

    public function getJsonEtapasFluxo($idFlux)
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_etapa';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;

        $this->db->select('tb_fluxo_mudanca_etapas.*, tb_fluxo_mudanca.nome as fluxo, tb_usuarios.usuario');
        $this->db->from('tb_fluxo_mudanca_etapas');
        $this->db->join('tb_fluxo_mudanca', 'tb_fluxo_mudanca.id_fluxo_mudanca = tb_fluxo_mudanca_etapas.id_fluxo_mudanca', 'left');
        $this->db->join('tb_usuarios', 'tb_usuarios.id_usuario = tb_fluxo_mudanca_etapas.id_usuario_responsavel', 'left');
        $this->db->where('tb_fluxo_mudanca_etapas.id_fluxo_mudanca',$idFlux);
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);

        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_etapa'=>$data['id_etapa'],
                'id_fluxo_mudanca'=>$data['id_fluxo_mudanca'],
                'fluxo'=>$data['fluxo'],
                'id_usuario_responsavel'=>$data['id_usuario_responsavel'],
                'usuario'=>$data['usuario'],
                'etapa'=>$data['etapa'],
                'ordem'=>$data['ordem']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}