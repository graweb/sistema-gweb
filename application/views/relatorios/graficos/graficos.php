<div class="easyui-layout" fit="true">
    <div data-options="region:'west',collapsible:false" title="Informações" style="width:20%;">
        <form id="formGraficos" class="easyui-form" method="post" data-options="novalidate:true">
            <table style="width:96%;">
                <tr>
                    <td>
                        <select class="easyui-combobox" label="Modelo gráfico:" labelPosition="top" id="modelo_grafico" name="modelo_grafico" panelHeight="auto" editable="false" required="true" style="width:100%;">
                            <option value="1">Pizza</option>
                            <option value="2">Barras</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select class="easyui-combobox" label="Tipo de Relatório:" labelPosition="top" id="tipo_relatorio_grafico" name="tipo_relatorio_grafico" panelHeight="auto" editable="false" required="true" style="width:100%;">
                            <option value="1">Incidentes</option>
                            <option value="2">Requisições</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="id_analista_grafico" name="id_analista_grafico" class="easyui-combobox" label="Analista:" labelPosition="top" 
                        panelHeight="200px" required="true" style="width:100%;" data-options="
                            valueField: 'id_usuario',
                            textField: 'usuario',
                            url: '<?php base_url();?>usuarios/listarComboAnalistas'"
                        >
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="easyui-datetimebox" id="data_inicio_grafico" name="data_inicio_grafico" label="De:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataCombo,parser:formatarDataComboParser" editable="false" required="true">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="easyui-datetimebox" id="data_fim_grafico" name="data_fim_grafico" label="Até:" labelPosition="top" style="width:100%;" data-options="formatter:formatarDataCombo,parser:formatarDataComboParser" editable="false" required="true">
                    </td>
                </tr>
            </table>
            <hr>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="atualizarInformacoesGrafico()" style="width:100%">Aplicar filtro</a>
        </form>
    </div>
    <div id="conteudoGrafico" data-options="region:'east',collapsible:false" title="Gráfico" style="width:80%;">
        <?php if(isset($view)){ $this->load->view($view);} ?>
    </div>
</div>

<script type="text/javascript">

// ENVIAR INFORMAÇÕES DO RELATÓRIOS DE GRÁFICOS
function atualizarInformacoesGrafico(){
    $('#formGraficos').form('submit',{
        url: '<?php base_url();?>graficos/atualizarInformacoesGrafico',
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            $('#conteudoGrafico').panel('refresh', '<?php base_url();?>graficos/informacoesGrafico');
        }
    });
}
</script>