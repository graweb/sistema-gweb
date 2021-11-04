<table id="dgNivelDeAtendimento" 
        title="Nível de Atendimento" 
        class="easyui-datagrid" 
        fit="true"
        url="<?php base_url();?>nivel_de_atendimento/listar" 
        toolbar="#toolbarNivelDeAtendimento" 
        pagination="true"
        rownumbers="true" 
        fitColumns="true" 
        singleSelect="true"
        striped="true">
    <thead>
        <tr>
            <th data-options="field:'ck',checkbox:true"></th>
            <th field="id_nivel_atendimento" width="10">ID</th>
            <th field="nivel" width="80">NÍVEL</th>
            <th field="observacoes" width="90">OBSERVAÇÕES</th>
            <th field="situacao" width="20" align="center" formatter="formaSituacaoNivelDeAtendimento">SITUAÇÃO</th>
        </tr>
    </thead>
</table>
<div id="toolbarNivelDeAtendimento">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoNivelDeAtendimento()">Novo</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarNivelDeAtendimento()">Editar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" plain="true" onclick="desativarNivelDeAtendimento()">Ativar/Desativar</a>
    <span class="button-sep"></span>
    <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaNivelAtendimento" searcher='buscabuscaNivelDeAtendimento' style="width:30%">
    <div id='menuBuscaNivelAtendimento' style='width:auto'>
        <div name='id_nivel_atendimento'>ID</div>
        <div name='nivel'>Nível</div>
    </div>
</div>

<!-- MODAL NOVO/EDITAR -->
<div id="dlgNivelDeAtendimento" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgNivelDeAtendimentoButtons" modal="true">
    <form id="formNivelDeAtendimento" class="easyui-form" method="post" data-options="novalidate:true">
        <div style="margin-bottom:10px">
            <label>Nível:</label>
            <input id="nivel" name="nivel" class="easyui-textbox" required="true" style="width:100%">
        </div>
        <div style="margin-bottom:10px">
            <label>Situação:</label>
            <select class="easyui-combobox" id="situacao" name="situacao" panelHeight="auto" required="true" editable="false" style="width:100%;">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </div>
        <div style="margin-bottom:10px">
            <label>Observações:</label>
            <input class="easyui-textbox" id="observacoes" name="observacoes" style="width:100%;height:60px" data-options="multiline:true">
        </div>
    </form>
</div>
<div id="dlgNivelDeAtendimentoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgNivelDeAtendimento').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarNivelDeAtendimento()" style="width:90px">Salvar</a>
</div>

<!-- MODAL DESATIVAR -->
<div id="dlgNivelDeAtendimentoDesativar" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgNivelDeAtendimentoButtonsDesativar" modal="true">
    <form id="formDepartamentoDesativar" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="situacao_ativar_desativar" name="situacao_ativar_desativar">
        <h3 style="text-align: center;">Deseja ativar/desativar esse departamento?</h3>
    </form>
</div>
<div id="dlgNivelDeAtendimentoButtonsDesativar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgNivelDeAtendimentoDesativar').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarNivelDeAtendimentoDesativar()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
var url;

//BUSCA NÍVEL ATENDIMENTO
function buscabuscaNivelDeAtendimento(value,name){
    if(name == 'id_nivel_atendimento'){
        $('#dgNivelDeAtendimento').datagrid('load',{
            id_nivel_atendimento: value
        });
    }else if(name == 'nivel'){
        $('#dgNivelDeAtendimento').datagrid('load',{
            nivel: value
        });
    }
}

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgNivelDeAtendimento').datagrid({
    onDblClickCell: function(index,field,value){
        editarNivelDeAtendimento();
    }
});

// FORMATA SITUAÇÃO
function formaSituacaoNivelDeAtendimento(value,row){
    if (value == '1'){
        return '<i class="fa fa-check fa-lg" style="color:green"></i>';
    } else {
        return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
    }
}

// NOVO
function novoNivelDeAtendimento(){
    $('#dlgNivelDeAtendimento').dialog('open').dialog('center').dialog('setTitle','Novo Nível de Atendimento');
    $('#formNivelDeAtendimento').form('clear');
    url = '<?php base_url();?>nivel_de_atendimento/cadastrar';
}

// EDITAR
function editarNivelDeAtendimento(){
    var row = $('#dgNivelDeAtendimento').datagrid('getSelected');
    if (row != null){
        $('#dlgNivelDeAtendimento').dialog('open').dialog('center').dialog('setTitle','Editar Nível de Atendimento');
        $('#formNivelDeAtendimento').form('load',row);
        url = '<?php base_url();?>nivel_de_atendimento/atualizar/'+row.id_nivel_atendimento;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// DESATIVAR
function desativarNivelDeAtendimento(){
    var row = $('#dgNivelDeAtendimento').datagrid('getSelected');
    if (row != null){
        if(row.situacao == 1) {
            $('#situacao_ativar_desativar').val(0);
        } else {
            $('#situacao_ativar_desativar').val(1);
        }

        $('#dlgNivelDeAtendimentoDesativar').dialog('open').dialog('center').dialog('setTitle','Ativar/Desativar Nível de Atendimento');
        $('#formDepartamentoDesativar').form('load',row);
        url = '<?php base_url();?>nivel_de_atendimento/desativar/'+row.id_nivel_atendimento;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarNivelDeAtendimento(){
    $('#formNivelDeAtendimento').form('submit',{
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
                $('#dlgNivelDeAtendimento').dialog('close');
                $('#dgNivelDeAtendimento').datagrid('reload');
            }
        }
    });
}

// DESATIVAR
function salvarNivelDeAtendimentoDesativar(){
    $('#formDepartamentoDesativar').form('submit',{
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
                $('#dlgNivelDeAtendimentoDesativar').dialog('close');
                $('#dgNivelDeAtendimento').datagrid('reload');
            }
        }
    });
}

</script>