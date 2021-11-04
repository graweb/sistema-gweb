<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acordo_de_nivel_de_servico_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get(){
        return $this->db->get('tb_acordo_nivel_servico')->result();
    }

    public function listarComboPorUsuario($id_dpto = null)
    {
        $this->db->select('tb_acordo_nivel_servico.id_acordo_nivel_servico, tb_acordo_nivel_servico.tarefa');
        $this->db->from('tb_acordo_nivel_servico');
        $this->db->join('tb_departamentos','tb_departamentos.id_departamento = tb_acordo_nivel_servico.id_departamento');
        $this->db->where('tb_acordo_nivel_servico.id_departamento', $id_dpto);
        return json_encode($this->db->get()->result());
    }

    public function listarComboPorDptoUsuario($id_dpto = null, $id_cliente_usu = null)
    {
        $this->db->select('id_acordo_nivel_servico, tarefa');
        $this->db->from('tb_acordo_nivel_servico');
        $this->db->where('id_departamento', $id_dpto);
        $this->db->where('id_cliente', $id_cliente_usu);
        $this->db->where('situacao', 1);
        return json_encode($this->db->get()->result());
    }

    public function listarComboPorDptoUsuarioLogado($id_dpto = null)
    {
        $this->db->select('tb_acordo_nivel_servico.id_acordo_nivel_servico, tb_acordo_nivel_servico.tarefa');
        $this->db->from('tb_acordo_nivel_servico');
        $this->db->where('id_departamento', $id_dpto);
        $this->db->where('tb_acordo_nivel_servico.id_cliente', $this->session->userdata('id_cliente'));
        return json_encode($this->db->get()->result());
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_acordo_nivel_servico',array(
            'id_cliente'=>$this->input->post('id_cliente',true),
            'id_departamento'=>$this->input->post('id_departamento',true),
            'id_nivel_atendimento'=>$this->input->post('id_nivel_atendimento',true),
            'tarefa'=>$this->input->post('tarefa',true),
            'prazo'=>$this->input->post('prazo',true),
            'prioridade'=>$this->input->post('prioridade',true),
            'observacoes'=>$this->input->post('observacoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_acordo_nivel_servico', $id);
        return $this->db->update('tb_acordo_nivel_servico',array(
            'id_cliente'=>$this->input->post('id_cliente',true),
            'id_departamento'=>$this->input->post('id_departamento',true),
            'id_nivel_atendimento'=>$this->input->post('id_nivel_atendimento',true),
            'tarefa'=>$this->input->post('tarefa',true),
            'prazo'=>$this->input->post('prazo',true),
            'prioridade'=>$this->input->post('prioridade',true),
            'observacoes'=>$this->input->post('observacoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_acordo_nivel_servico', $id);
        return $this->db->update('tb_acordo_nivel_servico',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_acordo_nivel_servico';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        
        $id_acordo_nivel_servico = isset($_POST['id_acordo_nivel_servico']) ? strval($_POST['id_acordo_nivel_servico']) : '';
        $nome_cliente = isset($_POST['nome_cliente']) ? strval($_POST['nome_cliente']) : '';
        $nome_departamento = isset($_POST['nome_departamento']) ? strval($_POST['nome_departamento']) : '';
        $nivel = isset($_POST['nivel']) ? strval($_POST['nivel']) : '';
        $tarefa = isset($_POST['tarefa']) ? strval($_POST['tarefa']) : '';
        $prazo = isset($_POST['prazo']) ? strval($_POST['prazo']) : '';
        $prioridade = isset($_POST['prioridade']) ? strval($_POST['prioridade']) : '';
        
        $this->db->select('tb_acordo_nivel_servico.*, tb_clientes.nome_cliente, tb_departamentos.nome_departamento, tb_nivel_atendimento.nivel');
        $this->db->from('tb_acordo_nivel_servico');
        $this->db->join('tb_clientes','tb_clientes.id_cliente = tb_acordo_nivel_servico.id_cliente');
        $this->db->join('tb_departamentos','tb_departamentos.id_departamento = tb_acordo_nivel_servico.id_departamento');
        $this->db->join('tb_nivel_atendimento','tb_nivel_atendimento.id_nivel_atendimento = tb_acordo_nivel_servico.id_nivel_atendimento');
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_acordo_nivel_servico', $id_acordo_nivel_servico);
        $this->db->like('nome_cliente', $nome_cliente);
        $this->db->like('nome_departamento', $nome_departamento);
        $this->db->like('nivel', $nivel);
        $this->db->like('tarefa', $tarefa);
        $this->db->like('prazo', $prazo);
        $this->db->like('prioridade', $prioridade);

        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_acordo_nivel_servico'=>$data['id_acordo_nivel_servico'],
                'id_cliente'=>$data['id_cliente'],
                'nome_cliente'=>$data['nome_cliente'],
                'id_departamento'=>$data['id_departamento'],
                'nome_departamento'=>$data['nome_departamento'],
                'id_nivel_atendimento'=>$data['id_nivel_atendimento'],
                'nivel'=>$data['nivel'],
                'tarefa'=>$data['tarefa'],
                'prazo'=>$data['prazo'],
                'prioridade'=>$data['prioridade'],
                'observacoes'=>$data['observacoes'],
                'situacao'=>$data['situacao']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}