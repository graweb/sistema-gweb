<div class="easyui-layout" style="width:100%;height:100%;">
    <div data-options="region:'west',split:true" title="Incidentes" style="width:50%;">
    	<table id="dgIncidentes"
		        class="easyui-datagrid"
		        fit="true"
		        url="<?php base_url();?>incidentes_listar"
		        toolbar="#toolbarIncidentes"
		        pagination="true"
		        rownumbers="true"
		        fitColumns="true"
		        singleSelect="true"
		        striped="true">
		    <thead>
		        <tr>
		            <th data-options="field:'ck',checkbox:true"></th>
		            <th field="cod_incidente" width="25" formatter="formataCodIncidente">CÓD</th>
		            <th field="assunto_inc" width="75">ASSUNTO</th>
                    <th field="data_hora_inc" width="40" align="center">DATA/HORA</th>
		            <th field="situacao_inc" width="25" align="center" formatter="formataSituacaoIncidente" styler="formataFundoSituacaoIncidente">SITUAÇÃO</th>
		        </tr>
		    </thead>
		</table>
		<div id="toolbarIncidentes">
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aIncidentes')){ ?>
		    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoIncidente()">Novo</a>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'eIncidentes')){ ?>
		    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarIncidente()">Editar</a>
            <?php } ?>
            <span class="button-sep"></span>
            <a href="#" class="easyui-menubutton" data-options="menu:'#menuAtividadesIncidente',iconCls:'fa fa-cog fa-lg'">Atividades</a>
            <div id="menuAtividadesIncidente" style="width:auto;">
                <div onclick="responderIncidente()">Responder</div>
                <div onclick="encerrarIncidente()">Encerrar</div>
                <div onclick="cancelarIncidente()">Cancelar</div>
                <div class="menu-sep"></div>
                <div onclick="retomarIncidente()">Retomar</div>
                <div onclick="associarIncidente()">Associar</div>
                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'gerarMudancaIncidentes')){ ?>
                <div class="menu-sep"></div>
                <div onclick="gerarMudancaIncidente()">Gerar Mudança</div>
                <?php } ?>
                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'gerarProblemaIncidentes')){ ?>
                <div onclick="gerarProblemaIncidente()">Gerar Problema</div>
                <?php } ?>
                <div class="menu-sep"></div>
                <div onclick="responderPesquisaIncidente()"><i class="fa fa-bookmark-o fa-lg" style="color:#DBA901"></i> Pesquisa de Satisfação</div>
            </div>
            <span class="button-sep"></span>
            <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaIncidentes" searcher='buscaIncidente' style="width:40%">
            <div id='menuBuscaIncidentes' style='width:auto'>
                <div name='cod_incidente'>Cód. Incidente</div>
                <div name='assunto_inc'>Assunto</div>
            </div>
		</div>
    </div>
    <div id="conteudoIncidente" region="center" title="Informações Incidente">
    	<?php if(isset($view)){ $this->load->view($view);} ?>
    </div>
</div>

