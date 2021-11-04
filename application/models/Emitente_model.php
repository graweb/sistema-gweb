<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emitente_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get(){
        return $this->db->get('tb_emitente')->result();
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_emitente',array(
            'nome'=>$this->input->post('nome_emitente',true),
            'cnpj'=>$this->input->post('cnpj_emitente',true),
            'ie'=>$this->input->post('ie_emitente',true),
            'cep'=>$this->input->post('cep_emitente',true),
            'uf'=>$this->input->post('uf_emitente',true),
            'cidade'=>$this->input->post('cidade_emitente',true),
            'bairro'=>$this->input->post('bairro_emitente',true),
            'rua'=>$this->input->post('rua_emitente',true),
            'numero'=>$this->input->post('numero_emitente',true),
            'telefone'=>$this->input->post('telefone_emitente',true),
            'email'=>$this->input->post('email_emitente',true),
            'situacao'=>$this->input->post('situacao_emitente',true)
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_emitente', $id);
        return $this->db->update('tb_emitente',array(
            'nome'=>$this->input->post('nome_emitente',true),
            'cnpj'=>$this->input->post('cnpj_emitente',true),
            'ie'=>$this->input->post('ie_emitente',true),
            'cep'=>$this->input->post('cep_emitente',true),
            'uf'=>$this->input->post('uf_emitente',true),
            'cidade'=>$this->input->post('cidade_emitente',true),
            'bairro'=>$this->input->post('bairro_emitente',true),
            'rua'=>$this->input->post('rua_emitente',true),
            'numero'=>$this->input->post('numero_emitente',true),
            'telefone'=>$this->input->post('telefone_emitente',true),
            'email'=>$this->input->post('email_emitente',true),
            'situacao'=>$this->input->post('situacao_emitente',true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_emitente', $id);
        return $this->db->update('tb_emitente',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar_emitente',true)
        ));
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_emitente';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;

        $id_emitente = isset($_POST['id_emitente']) ? strval($_POST['id_emitente']) : '';
        $nome = isset($_POST['nome_emitente']) ? strval($_POST['nome_emitente']) : '';
        $email = isset($_POST['email_emitente']) ? strval($_POST['email_emitente']) : '';
        
        $this->db->limit($rows,$offset);
        $this->db->order_by($sort,$order);
        $this->db->like('id_emitente', $id_emitente);
        $this->db->like('nome', $nome);
        $this->db->like('email', $email);

        $criteria = $this->db->get('tb_emitente');

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_emitente'=>$data['id_emitente'],
                'nome_emitente'=>$data['nome'],
                'cnpj_emitente'=>$data['cnpj'],
                'ie_emitente'=>$data['ie'],
                'cep_emitente'=>$data['cep'],
                'uf_emitente'=>$data['uf'],
                'cidade_emitente'=>$data['cidade'],
                'bairro_emitente'=>$data['bairro'],
                'rua_emitente'=>$data['rua'],
                'numero_emitente'=>$data['numero'],
                'telefone_emitente'=>$data['telefone'],
                'email_emitente'=>$data['email'],
                'situacao_emitente'=>$data['situacao']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}