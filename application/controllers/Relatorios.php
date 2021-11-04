<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios extends MY_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('relatorios_pdf_model', '', TRUE);
    }

    // RELATÓRIOS DEMANDAS
    public function demandas()
    {
        // GRÁFICO INCIDENTES
        $this->load->model('incidentes_model');
        $this->data['contarIncAberto'] = $this->incidentes_model->contarIncUsuario(1);
        $this->data['contarIncEmAnalise'] = $this->incidentes_model->contarIncUsuario(2);
        $this->data['contarIncConcluido'] = $this->incidentes_model->contarIncUsuario(3);
        $this->data['contarIncCancelado'] = $this->incidentes_model->contarIncUsuario(4);

        // GRÁFICO REQUISIÇÕES
        $this->load->model('requisicoes_model');
        $this->data['contarReqAberto'] = $this->requisicoes_model->contarReqUsuario(1);
        $this->data['contarReqEmAnalise'] = $this->requisicoes_model->contarReqUsuario(2);
        $this->data['contarReqConcluido'] = $this->requisicoes_model->contarReqUsuario(3);
        $this->data['contarReqCancelado'] = $this->requisicoes_model->contarReqUsuario(4);

        // LISTA OS CLIENTES PARA GERAR O REL PDF DE ACORDO DE NÌVEL DE SERVIÇO POR CLIENTE
        $this->load->model('clientes_model');
        $this->data['dados_cliente_rel'] = $this->clientes_model->get();
        
        $this->load->view('relatorios/demandas/demandas', $this->data);
    }

    // LISTAR DEMANDAS
    public function listarDemandas()
    {
        echo $this->relatorios_pdf_model->getJsonDemandas();
    }
}