<!-- MODAL NOVO/EDITAR -->
<div id="dlgIncidentes" class="easyui-dialog" style="width:620px;height:370px"
        closed="true" buttons="#dlgIncidentesButtons" modal="true">
    <form id="formIncidentes" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:97%;">
            <?php if($this->session->userdata('tipo') != 1){ ?>
            <tr>
                <td>
                    <input id="id_usuario_inc" name="id_usuario_inc" class="easyui-combobox" label="Usuário:" labelPosition="top"
                    panelHeight="200px" required="true" style="width:100%;" data-options="
                        valueField: 'id_usuario',
                        textField: 'usuario',
                        url: '<?php base_url();?>usuarios/listarCombo',
                        onSelect: function(rec){
                            $('#id_cliente_inc').val(rec.id_cliente);
                            $('#nome_departamento_usu').textbox({value:rec.nome_departamento});
                        }"
                    >
                </td>
                <td>
                    <input type="hidden" id="id_cliente_inc" name="id_cliente_inc">
                    <input class="easyui-textbox" label="Departamento Usuário:" labelPosition="top" id="nome_departamento_usu" name="nome_departamento_usu" style="width:100%;" disabled="true">
                </td>
                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vDataHoraAbertura')) { ?>
                <td>
                    <input class="easyui-datetimebox" id="data_hora_inc" name="data_hora_inc" label="Data/Hora:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataCombo,parser:formatarDataComboParser" editable="false">
                </td>
                <?php }?>
            </tr>
            <tr>
                <td colspan="3">
                    <input id="id_departamento_inc" name="id_departamento_inc" class="easyui-combobox" label="Abrir para:" labelPosition="top"
                        panelHeight="auto" required="true" style="width:100%;" data-options="
                        valueField: 'id_departamento',
                        textField: 'nome_departamento',
                        url: '<?php base_url();?>departamentos/listarComboPorUsuario',
                        onSelect: function(dpto){
                            $('#id_acordo_nivel_servico_inc').combobox('clear');
                            var url = '<?php base_url();?>acordo_de_nivel_de_servico/listarComboPorDptoUsuario/'+dpto.id_departamento+'/'+document.getElementById('id_cliente_inc').value;
                            $('#id_acordo_nivel_servico_inc').combobox('reload', url);
                            $('#id_acordo_nivel_servico_inc').combobox('enable', true);
                        }"
                    >
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input label="Serviço:" labelPosition="top" id="id_acordo_nivel_servico_inc" name="id_acordo_nivel_servico_inc" class="easyui-combobox" panelHeight="auto" required="true" style="width:100%;" data-options="valueField:'id_acordo_nivel_servico',textField:'tarefa'" disabled="true">
                </td>
            </tr>
            <?php } else { ?>
            <tr>
                <td colspan="3">
                    <input type="hidden" id="id_usuario_inc" name="id_usuario_inc"
                    value="">
                    <input id="id_departamento_inc" name="id_departamento_inc" class="easyui-combobox" label="Abrir para:" labelPosition="top"
                        panelHeight="auto" required="true" style="width:100%;" data-options="
                        valueField: 'id_departamento',
                        textField: 'nome_departamento',
                        url: '<?php base_url();?>departamentos/listarComboPorUsuario',
                        onSelect: function(dpto){
                            $('#id_acordo_nivel_servico_inc').combobox('clear');
                            var url = '<?php base_url();?>acordo_de_nivel_de_servico/listarComboPorDptoUsuarioLogado/'+dpto.id_departamento;
                            $('#id_acordo_nivel_servico_inc').combobox('reload', url);
                            $('#id_acordo_nivel_servico_inc').combobox('enable', true);
                        }"
                    >
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input label="Serviço:" labelPosition="top" id="id_acordo_nivel_servico_inc" name="id_acordo_nivel_servico_inc" class="easyui-combobox" panelHeight="200px" required="true" style="width:100%;" data-options="valueField:'id_acordo_nivel_servico',textField:'tarefa'" disabled="true">
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" label="Assunto:" labelPosition="top" id="assunto_inc" name="assunto_inc" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" id="incidente_inc" name="incidente_inc" label="Incidente:" labelPosition="top" style="width:100%;height:100%" multiline="true" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgIncidentesButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgIncidentes').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarIncidente()" style="width:90px">Salvar</a>
</div>

<!-- MODAL RESPONDER -->
<div id="dlgIncidentesResponder" class="easyui-dialog" style="width:520px;height:280px"
        closed="true" buttons="#dlgIncidentesButtonsResponder" modal="true">
    <form id="formResponderIncidente" class="easyui-form" method="post" data-options="novalidate:true">
        <input class="easyui-textbox" id="resposta_inc" name="resposta_inc" label="Resposta:" labelPosition="top" style="width:100%;height:200px" multiline="true" required="true">
    </form>
</div>
<div id="dlgIncidentesButtonsResponder">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgIncidentesResponder').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarIncidentesResposta()" style="width:90px">Salvar</a>
</div>

<!-- MODAL GERAR MUDANÇA -->
<div id="dlgGerarMudancaIncidente" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgIncidentesButtonsgerarMudancaIncidente" modal="true">
    <form id="formGerarMudancaIncidente" class="easyui-form" method="post" data-options="novalidate:true">
        <input id="id_fluxo_mudanca" name="id_fluxo_mudanca" class="easyui-combobox" style="width:100%;" data-options="
            url:'<?php base_url();?>fluxo_de_mudancas/listarCombo',
            method:'get',
            valueField:'id_fluxo_mudanca',
            textField:'nome',
            panelHeight:'200px',
            label: 'Fluxo:',
            labelPosition: 'top'
        " required="true" editable="false">
    </form>
</div>
<div id="dlgIncidentesButtonsgerarMudancaIncidente">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgGerarMudancaIncidente').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvargerarMudancaIncidente()" style="width:90px">Salvar</a>
</div>

<!-- MODAL ASSOCIAR -->
<div id="dlgAssociarIncidente" class="easyui-dialog" style="width:20%;height:20%"
        closed="true" buttons="#dlgIncidentesButtonsAssociar" modal="true">
    <form id="formAssociarIncidente" class="easyui-form" method="post" data-options="novalidate:true">
        <input id="cod_incidente_associado" name="cod_incidente_associado" class="easyui-combobox" style="width:100%;" data-options="
            url:'<?php base_url();?>incidentes/listarCombo',
            method:'get',
            valueField:'cod_incidente',
            textField:'cod_incidente',
            panelHeight:'200px',
            label: 'Informe o código do Incidente:',
            labelPosition: 'top'
        " required="true">
    </form>
</div>
<div id="dlgIncidentesButtonsAssociar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgAssociarIncidente').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarAssociarIncidente()" style="width:90px">Salvar</a>
</div>

<!-- MODAL PESQUISA SATISFAÇÃO -->
<div id="dlgPesquisaSatisfacaoIncidente" class="easyui-dialog" style="width:620px;height:420px"
        closed="true" buttons="#dlgPesquisaSatisfacaoIncidenteButtons" modal="true">
    <form id="formPesquisaSatisfacaoIncidente" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:97%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Assunto:" labelPosition="top" id="assunto_pesq_inc" name="assunto_pesq_inc" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="Elogio">Elogio</option>
                        <option value="Sugestao">Sugestão</option>
                        <option value="Critica">Crítica</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="O Tecnico entrou em contato dentro do prazo de 24H para retorno de posicionamento?" labelPosition="top" id="pergunta1_pesq_inc" name="pergunta1_pesq_inc" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="O Tecnico cumpriu o prazo estipulado para solução?" labelPosition="top" id="pergunta2_pesq_inc" name="pergunta2_pesq_inc" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Seu problema foi resolvido?" labelPosition="top" id="pergunta3_pesq_inc" name="pergunta3_pesq_inc" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Você aceita ou rejeita a solução do tecnico?" labelPosition="top" id="pergunta4_pesq_inc" name="pergunta4_pesq_inc" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Aceitar</option>
                        <option value="2">Rejeitar</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-textbox" id="observacoes_pesq_inc" name="observacoes_pesq_inc" label="Observações:" labelPosition="top" style="width:100%;height:100%" multiline="true" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgPesquisaSatisfacaoIncidenteButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgPesquisaSatisfacaoIncidente').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarPesquisaSatisfacaoIncidente()" style="width:90px">Salvar</a>
</div>

<div id="menuAtividadesBtDireitoIncidente" style="width:auto;" class="easyui-menu">
    <div onclick="responderIncidente()">Responder</div>
    <div onclick="encerrarIncidente()">Encerrar</div>
    <div onclick="cancelarIncidente()">Cancelar</div>
    <div class="menu-sep"></div>
    <div onclick="retomarIncidente()">Retomar</div>
    <div onclick="associarIncidente()">Associar</div>
    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'gerarMudancaIncidentes')){ ?>
    <div class="menu-sep"></div>
    <div onclick="gerarMudancaIncidente()">Gerar Mudança</div>
    <?php } ?>
    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'gerarProblemaIncidentes')){ ?>
    <div onclick="gerarProblemaIncidente()">Gerar Problema</div>
    <?php } ?>
    <div class="menu-sep"></div>
    <div onclick="responderPesquisaIncidente()"><i class="fa fa-bookmark-o fa-lg" style="color:#DBA901"></i> Pesquisa de Satisfação</div>
