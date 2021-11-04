<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departamentos extends MY_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('departamentos_model', '', TRUE);
    }

    // PÁGINA DE LOGIN
	public function index()
	{
		$this->load->view('configuracoes/departamentos/departamentos');
	}

    // LISTAR
    public function listar()
    {
        echo $this->departamentos_model->getJson();
    }

    // LISTAR ATIVOS
    public function listarAtivos()
    {
        echo $this->departamentos_model->getJsonAtivos();
    }

    // LISTAR COMBO
    public function listarComboPorUsuario()
    {
        echo $this->departamentos_model->listarComboPorUsuario();
    }
    
    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->departamentos_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->departamentos_model->atualizar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DESATIVAR
    public function desativar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->departamentos_model->desativar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
    
    // DELETAR
    public function deletar()
    {
        if(!isset($_POST))  
            show_404();
        
        $id = intval(addslashes($_POST['id_departamento']));
        if($this->departamentos_model->deletar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}