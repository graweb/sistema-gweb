<div class="easyui-layout" fit="true">
    <div data-options="region:'west',border:false" style="width:38%;">
        <div class="easyui-layout" fit="true">
            <div data-options="region:'north'" style="height:50%">
                <div class="easyui-tabs" data-options="tools:'#btAjudaTabMinhaDemandas'" style="width:100%;height:100%">
                    <div title="Incidentes">
                        <table id="dgIncidentesRetorno"
                                class="easyui-datagrid" 
                                fit="true"
                                url="<?php base_url();?>incidentes/listarAguardandoRetorno" 
                                fitColumns="true" 
                                toolbar="#toolbarIncidentesRetorno" 
                                singleSelect="true"
                                striped="true"
                                pagination="true"
                                rownumbers="true">
                            <thead>
                                <tr>
                                    <th data-options="field:'cod_inc',checkbox:true"></th>
                                    <th field="cod_incidente" width="20">CÓD</th>
                                    <th field="assunto_inc" width="80">ASSUNTO</th>
                                </tr>
                            </thead>
                        </table>

                        <div id="toolbarIncidentesRetorno">
                            <a href="#" class="easyui-menubutton" data-options="menu:'#menuAtividadesIncidenteRetorno',iconCls:'fa fa-cog fa-lg'">Atividades</a>
                            <div id="menuAtividadesIncidenteRetorno" style="width:auto;">
                                <div onclick="responderIncidenteRetorno()">Responder</div>
                                <div onclick="encerrarIncidenteRetorno()">Encerrar</div>
                                <div onclick="cancelarIncidenteRetorno()">Cancelar</div>
                            </div>
                        </div>
                    </div>
                    <div title="Requisições">
                        <table id="dgRequisicoesRetorno"
                                class="easyui-datagrid" 
                                fit="true"
                                url="<?php base_url();?>requisicoes/listarAguardandoRetorno" 
                                fitColumns="true" 
                                toolbar="#toolbarRequisicoesRetorno" 
                                singleSelect="true"
                                striped="true"
                                pagination="true"
                                rownumbers="true">
                            <thead>
                                <tr>
                                    <th data-options="field:'cod_req',checkbox:true"></th>
                                    <th field="cod_requisicao" width="20">CÓD</th>
                                    <th field="assunto_req" width="80">ASSUNTO</th>
                                </tr>
                            </thead>
                        </table>

                        <div id="toolbarRequisicoesRetorno">
                            <a href="#" class="easyui-menubutton" data-options="menu:'#menuAtividadesRequisicaoRetorno',iconCls:'fa fa-cog fa-lg'">Atividades</a>
                            <div id="menuAtividadesRequisicaoRetorno" style="width:auto;">
                                <div onclick="responderRequisicaoRetorno()">Responder</div>
                                <div onclick="encerrarRequisicaoRetorno()">Encerrar</div>
                                <div onclick="cancelarRequisicaoRetorno()">Cancelar</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="btAjudaTabMinhaDemandas">
                    <i class="fa fa-question fa-2x easyui-tooltip" title="Suas <b>Atividades.</b> Estão aguardando o seu retorno"></i>
                </div>
            </div>
            <div data-options="region:'south',border:false" style="height:50%">
                <div class="easyui-tabs" data-options="tools:'#btAjudaTabDemandasArea'" style="width:100%;height:100%">
                    <div title="Incidentes">
                        <table id="dgIncidentesRetornoArea"
                                class="easyui-datagrid" 
                                fit="true"
                                url="<?php base_url();?>incidentes/listarAguardandoRetornoArea" 
                                singleSelect="true"
                                fitColumns="true" 
                                striped="true"
                                pagination="true"
                                rownumbers="true">
                            <thead>
                                <tr>
                                    <th field="cod_incidente" width="20">CÓD</th>
                                    <th field="assunto_inc" width="80">ASSUNTO</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div title="Requisições">
                        <table id="dgRequisicoesRetornoArea"
                                class="easyui-datagrid" 
                                fit="true"
                                url="<?php base_url();?>requisicoes/listarAguardandoRetornoArea" 
                                singleSelect="true"
                                fitColumns="true" 
                                striped="true"
                                pagination="true"
                                rownumbers="true">
                            <thead>
                                <tr>
                                    <th field="cod_requisicao" width="20">CÓD</th>
                                    <th field="assunto_req" width="80">ASSUNTO</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div id="btAjudaTabDemandasArea">
                    <i class="fa fa-question fa-2x easyui-tooltip" title="<b>Atividades</b> da sua Área/Equipe"></i>
                </div>
            </div>
        </div>
    </div>
    <div data-options="region:'center',border:false"  style="width:63%;">
        <div class="easyui-tabs" data-options="tools:'#btAjudaTabGraficosPie'" style="width:100%;height:100%">
            <div title="Incidentes" style="padding:10px">
                <div id="grafIncidentes" style="width:100%;height:100%;"></div>
            </div>
            <div title="Requisições" style="padding:10px">
                <div id="grafRequisicoes" style="width:100%;height:100%;"></div>
            </div>
        </div>
        <div id="btAjudaTabGraficosPie">
            <i class="fa fa-question fa-2x easyui-tooltip" title="<b>Demandas</b> em forma de gráfico"></i>
        </div>
    </div>

    <!-- MODAL RESPONDER INCIDENTE -->
    <div id="dlgIncidentesResponderRetorno" class="easyui-dialog" style="width:520px;height:280px" 
            closed="true" buttons="#dlgIncidentesButtonsResponderRetorno" modal="true">
        <form id="formResponderIncidenteRetorno" class="easyui-form" method="post" data-options="novalidate:true">
            <input class="easyui-textbox" id="resposta_inc" name="resposta_inc" label="Resposta:" labelPosition="top" style="width:100%;height:200px" multiline="true" required="true">
        </form>
    </div>
    <div id="dlgIncidentesButtonsResponderRetorno">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgIncidentesResponderRetorno').dialog('close')" style="width:90px">Fechar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarIncidentesRespostaRetorno()" style="width:90px">Salvar</a>
    </div>

    <!-- MODAL RESPONDER REQUISIÇÃO -->
    <div id="dlgRequisicaoResponderRetorno" class="easyui-dialog" style="width:520px;height:280px" 
            closed="true" buttons="#dlgRequisicaoButtonsResponderRetorno" modal="true">
        <form id="formResponderRequisicaoRetorno" class="easyui-form" method="post" data-options="novalidate:true">
            <input class="easyui-textbox" id="resposta" name="resposta" label="Resposta:" labelPosition="top" style="width:100%;height:200px" multiline="true" required="true">
        </form>
    </div>
    <div id="dlgRequisicaoButtonsResponderRetorno">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRequisicaoResponderRetorno').dialog('close')" style="width:90px">Fechar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarRequisicoesRespostaRetorno()" style="width:90px">Salvar</a>
    </div>

    <!-- MENU QUE ABRE QUANDO CLICA COM O BT DIREITO NA GRADE RETORNO INCIDENTES -->
    <div id="menuAtividadesBtDireitoIncidenteRetorno" style="width:auto;" class="easyui-menu">
        <div onclick="responderIncidenteRetorno()">Responder</div>
        <div onclick="encerrarIncidenteRetorno()">Encerrar</div>
        <div onclick="cancelarIncidenteRetorno()">Cancelar</div>
    </div>

    <!-- MENU QUE ABRE QUANDO CLICA COM O BT DIREITO NA GRADE RETORNO REQUISIÇÕES -->
    <div id="menuAtividadesBtDireitoRequisicaoRetorno" style="width:auto;" class="easyui-menu">
        <div onclick="responderRequisicaoRetorno()">Responder</div>
        <div onclick="encerrarRequisicaoRetorno()">Encerrar</div>
        <div onclick="cancelarRequisicaoRetorno()">Cancelar</div>
    </div>
