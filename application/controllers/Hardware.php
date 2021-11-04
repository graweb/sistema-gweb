<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hardware extends MY_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('hardware_model', '', TRUE);
    }

    // PÁGINA DE LOGIN
	public function index()
	{
        $this->load->model('clientes_model');
        $this->data['dados_cliente'] = $this->clientes_model->get();
		$this->load->view('inventario/hardware/hardware', $this->data);
	}

    // LISTAR
    public function listar()
    {
        echo $this->hardware_model->getJson();
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->hardware_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->hardware_model->atualizar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DESATIVAR
    public function desativar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->hardware_model->desativar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}