<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Graficos extends MY_Controller {

	function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('graficos_model', '', TRUE);
    }

    // RELATÓRIOS GRÁFICOS
    public function graficos()
    {
        $this->load->view('relatorios/graficos/graficos');
    }

    // INFORMAÇÕES DO GRÁFICO
    public function informacoesGrafico()
    {
        $this->data['modelo_grafico'] = $this->graficos_model->modeloGrafico();
        $this->data['info_grafico_aberto'] = $this->graficos_model->informacoesGrafico(1);
        $this->data['info_grafico_analise'] = $this->graficos_model->informacoesGrafico(2);
        $this->data['info_grafico_concluido'] = $this->graficos_model->informacoesGrafico(3);
        $this->data['info_grafico_cancelado'] = $this->graficos_model->informacoesGrafico(4);
        $this->load->view('relatorios/graficos/informacoesGrafico', $this->data);
    }

    // ATUALIZAR INFORMAÇÕES GRÁFICO
    public function atualizarInformacoesGrafico()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->graficos_model->atualizarInformacoesGrafico())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}