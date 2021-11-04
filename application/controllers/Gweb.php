<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gweb extends CI_Controller {

    function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('gweb_model', '', TRUE);
    }

    // PÁGINA DE LOGIN
    public function index()
    {
        if(!isset($_SESSION['id_usuario']) || !isset($_SESSION['logado'])) {
            redirect('login');
        }

        //$this->data['view'] = 'gweb/painel';
        $this->load->view('tema/tema');
    }

    // CARREGA O MENU DO SISTEMA
    public function menu()
    {
        $this->load->view('gweb/menu');
    }

    // CARREGA O CONTEÚDO DO PAINEL(DASHBOARD)
    public function painel()
    {
        if($this->session->userdata('tipo') == 1) {
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
        } else {
            // GRÁFICO INCIDENTES
            $this->load->model('incidentes_model');
            $this->data['contarIncAberto'] = $this->incidentes_model->contarIncAdmTec(1);
            $this->data['contarIncEmAnalise'] = $this->incidentes_model->contarIncAdmTec(2);
            $this->data['contarIncConcluido'] = $this->incidentes_model->contarIncAdmTec(3);
            $this->data['contarIncCancelado'] = $this->incidentes_model->contarIncAdmTec(4);

            // GRÁFICO REQUISIÇÕES
            $this->load->model('requisicoes_model');
            $this->data['contarReqAberto'] = $this->requisicoes_model->contarReqAdmTec(1);
            $this->data['contarReqEmAnalise'] = $this->requisicoes_model->contarReqAdmTec(2);
            $this->data['contarReqConcluido'] = $this->requisicoes_model->contarReqAdmTec(3);
            $this->data['contarReqCancelado'] = $this->requisicoes_model->contarReqAdmTec(4);
        }

        $this->load->view('gweb/painel', $this->data);
    }

    // CARREGA O RODAPÉ DO SISTEMA
    public function rodape()
    {
        $this->load->view('gweb/rodape');
    }

    // REDIRECIONA PARA A PÁGINA LOGIN
    public function login()
    {
        $this->load->view('gweb/login');
    }

    // SAI DO SISTEMA
    public function sair()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    // RECUPERAR SENHA
    public function recuperar()
    {
        $this->load->view('gweb/dados_usuario');
    }

    // VERICA SE OS DADOS DE ACESSO ESTAO CORRETOS E FAZ O LOGIN
    public function autenticar()
    {
        $this->load->library('encryption');

        // IDENTIFICA O USUÁRIO
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('senha', hash("sha1", $this->input->post('senha')));
        $this->db->limit(1);
        $pega_usuario = $this->db->get('tb_usuarios')->row();

        // RETORNA OS DADOS DO EMITENTE
        $this->db->where('situacao', 1);
        $emitente = $this->db->get('tb_emitente')->row();

        //if(count($pega_usuario) > 0){

            // RETORNA AS CONFIGURAÇÕES DO SISTEMA
            $config_gweb = $this->db->get('tb_gweb')->row();

            // ATUALIZA A CONFIGURAÇÃO DA DATA_GWEB_ATE PARA A DATA ATUAL(HOJE)
            if($config_gweb->data_gweb_ate < date('Y-m-d 00:00:00')) {
                $this->session->set_userdata('data_gweb_ate', date('Y-m-d 23:59:59'));
                $this->gweb_model->atualizarDataGwebAte($pega_usuario->id_usuario);
            } else {
                $this->session->set_userdata('data_gweb_ate', date('Y-m-d 23:59:59'));
            }

            if($pega_usuario->situacao == '1'){
                
                $dadosUSuario = array(
                    'id_usuario' => $pega_usuario->id_usuario,
                    'id_departamento' => $pega_usuario->id_departamento,
                    'id_cliente' => $pega_usuario->id_cliente,
                    'usuario' => $pega_usuario->usuario,
                    'nome' =>$pega_usuario->nome,
                    'email' => $pega_usuario->email,
                    'email_emitente' => $emitente->email,
                    'permissao' => $pega_usuario->id_permissao,
                    'tipo' => $pega_usuario->tipo,
                    'mudar_senha' => $pega_usuario->mudar_senha,
                    'tema' => $pega_usuario->tema,
                    'data_gweb_de' => $config_gweb->data_gweb_de,
                    //'data_gweb_ate' => $config_gweb->data_gweb_ate,
                    'logado' => TRUE
                );
                $this->session->set_userdata($dadosUSuario);
                redirect(base_url());
            } else {
                $this->session->set_flashdata('warning','Usuário desativado, favor enviar uma mensagem na área Fale Conosco.');
                redirect('login');
            }
        //} else {
        //    $this->session->set_flashdata('danger', 'Usuário/Senha incorreto!');
        //    redirect('login');
        //}
    }

    // CADASTRAR DEMANDA INICIO
    public function cadastrarDemandaInicio()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->gweb_model->cadastrarDemandaInicio())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR CONFIGURAÇÕES GWEB
    public function atualizarConfigGweb()
    {
        if(!isset($_POST))
            show_404();
        
        if($this->gweb_model->atualizarConfigGweb())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}
