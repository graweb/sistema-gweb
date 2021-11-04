<div id="hstRequisicao" class="easyui-tabs" style="width:100%;height:100%">
    <div title="Histórico" style="padding:10px">
        <div class="barra_titulo">
            <p><i class="fa fa-comment fa-lg"></i><strong> Solicitado por:</strong> <?php echo $info_requisicao->usuario_req;?></p>
            <p><i class="fa fa-calendar fa-lg"></i><strong> Previsão:</strong> <?php echo date('d/m/Y - H:i:s', strtotime($info_requisicao->data_retorno_req));?> hs</p>
            <hr>
            <p>
                <i class="fa fa-comment-o fa-lg"></i><strong> Requisição:</strong> <?php echo $info_requisicao->requisicao_req;?>
            </p>
        </div>
        <ul class="cbp_tmtimeline">
            <?php foreach($respostas_requisicao as $resp) {
                echo '
                <li>
                    <time class="cbp_tmtime" datetime="2013-04-10 18:30"><span>'.date('d/m/Y', strtotime($resp->data_resposta)).'</span> <span>'.date('H:i:s', strtotime($resp->data_resposta)).'</span></time>
                    <div class="cbp_tmicon"><i class="fa fa-user"></i></div>
                    <div class="cbp_tmlabel">
                        <h4>'.$resp->nome.'</h4>
                        <p>'.$resp->resposta.'</p>
                    </div>
                </li>';
            } ?>
        </ul>
    </div>
    <div title="Anexos" style="padding:10px">
        <form id="anexarArquivosRequisicao" enctype="multipart/form-data" method="post">
            <input type="hidden" id="cod_requisicao" name="cod_requisicao" value="<?php echo $info_requisicao->cod_requisicao;?>">
            <input id="anexoRequisicao" class="easyui-filebox" name="anexoRequisicao" data-options="prompt:'Selecione um arquivo...'" label="Arquivo:" labelPosition="top" style="width:85%">
            <a id="btnAddanexoRequisicao" href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true">Adicionar</a>
        </form>
        <p></p>
        <td style="width:100%;">
            <div id="carregaAnexoRequisicao" class="easyui-progressbar" style="width:100%;"></div>
        </td>
        <p></p>
        <hr>
        <p><strong>Arquivos anexados:</strong></p>
        <p>
            <?php 
            $contar_req = 0;
            foreach($anexos_requisicao as $anex_req) { 
                $contar_req += 1;
                if($anex_req->extensao_anex_req == ".xlsx") {
                    echo '
                        <a href="requisicoes/downloadAnexoRequisicao/'.$anex_req->id_anexo_req.'" title="Por: '.$anex_req->nome_anex_req.' em '.date('d/m/Y - H:i:s', strtotime($anex_req->data_hora_anex_req)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_excel.png" style="width:50px;height:50px;">'.$contar_req.'</a>
                    ';
                } else if($anex_req->extensao_anex_req == ".pdf") {
                    echo '
                        <a href="requisicoes/downloadAnexoRequisicao/'.$anex_req->id_anexo_req.'" title="Por: '.$anex_req->nome_anex_req.' em '.date('d/m/Y - H:i:s', strtotime($anex_req->data_hora_anex_req)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_pdf.png" style="width:50px;height:50px;">'.$contar_req.'</a>
                    ';
                } else if($anex_req->extensao_anex_req == ".doc") {
                    echo '
                        <a href="requisicoes/downloadAnexoRequisicao/'.$anex_req->id_anexo_req.'" title="Por: '.$anex_req->nome_anex_req.' em '.date('d/m/Y - H:i:s', strtotime($anex_req->data_hora_anex_req)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_word.png" style="width:50px;height:50px;">'.$contar_req.'</a>
                    ';
                } else if($anex_req->extensao_anex_req == ".txt") {
                    echo '
                        <a href="requisicoes/downloadAnexoRequisicao/'.$anex_req->id_anexo_req.'" title="Por: '.$anex_req->nome_anex_req.' em '.date('d/m/Y - H:i:s', strtotime($anex_req->data_hora_anex_req)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_txt.png" style="width:50px;height:50px;">'.$contar_req.'</a>
                    ';
                } else {
                    echo '
                        <a href="requisicoes/downloadAnexoRequisicao/'.$anex_req->id_anexo_req.'" title="Por: '.$anex_req->nome_anex_req.' em '.date('d/m/Y - H:i:s', strtotime($anex_req->data_hora_anex_req)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_image.png" style="width:50px;height:50px;">'.$contar_req.'</a>
                    ';
                }
            } ?>
        </p>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#anexarArquivosRequisicao').form({
        url:'<?php base_url();?>requisicoes/anexarArquivoRequisicao/',
        ajax:'true',
        iframe:false,
        onProgress: function(percent){
            $('#carregaAnexoRequisicao').progressbar('setValue', percent);
        },
        success: function(result){
            $.messager.show({
                title:'Feito',
                msg:'<strong style="color:green"><i class="fa fa-check fa-2x"></i>Registro armazenado com sucesso!</strong>',
                icon: 'info',
                showType:'show',
                style:{
                    left:'',
                    right:0,
                    top:document.body.scrollTop+document.documentElement.scrollTop,
                    bottom:''
                }
            });
            $('#conteudoRequisicao').panel('refresh');
            $('#hstRequisicao').tabs('enableTab', 1);
        },
        onLoadError: function(){
            $.messager.show({
                title:'Erro',
                msg: '<strong style="color:red"><i class="fa fa-ban fa-2x"></i>'+result.errorMsg+'</strong>',
                showType:'show',
                style:{
                    left:'',
                    right:0,
                    top:document.body.scrollTop+document.documentElement.scrollTop,
                    bottom:''
                }
            });
        }
    });

    $('#btnAddanexoRequisicao').bind('click', function(){
        if($('#anexoRequisicao').filebox('getValue')!="") {
            $('#anexarArquivosRequisicao').submit();
        } else {
            $.messager.alert('Atenção','Selecione um registro!','warning');
        }
    });
});
</script>