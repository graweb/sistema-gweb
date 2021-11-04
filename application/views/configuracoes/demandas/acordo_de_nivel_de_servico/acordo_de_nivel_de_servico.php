<table id="dgAcordoDeNivelDeServico" 
        title="Acordo de Nível de Serviço" 
        class="easyui-datagrid" 
        fit="true"
        url="<?php base_url();?>acordo_de_nivel_de_servico/listar" 
        toolbar="#toolbarAcordoDeNivelDeServico" 
        pagination="true"
        rownumbers="true" 
        fitColumns="true" 
        singleSelect="true"
        striped="true">
    <thead>
        <tr>
            <th data-options="field:'ck',checkbox:true"></th>
            <th field="id_acordo_nivel_servico" width="10">ID</th>
            <th field="nome_cliente" width="40">CLIENTE</th>
            <th field="tarefa" width="40">TAREFA</th>
            <th field="prazo" width="20" align="center" formatter="formataPrazo">PRAZO</th>
            <th field="prioridade" width="20" align="center" formatter="formataPrioridadeAcordoDeNivelDeServico">PRIORIDADE</th>
            <th field="situacao" width="20" align="center" formatter="formataSituacaoAcordoDeNivelDeServico">SITUAÇÃO</th>
        </tr>
    </thead>
</table>
<div id="toolbarAcordoDeNivelDeServico">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoAcordoDeNivelDeServico()">Novo</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarAcordoDeNivelDeServico()">Editar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" plain="true" onclick="desativarAcordoDeNivelDeServico()">Ativar/Desativar</a>
    <span class="button-sep"></span>
    <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaAcordoDeNivelDeServico" searcher='buscaAcordoDeNivelDeServico' style="width:30%">
    <div id='menuBuscaAcordoDeNivelDeServico' style='width:auto'>
        <div name='id_acordo_nivel_servico'>ID</div>
        <div name='nome_cliente'>Cliente</div>
        <div name='tarefa'>Tarefa</div>
        <div name='prazo'>Prazo</div>
        <div name='prioridade'>Prioridade</div>
    </div>
</div>

<!-- MODAL NOVO/EDITAR -->
<div id="dlgAcordoDeNivelDeServico" class="easyui-dialog" style="width:620px;height:370px" 
        closed="true" buttons="#dlgAcordoDeNivelDeServicoButtons" modal="true">
    <form id="formAcordoDeNivelDeServico" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:97%;">
            <tr>
                <td colspan="2">
                    <select class="easyui-combobox" label="Cliente:" labelPosition="top" id="id_cliente" name="id_cliente" panelHeight="auto" required="true" style="width:100%;">
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
                    <select class="easyui-combobox" label="Nível de Atendimento:" labelPosition="top" id="id_nivel_atendimento" name="id_nivel_atendimento" panelHeight="auto" required="true" style="width:100%;">
                        <?php foreach ($dados_nivel_atendimento as $nivel) { 
                            echo "<option value='".$nivel->id_nivel_atendimento."'>".$nivel->nivel."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-textbox" label="Tarefa:" labelPosition="top" id="tarefa" name="tarefa" style="width:100%;" required="true">
                </td>
                <td>
                    <input class="easyui-numberbox" label="Prazo (em horas):" labelPosition="top" id="prazo" name="prazo" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Prioridade:" labelPosition="top" id="prioridade" name="prioridade" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Muito baixa</option>
                        <option value="2">Baixa</option>
                        <option value="3">Média</option>
                        <option value="4">Alta</option>
                        <option value="5">Urgente</option>
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
                    <input class="easyui-textbox" id="observacoes" name="observacoes" label="Observações:" labelPosition="top" style="width:100%;height:100%" multiline="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgAcordoDeNivelDeServicoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgAcordoDeNivelDeServico').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarAcordoDeNivelDeServico()" style="width:90px">Salvar</a>
</div>

<!-- MODAL DESATIVAR -->
<div id="dlgAcordoDeNivelDeServicoDesativar" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgAcordoDeNivelDeServicoButtonsDesativar" modal="true">
    <form id="formDepartamentoDesativar" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="situacao_ativar_desativar" name="situacao_ativar_desativar">
        <h3 style="text-align: center;">Deseja ativar/desativar esse Acordo de Nível de Serviço?</h3>
    </form>
</div>
<div id="dlgAcordoDeNivelDeServicoButtonsDesativar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgAcordoDeNivelDeServicoDesativar').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarAcordoDeNivelDeServicoDesativar()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
var url;

//BUSCA ACORDE DE NÍVEL DE SERVIÇO
function buscaAcordoDeNivelDeServico(value,name){
    if(name == 'id_acordo_nivel_servico'){
        $('#dgAcordoDeNivelDeServico').datagrid('load',{
            id_acordo_nivel_servico: value
        });
    }else if(name == 'nome_cliente'){
        $('#dgAcordoDeNivelDeServico').datagrid('load',{
            nome_cliente: value
        });
    }else if(name == 'tarefa'){
        $('#dgAcordoDeNivelDeServico').datagrid('load',{
            tarefa: value
        });
    }else if(name == 'prazo'){
        $('#dgAcordoDeNivelDeServico').datagrid('load',{
            prazo: value
        });
    }else if(name == 'prioridade'){
        $('#dgAcordoDeNivelDeServico').datagrid('load',{
            prioridade: value
        });
    }
}

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgAcordoDeNivelDeServico').datagrid({
    onDblClickCell: function(index,field,value){
        editarAcordoDeNivelDeServico();
    }
});

