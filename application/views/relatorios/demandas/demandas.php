<table id="dgRelatoriosDemandas" 
        title="Relatórios de Demandas" 
        class="easyui-datagrid" 
        fit="true"
        url="<?php base_url();?>relatorios/listarDemandas" 
        toolbar="#toolbarRelatoriosDemandas" 
        pagination="true"
        rownumbers="true" 
        fitColumns="true" 
        singleSelect="true"
        striped="true">
    <thead>
        <tr>
            <th field="id_relatorio" width="10">ID</th>
            <th field="descricao" width="120">DESCRIÇÃO</th>
            <th field="tipo" width="40" hidden="true">TIPO</th>
        </tr>
    </thead>
</table>
<div id="toolbarRelatoriosDemandas">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-file-pdf-o fa-lg" plain="true" onclick="gerarRelDemandasPdf()">Gerar PDF</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-file-excel-o fa-lg" plain="true" onclick="gerarDemandaExcel()">Gerar EXCEL</a>
</div>

<!-- MODAL DEMANDAS POR DATA -->
<div id="dlgRelDemandasPorData" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasPorDataButtons" modal="true">
    <form id="formRelDemandasPorData" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_por_data" name="tipo_relatorio_por_data" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_demanda" name="data_inicio_demanda" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_demanda" name="data_fim_demanda" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasPorDataButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasPorData').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasPdfPorData()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS POR DATA EXCEL -->
<div id="dlgRelDemandasPorDataExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasPorDataExcelButtons" modal="true">
    <form id="formRelDemandasPorDataExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_por_data_excel" name="tipo_relatorio_por_data_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_demanda_excel" name="data_inicio_demanda_excel" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_demanda_excel" name="data_fim_demanda_excel" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasPorDataExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasPorDataExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasExcelPorData()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS POR ANALISTA -->
<div id="dlgRelDemandasPorAnalista" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasPorAnalistaButtons" modal="true">
    <form id="formRelDemandasPorAnalista" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_por_analista" name="tipo_relatorio_por_analista" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input id="id_analista_demanda" name="id_analista_demanda" class="easyui-combobox" label="Analista:" labelPosition="top" 
                    panelHeight="200px" required="true" style="width:100%;" data-options="
                        valueField: 'id_usuario',
                        textField: 'usuario',
                        url: '<?php base_url();?>usuarios/listarComboAnalistas'"
                    >
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao_por_analista" name="situacao_por_analista" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Aberto</option>
                        <option value="2">Em análise</option>
                        <option value="3">Concluído</option>
                        <option value="4">Cancelado</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_por_analista" name="data_inicio_por_analista" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_por_analista" name="data_fim_por_analista" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasPorAnalistaButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasPorAnalista').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasPdfPorAnalista()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS POR ANALISTA EXCEL -->
<div id="dlgRelDemandasPorAnalistaExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasPorAnalistaExcelButtons" modal="true">
    <form id="formRelDemandasPorAnalistaExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_por_analista_excel" name="tipo_relatorio_por_analista_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input id="id_analista_demanda_excel" name="id_analista_demanda_excel" class="easyui-combobox" label="Analista:" labelPosition="top" 
                    panelHeight="200px" required="true" style="width:100%;" data-options="
                        valueField: 'id_usuario',
                        textField: 'usuario',
                        url: '<?php base_url();?>usuarios/listarComboAnalistas'"
                    >
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao_por_analista_excel" name="situacao_por_analista_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Aberto</option>
                        <option value="2">Em análise</option>
                        <option value="3">Concluído</option>
                        <option value="4">Cancelado</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_por_analista_excel" name="data_inicio_por_analista_excel" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_por_analista_excel" name="data_fim_por_analista_excel" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasPorAnalistaExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasPorAnalistaExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="demandasPorAnalistaExcel()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS POR USUÁRIO -->
