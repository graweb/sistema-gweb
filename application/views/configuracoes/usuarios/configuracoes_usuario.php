<table id="dgDemandasUsuarios" 
        class="easyui-datagrid" 
        style="width:100%;height:100%"
        url="<?php base_url();?>departamentos/listarAtivos"
        toolbar="#toolbarDemandasUsuario" 
        pagination="true"
        rownumbers="true"
        fitColumns="true"
        singleSelect="true"
        striped="true">
    <thead>
        <tr>
            <th field="id_departamento" width="10">ID</th>
            <th field="nome_departamento" width="30">DEPARTAMENTO</th>
            <th field="idDpto" width="10" formatter="formataDptoUsu" align="center"></th>
            <th field="idUsuDpto" hidden="true"></th>
        </tr>
    </thead>
</table>
<div id="toolbarDemandasUsuario">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="incluirDptoAbrirDemanda()">Incluir</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-remove fa-lg" plain="true" onclick="removerDptoAbrirDemanda()">Remover</a>
</div>

<!-- MODAL INCLUIR/REMOVER -->
<div id="dlgDemandasUsuarios" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgDemandasUsuarioButtons" modal="true">
    <form id="formDemandasUsuario" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="id_usu_config" name="id_usu_config">
        <input type="hidden" id="id_dpto_config" name="id_dpto_config">
        <h3 style="text-align: center;">Deseja ativar/desativar abertura de demandas para esse Departamento?</h3>
    </form>
</div>
<div id="dlgDemandasUsuarioButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgDemandasUsuarios').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarDemandasUsuario()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
// FORMATA PARA SABER SE O USUÁRIO ESTÁ COM O DPTO LIBERADO
function formataDptoUsu(value,row){

    <?php foreach ($dpto_acesso as $dptoAcesso) { ?>
        // VERIFICA SE O ID DOS USUARIOS SÃO IGUAIS E INFORMA O DPTO QUE O MSMO TEM ACESSO
        if(row.id_departamento == <?php echo $dptoAcesso->idDpto; ?>) {
            return '<i class="fa fa-check fa-lg" style="color:green"></i>';
        } 
    <?php } ?>

    return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
}

// INCLUIR DEMANDA
function incluirDptoAbrirDemanda(){
    var row = $('#dgDemandasUsuarios').datagrid('getSelected');
    var rowUsu = $('#dgUsuarios').datagrid('getSelected');

    if (row != null) {
        if(rowUsu.situacao == 0) {
            $.messager.alert('Atenção','Esse usuário está desativado!','warning');
        } else {
            $('#id_usu_config').val(rowUsu.id_usuario);
            $('#id_dpto_config').val(row.id_departamento);

            $('#dlgDemandasUsuarios').dialog('open').dialog('center').dialog('setTitle','Liberar/Remover abertura de demanda');
            url = '<?php base_url();?>usuarios/incluirDptoAbrirDemanda/';
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
    
}

// REMOVER DEMANDA
function removerDptoAbrirDemanda(){
    var row = $('#dgDemandasUsuarios').datagrid('getSelected');
    var rowUsu = $('#dgUsuarios').datagrid('getSelected');

    if (row != null){
        if(rowUsu.situacao == 0) {
            $.messager.alert('Atenção','Esse usuário está desativado!','warning');
        } else {
            $('#id_usu_config').val(rowUsu.id_usuario);
            $('#id_dpto_config').val(row.id_departamento);

            $('#dlgDemandasUsuarios').dialog('open').dialog('center').dialog('setTitle','Liberar/Remover abertura de demanda');
            url = '<?php base_url();?>usuarios/removerDptoAbrirDemanda/';
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR DEMANDAS USUARIO
function salvarDemandasUsuario(){
    $('#formDemandasUsuario').form('submit',{
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
                
                //ATAULIZA A GRADE DO DPTOS LIBERADOS, O "RELOAD" NA GRADE NÃO FUNCIONOU
                //PARA ATUALIZAR O ÍCONE
                var row = $('#dgUsuarios').datagrid('getSelected');
                $('#conteudoConfguracoesUsuario').panel('refresh', '<?php base_url();?>usuarios/configuracoes_usuario/'+row.id_usuario);

                $('#dlgDemandasUsuarios').dialog('close');
            }
        }
    });
}
</script>