</div>

<!-- MODAL TEMA -->
<div id="dlgTema" class="easyui-dialog" style="width:230px;height:150px" 
        closed="true" buttons="#dlgTemaButtons" modal="true" title="Configurar tema">
    <form id="formTema" class="easyui-form" method="post" data-options="novalidate:true">
        <tr>
            <td>
                <select class="easyui-combobox" label="Escolha o tema:" labelPosition="top" id="tema" name="tema" panelHeight="auto" editable="false" required="true" style="width:100%;">
                    <option value='default'>Padrão</option>
                    <option value='black'>Escuro</option>
                    <option value='bootstrap'>Bootstrap</option>
                    <option value='gray'>Cinza</option>
                    <option value='material'>Material</option>
                    <option value='metro'>Metro</option>
                    <option value='metro-blue'>Metro-Azul</option>
                    <option value='metro-gray'>Metro-Cinza</option>
                    <option value='metro-green'>Metro-Verde</option>
                    <option value='metro-orange'>Metro-Laranja</option>
                    <option value='metro-red'>Metro-Vermelho</option>
                    <option value='ui-cupertino'>UI-Cupertino</option>
                    <option value='ui-dark-hive'>UI-Escuro forte</option>
                    <option value='ui-pepper-grinder'>UI-Pimenta</option>
                    <option value='ui-sunny'>UI-Sol</option>
                </select>
            </td>
        </tr>
    </form>
