<table id="dgDepartamentos" 
        title="Departamentos" 
        class="easyui-datagrid" 
        fit="true"
        url="<?php base_url();?>departamentos/listar" 
        toolbar="#toolbarDepartamentos" 
        pagination="true"
        rownumbers="true" 
        fitColumns="true" 
        singleSelect="true"
        striped="true">
    <thead>
        <tr>
            <th data-options="field:'ck',checkbox:true"></th>
            <th field="id_departamento" width="10">ID</th>
            <th field="nome_departamento" width="80">DEPARTAMENTO</th>
            <th field="observacoes" width="90">OBSERVAÇÕES</th>
            <th field="situacao" width="20" align="center" formatter="formataSituacaoDepartamento">SITUAÇÃO</th>
        </tr>
    </thead>
</table>
<div id="toolbarDepartamentos">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoDepartamento()">Novo</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarDepartamento()">Editar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" plain="true" onclick="desativarDepartamento()">Ativar/Desativar</a>
    <span class="button-sep"></span>
    <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaDepartamento" searcher='buscaDepartamento' style="width:30%">
    <div id='menuBuscaDepartamento' style='width:auto'>
        <div name='id_departamento'>ID</div>
        <div name='nome_departamento'>Departamento</div>
    </div>
</div>

<!-- MODAL NOVO/EDITAR -->
<div id="dlgDepartamentos" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgDepartamentoButtons" modal="true">
    <form id="formDepartamento" class="easyui-form" method="post" data-options="novalidate:true">
        <div style="margin-bottom:10px">
            <label>Nome:</label>
            <input id="nome_departamento" name="nome_departamento" class="easyui-textbox" required="true" style="width:100%">
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
<div id="dlgDepartamentoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgDepartamentos').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarDepartamento()" style="width:90px">Salvar</a>
</div>

<!-- MODAL DESATIVAR -->
<div id="dlgDepartamentosDesativar" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgDepartamentoButtonsDesativar" modal="true">
    <form id="formDepartamentoDesativar" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="situacao_ativar_desativar" name="situacao_ativar_desativar">
        <h3 style="text-align: center;">Deseja ativar/desativar esse departamento?</h3>
    </form>
</div>
<div id="dlgDepartamentoButtonsDesativar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgDepartamentosDesativar').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarDepartamentoAtivarDesativar()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
var url;

//BUSCA DEPARTAMENTO
function buscaDepartamento(value,name){
    if(name == 'id_departamento'){
        $('#dgDepartamentos').datagrid('load',{
            id_departamento: value
        });
    }else if(name == 'nome_departamento'){
        $('#dgDepartamentos').datagrid('load',{
            nome_departamento: value
        });
    }
}

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgDepartamentos').datagrid({
    onDblClickCell: function(index,field,value){
        editarDepartamento();
    }
});

// FORMATA SITUAÇÃO
function formataSituacaoDepartamento(value,row){
    if (value == '1'){
        return '<i class="fa fa-check fa-lg" style="color:green"></i>';
    } else {
        return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
    }
}

// NOVO
function novoDepartamento(){
    $('#dlgDepartamentos').dialog('open').dialog('center').dialog('setTitle','Novo Departamento');
    $('#formDepartamento').form('clear');
    url = '<?php base_url();?>departamentos/cadastrar';
}

// EDITAR
function editarDepartamento(){
    var row = $('#dgDepartamentos').datagrid('getSelected');
    if (row != null){
        $('#dlgDepartamentos').dialog('open').dialog('center').dialog('setTitle','Editar Departamento');
        $('#formDepartamento').form('load',row);
        url = '<?php base_url();?>departamentos/atualizar/'+row.id_departamento;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// DESATIVAR
function desativarDepartamento(){
    var row = $('#dgDepartamentos').datagrid('getSelected');
    if (row != null){
        if(row.situacao == 1) {
            $('#situacao_ativar_desativar').val(0);
        } else {
            $('#situacao_ativar_desativar').val(1);
        }

        $('#dlgDepartamentosDesativar').dialog('open').dialog('center').dialog('setTitle','Ativar/Desativar Departamento');
        $('#formDepartamentoDesativar').form('load',row);
        url = '<?php base_url();?>departamentos/desativar/'+row.id_departamento;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarDepartamento(){
    $('#formDepartamento').form('submit',{
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
                $('#dlgDepartamentos').dialog('close');
                $('#dgDepartamentos').datagrid('reload');
            }
        }
    });
}

// DESATIVAR
function salvarDepartamentoAtivarDesativar(){
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
                $('#dlgDepartamentosDesativar').dialog('close');
                $('#dgDepartamentos').datagrid('reload');
            }
        }
    });
}

</script>