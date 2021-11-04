<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acordo_de_nivel_de_servico extends MY_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('acordo_de_nivel_de_servico_model', '', TRUE);
    }

    // PÁGINA DE LOGIN
	public function index()
	{
        $this->load->model('clientes_model');
        $this->data['dados_cliente'] = $this->clientes_model->get();
        $this->load->model('departamentos_model');
        $this->data['dados_departamento'] = $this->departamentos_model->get();
        $this->load->model('nivel_de_atendimento_model');
        $this->data['dados_nivel_atendimento'] = $this->nivel_de_atendimento_model->get();
		$this->load->view('configuracoes/demandas/acordo_de_nivel_de_servico/acordo_de_nivel_de_servico', $this->data);
	}

    // LISTAR
    public function listar()
    {
        echo $this->acordo_de_nivel_de_servico_model->getJson();
    }

    // LISTAR COMBO PELO USUÁRIO SELECIONADO
    public function listarComboPorUsuario($id_cli = null)
    {
        echo $this->acordo_de_nivel_de_servico_model->listarComboPorUsuario($id_cli);
    }

    // LISTAR COMBO PELO DPTO QUE O USUÁRIO TEM PERMISSÃO PARA ABRIR DEMANDAS
    public function listarComboPorDptoUsuario($id_dpto = null, $id_cliente_usu = null)
    {
        echo $this->acordo_de_nivel_de_servico_model->listarComboPorDptoUsuario($id_dpto, $id_cliente_usu);
    }

    // LISTAR COMBO PELO DPTO QUE O USUÁRIO TEM PERMISSÃO PARA ABRIR DEMANDAS
    public function listarComboPorDptoUsuarioLogado($id_dpto = null)
    {
        echo $this->acordo_de_nivel_de_servico_model->listarComboPorDptoUsuarioLogado($id_dpto);
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->acordo_de_nivel_de_servico_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->acordo_de_nivel_de_servico_model->atualizar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DESATIVAR
    public function desativar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->acordo_de_nivel_de_servico_model->desativar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}