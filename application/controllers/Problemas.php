<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Problemas extends MY_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('problemas_model', '', TRUE);
    }

    // PÁGINA DE MUDANÇAS
	public function index()
	{
		$this->load->view('demandas/problemas/problemas');
	}

    // CONTEÚDO MUDANÇA - INCIDENTE
    public function historico_incidente($cod_incidente = null)
    {
        $this->load->model('incidentes_model');
        $this->data['info_incidente'] = $this->incidentes_model->infoIncidente($cod_incidente);
        $this->data['respostas_incidente'] = $this->incidentes_model->respostaIncidente($cod_incidente);
        $this->data['anexos_incidente'] = $this->incidentes_model->anexoIncidente($cod_incidente);
        $this->data['fluxo_incidente'] = $this->problemas_model->getProblemasFluxoIncidentes($cod_incidente);
        $this->load->view('demandas/problemas/historico_problema_incidente', $this->data);
    }

    // CONTEÚDO MUDANÇA - REQUISIÇÃO
    public function historico_requisicao($cod_requisicao = null)
    {
        $this->load->model('requisicoes_model');
        $this->data['info_requisicao'] = $this->requisicoes_model->infoRequisicao($cod_requisicao);
        $this->data['respostas_requisicao'] = $this->requisicoes_model->respostaRequisicao($cod_requisicao);
        $this->data['anexos_requisicao'] = $this->requisicoes_model->anexoRequisicao($cod_requisicao);
        $this->data['fluxo_requisicao'] = $this->problemas_model->getProblemasFluxoRequisicoes($cod_requisicao);
        $this->load->view('demandas/problemas/historico_problema_requisicao', $this->data);
    }

    // LISTAR
    public function listar()
    {
        echo $this->problemas_model->getJson();
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->problemas_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->problemas_model->atualizar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DESATIVAR
    public function desativar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->problemas_model->desativar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ENCERRAR INCIDENTE
    public function encerrarInc($cod_incidente = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->problemas_model->encerrarInc($cod_incidente))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ENCERRAR REQUISIÇÃO
    public function encerrarReq($cod_requisicao = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->problemas_model->encerrarReq($cod_requisicao))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}