<div id="dlgRelDemandasPorUsuario" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasPorUsuarioButtons" modal="true">
    <form id="formRelDemandasPorUsuario" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_por_usuario" name="tipo_relatorio_por_usuario" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input id="id_usuario_demanda" name="id_usuario_demanda" class="easyui-combobox" label="Usuário:" labelPosition="top" 
                    panelHeight="200px" required="true" style="width:100%;" data-options="
                        valueField: 'id_usuario',
                        textField: 'usuario',
                        url: '<?php base_url();?>usuarios/listarCombo'"
                    >
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao_por_usuario" name="situacao_por_usuario" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Aberto</option>
                        <option value="2">Em análise</option>
                        <option value="3">Concluído</option>
                        <option value="4">Cancelado</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_por_usuario" name="data_inicio_por_usuario" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_por_usuario" name="data_fim_por_usuario" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasPorUsuarioButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasPorUsuario').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasPdfPorUsuario()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS POR USUÁRIO EXCEL -->
<div id="dlgRelDemandasPorUsuarioExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasPorUsuarioExcelButtons" modal="true">
    <form id="formRelDemandasPorUsuarioExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_por_usuario_excel" name="tipo_relatorio_por_usuario_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input id="id_usuario_demanda_excel" name="id_usuario_demanda_excel" class="easyui-combobox" label="Usuário:" labelPosition="top" 
                    panelHeight="200px" required="true" style="width:100%;" data-options="
                        valueField: 'id_usuario',
                        textField: 'usuario',
                        url: '<?php base_url();?>usuarios/listarCombo'"
                    >
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao_por_usuario_excel" name="situacao_por_usuario_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Aberto</option>
                        <option value="2">Em análise</option>
                        <option value="3">Concluído</option>
                        <option value="4">Cancelado</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_por_usuario_excel" name="data_inicio_por_usuario_excel" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_por_usuario_excel" name="data_fim_por_usuario_excel" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasPorUsuarioExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasPorUsuarioExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasExcelPorUsuario()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS POR SITUAÇÃO -->
<div id="dlgRelDemandasPorSituacao" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasPorSituacaoButtons" modal="true">
    <form id="formRelDemandasPorSituacao" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_por_situacao" name="tipo_relatorio_por_situacao" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao_por_situacao" name="situacao_por_situacao" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Aberto</option>
                        <option value="2">Em análise</option>
                        <option value="3">Concluído</option>
                        <option value="4">Cancelado</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_por_situacao" name="data_inicio_por_situacao" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_por_situacao" name="data_fim_por_situacao" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasPorSituacaoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasPorSituacao').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasPdfPorSituacao()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS POR SITUAÇÃO EXCEL -->
<div id="dlgRelDemandasPorSituacaoExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasPorSituacaoExcelButtons" modal="true">
    <form id="formRelDemandasPorSituacaoExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_por_situacao_excel" name="tipo_relatorio_por_situacao_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao_por_situacao_excel" name="situacao_por_situacao_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Aberto</option>
                        <option value="2">Em análise</option>
                        <option value="3">Concluído</option>
                        <option value="4">Cancelado</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_por_situacao_excel" name="data_inicio_por_situacao_excel" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_por_situacao_excel" name="data_fim_por_situacao_excel" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasPorSituacaoExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasPorSituacaoExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasExcelPorSituacao()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS QUE TIVERAM A PESQUISA DE SATISFAÇÃO PREENCHIDA -->
<div id="dlgRelDemandasPesqSatisfPreenchida" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasPesqSatisfPreenchidaButtons" modal="true">
    <form id="formRelDemandasPesqSatisfPreenchida" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_pesq_satis_preenchida" name="tipo_relatorio_pesq_satis_preenchida" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_pesq_satis_preenchida" name="data_inicio_pesq_satis_preenchida" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_pesq_satis_preenchida" name="data_fim_pesq_satis_preenchida" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasPesqSatisfPreenchidaButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasPesqSatisfPreenchida').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasPdfPesqSatisfPreenchida()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS QUE TIVERAM A PESQUISA DE SATISFAÇÃO PREENCHIDA EXCEL -->
