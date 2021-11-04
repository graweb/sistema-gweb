<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enviar_email_model extends CI_Model {

    // ENVIAR E-MAIL NA ABERTURA
	public function enviar_email_abertura($assunto, $cod, $tema, $descricao)
    {
        // ENVIA E-MAIL DA ABERTURA DO INCIDENTE PARA O EMITENTE E O USUÁRIO QUE ABRIU
        $this->email->from($this->session->userdata('email_emitente'), 'GWeb - Gestão de Serviços');
        $this->email->to($this->session->userdata('email'), 'GWeb - Gestão de Serviços');
        //$this->email->cc($this->session->userdata('email_emitente'));

        $this->email->subject($assunto." ".str_pad($cod, 6, "0", STR_PAD_LEFT)." por ".$this->session->userdata('nome'));
        $this->email->message("
            <b><h2>Gweb - Gestão de Serviços</h2></b>
            <b>Código $assunto:</b> <b style=font-size:15px>". str_pad($cod, 6, "0", STR_PAD_LEFT) ."</b>
            <br /><b>Usuário:</b> " . $this->session->userdata('nome') ."
            <br /><b>E-mail:</b> " . $this->session->userdata('email') . "
            <br /><b>Assunto:</b> " . $tema . "
            <br /><b>Descrição:</b> " . $descricao . " <hr>
            <p>
            <b>* Aguarde o prazo de 24h para posicionamento do Técnico!</b>" . "
            <br /><b>* Favor, não responder esse e-mail!</b>"
            );
        $this->email->set_mailtype("html");
        $this->email->send();
    }

    // ENVIAR E-MAIL NA RESPOSTA
    public function enviar_email_resposta($assunto, $cod, $resposta)
    {
        // ENVIA E-MAIL DA ABERTURA DO INCIDENTE PARA O EMITENTE E O USUÁRIO QUE ABRIU
        $this->email->from($this->session->userdata('email_emitente'), 'GWeb - Gestão de Serviços');
        $this->email->to($this->session->userdata('email'), 'GWeb - Gestão de Serviços');
        //$this->email->cc($this->session->userdata('email_emitente'));

        $this->email->subject($assunto." ".str_pad($cod, 6, "0", STR_PAD_LEFT)." por ".$this->session->userdata('nome'));
        $this->email->message("
            <b><h2>Gweb - Gestão de Serviços</h2></b>
            <b>Código $assunto:</b> <b style=font-size:15px>". str_pad($cod, 6, "0", STR_PAD_LEFT) ."</b>
            <br /><b>Usuário:</b> " . $this->session->userdata('nome') ."
            <br /><b>E-mail:</b> " . $this->session->userdata('email') . "
            <br /><b>Resposta:</b> " . $resposta . " <hr>
            <p>
            <b>* Aguarde o prazo de 24h para posicionamento do Técnico!</b>" . "
            <br /><b>* Favor, não responder esse e-mail!</b>"
            );
        $this->email->set_mailtype("html");
        $this->email->send();
    }

    // ENVIAR E-MAIL NO ENCERRAMENTO
    public function enviar_email_encerrar($assunto, $cod)
    {
        // ENVIA E-MAIL DA ABERTURA DO INCIDENTE PARA O EMITENTE E O USUÁRIO QUE ABRIU
        $this->email->from($this->session->userdata('email_emitente'), 'GWeb - Gestão de Serviços');
        $this->email->to($this->session->userdata('email'), 'GWeb - Gestão de Serviços');
        //$this->email->cc($this->session->userdata('email_emitente'));

        $this->email->subject($assunto." ".str_pad($cod, 6, "0", STR_PAD_LEFT)." por ".$this->session->userdata('nome'));
        $this->email->message("
            <b><h2>Gweb - Gestão de Serviços</h2></b>
            <b>Código $assunto:</b> <b style=font-size:15px>". str_pad($cod, 6, "0", STR_PAD_LEFT) ."</b>
            <br /><b>Encerrado por:</b> " . $this->session->userdata('nome') . " <hr>
            <p>
            <b>* Favor, não responder esse e-mail!</b>"
            );
        $this->email->set_mailtype("html");
        $this->email->send();
    }

    // ENVIAR E-MAIL NO CANCELAMENTO
    public function enviar_email_cancelar($assunto, $cod)
    {
        // ENVIA E-MAIL DA ABERTURA DO INCIDENTE PARA O EMITENTE E O USUÁRIO QUE ABRIU
        $this->email->from($this->session->userdata('email_emitente'), 'GWeb - Gestão de Serviços');
        $this->email->to($this->session->userdata('email'), 'GWeb - Gestão de Serviços');
        //$this->email->cc($this->session->userdata('email_emitente'));

        $this->email->subject($assunto." ".str_pad($cod, 6, "0", STR_PAD_LEFT)." por ".$this->session->userdata('nome'));
        $this->email->message("
            <b><h2>Gweb - Gestão de Serviços</h2></b>
            <b>Código $assunto:</b> <b style=font-size:15px>". str_pad($cod, 6, "0", STR_PAD_LEFT) ."</b>
            <br /><b>Cancelado por:</b> " . $this->session->userdata('nome') . " <hr>
            <p>
            <b>* Favor, não responder esse e-mail!</b>"
            );
        $this->email->set_mailtype("html");
        $this->email->send();
    }

    // ENVIAR E-MAIL RETOMAR
    public function enviar_email_retomar($assunto, $cod)
    {
        // ENVIA E-MAIL DA ABERTURA DO INCIDENTE PARA O EMITENTE E O USUÁRIO QUE ABRIU
        $this->email->from($this->session->userdata('email_emitente'), 'GWeb - Gestão de Serviços');
        $this->email->to($this->session->userdata('email'), 'GWeb - Gestão de Serviços');
        //$this->email->cc($this->session->userdata('email_emitente'));

        $this->email->subject($assunto." ".str_pad($cod, 6, "0", STR_PAD_LEFT)." por ".$this->session->userdata('nome'));
        $this->email->message("
            <b><h2>Gweb - Gestão de Serviços</h2></b>
            <b>Código $assunto:</b> <b style=font-size:15px>". str_pad($cod, 6, "0", STR_PAD_LEFT) ."</b>
            <br /><b>Retomado por:</b> " . $this->session->userdata('nome') . " <hr>
            <p>
            <b>* Favor, não responder esse e-mail!</b>"
            );
        $this->email->set_mailtype("html");
        $this->email->send();
    }

    // ENVIAR E-MAIL AO GERAR MUDANÇA
    public function enviar_email_gerar_mudanca($assunto, $cod, $cod_incidente, $tipo_inc_req)
    {
        // ENVIA E-MAIL DA ABERTURA DO INCIDENTE PARA O EMITENTE E O USUÁRIO QUE ABRIU
        $this->email->from($this->session->userdata('email_emitente'), 'GWeb - Gestão de Serviços');
        $this->email->to($this->session->userdata('email'), 'GWeb - Gestão de Serviços');
        //$this->email->cc($this->session->userdata('email_emitente'));

        $this->email->subject($assunto." ".str_pad($cod, 6, "0", STR_PAD_LEFT)." por ".$this->session->userdata('nome'));
        $this->email->message("
            <b><h2>Gweb - Gestão de Serviços</h2></b>
            <b>Código $assunto:</b> <b style=font-size:15px>". str_pad($cod, 6, "0", STR_PAD_LEFT) ."</b>
            <br /><b>Registrado por:</b> " . $this->session->userdata('nome') ."
            <br /><b>E-mail:</b> " . $this->session->userdata('email') . "
            <br /><b>Cód. ". $tipo_inc_req ." Associado</b> " . $cod_incidente . "
            <p>
            <b>* Aguarde o prazo de 24h para posicionamento do Técnico!</b>" . "
            <br /><b>* Favor, não responder esse e-mail!</b>"
            );
        $this->email->set_mailtype("html");
        $this->email->send();
    }

    // ENVIAR E-MAIL AO GERAR PROBLEMA
    public function enviar_email_gerar_problema($assunto, $cod, $cod_incidente, $tipo_inc_req)
    {
        // ENVIA E-MAIL DA ABERTURA DO INCIDENTE PARA O EMITENTE E O USUÁRIO QUE ABRIU
        $this->email->from($this->session->userdata('email_emitente'), 'GWeb - Gestão de Serviços');
        $this->email->to($this->session->userdata('email'), 'GWeb - Gestão de Serviços');
        //$this->email->cc($this->session->userdata('email_emitente'));

        $this->email->subject($assunto." ".str_pad($cod, 6, "0", STR_PAD_LEFT)." por ".$this->session->userdata('nome'));
        $this->email->message("
            <b><h2>Gweb - Gestão de Serviços</h2></b>
            <b>Código $assunto:</b> <b style=font-size:15px>". str_pad($cod, 6, "0", STR_PAD_LEFT) ."</b>
            <br /><b>Registrado por:</b> " . $this->session->userdata('nome') ."
            <br /><b>E-mail:</b> " . $this->session->userdata('email') . "
            <br /><b>Cód. ". $tipo_inc_req ." Associado</b> " . $cod_incidente . "
            <p>
            <b>* Aguarde o prazo de 24h para posicionamento do Técnico!</b>" . "
            <br /><b>* Favor, não responder esse e-mail!</b>"
            );
        $this->email->set_mailtype("html");
        $this->email->send();
    }

    // ENVIAR E-MAIL RESPOTA PESQUISA DE SATISFAÇÃO
    public function enviar_email_pesquisa_satisfacao($assunto, $cod)
    {
        // ENVIA E-MAIL DA ABERTURA DO INCIDENTE PARA O EMITENTE E O USUÁRIO QUE ABRIU
        $this->email->from($this->session->userdata('email_emitente'), 'GWeb - Gestão de Serviços');
        $this->email->to($this->session->userdata('email'), 'GWeb - Gestão de Serviços');
        //$this->email->cc($this->session->userdata('email_emitente'));

        $this->email->subject($assunto." ".str_pad($cod, 6, "0", STR_PAD_LEFT)." por ".$this->session->userdata('nome'));
        $this->email->message("
            <b><h2>Gweb - Gestão de Serviços</h2></b>
            <b>Código $assunto:</b> <b style=font-size:15px>". str_pad($cod, 6, "0", STR_PAD_LEFT) ."</b>
            <br /><b>Respondida por:</b> " . $this->session->userdata('nome') ."
            <br /><b>E-mail:</b> " . $this->session->userdata('email') . "
            <p>
            <b>* Obrigado por responder nossa pesquisa de satisfação, vamos analisar e melhorar nosso atendimento.</b>" . "
            <br /><b>* Favor, não responder esse e-mail!</b>"
            );
        $this->email->set_mailtype("html");
        $this->email->send();
    }

    // ENVIAR E-MAIL NO FLUXO DE APROVAÇÃO
    public function enviar_email_fluxo_aprovacao($assunto, $cod, $prox_aprovador)
    {
        // ENVIA E-MAIL DA ABERTURA DO INCIDENTE PARA O EMITENTE E O USUÁRIO QUE ABRIU
        $this->email->from($this->session->userdata('email_emitente'), 'GWeb - Gestão de Serviços');
        $this->email->to($this->session->userdata('email'), 'GWeb - Gestão de Serviços');
        //$this->email->cc($this->session->userdata('email_emitente'));

        $this->email->subject($assunto." ".str_pad($cod, 6, "0", STR_PAD_LEFT)." por ".$this->session->userdata('nome'));
        $this->email->message("
            <b><h2>Gweb - Gestão de Serviços</h2></b>
            <b>Código $assunto:</b> <b style=font-size:15px>". str_pad($cod, 6, "0", STR_PAD_LEFT) ."</b>
            <br /><b>Aprovado por:</b> " . $this->session->userdata('nome') ."
            <br /><b>Próximo aprovador:</b> " . $prox_aprovador . "
            <p>
            <b>* Favor, não responder esse e-mail!</b>"
            );
        $this->email->set_mailtype("html");
        $this->email->send();
    }
}