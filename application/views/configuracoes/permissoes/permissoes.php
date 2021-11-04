<div class="easyui-layout" style="width:100%;height:100%;">
    <div data-options="region:'west',split:true" title="Permissões" style="width:40%;">
    	<table id="dgPermissoes"
		        class="easyui-datagrid" 
		        fit="true"
		        url="<?php base_url();?>permissoes/listar" 
		        toolbar="#toolbarPermissoes" 
		        pagination="true"
		        rownumbers="true" 
		        fitColumns="true" 
		        singleSelect="true"
		        striped="true">
		    <thead>
		        <tr>
		            <th data-options="field:'ck',checkbox:true"></th>
		            <th field="id_permissao" width="10">ID</th>
		            <th field="nome" width="80">PERMISSÃO</th>
		            <th field="situacao" width="20" align="center" formatter="formataSituacaoPermissao">SITUAÇÃO</th>
		        </tr>
		    </thead>
		</table>
		<div id="toolbarPermissoes">
		    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoPermissao()">Novo</a>
		    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarPermissao()">Editar</a>
		    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" plain="true" onclick="desativarPermissao()">Ativar/Desativar</a>
            <span class="button-sep"></span>
            <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaPermissao" searcher='buscaPermissao' style="width:40%">
            <div id='menuBuscaPermissao' style='width:auto'>
                <div name='id_permissao'>ID</div>
                <div name='nome'>Permissão</div>
            </div>
		</div>
    </div>
    <div id="conteudoPermissao" region="center" title="Acessos Concedidos">
    	<?php if(isset($view)){ $this->load->view($view);} ?>
    </div>
</div>

<!-- MODAL NOVO/EDITAR -->
<div id="dlgPermissoes" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgPermissaoButtons" modal="true">
    <form id="formPermissoes" class="easyui-form" method="post" data-options="novalidate:true">
        <div style="margin-bottom:10px">
            <label>Permissão:</label>
            <input id="nome" name="nome" class="easyui-textbox" required="true" style="width:100%">
        </div>
        <div style="margin-bottom:10px">
            <label>Situação:</label>
            <select class="easyui-combobox" id="situacao" name="situacao" panelHeight="auto" required="true" editable="false" style="width:100%;">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </div>
    </form>
</div>
<div id="dlgPermissaoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgPermissoes').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarDepartamento()" style="width:90px">Salvar</a>
</div>

<!-- MODAL DESATIVAR -->
<div id="dlgPermissoesDesativar" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgPermissaoButtonsDesativar" modal="true">
    <form id="formPermissoesDesativar" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="situacao_ativar_desativar" name="situacao_ativar_desativar">
        <h3 style="text-align: center;">Deseja ativar/desativar essa Permissão?</h3>
    </form>
</div>
<div id="dlgPermissaoButtonsDesativar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgPermissoesDesativar').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarDepartamentoAtivarDesativar()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
var url;

//BUSCA PERMISSAO
function buscaPermissao(value,name){
    if(name == 'id_permissao'){
        $('#dgPermissoes').datagrid('load',{
            id_permissao: value
        });
    }else if(name == 'nome'){
        $('#dgPermissoes').datagrid('load',{
            nome: value
        });
    }
}

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgPermissoes').datagrid({
    onDblClickRow: function(index,row){
        editarPermissao();
    }
});

//ABRE INFORMAÇÕES DE ACESSO COM 1 CLICK
$('#dgPermissoes').datagrid({
    onClickRow: function(index,row){
    	var row = $('#dgPermissoes').datagrid('getSelected');
        $('#conteudoPermissao').panel('refresh', '<?php base_url();?>permissoes/conteudo_permissao/'+row.id_permissao);
    }
});

// FORMATA SITUAÇÃO
function formataSituacaoPermissao(value,row){
    if (value == '1'){
        return '<i class="fa fa-check fa-lg" style="color:green"></i>';
    } else {
        return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
    }
}

// NOVO
function novoPermissao(){
    $('#dlgPermissoes').dialog('open').dialog('center').dialog('setTitle','Nova Permissão');
    $('#formPermissoes').form('clear');
    url = '<?php base_url();?>permissoes/cadastrar';
}

// EDITAR
function editarPermissao(){
    var row = $('#dgPermissoes').datagrid('getSelected');
    if (row != null){
        $('#dlgPermissoes').dialog('open').dialog('center').dialog('setTitle','Editar Permissão');
        $('#formPermissoes').form('load',row);
        url = '<?php base_url();?>permissoes/atualizar/'+row.id_permissao;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// DESATIVAR
function desativarPermissao(){
    var row = $('#dgPermissoes').datagrid('getSelected');
    if (row != null){
        if(row.situacao == 1) {
            $('#situacao_ativar_desativar').val(0);
        } else {
            $('#situacao_ativar_desativar').val(1);
        }

        $('#dlgPermissoesDesativar').dialog('open').dialog('center').dialog('setTitle','Ativar/Desativar Permissão');
        $('#formPermissoesDesativar').form('load',row);
        url = '<?php base_url();?>permissoes/desativar/'+row.id_permissao;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarDepartamento(){
    $('#formPermissoes').form('submit',{
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
                $('#dlgPermissoes').dialog('close');
                $('#dgPermissoes').datagrid('reload');
            }
        }
    });
}

// DESATIVAR
function salvarDepartamentoAtivarDesativar(){
    $('#formPermissoesDesativar').form('submit',{
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
                $('#dlgPermissoesDesativar').dialog('close');
                $('#dgPermissoes').datagrid('reload');
            }
        }
    });
}

</script>