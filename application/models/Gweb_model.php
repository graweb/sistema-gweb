<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gweb_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function autenticar()
    {
        $this->load->library('encryption');

        $this->db->where('email', $this->input->post('email'));
        $this->db->where('senha', $this->encryption->encrypt($this->input->post('senha')));
        $this->db->limit(1);
        $pega_usuario = $this->db->get('tb_usuarios')->row();

        if(count($pega_usuario) > 0){
            if($pega_usuario->situacao==1){
                $dadosUSuario = array(
                    'id_usuario' => $pega_usuario->id_usuario,
                    'usuario' => $pega_usuario->usuario,
                    'nome' =>$pega_usuario->nome,
                    'email' => $pega_usuario->email,
                    'permissao' => $pega_usuario->id_permissao,
                    'id_membro' => $pega_usuario->id_membro,
                    'logado' => TRUE
                );

                $this->session->set_userdata($dadosUSuario);
                return json_encode(array('success'=>true));
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function cadastrarDemandaInicio()
    {
        if($this->input->post('tipo_demanda') == 1) 
        {
            if($this->input->post('data_hora_inicio') == null) {

                if($this->session->userdata('tipo') != 1) {
                    $this->db->insert('tb_incidentes',array(
                        'id_usuario'=>$this->input->post('id_usuario_inicio', true),
                        'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_inicio', true),
                        'id_departamento'=>$this->input->post('id_departamento_inicio', true),
                        'assunto'=>$this->input->post('assunto_inicio', true),
                        'incidente'=>$this->input->post('descricao_inicio', true),
                        'situacao'=>1,
                        'id_usuario_ult_resp'=>$this->input->post('id_usuario_inicio', true)
                    ));
                } else {
                    $this->db->insert('tb_incidentes',array(
                        'id_usuario'=>$this->input->post('id_usuario_inicio', true),
                        'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_inicio', true),
                        'id_departamento'=>$this->input->post('id_departamento_inicio', true),
                        'assunto'=>$this->input->post('assunto_inicio', true),
                        'incidente'=>$this->input->post('descricao_inicio', true),
                        'situacao'=>1,
                        'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
                    ));
                }
            } else {

                $data_hora = strtr($this->input->post('data_hora_inicio'), '/', '-');

                if($this->session->userdata('tipo') != 1) {
                    $this->db->insert('tb_incidentes',array(
                        'id_usuario'=>$this->input->post('id_usuario_inicio', true),
                        'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_inicio', true),
                        'id_departamento'=>$this->input->post('id_departamento_inicio', true),
                        'assunto'=>$this->input->post('assunto_inicio', true),
                        'incidente'=>$this->input->post('descricao_inicio', true),
                        'data_hora'=>date('Y-m-d H:i:s', strtotime($data_hora)),
                        'situacao'=>1,
                        'id_usuario_ult_resp'=>$this->input->post('id_usuario_inicio', true)
                    ));
                } else {
                    $this->db->insert('tb_incidentes',array(
                        'id_usuario'=>$this->input->post('id_usuario_inicio', true),
                        'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_inicio', true),
                        'id_departamento'=>$this->input->post('id_departamento_inicio', true),
                        'assunto'=>$this->input->post('assunto_inicio', true),
                        'incidente'=>$this->input->post('descricao_inicio', true),
                        'data_hora'=>date('Y-m-d H:i:s', strtotime($data_hora)),
                        'situacao'=>1,
                        'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
                    ));
                }
            }

            // VERIFICA SE O REGISTRO FOI INSERIDO E CHAMA O MODEL PARA ENVIAR O E-MAIL
            if ($this->db->affected_rows() == '1')
            {
                $cod = $this->db->insert_id('tb_incidentes');

                $this->load->model('enviar_email_model');
                return $this->enviar_email_model->enviar_email_abertura("Novo Incidente", $cod, $this->input->post('assunto_inicio'), $this->input->post('descricao_inicio'));
            }

        } else {
            if($this->input->post('data_hora_inicio') == null) {

                if($this->session->userdata('tipo') != 1) {
                    $this->db->insert('tb_requisicoes',array(
                        'id_usuario'=>$this->input->post('id_usuario_inicio', true),
                        'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_inicio', true),
                        'id_departamento'=>$this->input->post('id_departamento_inicio', true),
                        'assunto'=>$this->input->post('assunto_inicio', true),
                        'requisicao'=>$this->input->post('descricao_inicio', true),
                        'situacao'=>1,
                        'id_usuario_ult_resp'=>$this->input->post('id_usuario_inicio', true)
                    ));
                } else {
                    $this->db->insert('tb_requisicoes',array(
                        'id_usuario'=>$this->input->post('id_usuario_inicio', true),
                        'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_inicio', true),
                        'id_departamento'=>$this->input->post('id_departamento_inicio', true),
                        'assunto'=>$this->input->post('assunto_inicio', true),
                        'requisicao'=>$this->input->post('descricao_inicio', true),
                        'situacao'=>1,
                        'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
                    ));
                }
            } else {

                $data_hora = strtr($this->input->post('data_hora_inicio'), '/', '-');

                if($this->session->userdata('tipo') != 1) {
                    $this->db->insert('tb_requisicoes',array(
                        'id_usuario'=>$this->input->post('id_usuario_inicio', true),
                        'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_inicio', true),
                        'id_departamento'=>$this->input->post('id_departamento_inicio', true),
                        'assunto'=>$this->input->post('assunto_inicio', true),
                        'requisicao'=>$this->input->post('descricao_inicio', true),
                        'data_hora'=>date('Y-m-d H:i:s', strtotime($data_hora)),
                        'situacao'=>1,
                        'id_usuario_ult_resp'=>$this->input->post('id_usuario_inicio', true)
                    ));
                } else {
                    $this->db->insert('tb_requisicoes',array(
                        'id_usuario'=>$this->input->post('id_usuario_inicio', true),
                        'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_inicio', true),
                        'id_departamento'=>$this->input->post('id_departamento_inicio', true),
                        'assunto'=>$this->input->post('assunto_inicio', true),
                        'requisicao'=>$this->input->post('descricao_inicio', true),
                        'data_hora'=>date('Y-m-d H:i:s', strtotime($data_hora)),
                        'situacao'=>1,
                        'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
                    ));
                }
            }

            // VERIFICA SE O REGISTRO FOI INSERIDO E CHAMA O MODEL PARA ENVIAR O E-MAIL
            if ($this->db->affected_rows() == '1')
            {
                $cod = $this->db->insert_id('tb_requisicoes');

                $this->load->model('enviar_email_model');
                return $this->enviar_email_model->enviar_email_abertura("Nova Requisição", $cod, $this->input->post('assunto_inicio'), $this->input->post('descricao_inicio'));
            }
        }
    }

    public function atualizarConfigGweb()
    {
        $data_de = strtr($this->input->post('data_gweb_de'), '/', '-');
        $data_ate = strtr($this->input->post('data_gweb_ate'), '/', '-');

        $configGweb = array(
            'data_gweb_de'=>date('Y-m-d', strtotime($data_de)),
            'data_gweb_ate'=>date('Y-m-d', strtotime($data_ate))
        );

        $this->session->set_userdata($configGweb);

        $this->db->where('id_config_gweb', 1);
        return $this->db->update('tb_gweb',array(
            'data_gweb_de'=>date('Y-m-d H:i:s', strtotime($data_de)),
            'data_gweb_ate'=>date('Y-m-d 23:59:59', strtotime($data_ate)),
            'atualizado_por'=>$this->session->userdata('id_usuario')
        ));
    }

    public function atualizarDataGwebAte($id_usuario)
    {
        $this->db->where('id_config_gweb', 1);
        $this->db->update('tb_gweb',array(
            'data_gweb_ate'=>date('Y-m-d 23:59:59'),
            'atualizado_por'=>$id_usuario
        ));
    }
}