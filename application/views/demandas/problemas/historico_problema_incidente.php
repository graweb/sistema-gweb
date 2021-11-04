<div id="hstIncidenteProblema" class="easyui-tabs" style="width:100%;height:100%">
    <div title="Histórico Incidente" style="padding:10px">
        <div class="barra_titulo">
            <p><i class="fa fa-code fa-lg"></i><strong> Código:</strong> <?php echo $info_incidente->cod_incidente;?></p>
            <p><i class="fa fa-comment fa-lg"></i><strong> Solicitado por:</strong> <?php echo $info_incidente->usuario_inc;?></p>
            <p><i class="fa fa-calendar fa-lg"></i><strong> Previsão:</strong> <?php echo date('d/m/Y - H:i:s', strtotime($info_incidente->data_retorno_inc));?> hs</p>
            <hr>
            <p>
                <i class="fa fa-comment-o fa-lg"></i><strong> Incidente:</strong> <?php echo $info_incidente->incidente_inc;?>
            </p>
        </div>
        <ul class="cbp_tmtimeline">
            <?php foreach($respostas_incidente as $resp) {
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
        <form id="anexarArquivosIncidenteProblema" enctype="multipart/form-data" method="post">
            <input type="hidden" id="cod_incidente" name="cod_incidente" value="<?php echo $info_incidente->cod_incidente;?>">
            <input id="anexoIncidenteProblema" class="easyui-filebox" name="anexoIncidenteProblema" data-options="prompt:'Selecione um arquivo...'" label="Arquivo:" labelPosition="top" style="width:85%">
            <a id="btnAddAnexoIncidenteProblema" href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true">Adicionar</a>
        </form>
        <p></p>
        <td style="width:100%;">
            <div id="carregaAnexoIncidenteProblema" class="easyui-progressbar" style="width:100%;"></div>
        </td>
        <p></p>
        <hr>
        <p><strong>Arquivos anexados:</strong></p>
        <p>
            <?php 
            $contar_anex_req_mud = 0;
            foreach($anexos_incidente as $anex_req_problema) { 
                $contar_anex_req_mud += 1;
                if($anex_req_problema->extensao_anex_inc == ".xlsx") {
                    echo '
                        <a href="incidentes/downloadAnexoIncidente/'.$anex_req_problema->id_anexo_inc.'" title="Por: '.$anex_req_problema->nome_anex_inc.' em '.date('d/m/Y - H:i:s', strtotime($anex_req_problema->data_hora_anex_inc)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_excel.png" style="width:50px;height:50px;">'.$contar_anex_req_mud.'</a>
                    ';
                } else if($anex_req_problema->extensao_anex_inc == ".pdf") {
                    echo '
                        <a href="incidentes/downloadAnexoIncidente/'.$anex_req_problema->id_anexo_inc.'" title="Por: '.$anex_req_problema->nome_anex_inc.' em '.date('d/m/Y - H:i:s', strtotime($anex_req_problema->data_hora_anex_inc)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_pdf.png" style="width:50px;height:50px;">'.$contar_anex_req_mud.'</a>
                    ';
                } else if($anex_req_problema->extensao_anex_inc == ".doc") {
                    echo '
                        <a href="incidentes/downloadAnexoIncidente/'.$anex_req_problema->id_anexo_inc.'" title="Por: '.$anex_req_problema->nome_anex_inc.' em '.date('d/m/Y - H:i:s', strtotime($anex_req_problema->data_hora_anex_inc)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_word.png" style="width:50px;height:50px;">'.$contar_anex_req_mud.'</a>
                    ';
                } else if($anex_req_problema->extensao_anex_inc == ".txt") {
                    echo '
                        <a href="incidentes/downloadAnexoIncidente/'.$anex_req_problema->id_anexo_inc.'" title="Por: '.$anex_req_problema->nome_anex_inc.' em '.date('d/m/Y - H:i:s', strtotime($anex_req_problema->data_hora_anex_inc)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_txt.png" style="width:50px;height:50px;">'.$contar_anex_req_mud.'</a>
                    ';
                } else {
                    echo '
                        <a href="incidentes/downloadAnexoIncidente/'.$anex_req_problema->id_anexo_inc.'" title="Por: '.$anex_req_problema->nome_anex_inc.' em '.date('d/m/Y - H:i:s', strtotime($anex_req_problema->data_hora_anex_inc)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_image.png" style="width:50px;height:50px;">'.$contar_anex_req_mud.'</a>
                    ';
                }
            } ?>
        </p>
    </div>
</div>

<script type="text/javascript">

// ENCERRAR MUDANÇA
function encerrarProblemaInc(){
    var row = $('#dgProblemas').datagrid('getSelected');
    
    if (row != null) {
        if(row.situacao == 3 || row.situacao == 4) {
            $.messager.alert('Atenção','Este Problema está cancelado/concluído!','warning');
        } else {
            jQuery.messager.confirm('Atenção','Deseja encerrar esse Problema?',function(r) {
                if (r) {
                    jQuery.post('<?php base_url();?>problemas/encerrarInc/'+row.cod_incidente,function(result){
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
                            $('#dgProblemas').datagrid('reload');
                            $('#conteudoProblema').panel('refresh');

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
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// ANEXAR ARQUIVOS
$(document).ready(function(){
    $('#anexarArquivosIncidenteProblema').form({
        url:'<?php base_url();?>incidentes/anexarArquivoIncidente/',
        ajax:'true',
        iframe:false,
        onProgress: function(percent){
            $('#carregaAnexoIncidenteProblema').progressbar('setValue', percent);
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
            $('#conteudoProblema').panel('refresh');
            $('#hstIncidenteProblema').tabs('enableTab', 1);
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

    $('#btnAddAnexoIncidenteProblema').bind('click', function(){
        if($('#anexoIncidenteProblema').filebox('getValue')!="") {
            $('#anexarArquivosIncidenteProblema').submit();
        } else {
            $.messager.alert('Atenção','Selecione um registro!','warning');
        }
    });
});
</script>