</div>
<div id="dlgTemaButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgTema').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarTema()" style="width:90px">Salvar</a>
</div>

<!-- MODAL MUDAR SENHA -->
<?php 
    if($this->session->userdata('mudar_senha') == 1) { ?>
    <div id="dlgDefinirSenhaUsuario" class="easyui-dialog" style="width:250px;padding:10px 20px;"
        buttons="#dlgUsuarioButtonsSenhaDefinir" modal="true" title="Definir senha">
        <form id="formDefinirSenhaUsuario" class="easyui-form" method="post" data-options="novalidate:true">
            <input class="easyui-textbox" type="password" data-options="prompt:'Senha',iconCls:'icon-lock',iconWidth:38" label="Senha:" labelPosition="top" id="senha_definir" name="senha_definir" style="width:100%;" required="true">
            <input class="easyui-textbox" type="password" data-options="prompt:'Senha',iconCls:'icon-lock',iconWidth:38" label="Confirmar senha:" labelPosition="top" id="senha_definir_confirma" name="senha_definir_confirma" style="width:100%;" required="true">
        </form>
    </div>
    <div id="dlgUsuarioButtonsSenhaDefinir">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgDefinirSenhaUsuario').dialog('close')" style="width:90px">Fechar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarDefinirSenhaUsuario()" style="width:90px">Salvar</a>
    </div>
<?php } ?>
<div id="dlgDefinirSenhaUsuario" class="easyui-dialog" style="width:250px;padding:10px 20px;"
        closed="true" buttons="#dlgUsuarioButtonsSenhaDefinir" modal="true">
    <form id="formDefinirSenhaUsuario" class="easyui-form" method="post" data-options="novalidate:true">
        <input class="easyui-textbox" type="password" data-options="prompt:'Senha',iconCls:'icon-lock',iconWidth:38" label="Senha:" labelPosition="top" id="senha_definir" name="senha_definir" style="width:100%;" required="true">
        <input class="easyui-textbox" type="password" data-options="prompt:'Senha',iconCls:'icon-lock',iconWidth:38" label="Confirmar senha:" labelPosition="top" id="senha_definir_confirma" name="senha_definir_confirma" style="width:100%;" required="true">
    </form>
</div>
<div id="dlgUsuarioButtonsSenhaDefinir">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgDefinirSenhaUsuario').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarDefinirSenhaUsuario()" style="width:90px">Salvar</a>
</div>

<?php
    // FAZ O SELECT FILTRANDO PELO ID DA PERMISSÃO E VERIFICA SE A OPÇÃO PARA ABRIR CHAMADOS
    // ESTÁ MARCADA
    $this->db->where('id_permissao', $this->session->userdata('permissao'));
    $permi = $this->db->get('tb_permissoes')->row();

    $permissoes = unserialize($permi->permissoes);

    if($permissoes['vCadastroIncReq'] == '1') {
        $abrirDlg = "false";
    } else {
        $abrirDlg = "true";
    }
?>

