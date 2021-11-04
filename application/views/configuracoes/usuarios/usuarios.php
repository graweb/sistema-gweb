<div class="easyui-layout" style="width:100%;height:100%;">
    <div data-options="region:'west',split:true" title="Usuários" style="width:60%;">
        <table id="dgUsuarios"
                class="easyui-datagrid"
                style="width:100%;height:100%"
                url="<?php base_url();?>usuarios/listar"
                toolbar="#toolbarUsuario" 
                pagination="true"
                rownumbers="true"
                fitColumns="true"
                singleSelect="true"
                striped="true">
            <thead>
                <tr>
                    <th data-options="field:'ck',checkbox:true"></th>
                    <th field="id_usuario" width="10">ID</th>
                    <th field="usuario" width="30">USUÁRIO</th>
                    <th field="email" width="50">E-MAIL</th>
                    <th field="situacao" width="20" align="center" formatter="formataSituacaoUsuario">SITUAÇÃO</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarUsuario">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoUsuario()">Novo</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarUsuario()">Editar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" plain="true" onclick="desativarUsuario()">Ativar/Desativar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-key fa-lg" plain="true" onclick="definirSenha()">Definir senha</a>
            <span class="button-sep"></span>
            <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaUsuarios" searcher='buscaUsuario' style="width:30%">
            <div id='menuBuscaUsuarios' style='width:auto'>
                <div name='id_usuario'>ID</div>
                <div name='usuario'>Usuário</div>
                <div name='email'>E-mail</div>
            </div>
        </div>
    </div>
    <div id="conteudoConfguracoesUsuario" region="center" title="Abrir demandas para">
        <?php if(isset($view)){ $this->load->view($view);} ?>
    </div>
</div>

<div id="dlgUsuarios" class="easyui-dialog" style="width:620px;height:480px" 
        closed="true" buttons="#dlgUsuariosButtons" modal="true">
    <form id="formUsuario" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:97%;">
            <tr>
                <td colspan="2">
                    <select class="easyui-combobox" label="Cliente Associado:" labelPosition="top" id="id_cliente" name="id_cliente" panelHeight="auto" required="true" style="width:100%;">
                        <?php foreach ($dados_cliente as $cli) { 
                            echo "<option value='".$cli->id_cliente."'>".$cli->nome_cliente."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Departamento:" labelPosition="top" id="id_departamento" name="id_departamento" panelHeight="auto" required="true" style="width:100%;">
                        <?php foreach ($dados_departamento as $dpto) { 
                            echo "<option value='".$dpto->id_departamento."'>".$dpto->nome_departamento."</option>";
                        } ?>
                    </select>
                </td>
                <td>
                    <select class="easyui-combobox" label="Permissão:" labelPosition="top" id="id_permissao" name="id_permissao" panelHeight="auto" required="true" style="width:100%;">
                        <?php foreach ($dados_permissao as $per) { 
                            echo "<option value='".$per->id_permissao."'>".$per->nome."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="easyui-textbox" label="Nome:" labelPosition="top" id="nome" name="nome" style="width:100%;" required="true">
                </td>
            </tr>
                <td>
                    <input class="easyui-textbox" label="Usuário:" labelPosition="top" id="usuario" name="usuario" style="width:100%;" required="true">
                </td>
                <td>
                    <input class="easyui-textbox" type="password" label="Senha:" labelPosition="top" id="senha" name="senha" style="width:100%;" required="true" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-textbox" label="E-mail:" labelPosition="top" id="email" name="email" style="width:100%;" required="true" validType="email">
                </td>
                <td>
                    <select class="easyui-combobox" label="Mudar Senha:" labelPosition="top" id="mudar_senha" name="mudar_senha" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo:" labelPosition="top" id="tipo" name="tipo" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value='3'>Administrador</option>
                        <option value='2'>Técnico</option>
                        <option value='1'>Usuário</option>
                    </select>
                </td>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao" name="situacao" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value='1'>Ativo</option>
                        <option value='0'>Inativo</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="easyui-textbox" id="assinatura" name="assinatura" label="Assinatura:" labelPosition="top" style="width:100%;height:100%" multiline="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgUsuariosButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgUsuarios').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarUsuario()" style="width:90px">Salvar</a>
</div>

<!-- MODAL DESATIVAR -->
<div id="dlgUsuariosDesativar" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgUsuarioButtonsDesativar" modal="true">
    <form id="formUsuarioDesativar" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="situacao_ativar_desativar" name="situacao_ativar_desativar">
        <h3 style="text-align: center;">Deseja ativar/desativar esse usuário?</h3>
    </form>
</div>
<div id="dlgUsuarioButtonsDesativar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgUsuariosDesativar').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarUsuarioAtivarDesativar()" style="width:90px">Salvar</a>
</div>

<!-- MODAL DEFINIR SENHA -->
<div id="dlgUsuariosDefinirSenha" class="easyui-dialog" style="width:250px;padding:10px 20px;"
        closed="true" buttons="#dlgUsuarioButtonsDefinirSenha" modal="true">
    <form id="formUsuarioDefinirSenha" class="easyui-form" method="post" data-options="novalidate:true">
        <input class="easyui-textbox" type="password" data-options="prompt:'Senha',iconCls:'icon-lock',iconWidth:38" label="Senha:" labelPosition="top" id="senha_definir" name="senha_definir" style="width:100%;" required="true">
        <input class="easyui-textbox" type="password" data-options="prompt:'Senha',iconCls:'icon-lock',iconWidth:38" label="Confirmar senha:" labelPosition="top" id="senha_definir_confirma" name="senha_definir_confirma" style="width:100%;" required="true">
    </form>
</div>
<div id="dlgUsuarioButtonsDefinirSenha">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgUsuariosDefinirSenha').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarDefinirSenha()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
var url;

//BUSCA USUARIO
function buscaUsuario(value,name){
    if(name == 'id_usuario'){
        $('#dgUsuarios').datagrid('load',{
            id_usuario: value
        });
    }else if(name == 'usuario'){
        $('#dgUsuarios').datagrid('load',{
            usuario: value
        });
    }else if(name == 'email'){
        $('#dgUsuarios').datagrid('load',{
            email: value
        });
    }
}

// FORMATA SITUAÇÃO
function formataSituacaoUsuario(value,row){
    if (value == '1'){
        return '<i class="fa fa-check fa-lg" style="color:green"></i>';
    } else {
        return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
    }
}

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgUsuarios').datagrid({
    onDblClickCell: function(index,field,value){
        editarUsuario();
    }
});

