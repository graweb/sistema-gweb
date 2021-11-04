<div class="easyui-layout" style="width:100%;height:100%;">
    <div data-options="region:'west',split:true" title="Requisições" style="width:50%;">
        <table id="dgRequisicoes"
                class="easyui-datagrid"
                fit="true"
                url="<?php base_url();?>requisicoes_listar"
                toolbar="#toolbarRequisicoes"
                pagination="true"
                rownumbers="true"
                fitColumns="true"
                singleSelect="true"
                striped="true">
            <thead>
                <tr>
                    <th data-options="field:'ck',checkbox:true"></th>
                    <th field="cod_requisicao" width="25" formatter="formataCodRequisicao">CÓD</th>
                    <th field="assunto_req" width="75">ASSUNTO</th>
                    <th field="data_hora_req" width="40" align="center">DATA/HORA</th>
                    <th field="situacao_req" width="25" align="center" formatter="formataSituacaoRequisicao" styler="formataFundoSituacaoRequisicao">SITUAÇÃO</th>
                </tr>
            </thead>
        </table>
        <div id="toolbarRequisicoes">
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aRequisicoes')){ ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoRequisicao()">Novo</a>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'eRequisicoes')){ ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarRequisicao()">Editar</a>
            <?php } ?>
            <span class="button-sep"></span>
            <a href="#" class="easyui-menubutton" data-options="menu:'#menuAtividadesRequisicao',iconCls:'fa fa-cog fa-lg'">Atividades</a>
            <div id="menuAtividadesRequisicao" style="width:auto;">
                <div onclick="responderRequisicao()">Responder</div>
                <div onclick="encerrarRequisicao()">Encerrar</div>
                <div onclick="cancelarRequisicao()">Cancelar</div>
                <div class="menu-sep"></div>
                <div onclick="retomarRequisicao()">Retomar</div>
                <div onclick="associarRequisicao()">Associar</div>
                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'gerarMudancaRequisicoes')){ ?>
                <div class="menu-sep"></div>
                <div onclick="gerarMudancaRequisicao()">Gerar Mudança</div>
                <?php }?>
                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'gerarProblemaRequisicoes')){ ?>
                <div onclick="gerarProblemaRequisicao()">Gerar Problema</div>
                <?php } ?>
                <div class="menu-sep"></div>
                <div onclick="responderPesquisaRequisicao()"><i class="fa fa-bookmark-o fa-lg" style="color:#DBA901"></i> Pesquisa de Satisfação</div>
            </div>
            <span class="button-sep"></span>
            <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaRequisicoes" searcher='buscaRequisicao' style="width:40%">
            <div id='menuBuscaRequisicoes' style='width:auto'>
                <div name='cod_requisicao'>Cód. Requisição</div>
                <div name='assunto_req'>Assunto</div>
            </div>
        </div>
    </div>
    <div id="conteudoRequisicao" region="center" title="Informações Requisição">
        <?php if(isset($view)){ $this->load->view($view);} ?>
    </div>
</div>

