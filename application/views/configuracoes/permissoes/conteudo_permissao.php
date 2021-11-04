<?php $permissoes = unserialize($dados->permissoes); ?>

<form id="formAcessosConcedidos" method="post">

<div style="padding: 10px">
	<a href="javascript:void(0)" class="easyui-linkbutton c1" size="large" iconCls="icon-ok" onclick="salvarAcessos()"> Salvar Alterações </a>
	<input type="checkbox" id="marcar_todos" name="marcar_todos" class="marcar" onclick="marcarTodos()">Marcar todos?
</div>

<div class="easyui-tabs" width="100%" height="100%">
	<input type="hidden" id="id_permissao" name="id_permissao" value="<?php echo $dados->id_permissao;?>">
    <div title="Estatísticas">
        <table id="dgEstatisticas">
            <thead>
                <tr>
                    <th field="visualizar" width="25%" align="left">Visualizar</th>
                    <th field="visualizarb" width="25%" align="left"></th>
                    <th field="visualizarc" width="25%" align="left"></th>
                    <th field="visualizard" width="25%" align="left"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="checkbox" class="marcar" id="vCadastroIncReq" name="vCadastroIncReq" <?php if(isset($permissoes['vCadastroIncReq'])){ if($permissoes['vCadastroIncReq'] == '1'){echo 'checked';}}?> value="1">Cadastro na abertura
                    </td>
                    <td><input type="checkbox" class="marcar" id="vGraficoDemandasArea" name="vGraficoDemandasArea" <?php if(isset($permissoes['vGraficoDemandasArea'])){ if($permissoes['vGraficoDemandasArea'] == '1'){echo 'checked';}}?> value="1">Gráfico demandas da área</td>
                    <td><input type="checkbox" class="marcar" id="vGraficoAguardandoRetorno" name="vGraficoAguardandoRetorno" <?php if(isset($permissoes['vGraficoAguardandoRetorno'])){ if($permissoes['vGraficoAguardandoRetorno'] == '1'){echo 'checked';}}?> value="1">Tabela retorno</td>
                    <td><input type="checkbox" class="marcar" id="vGraficoDemandasPizza" name="vGraficoDemandasPizza" <?php if(isset($permissoes['vGraficoDemandasPizza'])){ if($permissoes['vGraficoDemandasPizza'] == '1'){echo 'checked';}}?> value="1">Gráfico demandas pizza</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div title="Demandas">
        <table id="dgDemandas">
            <thead>
                <tr>
                    <th field="menu" width="20%" align="left"></th>
                    <th field="visualizar" width="12%" align="left">Visualizar</th>
                    <th field="cadastrar" width="12%" align="left">Cadastrar</th>
                    <th field="editar" width="12%" align="left">Editar</th>
                    <th field="desativar_excluir" width="12%" align="left">Desativar/Excluir</th>
                    <th field="gerar_mudanca" width="12%" align="left">Gerar Mudança</th>
                    <th field="gerar_problema" width="12%" align="left">Gerar Problema</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Incidentes</td>
                    <td><input type="checkbox" class="marcar" id="vIncidentes" name="vIncidentes" <?php if(isset($permissoes['vIncidentes'])){ if($permissoes['vIncidentes'] == '1'){echo 'checked';}}?> value="1"></td>
                    <td><input type="checkbox" class="marcar" id="aIncidentes" name="aIncidentes" <?php if(isset($permissoes['aIncidentes'])){ if($permissoes['aIncidentes'] == '1'){echo 'checked';}}?> value="1"></td>
                    <td><input type="checkbox" class="marcar" id="eIncidentes" name="eIncidentes" <?php if(isset($permissoes['eIncidentes'])){ if($permissoes['eIncidentes'] == '1'){echo 'checked';}}?> value="1"></td>
                    <td><input type="checkbox" class="marcar" id="dIncidentes" name="dIncidentes" <?php if(isset($permissoes['dIncidentes'])){ if($permissoes['dIncidentes'] == '1'){echo 'checked';}}?> value="1"></td>
                    <td><input type="checkbox" class="marcar" id="gerarMudancaIncidentes" name="gerarMudancaIncidentes" <?php if(isset($permissoes['gerarMudancaIncidentes'])){ if($permissoes['gerarMudancaIncidentes'] == '1'){echo 'checked';}}?> value="1"></td>
                    <td><input type="checkbox" class="marcar" id="gerarProblemaIncidentes" name="gerarProblemaIncidentes" <?php if(isset($permissoes['gerarProblemaIncidentes'])){ if($permissoes['gerarProblemaIncidentes'] == '1'){echo 'checked';}}?> value="1"></td>
                </tr>
                <tr>
                    <td>Requisições</td>
                    <td><input type="checkbox" class="marcar" id="vRequisicoes" name="vRequisicoes" value="1" <?php if(isset($permissoes['vRequisicoes'])){ if($permissoes['vRequisicoes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aRequisicoes" name="aRequisicoes" value="1" <?php if(isset($permissoes['aRequisicoes'])){ if($permissoes['aRequisicoes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eRequisicoes" name="eRequisicoes" value="1" <?php if(isset($permissoes['eRequisicoes'])){ if($permissoes['eRequisicoes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dRequisicoes" name="dRequisicoes" value="1" <?php if(isset($permissoes['dRequisicoes'])){ if($permissoes['dRequisicoes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="gerarMudancaRequisicoes" name="gerarMudancaRequisicoes" <?php if(isset($permissoes['gerarMudancaRequisicoes'])){ if($permissoes['gerarMudancaRequisicoes'] == '1'){echo 'checked';}}?> value="1"></td>
                    <td><input type="checkbox" class="marcar" id="gerarProblemaRequisicoes" name="gerarProblemaRequisicoes" <?php if(isset($permissoes['gerarProblemaRequisicoes'])){ if($permissoes['gerarProblemaRequisicoes'] == '1'){echo 'checked';}}?> value="1"></td>
                </tr>
                <tr>
                    <td>Mudanças</td>
                    <td><input type="checkbox" class="marcar" id="vMudancas" name="vMudancas" value="1" <?php if(isset($permissoes['vMudancas'])){ if($permissoes['vMudancas'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aMudancas" name="aMudancas" value="1" <?php if(isset($permissoes['aMudancas'])){ if($permissoes['aMudancas'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eMudancas" name="eMudancas" value="1" <?php if(isset($permissoes['eMudancas'])){ if($permissoes['eMudancas'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dMudancas" name="dMudancas" value="1" <?php if(isset($permissoes['dMudancas'])){ if($permissoes['dMudancas'] == '1'){echo 'checked';}}?>></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Problemas</td>
                    <td><input type="checkbox" class="marcar" id="vProblemas" name="vProblemas" value="1" <?php if(isset($permissoes['vProblemas'])){ if($permissoes['vProblemas'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aProblemas" name="aProblemas" value="1" <?php if(isset($permissoes['aProblemas'])){ if($permissoes['aProblemas'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eProblemas" name="eProblemas" value="1" <?php if(isset($permissoes['eProblemas'])){ if($permissoes['eProblemas'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dProblemas" name="dProblemas" value="1" <?php if(isset($permissoes['dProblemas'])){ if($permissoes['dProblemas'] == '1'){echo 'checked';}}?>></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Data e Hora Abertura</td>
                    <td><input type="checkbox" class="marcar" id="vDataHoraAbertura" name="vDataHoraAbertura" value="1" <?php if(isset($permissoes['vDataHoraAbertura'])){ if($permissoes['vDataHoraAbertura'] == '1'){echo 'checked';}}?>></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Data e Hora Fechamento</td>
                    <td><input type="checkbox" class="marcar" id="vDataHoraFechamento" name="vDataHoraFechamento" value="1" <?php if(isset($permissoes['vDataHoraFechamento'])){ if($permissoes['vDataHoraFechamento'] == '1'){echo 'checked';}}?>></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div title="Governança">
        <table id="dgGovernanca">
            <thead>
                <tr>
                    <th field="menu" width="21%" align="left"></th>
                    <th field="visualizar" width="21%" align="left">Visualizar</th>
                    <th field="cadastrar" width="21%" align="left">Cadastrar</th>
                    <th field="editar" width="21%" align="left">Editar</th>
                    <th field="desativar_excluir" width="21%" align="left">Desativar/Excluir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>COBIT</td>
                    <td><input type="checkbox" class="marcar" id="vCobit" name="vCobit" value="1" <?php if(isset($permissoes['vCobit'])){ if($permissoes['vCobit'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aCobit" name="aCobit" value="1" <?php if(isset($permissoes['aCobit'])){ if($permissoes['aCobit'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eCobit" name="eCobit" value="1" <?php if(isset($permissoes['eCobit'])){ if($permissoes['eCobit'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dCobit" name="dCobit" value="1" <?php if(isset($permissoes['dCobit'])){ if($permissoes['dCobit'] == '1'){echo 'checked';}}?>></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div title="Inventário">
        <table id="dgInventario">
            <thead>
                <tr>
                    <th field="menu" width="21%" align="left"></th>
                    <th field="visualizar" width="21%" align="left">Visualizar</th>
                    <th field="cadastrar" width="21%" align="left">Cadastrar</th>
                    <th field="editar" width="21%" align="left">Editar</th>
                    <th field="desativar_excluir" width="21%" align="left">Desativar/Excluir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Hardware</td>
                    <td><input type="checkbox" class="marcar" id="vHardware" name="vHardware" value="1" <?php if(isset($permissoes['vHardware'])){ if($permissoes['vHardware'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aHardware" name="aHardware" value="1" <?php if(isset($permissoes['aHardware'])){ if($permissoes['aHardware'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eHardware" name="eHardware" value="1" <?php if(isset($permissoes['eHardware'])){ if($permissoes['eHardware'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dHardware" name="dHardware" value="1" <?php if(isset($permissoes['dHardware'])){ if($permissoes['dHardware'] == '1'){echo 'checked';}}?>></td>
                </tr>
                <tr>
                    <td>Software</td>
                    <td><input type="checkbox" class="marcar" id="vSoftware" name="vSoftware" value="1" <?php if(isset($permissoes['vSoftware'])){ if($permissoes['vSoftware'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aSoftware" name="aSoftware" value="1" <?php if(isset($permissoes['aSoftware'])){ if($permissoes['aSoftware'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eSoftware" name="eSoftware" value="1" <?php if(isset($permissoes['eSoftware'])){ if($permissoes['eSoftware'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dSoftware" name="dSoftware" value="1" <?php if(isset($permissoes['dSoftware'])){ if($permissoes['dSoftware'] == '1'){echo 'checked';}}?>></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div title="Relatórios">
        <table id="dgRelatorios">
            <thead>
                <tr>
                    <th field="visualizar" width="25%" align="left">Visualizar</th>
                    <th field="visualizarb" width="25%" align="left"></th>
                    <th field="visualizarc" width="25%" align="left"></th>
                    <th field="visualizard" width="25%" align="left"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" class="marcar" id="vRelatorioDemandas" name="vRelatorioDemandas" value="1" <?php if(isset($permissoes['vRelatorioDemandas'])){ if($permissoes['vRelatorioDemandas'] == '1'){echo 'checked';}}?>>Demandas</td>
                    <td><input type="checkbox" class="marcar" id="vRelatorioGraficos" name="vRelatorioGraficos" value="1" <?php if(isset($permissoes['vRelatorioGraficos'])){ if($permissoes['vRelatorioGraficos'] == '1'){echo 'checked';}}?>>Gráficos</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div title="Configurações">
        <table id="dgConfiguracoes">
            <thead>
                <tr>
                    <th field="menu" width="21%" align="left"></th>
                    <th field="visualizar" width="21%" align="left">Visualizar</th>
                    <th field="cadastrar" width="21%" align="left">Cadastrar</th>
                    <th field="editar" width="21%" align="left">Editar</th>
                    <th field="desativar_excluir" width="21%" align="left">Desativar/Excluir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Emitente</td>
                    <td><input type="checkbox" class="marcar" id="vConfigEmitente" name="vConfigEmitente" value="1" <?php if(isset($permissoes['vConfigEmitente'])){ if($permissoes['vConfigEmitente'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigEmitente" name="aConfigEmitente" value="1" <?php if(isset($permissoes['aConfigEmitente'])){ if($permissoes['aConfigEmitente'] == '1'){echo 'checked';}}?>></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Clientes</td>
                    <td><input type="checkbox" class="marcar" id="vConfigClientes" name="vConfigClientes" value="1" <?php if(isset($permissoes['vConfigClientes'])){ if($permissoes['vConfigClientes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigClientes" name="aConfigClientes" value="1" <?php if(isset($permissoes['aConfigClientes'])){ if($permissoes['aConfigClientes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eConfigClientes" name="eConfigClientes" value="1" <?php if(isset($permissoes['eConfigClientes'])){ if($permissoes['eConfigClientes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dConfigClientes" name="dConfigClientes" value="1" <?php if(isset($permissoes['dConfigClientes'])){ if($permissoes['dConfigClientes'] == '1'){echo 'checked';}}?>></td>
                </tr>
                <tr>
                    <td>Nível de Atendimento</td>
                    <td><input type="checkbox" class="marcar" id="vConfigNivelAtendimento" name="vConfigNivelAtendimento" value="1" <?php if(isset($permissoes['vConfigNivelAtendimento'])){ if($permissoes['vConfigNivelAtendimento'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigNivelAtendimento" name="aConfigNivelAtendimento" value="1" <?php if(isset($permissoes['aConfigNivelAtendimento'])){ if($permissoes['aConfigNivelAtendimento'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eConfigNivelAtendimento" name="eConfigNivelAtendimento" value="1" <?php if(isset($permissoes['eConfigNivelAtendimento'])){ if($permissoes['eConfigNivelAtendimento'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dConfigNivelAtendimento" name="dConfigNivelAtendimento" value="1" <?php if(isset($permissoes['eConfigNivelAtendimento'])){ if($permissoes['eConfigNivelAtendimento'] == '1'){echo 'checked';}}?>></td>
                </tr>
                <tr>
                    <td>Acordo de Nível de Serviço</td>
                    <td><input type="checkbox" class="marcar" id="vConfigAcordoNivelServico" name="vConfigAcordoNivelServico" value="1" <?php if(isset($permissoes['vConfigAcordoNivelServico'])){ if($permissoes['vConfigAcordoNivelServico'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigAcordoNivelServico" name="aConfigAcordoNivelServico" value="1" <?php if(isset($permissoes['aConfigAcordoNivelServico'])){ if($permissoes['aConfigAcordoNivelServico'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eConfigAcordoNivelServico" name="eConfigAcordoNivelServico" value="1" <?php if(isset($permissoes['eConfigAcordoNivelServico'])){ if($permissoes['eConfigAcordoNivelServico'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dConfigAcordoNivelServico" name="dConfigAcordoNivelServico" value="1" <?php if(isset($permissoes['dConfigAcordoNivelServico'])){ if($permissoes['dConfigAcordoNivelServico'] == '1'){echo 'checked';}}?>></td>
                </tr>
                <tr>
                    <td>Fluxo de Mudanças</td>
                    <td><input type="checkbox" class="marcar" id="vConfigFluxoMudancas" name="vConfigFluxoMudancas" value="1" <?php if(isset($permissoes['vConfigFluxoMudancas'])){ if($permissoes['vConfigFluxoMudancas'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigFluxoMudancas" name="aConfigFluxoMudancas" value="1" <?php if(isset($permissoes['aConfigFluxoMudancas'])){ if($permissoes['aConfigFluxoMudancas'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eConfigFluxoMudancas" name="eConfigFluxoMudancas" value="1" <?php if(isset($permissoes['eConfigFluxoMudancas'])){ if($permissoes['eConfigFluxoMudancas'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dConfigFluxoMudancas" name="dConfigFluxoMudancas" value="1" <?php if(isset($permissoes['dConfigFluxoMudancas'])){ if($permissoes['dConfigFluxoMudancas'] == '1'){echo 'checked';}}?>></td>
                </tr>
                <tr>
                    <td>Departamentos</td>
                    <td><input type="checkbox" class="marcar" id="vConfigDepartamentos" name="vConfigDepartamentos" value="1" <?php if(isset($permissoes['vConfigDepartamentos'])){ if($permissoes['vConfigDepartamentos'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigDepartamentos" name="aConfigDepartamentos" value="1" <?php if(isset($permissoes['aConfigDepartamentos'])){ if($permissoes['aConfigDepartamentos'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eConfigDepartamentos" name="eConfigDepartamentos" value="1" <?php if(isset($permissoes['eConfigDepartamentos'])){ if($permissoes['eConfigDepartamentos'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dConfigDepartamentos" name="dConfigDepartamentos" value="1" <?php if(isset($permissoes['dConfigDepartamentos'])){ if($permissoes['dConfigDepartamentos'] == '1'){echo 'checked';}}?>></td>
                </tr>
                <tr>
                    <td>Permissões</td>
                    <td><input type="checkbox" class="marcar" id="vConfigPermissoes" name="vConfigPermissoes" value="1" <?php if(isset($permissoes['vConfigPermissoes'])){ if($permissoes['vConfigPermissoes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigPermissoes" name="aConfigPermissoes" value="1" <?php if(isset($permissoes['aConfigPermissoes'])){ if($permissoes['aConfigPermissoes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eConfigPermissoes" name="eConfigPermissoes" value="1" <?php if(isset($permissoes['eConfigPermissoes'])){ if($permissoes['eConfigPermissoes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dConfigPermissoes" name="dConfigPermissoes" value="1" <?php if(isset($permissoes['dConfigPermissoes'])){ if($permissoes['dConfigPermissoes'] == '1'){echo 'checked';}}?>></td>
                </tr>
                <tr>
                    <td>Usuários</td>
                    <td><input type="checkbox" class="marcar" id="vConfigUsuarios" name="vConfigUsuarios" value="1" <?php if(isset($permissoes['vConfigUsuarios'])){ if($permissoes['vConfigUsuarios'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigUsuarios" name="aConfigUsuarios" value="1" <?php if(isset($permissoes['aConfigUsuarios'])){ if($permissoes['aConfigUsuarios'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eConfigUsuarios" name="eConfigUsuarios" value="1" <?php if(isset($permissoes['eConfigUsuarios'])){ if($permissoes['eConfigUsuarios'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dConfigUsuarios" name="dConfigUsuarios" value="1" <?php if(isset($permissoes['dConfigUsuarios'])){ if($permissoes['dConfigUsuarios'] == '1'){echo 'checked';}}?>></td>
                </tr>
                <tr>
                    <td>Gweb</td>
                    <td><input type="checkbox" class="marcar" id="vConfigGweb" name="vConfigGweb" value="1" <?php if(isset($permissoes['vConfigGweb'])){ if($permissoes['vConfigGweb'] == '1'){echo 'checked';}}?>></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</form>

<script type="text/javascript">

// MARCAR TODOS OS CHECKBOXES
function marcarTodos(){
	$('.marcar').each(
		function(){
			if ($(this).prop("checked")) {
				$(this).prop("checked", false);
				$('#marcar_todos').prop("checked", false);
			} else { 
				$(this).prop("checked", true);
				$('#marcar_todos').prop("checked", true);
			}
		}
	);
}

// SALVAR NOVO/EDITAR
function salvarAcessos(){
    $('#formAcessosConcedidos').form('submit',{
        url: '<?php base_url();?>permissoes/salvarAcessos',
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
                /*$('#dgEstatisticas').datagrid('reload');
                $('#dgDemandas').datagrid('reload');
                $('#dgGovernanca').datagrid('reload');
                $('#dgInventario').datagrid('reload');
                $('#dgRelatorios').datagrid('reload');
                $('#dgConfiguracoes').datagrid('reload');*/
            }
        }
    });
}
</script>