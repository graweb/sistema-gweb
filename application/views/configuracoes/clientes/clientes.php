<table id="dgClientes" 
        title="Clientes" 
        class="easyui-datagrid" 
        fit="true"
        url="<?php base_url();?>clientes/listar" 
        toolbar="#toolbarClientes" 
        pagination="true"
        rownumbers="true" 
        fitColumns="true" 
        singleSelect="true"
        striped="true">
    <thead>
        <tr>
            <th data-options="field:'ck',checkbox:true"></th>
            <th field="id_cliente" width="10">ID</th>
            <th field="nome_cliente" width="80">CLIENTE</th>
            <th field="email" width="90">E-MAIL</th>
            <th field="situacao" width="20" align="center" formatter="formataSituacaoClientes">SITUAÇÃO</th>
        </tr>
    </thead>
</table>
<div id="toolbarClientes">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoCliente()">Novo</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarCliente()">Editar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" plain="true" onclick="desativarCliente()">Ativar/Desativar</a>
    <span class="button-sep"></span>
    <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaCliente" searcher='buscaCliente' style="width:30%">
    <div id='menuBuscaCliente' style='width:auto'>
        <div name='id_cliente'>ID</div>
        <div name='nome_cliente'>Cliente</div>
        <div name='email'>E-mail</div>
    </div>
</div>

<!-- MODAL NOVO/EDITAR -->
<div id="dlgClientes" class="easyui-dialog" style="width:620px;height:450px" 
        closed="true" buttons="#dlgClientesButtons" modal="true">
    <form id="formCliente" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:97%;">
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" label="Cliente:" labelPosition="top" id="nome_cliente" name="nome_cliente" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-textbox" label="CNPJ:" labelPosition="top" id="documento" name="documento" style="width:100%;" required="true">
                </td>
                <td>
                    <input class="easyui-textbox" label="Telefone:" labelPosition="top" id="telefone" name="telefone" style="width:100%;" required="true">
                </td>
                <td>
                    <input class="easyui-textbox" label="Celular:" labelPosition="top" id="celular" name="celular" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" label="E-mail:" labelPosition="top" id="email" name="email" style="width:100%;" required="true" validType="email">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-searchbox" label="CEP:" labelPosition="top" id="cep" name="cep" style="width:100%;" required="true">
                </td>
                <td>
                    <input class="easyui-textbox" label="Estado:" labelPosition="top" id="estado" name="estado" style="width:100%;" required="true">
                </td>
                <td>
                    <input class="easyui-textbox" label="Cidade:" labelPosition="top" id="cidade" name="cidade" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" label="Bairro:" labelPosition="top" id="bairro" name="bairro" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="easyui-textbox" label="Rua:" labelPosition="top" id="rua" name="rua" style="width:100%;" required="true">
                </td>
                <td>
                    <input class="easyui-numberbox" label="Número:" labelPosition="top" id="numero" name="numero" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="easyui-textbox" label="Complemento:" labelPosition="top" id="complemento" name="complemento" style="width:100%;">
                </td>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao" name="situacao" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value='1'>Ativo</option>
                        <option value='0'>Inativo</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgClientesButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgClientes').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarCliente()" style="width:90px">Salvar</a>
</div>

<!-- MODAL DESATIVAR -->
<div id="dlgClientesDesativar" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgClientesButtonsDesativar" modal="true">
    <form id="formClienteDesativar" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="situacao_ativar_desativar" name="situacao_ativar_desativar">
        <h3 style="text-align: center;">Deseja ativar/desativar esse Cliente?</h3>
    </form>
</div>
<div id="dlgClientesButtonsDesativar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgClientesDesativar').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarClienteAtivarDesativar()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
var url;

//BUSCA CLIENTE
function buscaCliente(value,name){
    if(name == 'id_cliente'){
        $('#dgClientes').datagrid('load',{
            id_cliente: value
        });
    }else if(name == 'nome_cliente'){
        $('#dgClientes').datagrid('load',{
            nome_cliente: value
        });
    }else if(name == 'email'){
        $('#dgClientes').datagrid('load',{
            email: value
        });
    }
}

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgClientes').datagrid({
    onDblClickCell: function(index,field,value){
        editarCliente();
    }
});

// FORMATA SITUAÇÃO
function formataSituacaoClientes(value,row){
    if (value == '1'){
        return '<i class="fa fa-check fa-lg" style="color:green"></i>';
    } else {
        return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
    }
}

// NOVO
function novoCliente(){
    $('#dlgClientes').dialog('open').dialog('center').dialog('setTitle','Novo Cliente');
    $('#formCliente').form('clear');
    url = '<?php base_url();?>clientes/cadastrar';
}

// EDITAR
function editarCliente(){
    var row = $('#dgClientes').datagrid('getSelected');
    if (row != null){
        $('#dlgClientes').dialog('open').dialog('center').dialog('setTitle','Editar Cliente');
        $('#formCliente').form('load',row);
        url = '<?php base_url();?>clientes/atualizar/'+row.id_cliente;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// DESATIVAR
function desativarCliente(){
    var row = $('#dgClientes').datagrid('getSelected');
    if (row != null){
        if(row.situacao == 1) {
            $('#situacao_ativar_desativar').val(0);
        } else {
            $('#situacao_ativar_desativar').val(1);
        }

        $('#dlgClientesDesativar').dialog('open').dialog('center').dialog('setTitle','Ativar/Desativar Cliente');
        $('#formClienteDesativar').form('load',row);
        url = '<?php base_url();?>clientes/desativar/'+row.id_cliente;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarCliente(){
    $('#formCliente').form('submit',{
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
                $('#dlgClientes').dialog('close');
                $('#dgClientes').datagrid('reload');
            }
        }
    });
}

// DESATIVAR
function salvarClienteAtivarDesativar(){
    $('#formClienteDesativar').form('submit',{
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
                $('#dlgClientesDesativar').dialog('close');
                $('#dgClientes').datagrid('reload');
            }
        }
    });
}

</script>