<!-- MODAL NOVO/EDITAR -->
<div id="dlgRequisicao" class="easyui-dialog" style="width:620px;height:370px"
        closed="true" buttons="#dlgRequisicaoButtons" modal="true">
    <form id="formRequisicoes" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:97%;">
            <?php if($this->session->userdata('tipo') != 1){ ?>
            <tr>
                <td>
                    <input id="id_usuario_req" name="id_usuario_req" class="easyui-combobox" label="Usuário:" labelPosition="top"
                    panelHeight="200px" required="true" style="width:100%;" data-options="
                        valueField: 'id_usuario',
                        textField: 'usuario',
                        url: '<?php base_url();?>usuarios/listarCombo',
                        onSelect: function(rec){
                            $('#id_cliente_req').val(rec.id_cliente);
                            $('#nome_departamento_usu_req').textbox({value:rec.nome_departamento});
                        }"
                    >
                </td>
                <td>
                    <input type="hidden" id="id_cliente_req" name="id_cliente_req">
                    <input class="easyui-textbox" label="Departamento:" labelPosition="top" id="nome_departamento_usu_req" name="nome_departamento_usu_req" style="width:100%;" disabled="true">
                </td>
                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vDataHoraAbertura')) { ?>
                <td>
                    <input class="easyui-datetimebox" id="data_hora_req" name="data_hora_req" label="Data/Hora:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataCombo,parser:formatarDataComboParser" editable="false">
                </td>
                <?php } ?>
            </tr>
            <tr>
                <td colspan="3">
                    <input id="id_departamento_req" name="id_departamento_req" class="easyui-combobox" label="Abrir para:" labelPosition="top"
                        panelHeight="auto" required="true" style="width:100%;" data-options="
                        valueField: 'id_departamento',
                        textField: 'nome_departamento',
                        url: '<?php base_url();?>departamentos/listarComboPorUsuario',
                        onSelect: function(dpto){
                            $('#id_acordo_nivel_servico_req').combobox('clear');
                            var url = '<?php base_url();?>acordo_de_nivel_de_servico/listarComboPorDptoUsuario/'+dpto.id_departamento+'/'+document.getElementById('id_cliente_req').value;
                            $('#id_acordo_nivel_servico_req').combobox('reload', url);
                            $('#id_acordo_nivel_servico_req').combobox('enable', true);
                        }"
                    >
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input label="Serviço:" labelPosition="top" id="id_acordo_nivel_servico_req" name="id_acordo_nivel_servico_req" class="easyui-combobox" panelHeight="auto" required="true" style="width:100%;" data-options="valueField:'id_acordo_nivel_servico',textField:'tarefa'" disabled="true">
                </td>
            </tr>
            <?php } else { ?>
            <tr>
                <td colspan="3">
                    <input type="hidden" id="id_usuario_req" name="id_usuario_req"
                    value="">
                    <input id="id_departamento_req" name="id_departamento_req" class="easyui-combobox" label="Departamento:" labelPosition="top"
                        panelHeight="auto" required="true" style="width:100%;" data-options="
                        valueField: 'id_departamento',
                        textField: 'nome_departamento',
                        url: '<?php base_url();?>departamentos/listarComboPorUsuario',
                        onSelect: function(dpto){
                            $('#id_acordo_nivel_servico_req').combobox('clear');
                            var url = '<?php echo base_url();?>acordo_de_nivel_de_servico/listarComboPorDptoUsuarioLogado/'+dpto.id_departamento;
                            $('#id_acordo_nivel_servico_req').combobox('reload', url);
                            $('#id_acordo_nivel_servico_req').combobox('enable', true);
                        }"
                    >
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input label="Serviço:" labelPosition="top" id="id_acordo_nivel_servico_req" name="id_acordo_nivel_servico_req" class="easyui-combobox" panelHeight="auto" required="true" style="width:100%;" data-options="valueField:'id_acordo_nivel_servico',textField:'tarefa'" disabled="true">
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" label="Assunto:" labelPosition="top" id="assunto_req" name="assunto_req" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" id="requisicao_req" name="requisicao_req" label="Requisição:" labelPosition="top" style="width:100%;height:100%" multiline="true" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRequisicaoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRequisicao').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarRequisicao()" style="width:90px">Salvar</a>
</div>

<!-- MODAL RESPONDER -->
<div id="dlgRequisicaoResponder" class="easyui-dialog" style="width:520px;height:280px"
        closed="true" buttons="#dlgRequisicaoButtonsResponder" modal="true">
    <form id="formresponderRequisicao" class="easyui-form" method="post" data-options="novalidate:true">
        <input class="easyui-textbox" id="resposta" name="resposta" label="Resposta:" labelPosition="top" style="width:100%;height:200px" multiline="true" required="true">
    </form>
</div>
<div id="dlgRequisicaoButtonsResponder">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRequisicaoResponder').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarRequisicoesResposta()" style="width:90px">Salvar</a>
</div>

<!-- MODAL GERAR MUDANÇA -->
<div id="dlggerarMudancaRequisicao" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgRequisicaoButtonsgerarMudancaRequisicao" modal="true">
    <form id="formgerarMudancaRequisicao" class="easyui-form" method="post" data-options="novalidate:true">
        <input id="id_fluxo_mudanca" name="id_fluxo_mudanca" class="easyui-combobox" style="width:100%;" data-options="
            url:'<?php base_url();?>fluxo_de_mudancas/listarCombo',
            method:'get',
            valueField:'id_fluxo_mudanca',
            textField:'nome',
            panelHeight:'auto',
            label: 'Fluxo:',
            labelPosition: 'top'
        " required="true" editable="false">
    </form>
</div>
<div id="dlgRequisicaoButtonsgerarMudancaRequisicao">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlggerarMudancaRequisicao').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvargerarMudancaRequisicao()" style="width:90px">Salvar</a>
</div>

<!-- MODAL ASSOCIAR -->
<div id="dlgassociarRequisicao" class="easyui-dialog" style="width:20%;height:20%"
        closed="true" buttons="#dlgRequisicaoButtonsAssociar" modal="true">
    <form id="formAssociarRequisicao" class="easyui-form" method="post" data-options="novalidate:true">
        <input id="cod_requisicao_associado" name="cod_requisicao_associado" class="easyui-combobox" style="width:100%;" data-options="
            url:'<?php base_url();?>requisicoes/listarCombo',
            method:'get',
            valueField:'cod_requisicao',
            textField:'cod_requisicao',
            panelHeight:'auto',
            label: 'Informe o código da Requisição:',
            labelPosition: 'top'
        " required="true">
    </form>
</div>
<div id="dlgRequisicaoButtonsAssociar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgassociarRequisicao').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarassociarRequisicao()" style="width:90px">Salvar</a>
</div>

<!-- MODAL PESQUISA SATISFAÇÃO -->
<div id="dlgPesquisaSatisfacaoRequisicao" class="easyui-dialog" style="width:620px;height:420px"
        closed="true" buttons="#dlgPesquisaSatisfacaoRequisicaoButtons" modal="true">
    <form id="formPesquisaSatisfacaoRequisicao" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:97%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Assunto:" labelPosition="top" id="assunto" name="assunto" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="Elogio">Elogio</option>
                        <option value="Sugestao">Sugestão</option>
                        <option value="Critica">Crítica</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="O Tecnico entrou em contato dentro do prazo de 24H para retorno de posicionamento?" labelPosition="top" id="pergunta1" name="pergunta1" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="O Tecnico cumpriu o prazo estipulado para solução?" labelPosition="top" id="pergunta2" name="pergunta2" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Seu problema foi resolvido?" labelPosition="top" id="pergunta3" name="pergunta3" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Você aceita ou rejeita a solução do tecnico?" labelPosition="top" id="pergunta4" name="pergunta4" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Aceitar</option>
                        <option value="2">Rejeitar</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-textbox" id="observacoes" name="observacoes" label="Observações:" labelPosition="top" style="width:100%;height:100%" multiline="true" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgPesquisaSatisfacaoRequisicaoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgPesquisaSatisfacaoRequisicao').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarPesquisaSatisfacaoRequisicao()" style="width:90px">Salvar</a>
</div>

<div id="menuAtividadesBtDireitoRequisicao" style="width:auto;" class="easyui-menu">
    <div onclick="responderRequisicao()">Responder</div>
    <div onclick="encerrarRequisicao()">Encerrar</div>
    <div onclick="cancelarRequisicao()">Cancelar</div>
    <div class="menu-sep"></div>
    <div onclick="retomarRequisicao()">Retomar</div>
    <div onclick="associarRequisicao()">Associar</div>
    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'gerarMudancaRequisicoes')){ ?>
    <div class="menu-sep"></div>
    <div onclick="gerarMudancaRequisicao()">Gerar Mudança</div>
    <?php }?>
    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'gerarProblemaRequisicoes')){ ?>
    <div onclick="gerarProblemaRequisicao()">Gerar Problema</div>
    <?php } ?>
    <div class="menu-sep"></div>
    <div onclick="responderPesquisaRequisicao()"><i class="fa fa-bookmark-o fa-lg" style="color:#DBA901"></i> Pesquisa de Satisfação</div>