</div>

<script type="text/javascript">
var url;

function formataCodIncidente(value, row){
    if(row.situacao_inc == 3) {
        if(row.respondeu_pesq_inc == 0) {
            return value + ' <i class="fa fa-bookmark-o fa-lg" style="color:#DBA901"></i>';
        } else {
            return value;
        }
    } else {
        return value;
    }
}

// FORMATA A DATA/HORA NO COMBO DATA_HORA
function formatarDataCombo(date){
    var dataA = [date.getDate(),date.getMonth()+1,date.getFullYear()].join('/');
    var dataB = [date.getHours(),date.getMinutes(),date.getSeconds()].join(':');
    return dataA + ' ' + dataB;
}

function formatarDataComboParser(s){
    if (!s){return new Date();}
    var dt = s.split(' ');
    var dateFormat = dt[0].split('/');
    var timeFormat = dt[1].split(':');
    var date = new Date(dateFormat[2],dateFormat[1]-1,dateFormat[0]);
    if (dt.length>1){
        date.setHours(timeFormat[0]);
        date.setMinutes(timeFormat[1]);
        date.setSeconds(timeFormat[2]);
    }
    return date;
}

//BUSCA INCIDENTE
function buscaIncidente(value,name){
    if(name == 'cod_incidente'){
        $('#dgIncidentes').datagrid('load',{
            cod_incidente: value
        });
    }else if(name == 'assunto_inc'){
        $('#dgIncidentes').datagrid('load',{
            assunto_inc: value
        });
    }
}

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgIncidentes').datagrid({
    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'eIncidentes')){ ?>
        onDblClickRow: function(index,row){
            editarIncidente();
        }
    <?php } ?>
});

