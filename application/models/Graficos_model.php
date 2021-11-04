<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Graficos_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    // ATUALIZAR INFORMAÇÕES GRÁFICO
    public function atualizarInformacoesGrafico()
    {
        $dataInicial = str_replace('/', '-', $this->input->post('data_inicio_grafico'));
        $dataFinal = str_replace('/', '-', $this->input->post('data_fim_grafico'));

        $this->db->where('id_relatorio_grafico', 1);
        return $this->db->update('tb_relatorios_grafico',array(
            'tipo'=>$this->input->post('tipo_relatorio_grafico',true),
            'modelo_grafico'=>$this->input->post('modelo_grafico',true),
            'id_analista'=>$this->input->post('id_analista_grafico',true),
            'data_inicio'=>date('Y-m-d', strtotime($dataInicial)),
            'data_fim'=>date('Y-m-d', strtotime($dataFinal))
        ));
    }

    // RECUPERA AS INFORMAÇÕES NÚMERICAS DO GRÁFICO
    public function informacoesGrafico($situacao)
    {
        // SELECT PARA PEGAR OS DADOS DO RELATÓRIO
        $dados = $this->db->get('tb_relatorios_grafico')->row();

        switch ($dados->tipo) {
            case 1:
                $this->db->where('situacao', $situacao);
                $this->db->where('id_usuario_concluido_cancelado', $dados->id_analista);
                $this->db->where('data_hora >=', $dados->data_inicio);
                $this->db->where('data_hora <=', $dados->data_fim);
                return $this->db->count_all_results('tb_incidentes');
                break;
            case 2:
                $this->db->where('situacao', $situacao);
                $this->db->where('id_usuario_concluido_cancelado', $dados->id_analista);
                $this->db->where('data_hora >=', $dados->data_inicio);
                $this->db->where('data_hora <=', $dados->data_fim);
                return $this->db->count_all_results('tb_requisicoes');
                break;
        }
    }

    // RECUPERA O MODELO DO GRÁFICO
    public function modeloGrafico()
    {
        return $this->db->get('tb_relatorios_grafico')->row();
    }
}