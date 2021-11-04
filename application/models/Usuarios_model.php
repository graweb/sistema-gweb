<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get(){
        return $this->db->get('tb_usuarios')->result();
    }

    public function getDptoAcesso($id_usuario)
    {
        $this->db->select('tb_usuarios_departamentos.id_departamento AS idDpto');
        $this->db->from('tb_usuarios_departamentos');
        $this->db->join('tb_departamentos','tb_departamentos.id_departamento = tb_usuarios_departamentos.id_departamento');
        $this->db->where('tb_usuarios_departamentos.id_usuario', $id_usuario);
        return $this->db->get()->result();
    }

    public function listarCombo()
    {
        $this->db->select('tb_usuarios.*, tb_departamentos.nome_departamento');
        $this->db->from('tb_usuarios');
        $this->db->join('tb_departamentos','tb_usuarios.id_departamento = tb_departamentos.id_departamento');
        return json_encode($this->db->get()->result());
    }

    public function listarComboAnalistas()
    {
        $this->db->where('tipo', 2);
        return json_encode($this->db->get('tb_usuarios')->result());
    }

    public function cadastrar(){
        $this->load->library('encryption');
        
        return $this->db->insert('tb_usuarios',array(
            'id_permissao'=>$this->input->post('id_permissao', true),
            'id_cliente'=>$this->input->post('id_cliente', true),
            'id_departamento'=>$this->input->post('id_departamento', true),
            'nome'=>$this->input->post('nome', true),
            'usuario'=>$this->input->post('usuario', true),
            'senha'=> hash("sha1", $this->input->post('senha')),
            'email'=>$this->input->post('email', true),
            'situacao'=>$this->input->post('situacao', true),
            'tipo'=>$this->input->post('tipo', true),
            'mudar_senha'=>$this->input->post('mudar_senha', true),
            'assinatura'=>$this->input->post('assinatura', true)
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_usuario', $id);
        return $this->db->update('tb_usuarios',array(
            'id_permissao'=>$this->input->post('id_permissao', true),
            'id_cliente'=>$this->input->post('id_cliente', true),
            'id_departamento'=>$this->input->post('id_departamento', true),
            'nome'=>$this->input->post('nome', true),
            'usuario'=>$this->input->post('usuario', true),
            'email'=>$this->input->post('email', true),
            'situacao'=>$this->input->post('situacao', true),
            'tipo'=>$this->input->post('tipo', true),
            'mudar_senha'=>$this->input->post('mudar_senha', true),
            'assinatura'=>$this->input->post('assinatura', true)
        ));
    }

    public function definir_senha($id)
    {
        $this->load->library('encryption');

        $this->db->where('id_usuario', $id);
        return $this->db->update('tb_usuarios',array(
            'senha' => hash("sha1", $this->input->post('senha_definir', true)),
            'mudar_senha'=>0
        ));
    }

    public function incluirDptoAbrirDemanda()
    {
        return $this->db->insert('tb_usuarios_departamentos',array(
            'id_usuario'=>$this->input->post('id_usu_config', true),
            'id_departamento'=>$this->input->post('id_dpto_config', true)
        ));
    }

    public function removerDptoAbrirDemanda()
    {
        return $this->db->delete('tb_usuarios_departamentos',array(
            'id_usuario'=>$this->input->post('id_usu_config', true),
            'id_departamento'=>$this->input->post('id_dpto_config', true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_usuario', $id);
        return $this->db->update('tb_usuarios',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }

    public function salvarTema()
    {
        $dadosUSuario = array(
            'tema' => $this->input->post('tema')
        );

        $this->session->set_userdata($dadosUSuario);

        $this->db->where('id_usuario', $this->session->userdata('id_usuario'));
        return $this->db->update('tb_usuarios',array(
            'tema'=>$this->input->post('tema', true)
        ));
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_usuario';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;

        $id_usuario = isset($_POST['id_usuario']) ? strval($_POST['id_usuario']) : '';
        $nome = isset($_POST['nome']) ? strval($_POST['nome']) : '';
        $usuario = isset($_POST['usuario']) ? strval($_POST['usuario']) : '';
        $email = isset($_POST['email']) ? strval($_POST['email']) : '';

        //$this->db->select('*');
        //$this->db->from('tb_usuarios');
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_usuario', $id_usuario);
        $this->db->like('nome', $nome);
        $this->db->like('usuario', $usuario);
        $this->db->like('email', $email);

        $criteria = $this->db->get('tb_usuarios');

        $result = array();
        $result['total'] = $this->db->get('tb_usuarios')->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'id_usuario'=>$data['id_usuario'],
                'id_permissao'=>$data['id_permissao'],
                'id_cliente'=>$data['id_cliente'],
                'id_departamento'=>$data['id_departamento'],
                'nome'=>$data['nome'],
                'usuario'=>$data['usuario'],
                'email'=>$data['email'],
                'senha'=>$data['senha'],
                'situacao'=>$data['situacao'],
                'tipo'=>$data['tipo'],
                'mudar_senha'=>$data['mudar_senha'],
                'assinatura'=>$data['assinatura']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}