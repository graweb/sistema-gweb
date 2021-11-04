<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mudancas_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->db->get('tb_mudancas')->result();
    }

    public function getMudancasFluxoIncidentes($cod_incidente = null)
    {
        $this->db->select('tb_fluxo_mudanca.*, tb_fluxo_aprovadores.id_usuario_aprovador_atual, tb_fluxo_aprovadores.finalizou');
        $this->db->from('tb_mudancas');
        $this->db->join('tb_fluxo_mudanca','tb_mudancas.id_fluxo_mudanca = tb_fluxo_mudanca.id_fluxo_mudanca');
        $this->db->join('tb_fluxo_aprovadores','tb_mudancas.cod_mudanca = tb_fluxo_aprovadores.cod_mudanca');
        $this->db->where('tb_mudancas.cod_incidente', $cod_incidente);
        return $this->db->get()->row();
    }

    public function getMudancasFluxoIncidentesEtapas($cod_incidente = null)
    {
        $this->db->select('tb_fluxo_mudanca_etapas.ordem, tb_usuarios.id_usuario, tb_usuarios.usuario, tb_fluxo_mudanca_etapas.id_usuario_responsavel');
        $this->db->from('tb_mudancas');
        $this->db->join('tb_fluxo_mudanca_etapas','tb_mudancas.id_fluxo_mudanca = tb_fluxo_mudanca_etapas.id_fluxo_mudanca');
        $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_fluxo_mudanca_etapas.id_usuario_responsavel');
        $this->db->where('tb_mudancas.cod_incidente', $cod_incidente);
        return $this->db->get()->result();
    }

    public function getMudancasFluxoRequisicoes($cod_requisicao = null)
    {
        $this->db->select('tb_fluxo_mudanca.*, tb_fluxo_aprovadores.id_usuario_aprovador_atual, tb_fluxo_aprovadores.finalizou');
        $this->db->from('tb_mudancas');
        $this->db->join('tb_fluxo_mudanca','tb_mudancas.id_fluxo_mudanca = tb_fluxo_mudanca.id_fluxo_mudanca');
        $this->db->join('tb_fluxo_aprovadores','tb_mudancas.cod_mudanca = tb_fluxo_aprovadores.cod_mudanca');
        $this->db->where('tb_mudancas.cod_requisicao', $cod_requisicao);
        return $this->db->get()->row();
    }

    public function getMudancasFluxoRequisicoesEtapas($cod_requisicao = null)
    {
        $this->db->select('tb_fluxo_mudanca_etapas.ordem, tb_usuarios.id_usuario, tb_usuarios.usuario, tb_fluxo_mudanca_etapas.id_usuario_responsavel');
        $this->db->from('tb_mudancas');
        $this->db->join('tb_fluxo_mudanca_etapas','tb_mudancas.id_fluxo_mudanca = tb_fluxo_mudanca_etapas.id_fluxo_mudanca');
        $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_fluxo_mudanca_etapas.id_usuario_responsavel');
        $this->db->where('tb_mudancas.cod_requisicao', $cod_requisicao);
        return $this->db->get()->result();
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_mudancas',array(
            'nivel'=>$this->input->post('nivel',true),
            'observacoes'=>$this->input->post('observacoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('cod_mudanca', $id);
        return $this->db->update('tb_mudancas',array(
            'nivel'=>$this->input->post('nivel',true),
            'observacoes'=>$this->input->post('observacoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('cod_mudanca', $id);
        return $this->db->update('tb_mudancas',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }

    public function aprovar($cod_mudanca = null, $cont_usu = null)
    {
        // PEGA O ID DO FLUXO DA MUDANÇA
        $this->db->where('cod_mudanca', $cod_mudanca);
        $pega_fluxo = $this->db->get('tb_mudancas')->row();

        // PEGA O PROXIMO USUARIO DA ETAPA DO FLUXO DE MUDANÇA
        $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_fluxo_mudanca_etapas.id_usuario_responsavel');
        $this->db->where('id_fluxo_mudanca', $pega_fluxo->id_fluxo_mudanca);
        $this->db->where('tb_fluxo_mudanca_etapas.id_usuario_responsavel >', $this->session->userdata('id_usuario'));
        //$this->db->where('ordem >', $ordem_aprov);
        $pega_etapa = $this->db->get('tb_fluxo_mudanca_etapas')->row();

        // ENVIAR E-MAIL NO FLUXO de APROVAÇÃO
        $this->load->model('enviar_email_model');
        $this->enviar_email_model->enviar_email_fluxo_aprovacao("Fluxo de aprovação da Mudança", $cod_mudanca, $pega_etapa->usuario);

        if($cont_usu == $pega_etapa->ordem) 
        {
            // FINALIZA O FLUXO CONFORME ÚLTIMO USUÁRIO
            $this->db->where('cod_mudanca', $cod_mudanca);
            return $this->db->update('tb_fluxo_aprovadores',array(
                'finalizou'=>1
            ));
        } else {
            // ATUALIZA O ARPOVADOR ATUAL CONFORME O COD DA MUDANÇA
            $this->db->where('cod_mudanca', $cod_mudanca);
            return $this->db->update('tb_fluxo_aprovadores',array(
                'id_usuario_aprovador_atual'=>$pega_etapa->id_usuario_responsavel
            ));
        }
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'cod_mudanca';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $offset = ($page-1) * $rows;
        
        $cod_mudanca = isset($_POST['cod_mudanca']) ? strval($_POST['cod_mudanca']) : '';
        $assunto = isset($_POST['assunto']) ? strval($_POST['assunto']) : '';
        
        $this->db->select('*');
        $this->db->from('vw_mudancas');
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('cod_mudanca', $cod_mudanca);
        $this->db->like('assunto', $assunto);
        if($this->session->userdata('tipo') == 1) {
            $this->db->where('id_usuario_aprovador_atual', $this->session->userdata('id_usuario'));
            $this->db->or_where('id_usuario', $this->session->userdata('id_usuario'));
        }

        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'cod_mudanca'=>$data['cod_mudanca'],
                'cod_incidente'=>$data['cod_incidente'],
                'cod_requisicao'=>$data['cod_requisicao'],
                'data_hora'=>$data['data_hora'],
                'id_usuario_aprovador_atual'=>$data['id_usuario_aprovador_atual'],
                'aprovador_atual'=>$data['aprovador_atual'],
                'assunto'=>$data['assunto'],
                'situacao'=>$data['situacao'],
                'id_fluxo_mudanca'=>$data['id_fluxo_mudanca'],
                'id_usuario'=>$data['id_usuario'],
                'finalizou'=>$data['finalizou'],
                'id_etapa'=>$data['id_etapa'],
                'ordem'=>$data['ordem']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}