</div>

<script type="text/javascript">
var url;

function formataCodRequisicao(value, row){
    if(row.situacao_req == 3) {
        if(row.respondeu_pesq_req == 0) {
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

//BUSCA REQUISIÇÃO
function buscaRequisicao(value,name){
    if(name == 'cod_requisicao'){
        $('#dgRequisicoes').datagrid('load',{
            cod_requisicao: value
        });
    }else if(name == 'assunto_req'){
        $('#dgRequisicoes').datagrid('load',{
            assunto_req: value
        });
    }
}

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgRequisicoes').datagrid({
    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'eRequisicoes')){ ?>
        onDblClickRow: function(index,row){
            editarRequisicao();
        }
    <?php } ?>
});

//ABRE INFORMAÇÕES DE ACESSO COM 1 CLICK
$('#dgRequisicoes').datagrid({
    onClickRow: function(index,row){
        var row = $('#dgRequisicoes').datagrid('getSelected');
        $('#conteudoRequisicao').panel('refresh', '<?php base_url();?>requisicoes/historico_requisicao/'+row.cod_requisicao);
    }
});

//ABRE O MENU AO CLICAR COM O BOTÃO DIREITO NO DATAGRID
$('#dgRequisicoes').datagrid({
    singleSelect: true,
    onRowContextMenu: function(e,index,row){
        $(this).datagrid('selectRow',index);
        var row = $('#dgRequisicoes').datagrid('getSelected');
        $('#conteudoRequisicao').panel('refresh', '<?php base_url();?>requisicoes/historico_requisicao/'+row.cod_requisicao);
        e.preventDefault();
        $('#menuAtividadesBtDireitoRequisicao').menu('show', {
            left:e.pageX,
            top:e.pageY
        });
    }
});

