<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requisicoes extends MY_Controller {

    function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('requisicoes_model', '', TRUE);
    }

    // PÁGINA DE REQUISIÇÕES
    public function index()
    {
        $this->load->view('demandas/requisicoes/requisicoes');
    }

    // CONTEÚDO REQUISIÇÃO
    public function historico_requisicao($cod = null)
    {
        $this->data['info_requisicao'] = $this->requisicoes_model->infoRequisicao($cod);
        $this->data['respostas_requisicao'] = $this->requisicoes_model->respostaRequisicao($cod);
        $this->data['anexos_requisicao'] = $this->requisicoes_model->anexoRequisicao($cod);
        $this->load->view('demandas/requisicoes/historico_requisicao', $this->data);
    }

    // LISTAR
    public function listar()
    {
        echo $this->requisicoes_model->getJson();
    }

    // LISTAR AGUARDANDO RETORNO
    public function listarAguardandoRetorno()
    {
        echo $this->requisicoes_model->getJsonRetorno();
    }

    // LISTAR AGUARDANDO RETORNO POR ÁREA
    public function listarAguardandoRetornoArea()
    {
        echo $this->requisicoes_model->getJsonRetornoArea();
    }

    // LISTAR
    public function listarCombo()
    {
        echo $this->requisicoes_model->listarCombo();
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->requisicoes_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($cod_requisicao = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->requisicoes_model->atualizar($cod_requisicao))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // RESPONDER
    public function responder($cod_requisicao = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->requisicoes_model->responder($cod_requisicao))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ENCERRAR
    public function encerrar($cod_requisicao = null, $cod_requisicao_associado = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->requisicoes_model->encerrar($cod_requisicao, $cod_requisicao_associado))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // RETOMAR
    public function retomar($cod_requisicao = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->requisicoes_model->retomar($cod_requisicao))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ASSOCIAR
    public function associar($cod_requisicao = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->requisicoes_model->associar($cod_requisicao))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // CANCELAR
    public function cancelar($cod_requisicao = null, $cod_requisicao_associado = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->requisicoes_model->cancelar($cod_requisicao, $cod_requisicao_associado))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // GERAR MUDANÇA
    public function gerar_mudanca($cod_requisicao = null)
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->requisicoes_model->gerar_mudanca($cod_requisicao, $this->input->post('id_fluxo_mudanca')))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // GERAR PROBLEMA
    public function gerar_problema($cod_requisicao = null)
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->requisicoes_model->gerar_problema($cod_requisicao))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // CADASTRAR PESQUISA DE SATISFAÇÃO
    public function responder_pesquisa_satisfacao($cod_requisicao = null)
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->requisicoes_model->responder_pesquisa_satisfacao($cod_requisicao))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ANEXAR ARQUIVO
    public function anexarArquivoRequisicao()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->requisicoes_model->anexarArquivoRequisicao($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DOWNLOAD ANEXO REQUISIÇÃO
    function downloadAnexoRequisicao($id_anexo = null){
        
        if(!isset($_POST))
            show_404();
        
        if($this->requisicoes_model->downloadAnexoRequisicao($id_anexo))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}