//ABRE INFORMAÇÕES DE ACESSO COM 1 CLICK
$('#dgIncidentes').datagrid({
    onClickRow: function(index,row){
    	var row = $('#dgIncidentes').datagrid('getSelected');
        $('#conteudoIncidente').panel('refresh', '<?php base_url();?>incidentes/historico_incidente/'+row.cod_incidente);
    }
});

//ABRE O MENU AO CLICAR COM O BOTÃO DIREITO NO DATAGRID
$('#dgIncidentes').datagrid({
    singleSelect: true,
    onRowContextMenu: function(e,index,row){
        $(this).datagrid('selectRow',index);
        var row = $('#dgIncidentes').datagrid('getSelected');
        $('#conteudoIncidente').panel('refresh', '<?php base_url();?>incidentes/historico_incidente/'+row.cod_incidente);
        e.preventDefault();
        $('#menuAtividadesBtDireitoIncidente').menu('show', {
            left:e.pageX,
            top:e.pageY
        });
    }
});

// FORMATA SITUAÇÃO
function formataSituacaoIncidente(value,row){
    var sit = row.situacao_inc;

    // NAO ACEITOU SWITCH NO JS
    if(sit == 1){
        return 'ABERTO';
    } else if(sit == 2){
        return 'EM ANÁLISE';
    } else if(sit == 3){
        return 'CONCLUÍDO';
    } else if(sit == 4){
        return 'CANCELADO';
    }
}

// FORMATA SITUAÇÃO
function formataFundoSituacaoIncidente(value,row){
    var sit = row.situacao_inc;

    // NAO ACEITOU SWITCH NO JS
    if(sit == 1){
        return 'background-color:#F78181;';
    } else if(sit == 2){
        return 'background-color:#A9D0F5;';
    } else if(sit == 3){
        return 'background-color:#CEF6CE;';
    } else if(sit == 4){
        return 'background-color:#F3E2A9;';
    }
}

// NOVO
function novoIncidente(){
    $('#dlgIncidentes').dialog('open').dialog('center').dialog('setTitle','Novo Incidente');
    $('#formIncidentes').form('clear');
    $('#id_acordo_nivel_servico_inc').combobox('disable', true);
    $('#id_usuario_inc').val('<?php echo $this->session->userdata('id_usuario'); ?>');
    url = '<?php base_url();?>incidentes/cadastrar';
}

