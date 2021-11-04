<table id="dgEmitente" 
        title="Emitente" 
        class="easyui-datagrid" 
        fit="true"
        url="<?php base_url();?>emitente/listar" 
        toolbar="#toolbarEmitente" 
        pagination="true"
        rownumbers="true" 
        fitColumns="true" 
        singleSelect="true"
        striped="true">
    <thead>
        <tr>
            <th data-options="field:'ck',checkbox:true"></th>
            <th field="id_emitente" width="10">ID</th>
            <th field="nome_emitente" width="80">EMITENTE</th>
            <th field="email_emitente" width="90">E-MAIL</th>
            <th field="situacao_emitente" width="20" align="center" formatter="formataSituacaoEmitente">SITUAÇÃO</th>
        </tr>
    </thead>
</table>
<div id="toolbarEmitente">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoEmitente()">Novo</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarEmitente()">Editar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" plain="true" onclick="desativarEmitente()">Ativar/Desativar</a>
    <span class="button-sep"></span>
    <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaEmitente" searcher='buscaEmitente' style="width:30%">
    <div id='menuBuscaEmitente' style='width:auto'>
        <div name='id_emitente'>ID</div>
        <div name='nome_emitente'>Emitente</div>
        <div name='email_emitente'>E-mail</div>
    </div>
</div>

<!-- MODAL NOVO/EDITAR -->
<div id="dlgEmitente" class="easyui-dialog" style="width:620px;height:450px" 
        closed="true" buttons="#dlgEmitenteButtons" modal="true">
    <form id="formEmitente" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:97%;">
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" label="Emitente:" labelPosition="top" id="nome_emitente" name="nome_emitente" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="easyui-textbox" label="CNPJ:" labelPosition="top" id="cnpj_emitente" name="cnpj_emitente" style="width:100%;" required="true">
                </td>
                <td>
                    <input class="easyui-textbox" label="Telefone:" labelPosition="top" id="telefone_emitente" name="telefone_emitente" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" label="E-mail:" labelPosition="top" id="email_emitente" name="email_emitente" style="width:100%;" required="true" validType="email">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-searchbox" label="CEP:" labelPosition="top" id="cep_emitente" name="cep_emitente" style="width:100%;" required="true">
                </td>
                <td>
                    <input class="easyui-textbox" label="UF:" labelPosition="top" id="uf_emitente" name="uf_emitente" style="width:100%;" required="true">
                </td>
                <td>
                    <input class="easyui-textbox" label="Cidade:" labelPosition="top" id="cidade_emitente" name="cidade_emitente" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" label="Bairro:" labelPosition="top" id="bairro_emitente" name="bairro_emitente" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="easyui-textbox" label="Rua:" labelPosition="top" id="rua_emitente" name="rua_emitente" style="width:100%;" required="true">
                </td>
                <td>
                    <input class="easyui-numberbox" label="Número:" labelPosition="top" id="numero_emitente" name="numero_emitente" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao_emitente" name="situacao_emitente" panelHeight="auto" editable="false" required="true" style="width:30%;">
                        <option value='1'>Ativo</option>
                        <option value='0'>Inativo</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgEmitenteButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgEmitente').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarEmitente()" style="width:90px">Salvar</a>
</div>

<!-- MODAL DESATIVAR -->
<div id="dlgEmitenteDesativar" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgEmitenteButtonsDesativar" modal="true">
    <form id="formEmitenteDesativar" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="situacao_ativar_desativar_emitente" name="situacao_ativar_desativar_emitente">
        <h3 style="text-align: center;">Deseja ativar/desativar esse Emitente?</h3>
    </form>
</div>
<div id="dlgEmitenteButtonsDesativar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgEmitenteDesativar').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarEmitenteAtivarDesativar()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
var url;

//BUSCA EMITENTE
function buscaEmitente(value,name){
    if(name == 'id_emitente'){
        $('#dgEmitente').datagrid('load',{
            id_emitente: value
        });
    }else if(name == 'nome_emitente'){
        $('#dgEmitente').datagrid('load',{
            nome_emitente: value
        });
    }else if(name == 'email_emitente'){
        $('#dgEmitente').datagrid('load',{
            email_emitente: value
        });
    }
}

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgEmitente').datagrid({
    onDblClickCell: function(index,field,value){
        editarEmitente();
    }
});

// FORMATA SITUAÇÃO
function formataSituacaoEmitente(value,row){
    if (value == '1'){
        return '<i class="fa fa-check fa-lg" style="color:green"></i>';
    } else {
        return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
    }
}

// NOVO
function novoEmitente(){
    $('#dlgEmitente').dialog('open').dialog('center').dialog('setTitle','Novo Emitente');
    $('#formEmitente').form('clear');
    url = '<?php base_url();?>emitente/cadastrar';
}

// EDITAR
function editarEmitente(){
    var row = $('#dgEmitente').datagrid('getSelected');
    if (row != null){
        $('#dlgEmitente').dialog('open').dialog('center').dialog('setTitle','Editar Emitente');
        $('#formEmitente').form('load',row);
        url = '<?php base_url();?>emitente/atualizar/'+row.id_emitente;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// DESATIVAR
function desativarEmitente(){
    var row = $('#dgEmitente').datagrid('getSelected');
    if (row != null){
        if(row.situacao_emitente == 1) {
            $('#situacao_ativar_desativar_emitente').val(0);
        } else {
            $('#situacao_ativar_desativar_emitente').val(1);
        }

        $('#dlgEmitenteDesativar').dialog('open').dialog('center').dialog('setTitle','Ativar/Desativar Emitente');
        $('#formEmitenteDesativar').form('load',row);
        url = '<?php base_url();?>emitente/desativar/'+row.id_emitente;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarEmitente(){
    $('#formEmitente').form('submit',{
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
                $('#dlgEmitente').dialog('close');
                $('#dgEmitente').datagrid('reload');
            }
        }
    });
}

// DESATIVAR
function salvarEmitenteAtivarDesativar(){
    $('#formEmitenteDesativar').form('submit',{
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
                $('#dlgEmitenteDesativar').dialog('close');
                $('#dgEmitente').datagrid('reload');
            }
        }
    });
}
</script>