// FORMATA SITUAÇÃO
function formataSituacaoRequisicao(value,row){
    var sit = row.situacao_req;

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
function formataFundoSituacaoRequisicao(value,row){
    var sit = row.situacao_req;

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
function novoRequisicao(){
    $('#dlgRequisicao').dialog('open').dialog('center').dialog('setTitle','Nova Requisição');
    $('#formRequisicoes').form('clear');
    $('#id_acordo_nivel_servico_req').combobox('disable', true);
    $('#id_usuario_req').val('<?php echo $this->session->userdata('id_usuario'); ?>');
    url = '<?php base_url();?>requisicoes/cadastrar';
}

// EDITAR
function editarRequisicao(){
    var row = $('#dgRequisicoes').datagrid('getSelected');
    if (row != null){
        $('#dlgRequisicao').dialog('open').dialog('center').dialog('setTitle','Editar Requisição');
        $('#formRequisicoes').form('load',row);
        url = '<?php base_url();?>requisicoes/atualizar/'+row.cod_requisicao;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// RESPONDER
function responderRequisicao(){
    var row = $('#dgRequisicoes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_req == 3 || row.situacao_req == 4){
            $.messager.alert('Atenção','Esta Requisição está cancelado/concluído!','warning');
        } else {
            $('#dlgRequisicaoResponder').dialog('open').dialog('center').dialog('setTitle','Responder Requisição');
            $('#formresponderRequisicao').form('clear');
            url = '<?php base_url();?>requisicoes/responder/'+row.cod_requisicao;
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// ENCERRAR
function encerrarRequisicao(){
    var row = $('#dgRequisicoes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_req == 3 || row.situacao_req == 4){
            $.messager.alert('Atenção','Esta Requisição está cancelado/concluído!','warning');
        } else {
            jQuery.messager.confirm('Atenção','Deseja encerrar esta Requisição?',function(r){
                if (r){
                    jQuery.post('<?php base_url();?>requisicoes/encerrar/'+row.cod_requisicao+'/'+row.cod_requisicao_associado_req,function(result){
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
                            $('#dgRequisicoes').datagrid('reload');
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
function cancelarRequisicao(){
    var row = $('#dgRequisicoes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_req == 3 || row.situacao_req == 4){
            $.messager.alert('Atenção','Esta Requisição está cancelado/concluído!','warning');
        } else {
            jQuery.messager.confirm('Atenção','Deseja cancelar esta Requisição?',function(r){
                if (r){
                    jQuery.post('<?php base_url();?>requisicoes/cancelar/'+row.cod_requisicao+'/'+row.cod_requisicao_associado_req,function(result){
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
                            $('#dgRequisicoes').datagrid('reload');
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
function retomarRequisicao(){
    var row = $('#dgRequisicoes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_req == 1 || row.situacao_req == 2){
            $.messager.alert('Atenção','Esta Requisição está aberto/em análise!','warning');
        } else {
            jQuery.messager.confirm('Atenção','Deseja retomar esta Requisição?',function(r){
                if (r){
                    jQuery.post('<?php base_url();?>requisicoes/retomar/'+row.cod_requisicao,function(result){
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
                            $('#dgRequisicoes').datagrid('reload');
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
function associarRequisicao(){
    var row = $('#dgRequisicoes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_req == 3 || row.situacao_req == 4){
            $.messager.alert('Atenção','Esta Requisição está cancelado/concluído!','warning');
        } else {
            if(row.cod_requisicao_associado_req == null){
                $('#dlgassociarRequisicao').dialog('open').dialog('center').dialog('setTitle','Associar Requisição');
                $('#formAssociarRequisicao').form('clear');
                url = '<?php base_url();?>requisicoes/associar/'+row.cod_requisicao;
            } else {
                $.messager.alert('Atenção','Esta Requisição já possui uma associação!','warning');
            }
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// GERAR MUDANÇA
function gerarMudancaRequisicao(){
    var row = $('#dgRequisicoes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_req == 3 || row.situacao_req == 4){
            $.messager.alert('Atenção','Esta Requisição está cancelado/concluído!','warning');
        } else {
            if(row.gerou_mudanca_req == 1) {
                $.messager.alert('Atenção','Já existe uma mudança associada para esta Requisição!','warning');
            } else {
                $('#dlggerarMudancaRequisicao').dialog('open').dialog('center').dialog('setTitle','Gerar Mudança');
                $('#formgerarMudancaRequisicao').form('clear');
                url = '<?php base_url();?>requisicoes/gerar_mudanca/'+row.cod_requisicao;
            }
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// GERAR PROBLEMA
function gerarProblemaRequisicao(){
    var row = $('#dgRequisicoes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_req == 3 || row.situacao_req == 4){
            $.messager.alert('Atenção','Esta Requisição está cancelado/concluído!','warning');
        } else {
            if(row.gerou_problema_req == 1) {
                $.messager.alert('Atenção','Já existe um problema associado para esta Requisição!','warning');
            } else {
                jQuery.messager.confirm('Atenção','Deseja gerar um problema a partir desta Requisição?',function(r){
                    if (r){
                        jQuery.post('<?php base_url();?>requisicoes/gerar_problema/'+row.cod_requisicao,function(result){
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
                                $('#dgRequisicoes').datagrid('reload');
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
function responderPesquisaRequisicao(){
    var row = $('#dgRequisicoes').datagrid('getSelected');

    if (row != null){
        if(row.situacao_req != 3){
            $.messager.alert('Atenção','Esta Requisição NÃO está concluído!','warning');
        } else {
            if(row.respondeu_pesq_req == 1) {
                $.messager.alert('Atenção','Pesquisa já respondida!','warning');
            } else {
                $('#dlgPesquisaSatisfacaoRequisicao').dialog('open').dialog('center').dialog('setTitle','Responder Pesquisa de Satisfação');
                $('#formPesquisaSatisfacaoRequisicao').form('clear');
                url = '<?php base_url();?>requisicoes/responder_pesquisa_satisfacao/'+row.cod_requisicao;
            }
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarRequisicao(){
    $('#formRequisicoes').form('submit',{
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
                $('#dlgRequisicao').dialog('close');
                $('#dgRequisicoes').datagrid('reload');
                $('#conteudoRequisicao').panel('refresh');
            }
        }
    });
}

// RESPONDER
function salvarRequisicoesResposta(){
    var row = $('#dgRequisicoes').datagrid('getSelected');
    $('#formresponderRequisicao').form('submit',{
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
                $('#dlgRequisicaoResponder').dialog('close');
                $('#dgRequisicoes').datagrid('reload');
                $('#conteudoRequisicao').panel('refresh');
                $('#dgRequisicoesRetorno').datagrid('reload');
            }
        }
    });
}

// ENCERRAR
function salvarRequisicoesEncerrar(){
    $('#formencerrarRequisicao').form('submit',{
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
                $('#dlgRequisicaoEncerrar').dialog('close');
                $('#dgRequisicoes').datagrid('reload');
            }
        }
    });
}

// CANCELAR
function salvarRequisicoesCancelar(){
    $('#formcancelarRequisicao').form('submit',{
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
                $('#dlgRequisicaoEncerrar').dialog('close');
                $('#dgRequisicoes').datagrid('reload');
            }
        }
    });
}

// SALVAR ASSOCIAR REQUISIÇÃO
function salvarassociarRequisicao(){
    $('#formAssociarRequisicao').form('submit',{
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
                $('#dlgassociarRequisicao').dialog('close');
                $('#dgRequisicoes').datagrid('reload');
            }
        }
    });
}

// SALVAR GERAR MUDANÇA
function salvargerarMudancaRequisicao(){
    $('#formgerarMudancaRequisicao').form('submit',{
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
                $('#dlggerarMudancaRequisicao').dialog('close');
                $('#dgRequisicoes').datagrid('reload');
            }
        }
    });
}

// SALVAR GERAR PROBLEMA
function salvargerarProblemaRequisicao(){
    $('#formgerarProblemaRequisicao').form('submit',{
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
                $('#dlggerarProblemaRequisicao').dialog('close');
                $('#dgRequisicoes').datagrid('reload');
            }
        }
    });
}

// SALVAR PESQUISA DE SATISFAÇÃO
function salvarPesquisaSatisfacaoRequisicao(){
    $('#formPesquisaSatisfacaoRequisicao').form('submit',{
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
                $('#dlgPesquisaSatisfacaoRequisicao').dialog('close');
                $('#dgRequisicoes').datagrid('reload');
            }
        }
    });
}

</script>