// EDITAR
function editarIncidente(){
    var row = $('#dgIncidentes').datagrid('getSelected');
    if (row != null){
        $('#dlgIncidentes').dialog('open').dialog('center').dialog('setTitle','Editar Incidente');
        $('#formIncidentes').form('load',row);
        url = '<?php base_url();?>incidentes/atualizar/'+row.cod_incidente;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// RESPONDER
function responderIncidente(){
    var row = $('#dgIncidentes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_inc == 3 || row.situacao_inc == 4){
            $.messager.alert('Atenção','Este Incidente está cancelado/concluído!','warning');
        } else {
            $('#dlgIncidentesResponder').dialog('open').dialog('center').dialog('setTitle','Responder Incidente');
            $('#formResponderIncidente').form('clear');
            url = '<?php base_url();?>incidentes/responder/'+row.cod_incidente;
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// ENCERRAR
function encerrarIncidente(){
    var row = $('#dgIncidentes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_inc == 3 || row.situacao_inc == 4){
            $.messager.alert('Atenção','Este Incidente está cancelado/concluído!','warning');
        } else {
            jQuery.messager.confirm('Atenção','Deseja encerrar este Incidente?',function(r){
                if (r){
                    jQuery.post('<?php base_url();?>incidentes/encerrar/'+row.cod_incidente+'/'+row.cod_incidente_associado_inc,function(result){
                        if (result.success){
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
                            $('#dgIncidentes').datagrid('reload');
                        } else {
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
                        }
                    },'json');
                }
            });
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// CANCELAR
function cancelarIncidente(){
    var row = $('#dgIncidentes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_inc == 3 || row.situacao_inc == 4){
            $.messager.alert('Atenção','Este Incidente está cancelado/concluído!','warning');
        } else {
            jQuery.messager.confirm('Atenção','Deseja cancelar este Incidente?',function(r){
                if (r){
                    jQuery.post('<?php base_url();?>incidentes/cancelar/'+row.cod_incidente+'/'+row.cod_incidente_associado_inc,function(result){
                        if (result.success){
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
                            $('#dgIncidentes').datagrid('reload');
                        } else {
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
                        }
                    },'json');
                }
            });
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// RETOMAR
function retomarIncidente(){
    var row = $('#dgIncidentes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_inc == 1 || row.situacao_inc == 2){
            $.messager.alert('Atenção','Este Incidente está aberto/em análise!','warning');
        } else {
            jQuery.messager.confirm('Atenção','Deseja retomar este Incidente?',function(r){
                if (r){
                    jQuery.post('<?php base_url();?>incidentes/retomar/'+row.cod_incidente,function(result){
                        if (result.success){
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
                            $('#dgIncidentes').datagrid('reload');
                        } else {
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
                        }
                    },'json');
                }
            });
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// ASSOCIAR
function associarIncidente(){
    var row = $('#dgIncidentes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_inc == 3 || row.situacao_inc == 4){
            $.messager.alert('Atenção','Este Incidente está cancelado/concluído!','warning');
        } else {
            if(row.cod_incidente_associado_inc == null){
                $('#dlgAssociarIncidente').dialog('open').dialog('center').dialog('setTitle','Associar Incidente');
                $('#formAssociarIncidente').form('clear');
                url = '<?php base_url();?>incidentes/associar/'+row.cod_incidente;
            } else {
                $.messager.alert('Atenção','Este Incidente já possui uma associação!','warning');
            }
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// GERAR MUDANÇA
function gerarMudancaIncidente(){
    var row = $('#dgIncidentes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_inc == 3 || row.situacao_inc == 4){
            $.messager.alert('Atenção','Este Incidente está cancelado/concluído!','warning');
        } else {
            if(row.gerou_mudanca_inc == 1) {
                $.messager.alert('Atenção','Já existe uma mudança associada para este Incidente!','warning');
            } else {
                $('#dlgGerarMudancaIncidente').dialog('open').dialog('center').dialog('setTitle','Gerar Mudança');
                $('#formGerarMudancaIncidente').form('clear');
                url = '<?php base_url();?>incidentes/gerar_mudanca/'+row.cod_incidente;
            }
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// GERAR PROBLEMA
function gerarProblemaIncidente(){
    var row = $('#dgIncidentes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_inc == 3 || row.situacao_inc == 4){
            $.messager.alert('Atenção','Este Incidente está cancelado/concluído!','warning');
        } else {
            if(row.gerou_problema_inc == 1) {
                $.messager.alert('Atenção','Já existe um problema associado para este Incidente!','warning');
            } else {
                jQuery.messager.confirm('Atenção','Deseja gerar um problema a partir deste Incidente?',function(r){
                    if (r){
                        jQuery.post('<?php base_url();?>incidentes/gerar_problema/'+row.cod_incidente,function(result){
                            if (result.success){
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
                                $('#dgIncidentes').datagrid('reload');
                            } else {
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
                            }
                        },'json');
                    }
                });
            }
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// RESPONDER PESQUISA
function responderPesquisaIncidente(){
    var row = $('#dgIncidentes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_inc != 3){
            $.messager.alert('Atenção','Este Incidente NÃO está concluído!','warning');
        } else {
            if(row.respondeu_pesq_inc == 1) {
                $.messager.alert('Atenção','Pesquisa já respondida!','warning');
            } else {
                $('#dlgPesquisaSatisfacaoIncidente').dialog('open').dialog('center').dialog('setTitle','Responder Pesquisa de Satisfação');
                $('#formPesquisaSatisfacaoIncidente').form('clear');
                url = '<?php base_url();?>incidentes/responder_pesquisa_satisfacao/'+row.cod_incidente;
            }
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarIncidente(){
    $('#formIncidentes').form('submit',{
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
                $('#dlgIncidentes').dialog('close');
                $('#dgIncidentes').datagrid('reload');
                $('#conteudoIncidente').panel('refresh');
            }
        }
    });
}

// RESPONDER
function salvarIncidentesResposta(){
    var row = $('#dgIncidentes').datagrid('getSelected');
    $('#formResponderIncidente').form('submit',{
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
                $('#dlgIncidentesResponder').dialog('close');
                $('#dgIncidentes').datagrid('reload');
                $('#conteudoIncidente').panel('refresh');
                $('#dgIncidentesRetorno').datagrid('reload');
            }
        }
    });
}

// ENCERRAR
function salvarIncidentesEncerrar(){
    $('#formEncerrarIncidente').form('submit',{
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
                $('#dlgIncidentesEncerrar').dialog('close');
                $('#dgIncidentes').datagrid('reload');
            }
        }
    });
}

// CANCELAR
function salvarIncidentesCancelar(){
    $('#formCancelarIncidente').form('submit',{
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
                $('#dlgIncidentesEncerrar').dialog('close');
                $('#dgIncidentes').datagrid('reload');
            }
        }
    });
}

// SALVAR ASSOCIAR INCIDENTE
function salvarAssociarIncidente(){
    $('#formAssociarIncidente').form('submit',{
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
                $('#dlgAssociarIncidente').dialog('close');
                $('#dgIncidentes').datagrid('reload');
            }
        }
    });
}

// SALVAR GERAR MUDANÇA
function salvargerarMudancaIncidente(){
    $('#formGerarMudancaIncidente').form('submit',{
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
                $('#dlgGerarMudancaIncidente').dialog('close');
                $('#dgIncidentes').datagrid('reload');
            }
        }
    });
}

// SALVAR GERAR PROBLEMA
function salvargerarProblemaIncidente(){
    $('#formGerarProblemaIncidente').form('submit',{
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
                $('#dlgGerarProblemaIncidente').dialog('close');
                $('#dgIncidentes').datagrid('reload');
            }
        }
    });
}

// SALVAR PESQUISA DE SATISFAÇÃO
function salvarPesquisaSatisfacaoIncidente(){
    $('#formPesquisaSatisfacaoIncidente').form('submit',{
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
                $('#dlgPesquisaSatisfacaoIncidente').dialog('close');
                $('#dgIncidentes').datagrid('reload');
            }
        }
    });
}

</script>