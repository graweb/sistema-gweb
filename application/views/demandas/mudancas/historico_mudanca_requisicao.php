<div id="hstRequisicaoMudanca" class="easyui-tabs" style="width:100%;height:100%">
    <div title="Histórico Requisição" style="padding:10px">
        <div class="barra_titulo">
            <p><i class="fa fa-code fa-lg"></i><strong> Código:</strong> <?php echo $info_requisicao->cod_requisicao;?></p>
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
    <div title="Etapas Fluxo" style="padding:10px">
        <div class="organograma">
            <ul>
                <li>
                    <a href="#"><?php echo $fluxo_requisicao->nome; ?></a>
                    <ul>
                        <?php 
                        $cont_usu_req = 0;
                            foreach($fluxo_requisicao_etapas as $flux) { 
                                $cont_usu_req +=1;
                        ?>
                            <li onclick="aprovarMudancaReq()"><a href="#"
                            <?php 
                                if($fluxo_requisicao->id_usuario_aprovador_atual == $flux->id_usuario) {
                                    if($fluxo_requisicao->finalizou == 1)
                                    {
                                        echo 'style="background-color:rgba(143,188,143,0.7)"';
                                    }

                                    echo 'style="background-color:rgba(255,128,0,0.7)"';
                                }

                                // PEGA A ORDEM DO APROVADOR NO FLUXO
                                if($flux->id_usuario_responsavel == $this->session->userdata('id_usuario'))
                                {
                                    $ordem_aprov_req = $flux->ordem;
                                }
                            ?>>
                            <?php echo $flux->usuario; ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div title="Anexos" style="padding:10px">
        <form id="anexarArquivosRequisicaoMudanca" enctype="multipart/form-data" method="post">
            <input type="hidden" id="cod_requisicao" name="cod_requisicao" value="<?php echo $info_requisicao->cod_requisicao;?>">
            <input id="anexoRequisicaoMudanca" class="easyui-filebox" name="anexoRequisicaoMudanca" data-options="prompt:'Selecione um arquivo...'" label="Arquivo:" labelPosition="top" style="width:85%">
            <a id="btnAddanexoRequisicaoMudanca" href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true">Adicionar</a>
        </form>
        <p></p>
        <td style="width:100%;">
            <div id="carregaAnexoRequisicaoMudanca" class="easyui-progressbar" style="width:100%;"></div>
        </td>
        <p></p>
        <hr>
        <p><strong>Arquivos anexados:</strong></p>
        <p>
            <?php 
            $contar = 0;
            foreach($anexos_requisicao as $anex_req_mudanca) { 
                $contar += 1;
                if($anex_req_mudanca->extensao_anex_req == ".xlsx") {
                    echo '
                        <a href="requisicoes/downloadAnexoRequisicao/'.$anex_req_mudanca->id_anexo_req.'" title="Por: '.$anex_req_mudanca->nome_anex_req.' em '.date('d/m/Y - H:i:s', strtotime($anex_req_mudanca->data_hora_anex_req)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_excel.png" style="width:50px;height:50px;">'.$contar.'</a>
                    ';
                } else if($anex_req_mudanca->extensao_anex_req == ".pdf") {
                    echo '
                        <a href="requisicoes/downloadAnexoRequisicao/'.$anex_req_mudanca->id_anexo_req.'" title="Por: '.$anex_req_mudanca->nome_anex_req.' em '.date('d/m/Y - H:i:s', strtotime($anex_req_mudanca->data_hora_anex_req)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_pdf.png" style="width:50px;height:50px;">'.$contar.'</a>
                    ';
                } else if($anex_req_mudanca->extensao_anex_req == ".doc") {
                    echo '
                        <a href="requisicoes/downloadAnexoRequisicao/'.$anex_req_mudanca->id_anexo_req.'" title="Por: '.$anex_req_mudanca->nome_anex_req.' em '.date('d/m/Y - H:i:s', strtotime($anex_req_mudanca->data_hora_anex_req)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_word.png" style="width:50px;height:50px;">'.$contar.'</a>
                    ';
                } else if($anex_req_mudanca->extensao_anex_req == ".txt") {
                    echo '
                        <a href="requisicoes/downloadAnexoRequisicao/'.$anex_req_mudanca->id_anexo_req.'" title="Por: '.$anex_req_mudanca->nome_anex_req.' em '.date('d/m/Y - H:i:s', strtotime($anex_req_mudanca->data_hora_anex_req)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_txt.png" style="width:50px;height:50px;">'.$contar.'</a>
                    ';
                } else {
                    echo '
                        <a href="requisicoes/downloadAnexoRequisicao/'.$anex_req_mudanca->id_anexo_req.'" title="Por: '.$anex_req_mudanca->nome_anex_req.' em '.date('d/m/Y - H:i:s', strtotime($anex_req_mudanca->data_hora_anex_req)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_image.png" style="width:50px;height:50px;">'.$contar.'</a>
                    ';
                }
            } ?>
        </p>
    </div>
</div>

<script type="text/javascript">
// APROVAR MUDANÇA
function aprovarMudancaReq(){
    var row = $('#dgMudancas').datagrid('getSelected');
    
    if (row != null){
        if(row.situacao == 3 || row.situacao == 4){
            $.messager.alert('Atenção','Esta mudança está cancelada/concluída!','warning');
        } else {
            if(<?php echo $fluxo_requisicao->finalizou;?> == 1) {
                $.messager.alert('Atenção','O fluxo já foi finalizado!','warning');
            } else if(row.id_usuario_aprovador_atual != <?php echo $this->session->userdata('id_usuario'); ?>) {
                $.messager.alert('Atenção','Você não é o aprovador atual desta Mudança!','warning');
            } else {
                jQuery.messager.confirm('Atenção','Deseja aprovar essa Mudança?',function(r){
                    if (r){
                        jQuery.post('<?php base_url();?>mudancas/aprovar/'+row.cod_mudanca+'/'+<?php echo $ordem_aprov_req;?>+'/'+<?php echo $cont_usu_req;?>,function(result){
                            if (result.success){
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
                                $('#dgMudancas').datagrid('reload');
                                $('#conteudoMudanca').panel('refresh');

                            } else {
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
                        },'json');
                    }
                });
            }
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

$(document).ready(function(){
    $('#anexarArquivosRequisicaoMudanca').form({
        url:'<?php base_url();?>requisicoes/anexarArquivoRequisicao/',
        ajax:'true',
        iframe:false,
        onProgress: function(percent){
            $('#carregaAnexoRequisicaoMudanca').progressbar('setValue', percent);
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
            $('#conteudoMudanca').panel('refresh');
            $('#hstRequisicaoMudanca').tabs('enableTab', 1);
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

    $('#btnAddanexoRequisicaoMudanca').bind('click', function(){
        if($('#anexoRequisicaoMudanca').filebox('getValue')!="") {
            $('#anexarArquivosRequisicaoMudanca').submit();
        } else {
            $.messager.alert('Atenção','Selecione um registro!','warning');
        }
    });
});
</script>