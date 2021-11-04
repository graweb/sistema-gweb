<div id="hstIncidente" class="easyui-tabs" style="width:100%;height:100%">
    <div title="Histórico" style="padding:10px">
        <div class="barra_titulo">
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
        <form id="anexarArquivosIncidente" enctype="multipart/form-data" method="post">
            <input type="hidden" id="cod_incidente" name="cod_incidente" value="<?php echo $info_incidente->cod_incidente;?>">
            <input id="anexoIncidente" class="easyui-filebox" name="anexoIncidente" data-options="prompt:'Selecione um arquivo...'" label="Arquivo:" labelPosition="top" style="width:85%">
            <a id="btnAddAnexoIncidente" href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true">Adicionar</a>
        </form>
        <p></p>
        <td style="width:100%;">
            <div id="carregaAnexoIncidente" class="easyui-progressbar" style="width:100%;"></div>
        </td>
        <p></p>
        <hr>
        <p><strong>Arquivos anexados:</strong></p>
        <p>
            <?php 
            $contar_anex_inc = 0;
            foreach($anexos_incidente as $anex_inc) { 
                $contar_anex_inc += 1;
                if($anex_inc->extensao_anex_inc == ".xlsx") {
                    echo '
                        <a href="incidentes/downloadAnexoIncidente/'.$anex_inc->id_anexo_inc.'" title="Por: '.$anex_inc->nome_anex_inc.' em '.date('d/m/Y - H:i:s', strtotime($anex_inc->data_hora_anex_inc)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_excel.png" style="width:50px;height:50px;">'.$contar_anex_inc.'</a>
                    ';
                } else if($anex_inc->extensao_anex_inc == ".pdf") {
                    echo '
                        <a href="incidentes/downloadAnexoIncidente/'.$anex_inc->id_anexo_inc.'" title="Por: '.$anex_inc->nome_anex_inc.' em '.date('d/m/Y - H:i:s', strtotime($anex_inc->data_hora_anex_inc)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_pdf.png" style="width:50px;height:50px;">'.$contar_anex_inc.'</a>
                    ';
                } else if(($anex_inc->extensao_anex_inc == ".doc") || ($anex_inc->extensao_anex_inc == ".docx") ) {
                    echo '
                        <a href="incidentes/downloadAnexoIncidente/'.$anex_inc->id_anexo_inc.'" title="Por: '.$anex_inc->nome_anex_inc.' em '.date('d/m/Y - H:i:s', strtotime($anex_inc->data_hora_anex_inc)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_word.png" style="width:50px;height:50px;">'.$contar_anex_inc.'</a>
                    ';
                } else if($anex_inc->extensao_anex_inc == ".txt") {
                    echo '
                        <a href="incidentes/downloadAnexoIncidente/'.$anex_inc->id_anexo_inc.'" title="Por: '.$anex_inc->nome_anex_inc.' em '.date('d/m/Y - H:i:s', strtotime($anex_inc->data_hora_anex_inc)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_txt.png" style="width:50px;height:50px;">'.$contar_anex_inc.'</a>
                    ';
                } else {
                    echo '
                        <a href="incidentes/downloadAnexoIncidente/'.$anex_inc->id_anexo_inc.'" title="Por: '.$anex_inc->nome_anex_inc.' em '.date('d/m/Y - H:i:s', strtotime($anex_inc->data_hora_anex_inc)).'" class="easyui-linkbutton easyui-tooltip"><img src="'.base_url().'assets/images/icone_image.png" style="width:50px;height:50px;">'.$contar_anex_inc.'</a>
                    ';
                }
            } ?>
        </p>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#anexarArquivosIncidente').form({
        url:'<?php base_url();?>incidentes/anexarArquivoIncidente/',
        ajax:'true',
        iframe:false,
        onProgress: function(percent){
            $('#carregaAnexoIncidente').progressbar('setValue', percent);
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
            $('#conteudoIncidente').panel('refresh');
            $('#hstIncidente').tabs('enableTab', 1);
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

    $('#btnAddAnexoIncidente').bind('click', function(){
        if((<?php echo $info_incidente->situacao_inc;?> == 3) || (<?php echo $info_incidente->situacao_inc;?>== 4)) {
            $.messager.alert('Atenção','Este Incidente está cancelado/concluído!','warning');
        } else {
            if($('#anexoIncidente').filebox('getValue')!="") {
                $('#anexarArquivosIncidente').submit();
            } else {
                $.messager.alert('Atenção','Selecione um registro!','warning');
            }
        }
    });
});
</script>