<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('usuarios_model', '', TRUE);
    }

    // PÁGINA DE LOGIN
	public function index()
	{
        $this->load->model('clientes_model');
        $this->data['dados_cliente'] = $this->clientes_model->get();
        $this->load->model('departamentos_model');
        $this->data['dados_departamento'] = $this->departamentos_model->getAtivos();
        $this->load->model('permissoes_model');
        $this->data['dados_permissao'] = $this->permissoes_model->get();
		$this->load->view('configuracoes/usuarios/usuarios', $this->data);
	}

    // CONTEÚDO PERMISSÃO
    public function configuracoes_usuario($id_usuario)
    {
        $this->data['dpto_acesso'] = $this->usuarios_model->getDptoAcesso($id_usuario);
        $this->load->view('configuracoes/usuarios/configuracoes_usuario', $this->data);
    }

    // LISTAR
    public function listar()
    {
        echo $this->usuarios_model->getJson();
    }

    // LISTAR COMBO
    public function listarCombo()
    {
        echo $this->usuarios_model->listarCombo();
    }

    // LISTAR COMBO ANALISTAS
    public function listarComboAnalistas()
    {
        echo $this->usuarios_model->listarComboAnalistas();
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($id_usuario)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_model->atualizar($id_usuario))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DEFINIR SENHA
    public function definir_senha($id_usuario = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_model->definir_senha($id_usuario))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // INCLUIR DPTOS ABRIR DEMANDA USUARIO
    public function incluirDptoAbrirDemanda()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_model->incluirDptoAbrirDemanda())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // REMOVER DPTOS ABRIR DEMANDA USUARIO
    public function removerDptoAbrirDemanda()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_model->removerDptoAbrirDemanda())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DESATIVAR
    public function desativar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_model->desativar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // SALVAR TEMA
    public function salvarTema()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->usuarios_model->salvarTema())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}