<div class="easyui-layout" style="width:100%;height:100%;">
    <div data-options="region:'west',split:true" title="Problemas" style="width:50%;">
        <table id="dgProblemas"
                class="easyui-datagrid"
                fit="true"
                url="<?php base_url();?>problemas_listar"
                toolbar="#toolbarProblemas"
                pagination="true"
                rownumbers="true"
                fitColumns="true"
                singleSelect="true"
                striped="true">
            <thead>
                <tr>
                    <th data-options="field:'ck',checkbox:true"></th>
                    <th field="cod_problema" width="25">CÓD</th>
                    <th field="assunto" width="75">ASSUNTO</th>
                    <th field="data_hora" width="40" align="center">DATA/HORA</th>
                    <th field="situacao" width="25" align="center" formatter="formataSituacaoProblema" styler="formataFundoSituacaoProblema">SITUAÇÃO</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarProblemas">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-check fa-lg" plain="true" onclick="encerrarProblemaSelecionado()">Encerrar</a>
            <span class="button-sep"></span>
            <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaProblemas" searcher='buscaProblema' style="width:40%">
            <div id='menuBuscaProblemas' style='width:auto'>
                <div name='cod_problema'>Cód. Problema</div>
                <div name='assunto'>Assunto</div>
            </div>
        </div>
    </div>
    <div id="conteudoProblema" region="center" title="Informações Problema">
        <?php if(isset($view)){ $this->load->view($view);} ?>
    </div>
</div>

<div id="menuAtividadesBtDireitoProblema" style="width:auto;" class="easyui-menu">
    <div onclick="encerrarProblemaSelecionado()">Encerrar</div>
</div>

<script type="text/javascript">
var url;

//BUSCA INCIDENTE
function buscaProblema(value,name){
    if(name == 'cod_problema'){
        $('#dgProblemas').datagrid('load',{
            cod_problema: value
        });
    }else if(name == 'assunto'){
        $('#dgProblemas').datagrid('load',{
            assunto: value
        });
    }
}

//ABRE INFORMAÇÕES DE ACESSO COM 1 CLICK
$('#dgProblemas').datagrid({
    onClickRow: function(index,row){
        var row = $('#dgProblemas').datagrid('getSelected');

        if(row.cod_incidente != null) {
            $('#conteudoProblema').panel('refresh', '<?php base_url();?>problemas/historico_incidente/'+row.cod_incidente);
        } else {
            $('#conteudoProblema').panel('refresh', '<?php base_url();?>problemas/historico_requisicao/'+row.cod_requisicao);
        }
    }
});

//ABRE O MENU AO CLICAR COM O BOTÃO DIREITO NO DATAGRID
$('#dgProblemas').datagrid({
    singleSelect: true,
    onRowContextMenu: function(e,index,row){
        $(this).datagrid('selectRow',index);
        if(row.cod_incidente != null) {
            $('#conteudoProblema').panel('refresh', '<?php base_url();?>problemas/historico_incidente/'+row.cod_incidente);
        } else {
            $('#conteudoProblema').panel('refresh', '<?php base_url();?>problemas/historico_requisicao/'+row.cod_requisicao);
        }
        e.preventDefault();
        $('#menuAtividadesBtDireitoProblema').menu('show', {
            left:e.pageX,
            top:e.pageY
        });
    }
});

// FORMATA SITUAÇÃO
function formataSituacaoProblema(value,row){
    var sit = row.situacao;

    // NAO ACEITOU SWITCH NO JS
    if(sit == 1){
        return 'ABERTO';
    } else if(sit == 2){
        return 'EM ANÁLISE';
    } else if(sit == 3){
        return 'CONCLUÍDO';
    } else if(sit == 4){
        return 'CANCELADO';
    }
}

// FORMATA SITUAÇÃO
function formataFundoSituacaoProblema(value,row){
    var sit = row.situacao;

    // NAO ACEITOU SWITCH NO JS
    if(sit == 1){
        return 'background-color:#F78181;';
    } else if(sit == 2){
        return 'background-color:#A9D0F5;';
    } else if(sit == 3){
        return 'background-color:#CEF6CE;';
    } else if(sit == 4){
        return 'background-color:#F3E2A9;';
    }
}

// APROVAR PROBLEMA SELECIONADO
function encerrarProblemaSelecionado(){
    var row = $('#dgProblemas').datagrid('getSelected');

    if (row != null){
        if (row.cod_incidente != null) {
            encerrarProblemaInc();
        } else {
            encerrarProblemaReq();
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}
</script>