<div class="easyui-layout" style="width:100%;height:100%;">
    <div data-options="region:'west',split:true" title="Fluxo de Mudanças" style="width:50%;">
        <table id="dgFluxoMudancas"
                class="easyui-datagrid"
                style="width:100%;height:100%"
                url="<?php base_url();?>fluxo_de_mudancas/listar"
                toolbar="#toolbarFluxoMudancas" 
                pagination="true"
                rownumbers="true"
                fitColumns="true"
                singleSelect="true"
                striped="true">
            <thead>
                <tr>
                    <th data-options="field:'ck',checkbox:true"></th>
                    <th field="id_fluxo_mudanca" width="10">ID</th>
                    <th field="nome" width="30">FLUXO</th>
                    <th field="descricao" width="50">DESCRIÇÃO</th>
                    <th field="situacao" width="20" align="center" formatter="formataSituacaoFluxoMudancas">SITUAÇÃO</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarFluxoMudancas">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoFluxoMudancas()">Novo</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarFluxoMudancas()">Editar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" plain="true" onclick="desativarFluxoMudancas()">Ativar/Desativar</a>
            <span class="button-sep"></span>
            <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuFluxoMudancas" searcher='buscaFluxoMudancas' style="width:30%">
            <div id='menuFluxoMudancas' style='width:auto'>
                <div name='id_fluxo_mudanca'>ID</div>
                <div name='nome'>Fluxo</div>
            </div>
        </div>
    </div>
    <div id="conteudoEtapasFluxo" region="center" title="Etapas">
        <?php if(isset($view)){ $this->load->view($view);} ?>
    </div>
</div>

<div id="dlgFluxoMudancas" class="easyui-dialog" style="width:400px;padding:10px 20px;" 
        closed="true" buttons="#dlgFluxoMudancasButtons" modal="true">
    <form id="formFluxoMudancas" class="easyui-form" method="post" data-options="novalidate:true">
        <div style="margin-bottom:10px">
            <label>Nome:</label>
            <input id="nome" name="nome" class="easyui-textbox" required="true" style="width:100%">
        </div>
        <div style="margin-bottom:10px">
            <label>Situação:</label>
            <select class="easyui-combobox" id="situacao" name="situacao" panelHeight="auto" required="true" editable="false" style="width:100%;">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </div>
        <div style="margin-bottom:10px">
            <label>Descrição:</label>
            <input class="easyui-textbox" id="descricao" name="descricao" style="width:100%;height:60px" data-options="multiline:true">
        </div>
    </form>
</div>
<div id="dlgFluxoMudancasButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgFluxoMudancas').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarFluxoMudancas()" style="width:90px">Salvar</a>
</div>

<!-- MODAL DESATIVAR -->
<div id="dlgFluxoMudancasDesativar" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgFluxoMudancasButtonsDesativar" modal="true">
    <form id="formFluxoMudancasDesativar" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="situacao_ativar_desativar" name="situacao_ativar_desativar">
        <h3 style="text-align: center;">Deseja ativar/desativar esse Fluxo de Mudança?</h3>
    </form>
</div>
<div id="dlgFluxoMudancasButtonsDesativar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgFluxoMudancasDesativar').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarFluxoMudancasAtivarDesativar()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
var url;

//BUSCA FLUXO
function buscaFluxoMudancas(value,name){
    if(name == 'id_fluxo_mudanca'){
        $('#dgFluxoMudancas').datagrid('load',{
            id_fluxo_mudanca: value
        });
    }else if(name == 'nome'){
        $('#dgFluxoMudancas').datagrid('load',{
            nome: value
        });
    }
}

// FORMATA SITUAÇÃO
function formataSituacaoFluxoMudancas(value,row){
    if (value == '1'){
        return '<i class="fa fa-check fa-lg" style="color:green"></i>';
    } else {
        return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
    }
}

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgFluxoMudancas').datagrid({
    onDblClickCell: function(index,field,value){
        editarFluxoMudancas();
    }
});

//ABRE INFORMAÇÕES DAS ETAPAS DO FLUCO COM 1 CLICK
$('#dgFluxoMudancas').datagrid({
    onClickRow: function(index,row){
        var row = $('#dgFluxoMudancas').datagrid('getSelected');
        $('#conteudoEtapasFluxo').panel('refresh', '<?php base_url();?>fluxo_de_mudancas/etapas_fluxo/'+row.id_fluxo_mudanca);
    }
});

// FORMATA SITUAÇÃO
function formataSituacaoFluxoMudancass(value,row){
    if (value == '1'){
        return '<i class="fa fa-check fa-lg" style="color:green"></i>';
    } else {
        return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
    }
}

// NOVO
function novoFluxoMudancas(){
    $('#dlgFluxoMudancas').dialog('open').dialog('center').dialog('setTitle','Novo Fluxo de Mudança');
    $('#formFluxoMudancas').form('clear');
    url = '<?php base_url();?>fluxo_de_mudancas/cadastrar';
}

// EDITAR
function editarFluxoMudancas(){
    var row = $('#dgFluxoMudancas').datagrid('getSelected');
    if (row != null){
        $('#dlgFluxoMudancas').dialog('open').dialog('center').dialog('setTitle','Editar Fluxo de Mudança');
        $('#formFluxoMudancas').form('load',row);
        url = '<?php base_url();?>fluxo_de_mudancas/atualizar/'+row.id_fluxo_mudanca;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// DESATIVAR
function desativarFluxoMudancas(){
    var row = $('#dgFluxoMudancas').datagrid('getSelected');
    if (row != null){
        if(row.situacao == 1) {
            $('#situacao_ativar_desativar').val(0);
        } else {
            $('#situacao_ativar_desativar').val(1);
        }

        $('#dlgFluxoMudancasDesativar').dialog('open').dialog('center').dialog('setTitle','Ativar/Desativar Fluxo de Mudança');
        $('#formFluxoMudancasDesativar').form('load',row);
        url = '<?php base_url();?>fluxo_de_mudancas/desativar/'+row.id_fluxo_mudanca;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarFluxoMudancas(){
    $('#formFluxoMudancas').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.errorMsg){
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
            } else {
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
                $('#dlgFluxoMudancas').dialog('close');
                $('#dgFluxoMudancas').datagrid('reload');
            }
        }
    });
}

// DESATIVAR
function salvarFluxoMudancasAtivarDesativar(){
    $('#formFluxoMudancasDesativar').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.errorMsg){
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
            } else {
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
                $('#dlgFluxoMudancasDesativar').dialog('close');
                $('#dgFluxoMudancas').datagrid('reload');
            }
        }
    });
}

</script>