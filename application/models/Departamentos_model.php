<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departamentos_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->db->get('tb_departamentos')->result();
    }

    public function getAtivos()
    {
        $this->db->where('situacao', 1);
        return $this->db->get('tb_departamentos')->result();
    }

    public function listarComboPorUsuario()
    {
        $this->db->select('tb_departamentos.id_departamento, tb_departamentos.nome_departamento');
        $this->db->from('tb_usuarios_departamentos');
        $this->db->join('tb_departamentos', 'tb_departamentos.id_departamento = tb_usuarios_departamentos.id_departamento', 'left');
        $this->db->where('situacao', 1);
        $this->db->where('tb_usuarios_departamentos.id_usuario', $this->session->userdata('id_usuario'));
        return json_encode($this->db->get()->result());
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_departamentos',array(
            'nome_departamento'=>$this->input->post('nome_departamento',true),
            'situacao'=>$this->input->post('situacao',true),
            'observacoes'=>$this->input->post('observacoes',true)
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_departamento', $id);
        return $this->db->update('tb_departamentos',array(
            'nome_departamento'=>$this->input->post('nome_departamento',true),
            'situacao'=>$this->input->post('situacao',true),
            'observacoes'=>$this->input->post('observacoes',true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_departamento', $id);
        return $this->db->update('tb_departamentos',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }
    
    public function deletar($id)
    {
        return $this->db->delete('tb_departamentos', array('id_departamento' => $id)); 
    }

    public function getDptoUsuario(){
        $this->db->select('tb_departamentos.id_departamento, tb_departamentos.nome_departamento');
        $this->db->from('tb_usuarios');
        $this->db->join('tb_usuarios_departamentos', 'tb_usuarios.id_usuario = tb_usuarios_departamentos.id_usuario', 'left');
        $this->db->join('tb_departamentos', 'tb_usuarios_departamentos.id_departamento = tb_departamentos.id_departamento', 'left');
        $this->db->where('tb_usuarios.id_usuario', '1');
        return $this->db->get()->result();
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_departamento';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        
        $id_departamento = isset($_POST['id_departamento']) ? strval($_POST['id_departamento']) : '';
        $nome_departamento = isset($_POST['nome_departamento']) ? strval($_POST['nome_departamento']) : '';
        
        $this->db->select('*');
        $this->db->from('tb_departamentos');
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_departamento', $id_departamento);
        $this->db->like('nome_departamento', $nome_departamento);

        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_departamento'=>$data['id_departamento'],
                'nome_departamento'=>$data['nome_departamento'],
                'observacoes'=>$data['observacoes'],
                'situacao'=>$data['situacao']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }

    public function getJsonAtivos()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_departamento';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        
        $id_departamento = isset($_POST['id_departamento']) ? strval($_POST['id_departamento']) : '';
        $nome_departamento = isset($_POST['nome_departamento']) ? strval($_POST['nome_departamento']) : '';
        
        $this->db->select('*');
        $this->db->from('tb_departamentos');
        $this->db->where('situacao', 1);
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_departamento', $id_departamento);
        $this->db->like('nome_departamento', $nome_departamento);

        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_departamento'=>$data['id_departamento'],
                'nome_departamento'=>$data['nome_departamento'],
                'observacoes'=>$data['observacoes'],
                'situacao'=>$data['situacao']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}