//ABRE INFORMAÇÕES DE ACESSO COM 1 CLICK
$('#dgUsuarios').datagrid({
    onClickRow: function(index,row){
        var row = $('#dgUsuarios').datagrid('getSelected');
        $('#conteudoConfguracoesUsuario').panel('refresh', '<?php base_url();?>usuarios/configuracoes_usuario/'+row.id_usuario);
    }
});

// FORMATA SITUAÇÃO
function formataSituacaoUsuarios(value,row){
    if (value == '1'){
        return '<i class="fa fa-check fa-lg" style="color:green"></i>';
    } else {
        return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
    }
}

// NOVO
function novoUsuario(){
    $('#dlgUsuarios').dialog('open').dialog('center').dialog('setTitle','Novo Usuário');
    $('#formUsuario').form('clear');
    url = '<?php base_url();?>usuarios/cadastrar';
}

// EDITAR
function editarUsuario(){
    var row = $('#dgUsuarios').datagrid('getSelected');
    if (row != null){
        $('#dlgUsuarios').dialog('open').dialog('center').dialog('setTitle','Editar Usuário');
        $('#formUsuario').form('load',row);
        $('#senha').textbox('disable');
        $('#senha').textbox('clear');
        url = '<?php base_url();?>usuarios/atualizar/'+row.id_usuario;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// DESATIVAR
function desativarUsuario(){
    var row = $('#dgUsuarios').datagrid('getSelected');
    if (row != null){
        if(row.situacao == 1) {
            $('#situacao_ativar_desativar').val(0);
        } else {
            $('#situacao_ativar_desativar').val(1);
        }

        $('#dlgUsuariosDesativar').dialog('open').dialog('center').dialog('setTitle','Ativar/Desativar Usuário');
        $('#formUsuarioDesativar').form('load',row);
        url = '<?php base_url();?>usuarios/desativar/'+row.id_usuario;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// DEFINIR SENHA
function definirSenha(){
    var row = $('#dgUsuarios').datagrid('getSelected');
    if (row != null){
        $('#dlgUsuariosDefinirSenha').dialog('open').dialog('center').dialog('setTitle','Definir senha Usuário');
        $('#formUsuarioDefinirSenha').form('clear');
        url = '<?php base_url();?>usuarios/definir_senha/'+row.id_usuario;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarUsuario(){
    $('#formUsuario').form('submit',{
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
                $('#dlgUsuarios').dialog('close');
                $('#dgUsuarios').datagrid('reload');
            }
        }
    });
}

// DESATIVAR
function salvarUsuarioAtivarDesativar(){
    $('#formUsuarioDesativar').form('submit',{
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
                $('#dlgUsuariosDesativar').dialog('close');
                $('#dgUsuarios').datagrid('reload');
            }
        }
    });
}

// SALVAR DEFINIÇÃO DE SENHA
function salvarDefinirSenha(){
    
    if($("#senha_definir").val() == $("#senha_definir_confirma").val())
    {
        $('#formUsuarioDefinirSenha').form('submit',{
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
                    $('#dlgUsuariosDefinirSenha').dialog('close');
                    $('#dgUsuarios').datagrid('reload');
                }
            }
        });
    } else {
        $.messager.alert('Atenção','Informações não conferem, favor digitar a mesma senha!','error');
    }
}

</script>