<!-- MODAL CADASTRAR DEMANDA -->
<div id="dlgAbrirDemandaInicio" class="easyui-dialog" style="width:620px;height:auto" 
    buttons="#dlgAbrirDemandaInicioBts" modal="true" title="Abrir demanda" closed="<?php echo $abrirDlg;?>">
    <form id="formDemandaInicio" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td colspan="3">
                    <select class="easyui-combobox" label="Tipo de demanda:" labelPosition="top" id="tipo_demanda" name="tipo_demanda" panelHeight="auto" editable="false" required="true" style="width:97%;">
                        <option value="1">Incidente</option>
                        <option value="2">Requisição</option>
                    </select>
                    <i class="fa fa-question fa-2x easyui-tooltip" title="<b>Incidente:</b> - quando alguma tarefa dá problema <p></p> <b>Requisição:</b> - solicitação de uma <b>nova</b> tarefa"></i>
                </td>
            </tr>
            <?php if($this->session->userdata('tipo') != 1){ ?>
            <tr>
                <td>
                    <input id="id_usuario_inicio" name="id_usuario_inicio" class="easyui-combobox" label="Usuário:" labelPosition="top" 
                    panelHeight="200px" required="true" style="width:100%;" data-options="
                        valueField: 'id_usuario',
                        textField: 'usuario',
                        url: '<?php base_url();?>usuarios/listarCombo',
                        onSelect: function(rec){
                            $('#id_cliente_inicio').val(rec.id_cliente);
                            $('#nome_departamento_usu_inicio').textbox({value:rec.nome_departamento});
                        }"
                    >
                </td>
                <td>
                    <input type="hidden" id="id_cliente_inicio" name="id_cliente_inicio">
                    <input class="easyui-textbox" label="Departamento Usuário:" labelPosition="top" id="nome_departamento_usu_inicio" name="nome_departamento_usu_inicio" style="width:100%;" disabled="true">
                </td>
                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vDataHoraAbertura')) { ?>
                <td>
                    <input class="easyui-datetimebox" id="data_hora_inicio" name="data_hora_inicio" label="Data/Hora:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataCombo,parser:formatarDataComboParser" editable="false">
                </td>
                <?php }?>
            </tr>
            <tr>
                <td colspan="3">
                    <input id="id_departamento_inicio" name="id_departamento_inicio" class="easyui-combobox" label="Abrir para:" labelPosition="top" 
                        panelHeight="auto" required="true" style="width:100%;" data-options="
                        valueField: 'id_departamento',
                        textField: 'nome_departamento',
                        url: '<?php base_url();?>departamentos/listarComboPorUsuario',
                        onSelect: function(dpto){
                            $('#id_acordo_nivel_servico_inicio').combobox('clear');
                            var url = '<?php base_url();?>acordo_de_nivel_de_servico/listarComboPorDptoUsuario/'+dpto.id_departamento+'/'+document.getElementById('id_cliente_inicio').value;
                            $('#id_acordo_nivel_servico_inicio').combobox('reload', url);
                            $('#id_acordo_nivel_servico_inicio').combobox('enable', true);
                        }"
                    >
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input label="Serviço:" labelPosition="top" id="id_acordo_nivel_servico_inicio" name="id_acordo_nivel_servico_inicio" class="easyui-combobox" panelHeight="200px" required="true" style="width:100%;" data-options="valueField:'id_acordo_nivel_servico',textField:'tarefa'" disabled="true">
                </td>
            </tr>
            <?php } else { ?>
            <tr>
                <td colspan="3">
                    <input type="hidden" id="id_usuario_inicio" name="id_usuario_inicio" 
                    value="<?php echo $this->session->userdata('id_usuario');?>">
                    <input id="id_departamento_inicio" name="id_departamento_inicio" class="easyui-combobox" label="Abrir para:" labelPosition="top" 
                        panelHeight="auto" required="true" style="width:100%;" data-options="
                        valueField: 'id_departamento',
                        textField: 'nome_departamento',
                        url: '<?php base_url();?>departamentos/listarComboPorUsuario',
                        onSelect: function(dpto){
                            $('#id_acordo_nivel_servico_inicio').combobox('clear');
                            var url = '<?php base_url();?>acordo_de_nivel_de_servico/listarComboPorDptoUsuario/'+dpto.id_departamento+'/'+<?php echo $this->session->userdata('id_cliente');?>;
                            $('#id_acordo_nivel_servico_inicio').combobox('reload', url);
                            $('#id_acordo_nivel_servico_inicio').combobox('enable', true);
                        }"
                    >
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input label="Serviço:" labelPosition="top" id="id_acordo_nivel_servico_inicio" name="id_acordo_nivel_servico_inicio" class="easyui-combobox" panelHeight="200px" required="true" style="width:100%;" data-options="valueField:'id_acordo_nivel_servico',textField:'tarefa'" disabled="true">
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" label="Assunto:" labelPosition="top" id="assunto_inicio" name="assunto_inicio" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input class="easyui-textbox" id="descricao_inicio" name="descricao_inicio" label="Descrição:" labelPosition="top" style="width:100%;height:100%" multiline="true" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgAbrirDemandaInicioBts">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgAbrirDemandaInicio').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarDemandaInicio()" style="width:90px">Salvar</a>
</div>

<!-- MODAL CONFIGURAÇÕES GWEB -->
<div id="dlgConfigGweb" class="easyui-dialog" style="width:250px;height:180px" 
        closed="true" buttons="#dlgConfigGwebButtons" modal="true" title="Configurações Gweb">
    <form id="formConfigGweb" class="easyui-form" method="post" data-options="novalidate:true">
        <tr>
            <td>
                <input class="easyui-datetimebox" id="data_gweb_de" name="data_gweb_de" label="Data/Hora a partir de:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataCombo,parser:formatarDataComboParser" editable="false">
            </td>
        </tr>
        <tr>
            <td>
                <input class="easyui-datetimebox" id="data_gweb_ate" name="data_gweb_ate" label="Data/Hora a partir até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataCombo,parser:formatarDataComboParser" editable="false">
            </td>
        </tr>
    </form>
</div>
<div id="dlgConfigGwebButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgConfigGweb').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="atualizarConfigGweb()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">

//ABRE O MENU AO CLICAR COM O BOTÃO DIREITO NO DATAGRID RETORNO INCIDENTES
$('#dgIncidentesRetorno').datagrid({
    singleSelect: true,
    onRowContextMenu: function(e,index,row)
    {
        $(this).datagrid('selectRow',index);
        var row = $('#dgIncidentesRetorno').datagrid('getSelected');
        e.preventDefault();
        $('#menuAtividadesBtDireitoIncidenteRetorno').menu('show', {
            left:e.pageX,
            top:e.pageY
        });
    }
});

//ABRE O MENU AO CLICAR COM O BOTÃO DIREITO NO DATAGRID RETORNO REQUISIÇÕES
$('#dgRequisicoesRetorno').datagrid({
    singleSelect: true,
    onRowContextMenu: function(e,index,row)
    {
        $(this).datagrid('selectRow',index);
        var row = $('#dgIncidentesRetorno').datagrid('getSelected');
        e.preventDefault();
        $('#menuAtividadesBtDireitoRequisicaoRetorno').menu('show', {
            left:e.pageX,
            top:e.pageY
        });
    }
});

// RESPONDER RETORNO INCIDENTE
function responderIncidenteRetorno()
{
    var row = $('#dgIncidentesRetorno').datagrid('getSelected');
    
    if (row != null){
        if(row.situacao_inc == 3 || row.situacao_inc == 4){
            $.messager.alert('Atenção','Este Incidente está cancelado/concluído!','warning');
        } else {
            $('#dlgIncidentesResponderRetorno').dialog('open').dialog('center').dialog('setTitle','Responder Incidente');
            $('#formResponderIncidenteRetorno').form('clear');
            url = '<?php base_url();?>incidentes/responder/'+row.cod_incidente;
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR RESPONDER RETORNO INCIDENTE
function salvarIncidentesRespostaRetorno()
{
    var row = $('#dgIncidentesRetorno').datagrid('getSelected');
    $('#formResponderIncidenteRetorno').form('submit',{
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
                $('#dlgIncidentesResponderRetorno').dialog('close');
                $('#dgIncidentes').datagrid('reload');
                $('#conteudoIncidente').panel('refresh');
                $('#dgIncidentesRetorno').datagrid('reload');
                $('#dgIncidentesRetornoArea').datagrid('reload');
            }
        }
    });
}

// ENCERRAR INCIDENTE
function encerrarIncidenteRetorno()
{
    var row = $('#dgIncidentesRetorno').datagrid('getSelected');
    
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
                            $('#conteudoIncidente').panel('refresh');
                            $('#dgIncidentesRetorno').datagrid('reload');
                            $('#dgIncidentesRetornoArea').datagrid('reload');
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

// CANCELAR INCIDENTE
function cancelarIncidenteRetorno()
{
    var row = $('#dgIncidentesRetorno').datagrid('getSelected');
    
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
                            $('#conteudoIncidente').panel('refresh');
                            $('#dgIncidentesRetorno').datagrid('reload');
                            $('#dgIncidentesRetornoArea').datagrid('reload');
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

// RESPONDER RETORNO
function responderRequisicaoRetorno()
{
    var row = $('#dgRequisicoesRetorno').datagrid('getSelected');
    
    if (row != null){
        if(row.situacao_req == 3 || row.situacao_req == 4){
            $.messager.alert('Atenção','Esta Requisição está cancelado/concluído!','warning');
        } else {
            $('#dlgRequisicaoResponderRetorno').dialog('open').dialog('center').dialog('setTitle','Responder Requisição');
            $('#formResponderRequisicaoRetorno').form('clear');
            url = '<?php base_url();?>requisicoes/responder/'+row.cod_requisicao;
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR RESPONDER REQUISIÇÃO
function salvarRequisicoesRespostaRetorno()
{
    var row = $('#dgRequisicoesRetorno').datagrid('getSelected');
    $('#formResponderRequisicaoRetorno').form('submit',{
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
                $('#dlgRequisicaoResponderRetorno').dialog('close');
                $('#dgRequisicoes').datagrid('reload');
                $('#conteudoRequisicao').panel('refresh');
                $('#dgRequisicoesRetorno').datagrid('reload');
                $('#dgRequisicoesRetornoArea').datagrid('reload');
            }
        }
    });
}

// ENCERRAR REQUISIÇÃO
function encerrarRequisicaoRetorno()
{
    var row = $('#dgRequisicoesRetorno').datagrid('getSelected');
    
    if (row != null){
        if(row.situacao_req == 3 || row.situacao_req == 4){
            $.messager.alert('Atenção','Esta Requisição está cancelada/concluída!','warning');
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
                            $('#conteudoRequisicao').panel('refresh');
                            $('#dgRequisicoesRetorno').datagrid('reload');
                            $('#dgRequisicoesRetornoArea').datagrid('reload');
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

// CANCELAR REQUISIÇÃO
function cancelarRequisicaoRetorno()
{
    var row = $('#dgRequisicoesRetorno').datagrid('getSelected');
    
    if (row != null){
        if(row.situacao_req == 3 || row.situacao_req == 4){
            $.messager.alert('Atenção','Esta Requisição está cancelada/concluída!','warning');
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
                            $('#conteudoRequisicao').panel('refresh');
                            $('#dgRequisicoesRetorno').datagrid('reload');
                            $('#dgRequisicoesRetornoArea').datagrid('reload');
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

//GERA OS DADOS DOS GRÁFICOS
var graficoSerialInc = AmCharts.makeChart("grafIncidentes", {
    "type": "serial",
    "theme": "light",
    "marginRight": 70,
    "language": "pt",
    "dataProvider": [ 
    {
        "status": "Aberto",
        "value": <?php echo $contarIncAberto; ?>,
        "color": "#F78181"
    },
    {
        "status": "Em análise",
        "value": <?php echo $contarIncEmAnalise; ?>,
        "color": "#A9D0F5"
    },
    {
        "status": "Concluído",
        "value": <?php echo $contarIncConcluido; ?>,
        "color": "#CEF6CE"
    },
    {
        "status": "Cancelado",
        "value": <?php echo $contarIncCancelado; ?>,
        "color": "#F3E2A9"
    }
    ],
    "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": "Incidentes"
    }],
        "startDuration": 1,
        "graphs": [{
        "balloonText": "[[category]]<br><span style='font-size:14px'><b>[[value]]</b></span>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "value"
    }],
        "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
        "categoryField": "status",
        "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
    },

    "export": {
        "enabled": true
    }
});

var graficoSerialReq = AmCharts.makeChart("grafRequisicoes", {
    "type": "serial",
    "theme": "light",
    "marginRight": 70,
    "language": "pt",
    "dataProvider": [ 
    {
        "status": "Aberto",
        "value": <?php echo $contarReqAberto; ?>,
        "color": "#F78181"
    },
    {
        "status": "Em análise",
        "value": <?php echo $contarReqEmAnalise; ?>,
        "color": "#A9D0F5"
    },
    {
        "status": "Concluído",
        "value": <?php echo $contarReqConcluido; ?>,
        "color": "#CEF6CE"
    },
    {
        "status": "Cancelado",
        "value": <?php echo $contarReqCancelado; ?>,
        "color": "#F3E2A9"
    }
    ],
    "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": "Requisições"
    }],
        "startDuration": 1,
        "graphs": [{
        "balloonText": "[[category]]<br><span style='font-size:14px'><b>[[value]]</b></span>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "value"
    }],
        "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
        "categoryField": "status",
        "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
    },

    "export": {
        "enabled": true
    }
});
</script>