<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_services extends CI_Controller {
	
	public function buscaCep(){
        $cep = $_POST['cep'];
         
        $reg = @simplexml_load_file("http://republicavirtual.com.br/web_cep.php?cep=" . $cep);
         
        $dados['sucesso'] = (string) $reg->resultado;
        $dados['rua']     = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
        $dados['bairro']  = (string) $reg->bairro;
        $dados['cidade']  = (string) $reg->cidade;
        $dados['estado']  = (string) $reg->uf;
         
        echo json_encode($dados);
    }
}