<div id="dlgRelDemandasPesqSatisfPreenchidaExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasPesqSatisfPreenchidaExcelButtons" modal="true">
    <form id="formRelDemandasPesqSatisfPreenchidaExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_pesq_satis_preenchida_excel" name="tipo_relatorio_pesq_satis_preenchida_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_pesq_satis_preenchida_excel" name="data_inicio_pesq_satis_preenchida_excel" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_pesq_satis_preenchida_excel" name="data_fim_pesq_satis_preenchida_excel" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasPesqSatisfPreenchidaExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasPesqSatisfPreenchidaExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasExcelPesqSatisfPreenchida()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS QUE GERARAM MUDANÇAS -->
<div id="dlgRelDemandasQueGeraramMudancas" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasQueGeraramMudancasButtons" modal="true">
    <form id="formRelDemandasQueGeraramMudancas" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_gerou_mudanca" name="tipo_relatorio_gerou_mudanca" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_gerou_mudanca" name="data_inicio_gerou_mudanca" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_gerou_mudanca" name="data_fim_gerou_mudanca" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasQueGeraramMudancasButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasQueGeraramMudancas').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasPdfGerouMudanca()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS QUE GERARAM MUDANÇAS EXCEL -->
<div id="dlgRelDemandasQueGeraramMudancasExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasQueGeraramMudancasExcelButtons" modal="true">
    <form id="formRelDemandasQueGeraramMudancasExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_gerou_mudanca_excel" name="tipo_relatorio_gerou_mudanca_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_gerou_mudanca_excel" name="data_inicio_gerou_mudanca_excel" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_gerou_mudanca_excel" name="data_fim_gerou_mudanca_excel" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasQueGeraramMudancasExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasQueGeraramMudancasExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasExcelGerouMudanca()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS QUE GERARAM PROBLEMAS -->
<div id="dlgRelDemandasQueGeraramProblemas" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasQueGeraramProblemasButtons" modal="true">
    <form id="formRelDemandasQueGeraramProblemas" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_gerou_problema" name="tipo_relatorio_gerou_problema" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_gerou_problema" name="data_inicio_gerou_problema" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_gerou_problema" name="data_fim_gerou_problema" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasQueGeraramProblemasButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasQueGeraramProblemas').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasPdfGerouProblema()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEMANDAS QUE GERARAM PROBLEMAS EXCEL -->
<div id="dlgRelDemandasQueGeraramProblemasExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelaDemandasQueGeraramProblemasExcelButtons" modal="true">
    <form id="formRelDemandasQueGeraramProblemasExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_gerou_problema_excel" name="tipo_relatorio_gerou_problema_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="1">Incidentes</option>
                        <option value="2">Requisições</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_inicio_gerou_problema_excel" name="data_inicio_gerou_problema_excel" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-datetimebox" id="data_fim_gerou_problema_excel" name="data_fim_gerou_problema_excel" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataComboRelDem,parser:formatarDataComboParserRelDem" editable="false" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaDemandasQueGeraramProblemasExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDemandasQueGeraramProblemasExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarDemandasExcelGerouProblema()" style="width:90px">Gerar</a>
</div>

<!-- MODAL CLIENTES -->
<div id="dlgRelClientes" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelClientesButtons" modal="true">
    <form id="formRelClientes" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="tipo_relatorio_cliente" name="tipo_relatorio_cliente" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="0">Todos</option>
                        <option value="1">Ativos</option>
                        <option value="2">Inativos</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelClientesButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelClientes').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarPdfClientes()" style="width:90px">Gerar</a>
</div>

<!-- MODAL CLIENTES EXCEL -->
<div id="dlgRelClientesExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelClientesExcelButtons" modal="true">
    <form id="formRelClientesExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="tipo_relatorio_cliente_excel" name="tipo_relatorio_cliente_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="0">Todos</option>
                        <option value="1">Ativos</option>
                        <option value="2">Inativos</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelClientesExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelClientesExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarExcelClientes()" style="width:90px">Gerar</a>
</div>

