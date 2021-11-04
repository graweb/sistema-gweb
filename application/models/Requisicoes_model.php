<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requisicoes_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function listarCombo()
    {
        $arr = array(3, 4);
        $this->db->where_not_in('situacao', $arr);
        return json_encode($this->db->get('tb_requisicoes')->result());
    }

    public function infoRequisicao($cod = null){
        $this->db->where('cod_requisicao',$cod);
        return $this->db->get('vw_requisicoes')->row();
    }

    public function contarReqUsuario($situacao)
    {
        $this->db->where('situacao',$situacao);
        $this->db->where('id_usuario',$this->session->userdata('id_usuario'));
        $this->db->where('data_hora >=',$this->session->userdata('data_gweb_de'));
        $this->db->where('data_hora <=',$this->session->userdata('data_gweb_ate'));
        return $this->db->count_all_results('tb_requisicoes');
    }

    public function contarReqAdmTec($situacao)
    {
        $this->db->where('situacao',$situacao);
        $this->db->where('data_hora >=',$this->session->userdata('data_gweb_de'));
        $this->db->where('data_hora <=',$this->session->userdata('data_gweb_ate'));
        return $this->db->count_all_results('tb_requisicoes');
    }

    public function respostaRequisicao($cod = null){
        $this->db->select('tb_requisicoes_respostas.*, tb_usuarios.nome, tb_usuarios.url_imagem');
        $this->db->from('tb_requisicoes_respostas');
        $this->db->join('tb_requisicoes','tb_requisicoes.cod_requisicao = tb_requisicoes_respostas.cod_requisicao');
        $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes_respostas.id_usuario');
        $this->db->where('tb_requisicoes_respostas.cod_requisicao',$cod);
        $this->db->order_by('tb_requisicoes_respostas.data_resposta','desc'); 
        return $this->db->get()->result();
    }

    public function anexoRequisicao($cod = null){
        $this->db->select('tb_requisicoes_anexos.id_anexo as id_anexo_req, 
            tb_requisicoes_anexos.cod_requisicao as cod_requisicao_anex, 
            tb_requisicoes_anexos.id_usuario as id_usuario_anex_req,
            tb_requisicoes_anexos.anexo as anexo_anex_req,
            tb_requisicoes_anexos.thumb as thumb_anex_req,
            tb_requisicoes_anexos.url as url_anex_req,
            tb_requisicoes_anexos.extensao as extensao_anex_req,
            tb_requisicoes_anexos.data_hora as data_hora_anex_req,
            tb_usuarios.nome as nome_anex_req');
        $this->db->from('tb_requisicoes_anexos');
        $this->db->join('tb_requisicoes','tb_requisicoes.cod_requisicao = tb_requisicoes_anexos.cod_requisicao');
        $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes_anexos.id_usuario');
        $this->db->where('tb_requisicoes_anexos.cod_requisicao',$cod);
        $this->db->order_by('tb_requisicoes_anexos.data_hora','desc'); 
        return $this->db->get()->result();
    }

    public function cadastrar()
    {
        if($this->input->post('data_hora_req') == null) {

            $this->db->insert('tb_requisicoes',array(
                'id_usuario'=>$this->input->post('id_usuario_req', true),
                'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_req', true),
                'id_departamento'=>$this->input->post('id_departamento_req', true),
                'assunto'=>$this->input->post('assunto_req', true),
                'requisicao'=>$this->input->post('requisicao_req', true),
                'situacao'=>1,
                'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
            ));
        } else {

            $data_hora = strtr($this->input->post('data_hora_req'), '/', '-');

            $this->db->insert('tb_requisicoes',array(
                'id_usuario'=>$this->input->post('id_usuario_req', true),
                'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_req', true),
                'id_departamento'=>$this->input->post('id_departamento_req', true),
                'assunto'=>$this->input->post('assunto_req', true),
                'requisicao'=>$this->input->post('requisicao_req', true),
                'data_hora'=>date('Y-m-d H:i:s', strtotime($data_hora)),
                'situacao'=>1,
                'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
            ));
        }

        // VERIFICA SE O REGISTRO FOI INSERIDO E CHAMA O MODEL PARA ENVIAR O E-MAIL
        if ($this->db->affected_rows() == '1')
        {
            $cod = $this->db->insert_id('tb_requisicoes');

            $this->load->model('enviar_email_model');
            return $this->enviar_email_model->enviar_email_abertura("Nova Requisição", $cod, $this->input->post('assunto_req'), $this->input->post('requisicao_req'));
        }
    }

    public function atualizar($cod_requisicao = null)
    {
        $data_hora = strtr($this->input->post('data_hora_req'), '/', '-');

        $this->db->where('cod_requisicao', $cod_requisicao);
        return $this->db->update('tb_requisicoes',array(
            'id_usuario'=>$this->input->post('id_usuario_req',true),
            'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_req',true),
            'id_departamento'=>$this->input->post('id_departamento_req',true),
            'assunto'=>$this->input->post('assunto_req',true),
            'requisicao'=>$this->input->post('requisicao_req',true),
            'data_hora'=>date('Y-m-d H:i:s', strtotime($data_hora)),
            'situacao'=>1,
            'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
        ));
    }

    public function responder($cod_requisicao = null)
    {
        $this->db->insert('tb_requisicoes_respostas',array(
            'cod_requisicao'=>$cod_requisicao,
            'id_usuario'=>$this->session->userdata('id_usuario'),
            'resposta'=>$this->input->post('resposta',true)
        ));

        $this->db->where('cod_requisicao', $cod_requisicao);
        $this->db->update('tb_requisicoes',array(
            'situacao'=>2,
            'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
        ));

        // ENVIAR E-MAIL RESPOSTA
        $this->load->model('enviar_email_model');
        return $this->enviar_email_model->enviar_email_resposta("Resposta Requisição", $cod_requisicao, $this->input->post('resposta'));
    }

    public function encerrar($cod_requisicao = null, $cod_requisicao_associado = null)
    {
        // ENVIAR E-MAIL ENCERRAR
        $this->load->model('enviar_email_model');
        $this->enviar_email_model->enviar_email_encerrar("Encerramento Requisição", $cod_requisicao);

        if($cod_requisicao_associado == null) {
            $this->db->where('cod_requisicao', $cod_requisicao);
            return $this->db->update('tb_requisicoes',array(
                'situacao'=>3,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));
        } else {

            $this->db->where('cod_requisicao', $cod_requisicao);
            $this->db->update('tb_requisicoes',array(
                'situacao'=>3,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));

            $this->db->where('cod_requisicao', $cod_requisicao_associado);
            return $this->db->update('tb_requisicoes',array(
                'situacao'=>3,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));
        }
    }

    public function cancelar($cod_requisicao = null, $cod_requisicao_associado = null)
    {
        // ENVIAR E-MAIL CANCELAR
        $this->load->model('enviar_email_model');
        return $this->enviar_email_model->enviar_email_cancelar("Cancelar Requisição", $cod_requisicao);

        if($cod_requisicao_associado == null) {
            $this->db->where('cod_requisicao', $cod_requisicao);
            return $this->db->update('tb_requisicoes',array(
                'situacao'=>4,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));
        } else {

            $this->db->where('cod_requisicao', $cod_requisicao);
            $this->db->update('tb_requisicoes',array(
                'situacao'=>4,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));

            $this->db->where('cod_requisicao', $cod_requisicao_associado);
            return $this->db->update('tb_requisicoes',array(
                'situacao'=>4,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));
        }
    }

    public function retomar($cod_requisicao = null)
    {
        // ENVIAR E-MAIL CANCELAR
        $this->load->model('enviar_email_model');
        $this->enviar_email_model->enviar_email_retomar("Retomar Requisição", $cod_requisicao);

        $this->db->where('cod_requisicao', $cod_requisicao);
        return $this->db->update('tb_requisicoes',array(
            'situacao'=>1,
            'id_usuario_concluido_cancelado'=>'0'
        ));
    }

    public function associar($cod_requisicao = null)
    {
        $this->db->where('cod_requisicao', $cod_requisicao);
        $this->db->update('tb_requisicoes',array(
            'cod_requisicao_associado'=>$this->input->post('cod_requisicao_associado', true)
        ));

        $this->db->where('cod_requisicao', $this->input->post('cod_requisicao_associado'));
        return $this->db->update('tb_requisicoes',array(
            'cod_requisicao_associado'=>$cod_requisicao
        ));
    }

    public function gerar_mudanca($cod_requisicao = null, $id_fluxo_mudanca = null)
    {
        $this->db->insert('tb_mudancas',array(
            'cod_requisicao'=>$cod_requisicao,
            'id_fluxo_mudanca'=>$this->input->post('id_fluxo_mudanca', true)
        ));

        // VERIFICA SE O REGISTRO FOI INSERIDO E CHAMA O MODEL PARA ENVIAR O E-MAIL
        if ($this->db->affected_rows() == '1')
        {
            $cod = $this->db->insert_id('tb_mudancas');

            $this->load->model('enviar_email_model');
            $this->enviar_email_model->enviar_email_gerar_mudanca("Nova Mudança", $cod, $cod_requisicao, "da Requisição:");
        }

        $cod_mudanca = $this->db->insert_id();

        $this->db->where('cod_requisicao', $cod_requisicao);
        $this->db->update('tb_requisicoes',array(
            'gerou_mudanca'=>1
        ));

        // SELECT PARA PEGAR O ID DO PRIMEIRO USUÁRIO AO APROVAR O FLUXO
        $this->db->where('id_fluxo_mudanca', $id_fluxo_mudanca);
        $this->db->limit(1);
        $query = $this->db->get('tb_fluxo_mudanca_etapas');

        foreach ($query->result() as $row)
        {
            $idUsuResp = $row->id_usuario_responsavel;
        }

        return $this->db->insert('tb_fluxo_aprovadores',array(
            'cod_mudanca'=>$cod_mudanca,
            'id_usuario_aprovador_atual'=>$idUsuResp
        ));
    }

    public function gerar_problema($cod_requisicao = null)
    {
        $this->db->insert('tb_problemas',array(
            'cod_requisicao'=>$cod_requisicao
        ));

        // VERIFICA SE O REGISTRO FOI INSERIDO E CHAMA O MODEL PARA ENVIAR O E-MAIL
        if ($this->db->affected_rows() == '1')
        {
            $cod = $this->db->insert_id('tb_problemas');

            $this->load->model('enviar_email_model');
            $this->enviar_email_model->enviar_email_gerar_problema("Novo Problema", $cod, $cod_requisicao, "da Requisição:");
        }

        $this->db->where('cod_requisicao', $cod_requisicao);
        return $this->db->update('tb_requisicoes',array(
            'gerou_problema'=>1
        ));
    }

    public function responder_pesquisa_satisfacao($cod_requisicao = null)
    {
        $this->db->insert('tb_requisicoes_pesquisa_satisfacao',array(
            'cod_requisicao'=>$cod_requisicao,
            'id_usuario'=>1,
            'assunto'=>$this->input->post('assunto', true),
            'observacoes'=>$this->input->post('observacoes', true),
            'pergunta1'=>$this->input->post('pergunta1', true),
            'pergunta2'=>$this->input->post('pergunta2', true),
            'pergunta3'=>$this->input->post('pergunta3', true),
            'pergunta4'=>$this->input->post('pergunta4', true)
        ));

        $this->db->where('cod_requisicao', $cod_requisicao);
        $this->db->update('tb_requisicoes',array(
            'respondeu_pesq'=>1
        ));

        // ENVIAR E-MAIL RESPOSTA PESQUISA DE SATISFAÇÃO
        $this->load->model('enviar_email_model');
        return $this->enviar_email_model->enviar_email_pesquisa_satisfacao("Pesquisa de Satisfação da Requisição", $cod_requisicao);
    }

    public function anexarArquivoRequisicao()
    {
        $this->load->library('upload');
        $this->load->library('image_lib');

        $upload_conf = array(
            'upload_path'   => realpath('./assets/uploads/anexos_requisicoes'),
            'allowed_types' => 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG|pdf|PDF|cdr|CDR|doc|docx|DOCX|txt|xls|xlsx',
            'max_size'      => 0,
            'encrypt_name'  => true,
        );
    
        $this->upload->initialize($upload_conf);
        
        // Change $_FILES to new vars and loop them
        foreach($_FILES['userfile'] as $key=>$val)
        {
            $i = 1;
            foreach($val as $v)
            {
                $field_name = "file_".$i;
                $_FILES[$field_name][$key] = $v;
                $i++;   
            }
        }
        // Unset the useless one ;)
        unset($_FILES['userfile']);
    
        $error = array();
        $success = array();
        
        foreach($_FILES as $field_name => $file)
        {
            if ( ! $this->upload->do_upload($field_name))
            {
                $error['upload'][] = $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();
                
                return $this->db->insert('tb_requisicoes_anexos',array(
                    'cod_requisicao'=>$this->input->post('cod_requisicao', true),
                    'id_usuario'=>$this->session->userdata('id_usuario'),
                    'anexo'=>$upload_data['file_name'],
                    'url'=>base_url().'assets/uploads/anexos_incidentes/',
                    'thumb'=>'thumb_'.$upload_data['file_name'],
                    'path'=>realpath('./assets/uploads/anexos_incidentes/'),
                    'extensao'=>$upload_data['file_ext']
                ));
            }
        }
    }

    public function downloadAnexoRequisicao($id_anexo = null){
        
        if($id_anexo != null && is_numeric($id_anexo)){
            
            $this->db->where('id_anexo', $id_anexo);
            $file = $this->db->get('tb_requisicoes_anexos',1)->row();
            $this->load->library('zip');
            $path = $file->path;
            $this->zip->read_file($path.'/'.$file->anexo); 
            $this->zip->download('Requisição '.$file->cod_requisicao.' - '.date('d-m-Y-H.i.s').'.zip');

            return true;
        }
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'cod_requisicao';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $offset = ($page-1) * $rows;

        if($this->session->userdata('tipo') == 1) {
            $result = array();
            $result['total'] = $this->db->where('id_usuario_req', $this->session->userdata('id_usuario'))->get('vw_requisicoes')->num_rows();
            $row = array();
        } else {
            $result = array();
            $result['total'] = $this->db->get('vw_requisicoes')->num_rows();
            $row = array();
        }

        $cod_requisicao = isset($_POST['cod_requisicao']) ? strval($_POST['cod_requisicao']) : '';
        $assunto = isset($_POST['assunto_req']) ? strval($_POST['assunto_req']) : '';
        
        $this->db->limit($rows,$offset);
        $this->db->order_by($sort,$order);
        $this->db->like('cod_requisicao', $cod_requisicao);
        $this->db->like('assunto_req', $assunto);

        if($this->session->userdata('tipo') == 1) {
            $this->db->where('id_usuario_req', $this->session->userdata('id_usuario'));
        } else if ($this->session->userdata('tipo') == 2) {
            $this->db->where('id_departamento_req', $this->session->userdata('id_departamento'));
        }

        $criteria = $this->db->get('vw_requisicoes');
        
        foreach($criteria->result_array() as $data)
        {
            $row[] = array(
                'cod_requisicao'=>$data['cod_requisicao'],
                'id_usuario_req'=>$data['id_usuario_req'],
                'id_acordo_nivel_servico_req'=>$data['id_acordo_nivel_servico_req'],
                'tarefa_req'=>$data['tarefa_req'],
                'id_departamento_req'=>$data['id_departamento_req'],
                'assunto_req'=>$data['assunto_req'],
                'requisicao_req'=>$data['requisicao_req'],
                'data_hora_req'=>$data['data_hora_req'],
                'situacao_req'=>$data['situacao_req'],
                'aprovado_req'=>$data['aprovado_req'],
                'gerou_mudanca_req'=>$data['gerou_mudanca_req'],
                'gerou_problema_req'=>$data['gerou_problema_req'],
                'respondeu_pesq_req'=>$data['respondeu_pesq_req'],
                'cod_requisicao_associado_req'=>$data['cod_requisicao_associado_req']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }

    public function getJsonRetorno()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'cod_requisicao';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $offset = ($page-1) * $rows;

        $this->db->limit($rows,$offset);
        $this->db->order_by($sort,$order);
        $this->db->where('id_usuario', $this->session->userdata('id_usuario'));
        $this->db->where('id_usuario_ult_resp !=', $this->session->userdata('id_usuario'));
        $this->db->where('situacao', 2);
        $this->db->where('data_hora >=', $this->session->userdata('data_gweb_de'));
        $this->db->where('data_hora <=', $this->session->userdata('data_gweb_ate'));
        $criteria = $this->db->get('tb_requisicoes');

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'cod_requisicao'=>$data['cod_requisicao'],
                'assunto_req'=>$data['assunto']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }

    public function getJsonRetornoArea()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'cod_requisicao';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $offset = ($page-1) * $rows;

        $this->db->limit($rows,$offset);
        $this->db->order_by($sort,$order);

        $this->db->select('tb_requisicoes.*');
        $this->db->from('tb_requisicoes');
        $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_requisicoes.id_usuario');
        $this->db->where('tb_usuarios.id_departamento', $this->session->userdata('id_departamento'));
        $this->db->where('tb_requisicoes.id_usuario !=', $this->session->userdata('id_usuario'));
        $this->db->where('tb_requisicoes.id_usuario_ult_resp !=', $this->session->userdata('id_usuario'));
        $this->db->where('tb_requisicoes.situacao', 2);
        $this->db->where('data_hora >=', $this->session->userdata('data_gweb_de'));
        $this->db->where('data_hora <=', $this->session->userdata('data_gweb_ate'));
        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'cod_requisicao'=>$data['cod_requisicao'],
                'assunto_req'=>$data['assunto']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}