// FORMATA PRAZO
function formataPrazo(value,row){
    return value + ' hs';
}

// FORMATA PRIORIDADE
function formataPrioridadeAcordoDeNivelDeServico(value,row){
    if (value == '1'){
        return '<span style="color: #848484">MUITO BAIXA</span>';
    } else if (value == '2'){
        return '<span style="color: #088A08">BAIXA</span>';
    } else if (value == '3'){
        return '<span style="color: #0101DF">MÉDIA</span>';
    } else if (value == '4'){
        return '<span style="color: #B45F04">ALTA</span>';
    } else if (value == '5'){
        return '<span style="color: #B40404">URGENTE</span>';
    }
}

// FORMATA SITUAÇÃO
function formataSituacaoAcordoDeNivelDeServico(value,row){
    if (value == '1'){
        return '<i class="fa fa-check fa-lg" style="color:green"></i>';
    } else {
        return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
    }
}

// NOVO
function novoAcordoDeNivelDeServico(){
    $('#dlgAcordoDeNivelDeServico').dialog('open').dialog('center').dialog('setTitle','Novo Acordo de Nível de Serviço');
    $('#formAcordoDeNivelDeServico').form('clear');
    url = '<?php base_url();?>acordo_de_nivel_de_servico/cadastrar';
}

// EDITAR
function editarAcordoDeNivelDeServico(){
    var row = $('#dgAcordoDeNivelDeServico').datagrid('getSelected');
    if (row != null){
        $('#dlgAcordoDeNivelDeServico').dialog('open').dialog('center').dialog('setTitle','Editar Acordo de Nível de Serviço');
        $('#formAcordoDeNivelDeServico').form('load',row);
        url = '<?php base_url();?>acordo_de_nivel_de_servico/atualizar/'+row.id_acordo_nivel_servico;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// DESATIVAR
function desativarAcordoDeNivelDeServico(){
    var row = $('#dgAcordoDeNivelDeServico').datagrid('getSelected');
    if (row != null){
        if(row.situacao == 1) {
            $('#situacao_ativar_desativar').val(0);
        } else {
            $('#situacao_ativar_desativar').val(1);
        }

        $('#dlgAcordoDeNivelDeServicoDesativar').dialog('open').dialog('center').dialog('setTitle','Ativar/Desativar Acordo de Nível de Serviço');
        $('#formDepartamentoDesativar').form('load',row);
        url = '<?php base_url();?>acordo_de_nivel_de_servico/desativar/'+row.id_acordo_nivel_servico;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarAcordoDeNivelDeServico(){
    $('#formAcordoDeNivelDeServico').form('submit',{
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
                $('#dlgAcordoDeNivelDeServico').dialog('close');
                $('#dgAcordoDeNivelDeServico').datagrid('reload');
            }
        }
    });
}

// DESATIVAR
function salvarAcordoDeNivelDeServicoDesativar(){
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
                $('#dlgAcordoDeNivelDeServicoDesativar').dialog('close');
                $('#dgAcordoDeNivelDeServico').datagrid('reload');
            }
        }
    });
}

</script>