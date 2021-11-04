<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Problemas_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->db->get('tb_problemas')->result();
    }

    public function getProblemasFluxoIncidentes($cod_incidente = null)
    {
        $this->db->select('*');
        $this->db->from('tb_problemas');
        $this->db->where('tb_problemas.cod_incidente',$cod_incidente);
        return $this->db->get()->row();
    }

    public function getProblemasFluxoRequisicoes($cod_requisicao = null)
    {
        $this->db->select('*');
        $this->db->from('tb_problemas');
        $this->db->where('tb_problemas.cod_requisicao',$cod_requisicao);
        return $this->db->get()->row();
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_problemas',array(
            'nivel'=>$this->input->post('nivel',true),
            'observacoes'=>$this->input->post('observacoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('cod_problema', $id);
        return $this->db->update('tb_problemas',array(
            'nivel'=>$this->input->post('nivel',true),
            'observacoes'=>$this->input->post('observacoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('cod_problema', $id);
        return $this->db->update('tb_problemas',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }

    public function encerrarInc($cod_incidente = null)
    {
        $this->db->where('cod_incidente', $cod_incidente);
        return $this->db->update('tb_incidentes',array(
            'situacao'=>3
        ));
    }

    public function encerrarReq($cod_requisicao = null)
    {
        $this->db->where('cod_requisicao', $cod_requisicao);
        return $this->db->update('tb_requisicoes',array(
            'situacao'=>3
        ));
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'cod_problema';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $offset = ($page-1) * $rows;
        
        $cod_problema = isset($_POST['cod_problema']) ? strval($_POST['cod_problema']) : '';
        $assunto = isset($_POST['assunto']) ? strval($_POST['assunto']) : '';
        
        $this->db->select('*');
        $this->db->from('vw_problemas');
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('cod_problema', $cod_problema);
        $this->db->like('assunto', $assunto);
        if($this->session->userdata('tipo') == 1) {
            $this->db->where('id_usuario', $this->session->userdata('id_usuario'));
        }

        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'cod_problema'=>$data['cod_problema'],
                'cod_incidente'=>$data['cod_incidente'],
                'cod_requisicao'=>$data['cod_requisicao'],
                'data_hora'=>$data['data_hora'],
                'usuario'=>$data['usuario'],
                'id_cliente'=>$data['id_cliente'],
                'empresa'=>$data['empresa'],
                'assunto'=>$data['assunto'],
                'situacao'=>$data['situacao'],
                'tipo'=>$data['tipo']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}