<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nivel_de_atendimento_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get(){
        return $this->db->get('tb_nivel_atendimento')->result();
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_nivel_atendimento',array(
            'nivel'=>$this->input->post('nivel',true),
            'observacoes'=>$this->input->post('observacoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_nivel_atendimento', $id);
        return $this->db->update('tb_nivel_atendimento',array(
            'nivel'=>$this->input->post('nivel',true),
            'observacoes'=>$this->input->post('observacoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_nivel_atendimento', $id);
        return $this->db->update('tb_nivel_atendimento',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_nivel_atendimento';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        
        $id_nivel_atendimento = isset($_POST['id_nivel_atendimento']) ? strval($_POST['id_nivel_atendimento']) : '';
        $nivel = isset($_POST['nivel']) ? strval($_POST['nivel']) : '';
        
        $this->db->select('*');
        $this->db->from('tb_nivel_atendimento');
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_nivel_atendimento', $id_nivel_atendimento);
        $this->db->like('nivel', $nivel);

        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_nivel_atendimento'=>$data['id_nivel_atendimento'],
                'nivel'=>$data['nivel'],
                'observacoes'=>$data['observacoes'],
                'situacao'=>$data['situacao']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}