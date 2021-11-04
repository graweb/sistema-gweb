<div class="easyui-layout" style="width:100%;height:100%;">
    <div data-options="region:'west',split:true" title="Mudanças" style="width:50%;">
        <table id="dgMudancas"
                class="easyui-datagrid"
                fit="true"
                url="<?php base_url();?>mudancas_listar"
                toolbar="#toolbarMudancas"
                pagination="true"
                rownumbers="true"
                fitColumns="true"
                singleSelect="true"
                striped="true">
            <thead>
                <tr>
                    <th data-options="field:'ck',checkbox:true"></th>
                    <th field="cod_mudanca" width="25">CÓD</th>
                    <th field="assunto" width="75">ASSUNTO</th>
                    <th field="data_hora" width="40" align="center">DATA/HORA</th>
                    <th field="situacao" width="25" align="center" formatter="formataSituacaoMudanca" styler="formataFundoSituacaoMudanca">SITUAÇÃO</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarMudancas">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-check fa-lg" plain="true" onclick="aprovarMudancaSelecionada()">Aprovar</a>
            <span class="button-sep"></span>
            <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaMudancas" searcher='buscaMudanca' style="width:40%">
            <div id='menuBuscaMudancas' style='width:auto'>
                <div name='cod_mudanca'>Cód. Mudança</div>
                <div name='assunto'>Assunto</div>
            </div>
        </div>
    </div>
    <div id="conteudoMudanca" region="center" title="Informações Mudança">
        <?php if(isset($view)){ $this->load->view($view);} ?>
    </div>
</div>

<div id="menuAtividadesBtDireitoMudanca" style="width:auto;" class="easyui-menu">
    <div onclick="aprovarMudancaSelecionada()">Aprovar</div>
</div>

<script type="text/javascript">
var url;

//BUSCA INCIDENTE
function buscaMudanca(value,name){
    if(name == 'cod_mudanca'){
        $('#dgMudancas').datagrid('load',{
            cod_mudanca: value
        });
    }else if(name == 'assunto'){
        $('#dgMudancas').datagrid('load',{
            assunto: value
        });
    }
}

//ABRE INFORMAÇÕES DE ACESSO COM 1 CLICK
$('#dgMudancas').datagrid({
    onClickRow: function(index,row){
        var row = $('#dgMudancas').datagrid('getSelected');

        if(row.cod_incidente != null) {
            $('#conteudoMudanca').panel('refresh', '<?php base_url();?>mudancas/historico_mudanca_incidente/'+row.cod_incidente);
        } else {
            $('#conteudoMudanca').panel('refresh', '<?php base_url();?>mudancas/historico_mudanca_requisicao/'+row.cod_requisicao);
        }
    }
});

//ABRE O MENU AO CLICAR COM O BOTÃO DIREITO NO DATAGRID
$('#dgMudancas').datagrid({
    singleSelect: true,
    onRowContextMenu: function(e,index,row){
        $(this).datagrid('selectRow',index);
        if(row.cod_incidente != null) {
            $('#conteudoMudanca').panel('refresh', '<?php base_url();?>mudancas/historico_mudanca_incidente/'+row.cod_incidente);
        } else {
            $('#conteudoMudanca').panel('refresh', '<?php base_url();?>mudancas/historico_mudanca_requisicao/'+row.cod_requisicao);
        }
        e.preventDefault();
        $('#menuAtividadesBtDireitoMudanca').menu('show', {
            left:e.pageX,
            top:e.pageY
        });
    }
});

// FORMATA SITUAÇÃO
function formataSituacaoMudanca(value,row){
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
function formataFundoSituacaoMudanca(value,row){
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

// APROVAR MUDANÇA SELECIONADA
function aprovarMudancaSelecionada(){
    var row = $('#dgMudancas').datagrid('getSelected');

    if (row != null){
        if (row.cod_incidente != null) {
            aprovarMudancaInc();
        } else {
            aprovarMudancaReq();
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}
</script>