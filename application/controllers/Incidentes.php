<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Incidentes extends MY_Controller {

    function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('incidentes_model', '', TRUE);
    }

    // PÁGINA DE INCIDENTES
    public function index()
    {
        $this->load->view('demandas/incidentes/incidentes');
    }

    // CONTEÚDO INCIDENTE
    public function historico_incidente($cod = null)
    {
        $this->data['info_incidente'] = $this->incidentes_model->infoIncidente($cod);
        $this->data['respostas_incidente'] = $this->incidentes_model->respostaIncidente($cod);
        $this->data['anexos_incidente'] = $this->incidentes_model->anexoIncidente($cod);
        $this->load->view('demandas/incidentes/historico_incidente', $this->data);
    }

    // LISTAR
    public function listar()
    {
        echo $this->incidentes_model->getJson();
    }

    // LISTAR AGUARDANDO RETORNO
    public function listarAguardandoRetorno()
    {
        echo $this->incidentes_model->getJsonRetorno();
    }

    // LISTAR AGUARDANDO RETORNO POR ÁREA
    public function listarAguardandoRetornoArea()
    {
        echo $this->incidentes_model->getJsonRetornoArea();
    }

    // LISTAR COMBOBOX
    public function listarCombo()
    {
        echo $this->incidentes_model->listarCombo();
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->incidentes_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($cod_incidente = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->incidentes_model->atualizar($cod_incidente))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // RESPONDER
    public function responder($cod_incidente = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->incidentes_model->responder($cod_incidente))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ENCERRAR
    public function encerrar($cod_incidente = null, $cod_incidente_associado = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->incidentes_model->encerrar($cod_incidente, $cod_incidente_associado))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // RETOMAR
    public function retomar($cod_incidente = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->incidentes_model->retomar($cod_incidente))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ASSOCIAR
    public function associar($cod_incidente = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->incidentes_model->associar($cod_incidente))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // CANCELAR
    public function cancelar($cod_incidente = null, $cod_incidente_associado = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->incidentes_model->cancelar($cod_incidente, $cod_incidente_associado))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // GERAR MUDANÇA
    public function gerar_mudanca($cod_incidente = null)
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->incidentes_model->gerar_mudanca($cod_incidente))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // GERAR PROBLEMA
    public function gerar_problema($cod_incidente = null)
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->incidentes_model->gerar_problema($cod_incidente))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // CADASTRAR PESQUISA DE SATISFAÇÃO
    public function responder_pesquisa_satisfacao($cod_incidente = null)
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->incidentes_model->responder_pesquisa_satisfacao($cod_incidente))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ANEXAR ARQUIVO
    public function anexarArquivoIncidente()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->incidentes_model->anexarArquivoIncidente($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DOWNLOAD ANEXO INCIDENTE
    function downloadAnexoIncidente($id_anexo = null){
        
        if(!isset($_POST))
            show_404();
        
        if($this->incidentes_model->downloadAnexoIncidente($id_anexo))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}