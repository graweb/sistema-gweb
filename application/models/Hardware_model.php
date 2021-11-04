<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hardware_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get(){
        return $this->db->get('tb_hardware')->result();
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_hardware',array(
            'nivel'=>$this->input->post('nivel',true),
            'observacoes'=>$this->input->post('observacoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_hardware', $id);
        return $this->db->update('tb_hardware',array(
            'nivel'=>$this->input->post('nivel',true),
            'observacoes'=>$this->input->post('observacoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_hardware', $id);
        return $this->db->update('tb_hardware',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_hardware';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        
        $id_hardware = isset($_POST['id_hardware']) ? strval($_POST['id_hardware']) : '';
        $ip = isset($_POST['ip']) ? strval($_POST['ip']) : '';
        $nome_host = isset($_POST['nome_host']) ? strval($_POST['nome_host']) : '';
        $sistema_operacional = isset($_POST['sistema_operacional']) ? strval($_POST['sistema_operacional']) : '';
        
        $this->db->select('*');
        $this->db->from('tb_hardware');
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_hardware', $id_hardware);
        $this->db->like('ip', $ip);
        $this->db->like('nome_host', $nome_host);
        $this->db->like('sistema_operacional', $sistema_operacional);

        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_hardware'=>$data['id_hardware'],
                'id_cliente'=>$data['id_cliente'],
                'nome_host'=>$data['nome_host'],
                'processador'=>$data['processador'],
                'sistema_operacional'=>$data['sistema_operacional'],
                'disco_rigido'=>$data['disco_rigido'],
                'memoria'=>$data['memoria'],
                'ip'=>$data['ip'],
                'observacoes'=>$data['observacoes'],
                'situacao'=>$data['situacao']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}