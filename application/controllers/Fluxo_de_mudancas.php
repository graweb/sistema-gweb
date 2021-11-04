<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fluxo_de_mudancas extends MY_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('fluxo_de_mudancas_model', '', TRUE);
    }

    // PÁGINA DE LOGIN
	public function index()
	{
		$this->load->view('configuracoes/demandas/fluxo_de_mudancas/fluxo_de_mudancas');
	}

    // CONTEÚDO ETAPAS FLUXO
    public function etapas_fluxo($id)
    {
        $this->load->model('usuarios_model');
        $this->data['dados_usuario'] = $this->usuarios_model->get();
        $this->data['id_flux_mud'] = $this->fluxo_de_mudancas_model->pegarPorID($id);
        $this->load->view('configuracoes/demandas/fluxo_de_mudancas/etapas_fluxo', $this->data);
    }

    // LISTAR
    public function listar()
    {
        echo $this->fluxo_de_mudancas_model->getJson();
    }

    // LISTAR COMBOBOX
    public function listarCombo()
    {
        echo $this->fluxo_de_mudancas_model->listarCombo();
    }

    // LISTAR DPTOS QUE O USUARIO PODE ABRIR DEMANDAS
    public function listarEtapasFluxo($idFlux)
    {
        echo $this->fluxo_de_mudancas_model->getJsonEtapasFluxo($idFlux);
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->fluxo_de_mudancas_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // CADASTRAR ETAPAS
    public function cadastrarEtapa()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->fluxo_de_mudancas_model->cadastrarEtapa())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->fluxo_de_mudancas_model->atualizar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR ETAPA
    public function atualizarEtapa($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->fluxo_de_mudancas_model->atualizarEtapa($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DESATIVAR
    public function desativar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->fluxo_de_mudancas_model->desativar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // EXCLUIR
    public function removerEtapa($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->fluxo_de_mudancas_model->removerEtapa($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}