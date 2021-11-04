<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nivel_de_atendimento extends MY_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('nivel_de_atendimento_model', '', TRUE);
    }

    // PÁGINA DE LOGIN
	public function index()
	{
		$this->load->view('configuracoes/demandas/nivel_de_atendimento/nivel_de_atendimento');
	}

    // LISTAR
    public function listar()
    {
        echo $this->nivel_de_atendimento_model->getJson();
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->nivel_de_atendimento_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->nivel_de_atendimento_model->atualizar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DESATIVAR
    public function desativar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->nivel_de_atendimento_model->desativar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}