<!-- MODAL NÍVEL ATENDIMENTO -->
<div id="dlgRelNivelAtendimento" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelNivelAtendimentoButtons" modal="true">
    <form id="formRelNivelAtendimento" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="tipo_relatorio_nivel_atendimento" name="tipo_relatorio_nivel_atendimento" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="0">Todos</option>
                        <option value="1">Ativos</option>
                        <option value="2">Inativos</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelNivelAtendimentoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelNivelAtendimento').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarPdfNivelAtendimento()" style="width:90px">Gerar</a>
</div>

<!-- MODAL NÍVEL ATENDIMENTO EXCEL -->
<div id="dlgRelNivelAtendimentoExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelNivelAtendimentoExcelButtons" modal="true">
    <form id="formRelNivelAtendimentoExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="tipo_relatorio_nivel_atendimento_excel" name="tipo_relatorio_nivel_atendimento_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="0">Todos</option>
                        <option value="1">Ativos</option>
                        <option value="2">Inativos</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelNivelAtendimentoExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelNivelAtendimentoExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarExcelNivelAtendimento()" style="width:90px">Gerar</a>
</div>

<!-- MODAL ACORDO NÍVEL SERVIÇO -->
<div id="dlgRelAcordoNivelServico" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelAcordoNivelServicoButtons" modal="true">
    <form id="formRelAcordoNivelServico" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Cliente:" labelPosition="top" id="id_cliente_rel_acordo_nivel_de_servico" name="id_cliente_rel_acordo_nivel_de_servico" panelHeight="auto" required="true" style="width:100%;">
                        <?php foreach ($dados_cliente_rel as $cli) { 
                            echo "<option value='".$cli->id_cliente."'>".$cli->nome_cliente."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelAcordoNivelServicoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelAcordoNivelServico').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarPdfAcordoNivelServico()" style="width:90px">Gerar</a>
</div>

<!-- MODAL ACORDO NÍVEL SERVIÇO EXCEL -->
<div id="dlgRelAcordoNivelServicoExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelAcordoNivelServicoExcelButtons" modal="true">
    <form id="formRelAcordoNivelServicoExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Cliente:" labelPosition="top" id="id_cliente_rel_acordo_nivel_de_servico_excel" name="id_cliente_rel_acordo_nivel_de_servico_excel" panelHeight="auto" required="true" style="width:100%;">
                        <?php foreach ($dados_cliente_rel as $cli) { 
                            echo "<option value='".$cli->id_cliente."'>".$cli->nome_cliente."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelAcordoNivelServicoExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelAcordoNivelServicoExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarExcelAcordoNivelServico()" style="width:90px">Gerar</a>
</div>

<!-- MODAL FLUXO MUDANÇA -->
<div id="dlgRelFluxoMudanca" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelFluxoMudancaButtons" modal="true">
    <form id="formRelFluxoMudanca" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao_fluxo_mudanca" name="situacao_fluxo_mudanca" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="0">Todos</option>
                        <option value="1">Ativos</option>
                        <option value="2">Inativos</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelFluxoMudancaButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelFluxoMudanca').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarPdfFluxoMudanca()" style="width:90px">Gerar</a>
</div>

<!-- MODAL FLUXO MUDANÇA EXCEL -->
<div id="dlgRelFluxoMudancaExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelFluxoMudancaExcelButtons" modal="true">
    <form id="formRelFluxoMudancaExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao_fluxo_mudanca_excel" name="situacao_fluxo_mudanca_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="0">Todos</option>
                        <option value="1">Ativos</option>
                        <option value="2">Inativos</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelFluxoMudancaExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelFluxoMudancaExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarExcelFluxoMudanca()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEPARTAMENTOS -->
<div id="dlgRelDepartamentos" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelDepartamentosButtons" modal="true">
    <form id="formRelDepartamentos" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao_departamentos" name="situacao_departamentos" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="0">Todos</option>
                        <option value="1">Ativos</option>
                        <option value="2">Inativos</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelDepartamentosButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDepartamentos').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarPdfDepartamentos()" style="width:90px">Gerar</a>
</div>

<!-- MODAL DEPARTAMENTOS EXCEL -->
<div id="dlgRelDepartamentosExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelDepartamentosExcelButtons" modal="true">
    <form id="formRelDepartamentosExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao_departamentos_excel" name="situacao_departamentos_excel" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value="0">Todos</option>
                        <option value="1">Ativos</option>
                        <option value="2">Inativos</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelDepartamentosExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelDepartamentosExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarExcelDepartamentos()" style="width:90px">Gerar</a>
</div>

<!-- MODAL USUÁRIOS -->
<div id="dlgRelUsuarios" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelUsuariosButtons" modal="true">
    <form id="formRelUsuarios" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Cliente:" labelPosition="top" id="id_cliente_rel_usuarios" name="id_cliente_rel_usuarios" panelHeight="auto" required="true" style="width:100%;">
                        <?php foreach ($dados_cliente_rel as $cli) { 
                            echo "<option value='".$cli->id_cliente."'>".$cli->nome_cliente."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelUsuariosButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelUsuarios').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarPdfUsuarios()" style="width:90px">Gerar</a>
</div>

<!-- MODAL USUÁRIOS EXCEL -->
<div id="dlgRelUsuariosExcel" class="easyui-dialog" 
    style="width:350px;height:auto" closed="true" buttons="#dlgRelUsuariosExcelButtons" modal="true">
    <form id="formRelUsuariosExcel" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td>
                    <select class="easyui-combobox" label="Cliente:" labelPosition="top" id="id_cliente_rel_usuarios_excel" name="id_cliente_rel_usuarios_excel" panelHeight="auto" required="true" style="width:100%;">
                        <?php foreach ($dados_cliente_rel as $cli) { 
                            echo "<option value='".$cli->id_cliente."'>".$cli->nome_cliente."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelUsuariosExcelButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgRelUsuariosExcel').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarExcelUsuarios()" style="width:90px">Gerar</a>
</div>

<script type="text/javascript">
// FORMATA A DATA/HORA NO COMBO DATA_HORA
function formatarDataComboRelDem(date){
    var dataA = [date.getDate(),date.getMonth()+1,date.getFullYear()].join('/');
    var dataB = [date.getHours(),date.getMinutes(),date.getSeconds()].join(':');
    return dataA + ' ' + dataB;
}

function formatarDataComboParserRelDem(s){
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

// ABRE O DIALOG PARA SELECIONAR AS INFORMAÇÕES PDF
function gerarRelDemandasPdf(){
    var row = $('#dgRelatoriosDemandas').datagrid('getSelected');
    
    if (row != null){
        if(row.id_relatorio == 1) {
            $('#dlgRelDemandasPorData').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasPorData').form('clear');
        } else if(row.id_relatorio == 2) {
            $('#dlgRelDemandasPorAnalista').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasPorAnalista').form('clear');
        } else if(row.id_relatorio == 3) {
            $('#dlgRelDemandasPorUsuario').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasPorUsuario').form('clear');
        } else if(row.id_relatorio == 4) {
            $('#dlgRelDemandasPorSituacao').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasPorSituacao').form('clear');
        } else if(row.id_relatorio == 5) {
            $('#dlgRelDemandasPesqSatisfPreenchida').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasPesqSatisfPreenchida').form('clear');
        } else if(row.id_relatorio == 6) {
            $('#dlgRelDemandasQueGeraramMudancas').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasQueGeraramMudancas').form('clear');
        } else if(row.id_relatorio == 7) {
            $('#dlgRelDemandasQueGeraramProblemas').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasQueGeraramProblemas').form('clear');
        } else if(row.id_relatorio == 8) {
            $('#dlgRelClientes').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelClientes').form('clear');
        } else if(row.id_relatorio == 9) {
            $('#dlgRelNivelAtendimento').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelNivelAtendimento').form('clear');
        } else if(row.id_relatorio == 10) {
            $('#dlgRelAcordoNivelServico').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelAcordoNivelServico').form('clear');
        } else if(row.id_relatorio == 11) {
            $('#dlgRelFluxoMudanca').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelFluxoMudanca').form('clear');
        } else if(row.id_relatorio == 12) {
            $('#dlgRelDepartamentos').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDepartamentos').form('clear');
        } else if(row.id_relatorio == 13) {
            $('#dlgRelUsuarios').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelUsuarios').form('clear');
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// ABRE O DIALOG PARA SELECIONAR AS INFORMAÇÕES EXCEL
function gerarDemandaExcel(){
    var row = $('#dgRelatoriosDemandas').datagrid('getSelected');
    
    if (row != null){
        if(row.id_relatorio == 1) {
            $('#dlgRelDemandasPorDataExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasPorDataExcel').form('clear');
        } else if(row.id_relatorio == 2) {
            $('#dlgRelDemandasPorAnalistaExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasPorAnalistaExcel').form('clear');
        } else if(row.id_relatorio == 3) {
            $('#dlgRelDemandasPorUsuarioExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasPorUsuarioExcel').form('clear');
        } else if(row.id_relatorio == 4) {
            $('#dlgRelDemandasPorSituacaoExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasPorSituacaoExcel').form('clear');
        } else if(row.id_relatorio == 5) {
            $('#dlgRelDemandasPesqSatisfPreenchidaExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasPesqSatisfPreenchidaExcel').form('clear');
        } else if(row.id_relatorio == 6) {
            $('#dlgRelDemandasQueGeraramMudancasExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasQueGeraramMudancasExcel').form('clear');
        } else if(row.id_relatorio == 7) {
            $('#dlgRelDemandasQueGeraramProblemasExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDemandasQueGeraramProblemasExcel').form('clear');
        } else if(row.id_relatorio == 8) {
            $('#dlgRelClientesExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelClientesExcel').form('clear');
        } else if(row.id_relatorio == 9) {
            $('#dlgRelNivelAtendimentoExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelNivelAtendimentoExcel').form('clear');
        } else if(row.id_relatorio == 10) {
            $('#dlgRelAcordoNivelServicoExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelAcordoNivelServicoExcel').form('clear');
        } else if(row.id_relatorio == 11) {
            $('#dlgRelFluxoMudancaExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelFluxoMudancaExcel').form('clear');
        } else if(row.id_relatorio == 12) {
            $('#dlgRelDepartamentosExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelDepartamentosExcel').form('clear');
        } else if(row.id_relatorio == 13) {
            $('#dlgRelUsuariosExcel').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelUsuariosExcel').form('clear');
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// GERAR O RELATÓRIO POR DATA
function gerarDemandasPdfPorData() {
    $('#dlgRelDemandasPorData').dialog('close');

    var demData = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasPorData').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/demandasPorData/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO POR ANALISTA
function gerarDemandasPdfPorAnalista() {
    $('#dlgRelDemandasPorAnalista').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasPorAnalista').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/demandasPorAnalista/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO POR USUÁRIO
function gerarDemandasPdfPorUsuario() {
    $('#dlgRelDemandasPorUsuario').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasPorUsuario').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/demandasPorUsuario/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO POR SITUAÇÃO
function gerarDemandasPdfPorSituacao() {
    $('#dlgRelDemandasPorSituacao').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasPorSituacao').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/demandasPorSituacao/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO QUE TIVERAM A PESQUISA DE SATISFAÇÃO PREENCHIDA
function gerarDemandasPdfPesqSatisfPreenchida() {
    $('#dlgRelDemandasPesqSatisfPreenchida').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasPesqSatisfPreenchida').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/demandasPesqSatisfPreenchida/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO QUE GERARAM MUDANÇAS
function gerarDemandasPdfGerouMudanca() {
    $('#dlgRelDemandasQueGeraramMudancas').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasQueGeraramMudancas').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/demandasQueGeraramMudancas/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO QUE GERARAM PROBLEMAS
function gerarDemandasPdfGerouProblema() {
    $('#dlgRelDemandasQueGeraramProblemas').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasQueGeraramProblemas').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/demandasQueGeraramProblemas/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE CLIENTES
function gerarPdfClientes() {
    $('#dlgRelClientes').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelClientes').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/gerarPdfClientes/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE NÍVEL DE ATENDIMENTO
function gerarPdfNivelAtendimento() {
    $('#dlgRelNivelAtendimento').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelNivelAtendimento').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/gerarPdfNivelAtendimento/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE ACORDO DE NÍVEL DE SERVIÇO
function gerarPdfAcordoNivelServico() {
    $('#dlgRelAcordoNivelServico').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelAcordoNivelServico').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/gerarPdfAcordoNivelServico/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE FLUXO DE MUDANÇA
function gerarPdfFluxoMudanca() {
    $('#dlgRelFluxoMudanca').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelFluxoMudanca').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/gerarPdfFluxoMudanca/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE DEPARTAMENTOS
function gerarPdfDepartamentos() {
    $('#dlgRelDepartamentos').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDepartamentos').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/gerarPdfDepartamentos/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE USUÁRIOS
function gerarPdfUsuarios() {
    $('#dlgRelUsuarios').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelUsuarios').form('submit',{
            url: '<?php base_url();?>relatorios_pdf/gerarPdfUsuarios/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO POR DATA EM EXCEL
function gerarDemandasExcelPorData() {
    $('#dlgRelDemandasPorDataExcel').dialog('close');

    var demData = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasPorDataExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/demandasPorDataExcel/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO POR ANALISTA EXCEL
function demandasPorAnalistaExcel() {
    $('#dlgRelDemandasPorAnalistaExcel').dialog('close');

    var demData = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasPorAnalistaExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/demandasPorAnalistaExcel/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO POR USUÁRIO EXCEL
function gerarDemandasExcelPorUsuario() {
    $('#dlgRelDemandasPorUsuarioExcel').dialog('close');

    var demData = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasPorUsuarioExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/demandasPorUsuarioExcel/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO POR SITUAÇÃO Excel
function gerarDemandasExcelPorSituacao() {
    $('#dlgRelDemandasPorSituacaoExcel').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasPorSituacaoExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/demandasPorSituacaoExcel/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO QUE TIVERAM A PESQUISA DE SATISFAÇÃO PREENCHIDA EXCEL
function gerarDemandasExcelPesqSatisfPreenchida() {
    $('#dlgRelDemandasPesqSatisfPreenchidaExcel').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasPesqSatisfPreenchidaExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/demandasPesqSatisfPreenchidaExcel/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO QUE GERARAM MUDANÇAS EXCEL
function gerarDemandasExcelGerouMudanca() {
    $('#dlgRelDemandasQueGeraramMudancasExcel').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasQueGeraramMudancasExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/demandasQueGeraramMudancasExcel/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO QUE GERARAM PROBLEMAS EXCEL
function gerarDemandasExcelGerouProblema() {
    $('#dlgRelDemandasQueGeraramProblemasExcel').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDemandasQueGeraramProblemasExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/demandasQueGeraramProblemasExcel/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE CLIENTES EXCEL
function gerarExcelClientes() {
    $('#dlgRelClientesExcel').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelClientesExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/gerarExcelClientes/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE NÍVEL DE ATENDIMENTO EXCEL
function gerarExcelNivelAtendimento() {
    $('#dlgRelNivelAtendimentoExcel').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelNivelAtendimentoExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/gerarExcelNivelAtendimento/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE ACORDO DE NÍVEL DE SERVIÇO EXCEL
function gerarExcelAcordoNivelServico() {
    $('#dlgRelAcordoNivelServicoExcel').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelAcordoNivelServicoExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/gerarExcelAcordoNivelServico/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE FLUXO DE MUDANÇA EXCEL
function gerarExcelFluxoMudanca() {
    $('#dlgRelFluxoMudancaExcel').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelFluxoMudancaExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/gerarExcelFluxoMudanca/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE DEPARTAMENTOS EXCEL
function gerarExcelDepartamentos() {
    $('#dlgRelDepartamentosExcel').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelDepartamentosExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/gerarExcelDepartamentos/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE USUÁRIOS EXCEL
function gerarExcelUsuarios() {
    $('#dlgRelUsuariosExcel').dialog('close');

    var demAnalista = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelUsuariosExcel').form('submit',{
            url: '<?php base_url();?>relatorios_excel/gerarExcelUsuarios/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}
</script>