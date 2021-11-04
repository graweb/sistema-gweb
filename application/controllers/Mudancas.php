<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mudancas extends MY_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('mudancas_model', '', TRUE);
    }

    // PÁGINA DE MUDANÇAS
	public function index()
	{
		$this->load->view('demandas/mudancas/mudancas');
	}

    // CONTEÚDO MUDANÇA - INCIDENTE
    public function historico_mudanca_incidente($cod_incidente = null)
    {
        $this->load->model('incidentes_model');
        $this->data['info_incidente'] = $this->incidentes_model->infoIncidente($cod_incidente);
        $this->data['respostas_incidente'] = $this->incidentes_model->respostaIncidente($cod_incidente);
        $this->data['anexos_incidente'] = $this->incidentes_model->anexoIncidente($cod_incidente);
        $this->data['fluxo_incidente'] = $this->mudancas_model->getMudancasFluxoIncidentes($cod_incidente);
        $this->data['fluxo_incidente_etapas'] = $this->mudancas_model->getMudancasFluxoIncidentesEtapas($cod_incidente);
        $this->load->view('demandas/mudancas/historico_mudanca_incidente', $this->data);
    }

    // CONTEÚDO MUDANÇA - REQUISIÇÃO
    public function historico_mudanca_requisicao($cod_requisicao = null)
    {
        $this->load->model('requisicoes_model');
        $this->data['info_requisicao'] = $this->requisicoes_model->infoRequisicao($cod_requisicao);
        $this->data['respostas_requisicao'] = $this->requisicoes_model->respostaRequisicao($cod_requisicao);
        $this->data['anexos_requisicao'] = $this->requisicoes_model->anexoRequisicao($cod_requisicao);
        $this->data['fluxo_requisicao'] = $this->mudancas_model->getMudancasFluxoRequisicoes($cod_requisicao);
        $this->data['fluxo_requisicao_etapas'] = $this->mudancas_model->getMudancasFluxoRequisicoesEtapas($cod_requisicao);
        $this->load->view('demandas/mudancas/historico_mudanca_requisicao', $this->data);
    }

    // LISTAR
    public function listar()
    {
        echo $this->mudancas_model->getJson();
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->mudancas_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->mudancas_model->atualizar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DESATIVAR
    public function desativar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->mudancas_model->desativar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // APROVAR
    public function aprovar($cod_mudanca = null, $cont_usu = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->mudancas_model->aprovar($cod_mudanca, $cont_usu))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}