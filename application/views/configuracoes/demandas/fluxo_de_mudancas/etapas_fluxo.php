<table id="dgEtapasFluxo" 
        class="easyui-datagrid" 
        style="width:100%;height:100%"
        url="<?php base_url();?>fluxo_de_mudancas/listarEtapasFluxo/<?php echo $id_flux_mud->id_fluxo_mudanca;?>"
        toolbar="#toolbarEtapasFluxo" 
        pagination="true"
        rownumbers="true"
        fitColumns="true"
        singleSelect="true"
        striped="true">
    <thead>
        <tr>
            <th field="etapa" width="40">ETAPA</th>
            <th field="usuario" width="30">USUÁRIO RESPONSÁVEL</th>
            <th field="ordem" width="10" align="center">ORDEM</th>
        </tr>
    </thead>
</table>
<div id="toolbarEtapasFluxo">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoEtapaFluxo()">Novo</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarEtapaFluxo()">Editar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-remove fa-lg" plain="true" onclick="excluirEtapaFluxo()">Excluir</a>
</div>

<!-- MODAL NOVO -->
<div id="dlgEtapasFluxo" class="easyui-dialog" style="width:360px;height:250px" 
        closed="true" buttons="#dlgEtapasFluxoButtons" modal="true">
    <form id="formEtapasFluxo" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="id_fluxo_mudanca" name="id_fluxo_mudanca">
        <table style="width:96%;">
            <tr>
                <td>
                    <div style="margin-bottom:10px">
                        <select class="easyui-combobox" label="Usuário Responsável:" labelPosition="top" id="id_usuario_responsavel" name="id_usuario_responsavel" panelHeight="auto" required="true" style="width:100%;">
                            <?php foreach ($dados_usuario as $usu) { 
                                echo "<option value='".$usu->id_usuario."'>".$usu->usuario."</option>";
                            } ?>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-textbox" label="Etapa:" labelPosition="top" id="etapa" name="etapa" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-numberbox" label="Ordem:" labelPosition="top" id="ordem" name="ordem" style="width:50%;" required="true">

                    <i class="fa fa-question fa-2x easyui-tooltip" title="Sempre começar do número <b>1 (um).</b>"></i>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgEtapasFluxoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgEtapasFluxo').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarEtapaFluxo()" style="width:90px">Salvar</a>
</div>

<!-- MODAL EXCLUIR ETAPA -->
<div id="dlgExcluirEtapa" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgExcluirEtapaButtons" modal="true">
    <form id="formExcluirEtapa" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="id_etapa_excluir" name="id_etapa_excluir">
        <h3 style="text-align: center;">Deseja excluir essa etapa?</h3>
    </form>
</div>
<div id="dlgExcluirEtapaButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgExcluirEtapa').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarExcluirEtapa()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
var url;

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgEtapasFluxo').datagrid({
    onDblClickCell: function(index,field,value){
        editarEtapaFluxo();
    }
});

// NOVO
function novoEtapaFluxo(){
    var row = $('#dgFluxoMudancas').datagrid('getSelected');
    $('#dlgEtapasFluxo').dialog('open').dialog('center').dialog('setTitle','Nova Etapa');
    $('#formEtapasFluxo').form('clear');
    $('#id_fluxo_mudanca').val(row.id_fluxo_mudanca);
    url = '<?php base_url();?>fluxo_de_mudancas/cadastrarEtapa';
}

// EDITAR
function editarEtapaFluxo(){
    var row = $('#dgEtapasFluxo').datagrid('getSelected');
    if(row != null){
        $('#dlgEtapasFluxo').dialog('open').dialog('center').dialog('setTitle','Editar Etapa');
        $('#formEtapasFluxo').form('load',row);
        url = '<?php base_url();?>fluxo_de_mudancas/atualizarEtapa/'+row.id_etapa;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// EXCLUIR
function excluirEtapaFluxo(){
    var row = $('#dgEtapasFluxo').datagrid('getSelected');
    if (row != null){
        $('#id_etapa_excluir').val(row.id_etapa);

        $('#dlgExcluirEtapa').dialog('open').dialog('center').dialog('setTitle','Excluir etapa');
        url = '<?php base_url();?>fluxo_de_mudancas/removerEtapa/'+row.id_etapa;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarEtapaFluxo(){
    $('#formEtapasFluxo').form('submit',{
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
                $('#dlgEtapasFluxo').dialog('close');
                $('#dgEtapasFluxo').datagrid('reload');
            }
        }
    });
}

// SALVAR EXCLUIR ETAPA
function salvarExcluirEtapa(){
    $('#formExcluirEtapa').form('submit',{
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
                $('#dlgExcluirEtapa').dialog('close');
                $('#dgEtapasFluxo').datagrid('reload');
            }
        }
    });
}

</script>