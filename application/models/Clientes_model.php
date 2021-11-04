<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get(){
        return $this->db->get('tb_clientes')->result();
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_clientes',array(
            'nome_cliente'=>$this->input->post('nome_cliente',true),
            'documento'=>$this->input->post('documento',true),
            'telefone'=>$this->input->post('telefone',true),
            'celular'=>$this->input->post('celular',true),
            'email'=>$this->input->post('email',true),
            'cep'=>$this->input->post('cep',true),
            'estado'=>$this->input->post('estado',true),
            'cidade'=>$this->input->post('cidade',true),
            'bairro'=>$this->input->post('bairro',true),
            'rua'=>$this->input->post('rua',true),
            'situacao'=>$this->input->post('situacao',true),
            'numero'=>$this->input->post('numero',true),
            'complemento'=>$this->input->post('complemento',true)
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_cliente', $id);
        return $this->db->update('tb_clientes',array(
            'nome_cliente'=>$this->input->post('nome_cliente',true),
            'documento'=>$this->input->post('documento',true),
            'telefone'=>$this->input->post('telefone',true),
            'celular'=>$this->input->post('celular',true),
            'email'=>$this->input->post('email',true),
            'cep'=>$this->input->post('cep',true),
            'estado'=>$this->input->post('estado',true),
            'cidade'=>$this->input->post('cidade',true),
            'bairro'=>$this->input->post('bairro',true),
            'rua'=>$this->input->post('rua',true),
            'situacao'=>$this->input->post('situacao',true),
            'numero'=>$this->input->post('numero',true),
            'complemento'=>$this->input->post('complemento',true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_cliente', $id);
        return $this->db->update('tb_clientes',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_cliente';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;

        $id_cliente = isset($_POST['id_cliente']) ? strval($_POST['id_cliente']) : '';
        $nome_cliente = isset($_POST['nome_cliente']) ? strval($_POST['nome_cliente']) : '';
        $email = isset($_POST['email']) ? strval($_POST['email']) : '';
        
        $this->db->limit($rows,$offset);
        $this->db->order_by($sort,$order);
        $this->db->like('id_cliente', $id_cliente);
        $this->db->like('nome_cliente', $nome_cliente);
        $this->db->like('email', $email);

        $criteria = $this->db->get('tb_clientes');

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_cliente'=>$data['id_cliente'],
                'nome_cliente'=>$data['nome_cliente'],
                'documento'=>$data['documento'],
                'telefone'=>$data['telefone'],
                'celular'=>$data['celular'],
                'email'=>$data['email'],
                'cep'=>$data['cep'],
                'estado'=>$data['estado'],
                'cidade'=>$data['cidade'],
                'bairro'=>$data['bairro'],
                'rua'=>$data['rua'],
                'situacao'=>$data['situacao'],
                'numero'=>$data['numero'],
                'complemento'=>$data['complemento']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}