<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Incidentes_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function listarCombo()
    {
        $arr = array(3, 4);
        $this->db->where_not_in('situacao', $arr);
        return json_encode($this->db->get('tb_incidentes')->result());
    }

    public function infoIncidente($cod = null){
        $this->db->where('cod_incidente',$cod);
        return $this->db->get('vw_incidentes')->row();
    }

    public function contarIncUsuario($situacao)
    {
        $this->db->where('situacao',$situacao);
        $this->db->where('id_usuario',$this->session->userdata('id_usuario'));
        $this->db->where('data_hora >=',$this->session->userdata('data_gweb_de'));
        $this->db->where('data_hora <=',$this->session->userdata('data_gweb_ate'));
        return $this->db->count_all_results('tb_incidentes');
    }

    public function contarIncAdmTec($situacao)
    {
        $this->db->where('situacao',$situacao);
        $this->db->where('data_hora >=',$this->session->userdata('data_gweb_de'));
        $this->db->where('data_hora <=',$this->session->userdata('data_gweb_ate'));
        return $this->db->count_all_results('tb_incidentes');
    }

    public function respostaIncidente($cod = null){
        $this->db->select('tb_incidentes_respostas.*, tb_usuarios.nome, tb_usuarios.url_imagem');
        $this->db->from('tb_incidentes_respostas');
        $this->db->join('tb_incidentes','tb_incidentes.cod_incidente = tb_incidentes_respostas.cod_incidente');
        $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes_respostas.id_usuario');
        $this->db->where('tb_incidentes_respostas.cod_incidente',$cod);
        $this->db->order_by('tb_incidentes_respostas.data_resposta','desc'); 
        return $this->db->get()->result();
    }

    public function anexoIncidente($cod = null){
        $this->db->select('tb_incidentes_anexos.id_anexo as id_anexo_inc, 
            tb_incidentes_anexos.cod_incidente as cod_incidente_anex, 
            tb_incidentes_anexos.id_usuario as id_usuario_anex_inc,
            tb_incidentes_anexos.anexo as anexo_anex_inc,
            tb_incidentes_anexos.thumb as thumb_anex_inc,
            tb_incidentes_anexos.url as url_anex_inc,
            tb_incidentes_anexos.extensao as extensao_anex_inc,
            tb_incidentes_anexos.data_hora as data_hora_anex_inc,
            tb_usuarios.nome as nome_anex_inc');
        $this->db->from('tb_incidentes_anexos');
        $this->db->join('tb_incidentes','tb_incidentes.cod_incidente = tb_incidentes_anexos.cod_incidente');
        $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes_anexos.id_usuario');
        $this->db->where('tb_incidentes_anexos.cod_incidente',$cod);
        $this->db->order_by('tb_incidentes_anexos.data_hora','desc'); 
        return $this->db->get()->result();
    }

    public function cadastrar()
    {
        if($this->input->post('data_hora_inc') == null) {

            $this->db->insert('tb_incidentes',array(
                'id_usuario'=>$this->input->post('id_usuario_inc', true),
                'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_inc', true),
                'id_departamento'=>$this->input->post('id_departamento_inc', true),
                'assunto'=>$this->input->post('assunto_inc', true),
                'incidente'=>$this->input->post('incidente_inc', true),
                'situacao'=>1,
                'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
            ));

        } else {

            $data_hora = strtr($this->input->post('data_hora_inc'), '/', '-');

            $this->db->insert('tb_incidentes',array(
                'id_usuario'=>$this->input->post('id_usuario_inc', true),
                'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_inc', true),
                'id_departamento'=>$this->input->post('id_departamento_inc', true),
                'assunto'=>$this->input->post('assunto_inc', true),
                'incidente'=>$this->input->post('incidente_inc', true),
                'data_hora'=>date('Y-m-d H:i:s', strtotime($data_hora)),
                'situacao'=>1,
                'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
            ));
        }

        // VERIFICA SE O REGISTRO FOI INSERIDO E CHAMA O MODEL PARA ENVIAR O E-MAIL
        if ($this->db->affected_rows() > 0)
        {
            $cod = $this->db->insert_id('tb_incidentes');

            $this->load->model('enviar_email_model');
            return $this->enviar_email_model->enviar_email_abertura("Novo Incidente", $cod, $this->input->post('assunto_inc'), $this->input->post('incidente_inc'));
        }
    }

    public function atualizar($cod_incidente = null)
    {
        $data_hora = strtr($this->input->post('data_hora_inc'), '/', '-');

        $this->db->where('cod_incidente', $cod_incidente);
        return $this->db->update('tb_incidentes',array(
            'id_usuario'=>$this->input->post('id_usuario_inc',true),
            'id_acordo_nivel_servico'=>$this->input->post('id_acordo_nivel_servico_inc',true),
            'id_departamento'=>$this->input->post('id_departamento_inc',true),
            'assunto'=>$this->input->post('assunto_inc',true),
            'incidente'=>$this->input->post('incidente_inc',true),
            'data_hora'=>date('Y-m-d H:i:s', strtotime($data_hora)),
            'situacao'=>1,
            'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
        ));
    }

    public function responder($cod_incidente = null)
    {
        $this->db->insert('tb_incidentes_respostas',array(
            'cod_incidente'=>$cod_incidente,
            'id_usuario'=>$this->session->userdata('id_usuario'),
            'resposta'=>$this->input->post('resposta_inc',true)
        ));

        $this->db->where('cod_incidente', $cod_incidente);
        $this->db->update('tb_incidentes',array(
            'situacao'=>2,
            'id_usuario_ult_resp'=>$this->session->userdata('id_usuario')
        ));

        // ENVIAR E-MAIL RESPOSTA
        $this->load->model('enviar_email_model');
        return $this->enviar_email_model->enviar_email_resposta("Resposta Incidente", $cod_incidente, $this->input->post('resposta_inc'));
    }

    public function encerrar($cod_incidente = null, $cod_incidente_associado = null)
    {
        // ENVIAR E-MAIL ENCERRAR
        $this->load->model('enviar_email_model');
        $this->enviar_email_model->enviar_email_encerrar("Encerramento Incidente", $cod_incidente);

        if($cod_incidente_associado == null) {
            $this->db->where('cod_incidente', $cod_incidente);
            return $this->db->update('tb_incidentes',array(
                'situacao'=>3,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));
        } else {

            $this->db->where('cod_incidente', $cod_incidente);
            $this->db->update('tb_incidentes',array(
                'situacao'=>3,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));

            $this->db->where('cod_incidente', $cod_incidente_associado);
            return $this->db->update('tb_incidentes',array(
                'situacao'=>3,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));
        }
    }

    public function cancelar($cod_incidente = null, $cod_incidente_associado = null)
    {
        // ENVIAR E-MAIL CANCELAR
        $this->load->model('enviar_email_model');
        $this->enviar_email_model->enviar_email_cancelar("Cancelar Incidente", $cod_incidente);

        if($cod_incidente_associado == null) {
            $this->db->where('cod_incidente', $cod_incidente);
            return $this->db->update('tb_incidentes',array(
                'situacao'=>4,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));
        } else {

            $this->db->where('cod_incidente', $cod_incidente);
            $this->db->update('tb_incidentes',array(
                'situacao'=>4,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));

            $this->db->where('cod_incidente', $cod_incidente_associado);
            return $this->db->update('tb_incidentes',array(
                'situacao'=>4,
                'id_usuario_concluido_cancelado'=>$this->session->userdata('id_usuario')
            ));
        }
    }

    public function retomar($cod_incidente = null)
    {
        // ENVIAR E-MAIL CANCELAR
        $this->load->model('enviar_email_model');
        $this->enviar_email_model->enviar_email_retomar("Retomar Incidente", $cod_incidente);

        $this->db->where('cod_incidente', $cod_incidente);
        return $this->db->update('tb_incidentes',array(
            'situacao'=>1,
            'id_usuario_concluido_cancelado'=>'0'
        ));
    }

    public function associar($cod_incidente = null)
    {
        $this->db->where('cod_incidente', $cod_incidente);
        $this->db->update('tb_incidentes',array(
            'cod_incidente_associado'=>$this->input->post('cod_incidente_associado', true)
        ));

        $this->db->where('cod_incidente', $this->input->post('cod_incidente_associado'));
        return $this->db->update('tb_incidentes',array(
            'cod_incidente_associado'=>$cod_incidente
        ));
    }

    public function gerar_mudanca($cod_incidente = null)
    {
        $this->db->insert('tb_mudancas',array(
            'cod_incidente'=>$cod_incidente,
            'id_fluxo_mudanca'=>$this->input->post('id_fluxo_mudanca', true)
        ));

        // VERIFICA SE O REGISTRO FOI INSERIDO E CHAMA O MODEL PARA ENVIAR O E-MAIL
        if ($this->db->affected_rows() > 0)
        {
            $cod = $this->db->insert_id('tb_mudancas');

            $this->load->model('enviar_email_model');
            return $this->enviar_email_model->enviar_email_gerar_mudanca("Nova Mudança", $cod, $cod_incidente, "do Incidente:");
        }

        $cod_mudanca = $this->db->insert_id();

        // SELECT PARA PEGAR O ID DO PRIMEIRO USUÁRIO AO APROVAR O FLUXO
        $this->db->where('id_fluxo_mudanca', $this->input->post('id_fluxo_mudanca'));
        $this->db->where('ordem', 1);
        $this->db->order_by('id_etapa', 'asc');
        $query = $this->db->get('tb_fluxo_mudanca_etapas');

        foreach ($query->result() as $row)
        {
            $idUsuResp = $row->id_usuario_responsavel;
        }

        $this->db->insert('tb_fluxo_aprovadores',array(
            'cod_mudanca'=>$cod_mudanca,
            'id_usuario_aprovador_atual'=>$idUsuResp
        ));

        $this->db->where('cod_incidente', $cod_incidente);
        return $this->db->update('tb_incidentes',array(
            'gerou_mudanca'=>1
        ));
    }

    public function gerar_problema($cod_incidente = null)
    {
        $this->db->insert('tb_problemas',array(
            'cod_incidente'=>$cod_incidente
        ));

        // VERIFICA SE O REGISTRO FOI INSERIDO E CHAMA O MODEL PARA ENVIAR O E-MAIL
        if ($this->db->affected_rows() > 0)
        {
            $cod = $this->db->insert_id('tb_problemas');

            $this->load->model('enviar_email_model');
            $this->enviar_email_model->enviar_email_gerar_problema("Novo Problema", $cod, $cod_incidente, "do Incidente:");
        }

        $this->db->where('cod_incidente', $cod_incidente);
        return $this->db->update('tb_incidentes',array(
            'gerou_problema'=>1
        ));
    }

    public function responder_pesquisa_satisfacao($cod_incidente = null)
    {
        $this->db->insert('tb_incidentes_pesquisa_satisfacao',array(
            'cod_incidente'=>$cod_incidente,
            'id_usuario'=>1,
            'assunto'=>$this->input->post('assunto_pesq_inc', true),
            'observacoes'=>$this->input->post('observacoes_pesq_inc', true),
            'pergunta1'=>$this->input->post('pergunta1_pesq_inc', true),
            'pergunta2'=>$this->input->post('pergunta2_pesq_inc', true),
            'pergunta3'=>$this->input->post('pergunta3_pesq_inc', true),
            'pergunta4'=>$this->input->post('pergunta4_pesq_inc', true)
        ));

        $this->db->where('cod_incidente', $cod_incidente);
        $this->db->update('tb_incidentes',array(
            'respondeu_pesq'=>1
        ));

        // ENVIAR E-MAIL RESPOSTA PESQUISA DE SATISFAÇÃO
        $this->load->model('enviar_email_model');
        return $this->enviar_email_model->enviar_email_pesquisa_satisfacao("Pesquisa de Satisfação do Incidente", $cod_incidente);
    }

    public function anexarArquivoIncidente()
    {
        $this->load->library('upload');
        $this->load->library('image_lib');

        $upload_conf = array(
            'upload_path'   => realpath('./assets/uploads/anexos_incidentes'),
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
                
                return $this->db->insert('tb_incidentes_anexos',array(
                    'cod_incidente'=>$this->input->post('cod_incidente', true),
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

    public function downloadAnexoIncidente($id_anexo = null){
        
        if($id_anexo != null && is_numeric($id_anexo)){
            
            $this->db->where('id_anexo', $id_anexo);
            $file = $this->db->get('tb_incidentes_anexos',1)->row();
            $this->load->library('zip');
            $path = $file->path;
            $this->zip->read_file($path.'/'.$file->anexo); 
            $this->zip->download('Incidente '.$file->cod_incidente.' - '.date('d-m-Y-H.i.s').'.zip');

            return true;
        }
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'cod_incidente';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $offset = ($page-1) * $rows;

        if($this->session->userdata('tipo') == 1) {
            $result = array();
            $result['total'] = $this->db->where('id_usuario_inc', $this->session->userdata('id_usuario'))->get('vw_incidentes')->num_rows();
            $row = array();
        } else {
            $result = array();
            $result['total'] = $this->db->get('vw_incidentes')->num_rows();
            $row = array();
        }

        $cod_incidente = isset($_POST['cod_incidente']) ? strval($_POST['cod_incidente']) : '';
        $assunto = isset($_POST['assunto_inc']) ? strval($_POST['assunto_inc']) : '';
        
        $this->db->limit($rows,$offset);
        $this->db->order_by($sort,$order);
        $this->db->like('cod_incidente', $cod_incidente);
        $this->db->like('assunto_inc', $assunto);

        if($this->session->userdata('tipo') == 1) {
            $this->db->where('id_usuario_inc', $this->session->userdata('id_usuario'));
        } else if ($this->session->userdata('tipo') == 2) {
            $this->db->where('id_departamento_inc', $this->session->userdata('id_departamento'));
        }

        $criteria = $this->db->get('vw_incidentes');

        foreach($criteria->result_array() as $data)
        {
            $row[] = array(
                'cod_incidente'=>$data['cod_incidente'],
                'id_usuario_inc'=>$data['id_usuario_inc'],
                'id_acordo_nivel_servico_inc'=>$data['id_acordo_nivel_servico_inc'],
                'tarefa_inc'=>$data['tarefa_inc'],
                'id_departamento_inc'=>$data['id_departamento_inc'],
                'assunto_inc'=>$data['assunto_inc'],
                'incidente_inc'=>$data['incidente_inc'],
                'data_hora_inc'=>$data['data_hora_inc'],
                'situacao_inc'=>$data['situacao_inc'],
                'aprovado_inc'=>$data['aprovado_inc'],
                'gerou_mudanca_inc'=>$data['gerou_mudanca_inc'],
                'gerou_problema_inc'=>$data['gerou_problema_inc'],
                'respondeu_pesq_inc'=>$data['respondeu_pesq_inc'],
                'cod_incidente_associado_inc'=>$data['cod_incidente_associado_inc']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }

    public function getJsonRetorno()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'cod_incidente';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $offset = ($page-1) * $rows;

        $this->db->limit($rows,$offset);
        $this->db->order_by($sort,$order);
        $this->db->where('id_usuario', $this->session->userdata('id_usuario'));
        $this->db->where('id_usuario_ult_resp !=', $this->session->userdata('id_usuario'));
        $this->db->where('situacao', 2);
        $this->db->where('data_hora >=', $this->session->userdata('data_gweb_de'));
        $this->db->where('data_hora <=', $this->session->userdata('data_gweb_ate'));
        $criteria = $this->db->get('tb_incidentes');

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'cod_incidente'=>$data['cod_incidente'],
                'assunto_inc'=>$data['assunto']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }

    public function getJsonRetornoArea()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'cod_incidente';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $offset = ($page-1) * $rows;

        $this->db->limit($rows,$offset);
        $this->db->order_by($sort,$order);

        $this->db->select('tb_incidentes.*');
        $this->db->from('tb_incidentes');
        $this->db->join('tb_usuarios','tb_usuarios.id_usuario = tb_incidentes.id_usuario');
        $this->db->where('tb_usuarios.id_departamento', $this->session->userdata('id_departamento'));
        $this->db->where('tb_incidentes.id_usuario !=', $this->session->userdata('id_usuario'));
        $this->db->where('tb_incidentes.id_usuario_ult_resp !=', $this->session->userdata('id_usuario'));
        $this->db->where('tb_incidentes.situacao', 2);
        $this->db->where('data_hora >=', $this->session->userdata('data_gweb_de'));
        $this->db->where('data_hora <=', $this->session->userdata('data_gweb_ate'));
        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'cod_incidente'=>$data['cod_incidente'],
                'assunto_inc'=>$data['assunto']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}