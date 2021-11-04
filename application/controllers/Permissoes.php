<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissoes extends MY_Controller {

    function __construct() 
    {
        parent::__construct();

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('permissoes_model', '', TRUE);
    }

    // PÁGINA DE LOGIN
    public function index()
    {
        $this->load->view('configuracoes/permissoes/permissoes');
    }

    // CONTEÚDO PERMISSÃO
    public function conteudo_permissao($id)
    {
        $this->data['dados'] = $this->permissoes_model->pegarPorID($id);
        $this->load->view('configuracoes/permissoes/conteudo_permissao', $this->data);
    }

    // LISTAR
    public function listar()
    {
        echo $this->permissoes_model->getJson();
    }

    // CADASTRAR
    public function cadastrar()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->permissoes_model->cadastrar())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // SALVAR ACESSOS
    public function salvarAcessos()
    {
        if(!isset($_POST))  
            show_404();
        
        if($this->permissoes_model->salvarAcessos())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // ATUALIZAR
    public function atualizar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->permissoes_model->atualizar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }

    // DESATIVAR
    public function desativar($id = null)
    {
        if(!isset($_POST))
            show_404();
        
        if($this->permissoes_model->desativar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
    
    // DELETAR
    public function deletar()
    {
        if(!isset($_POST))  
            show_404();
        
        $id = intval(addslashes($_POST['id_permissao']));
        if($this->permissoes_model->deletar($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Falha ao cadastrar os dados'));
    }
}