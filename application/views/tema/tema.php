<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="GraWeb Tecnologia">
<meta name="description" content="Gweb - Gestão de Serviços">
<meta name="keywords" content="itil, cobit, governança, serviços, ti, kanban, scrum, ágil, projetos">
<title>Gweb - Gestão de Serviços</title>
<link rel="shortcut icon" href="<?php base_url()?>assets/images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/jquery-easyui-1.5.4/themes/<?php echo $this->session->userdata('tema');?>/easyui.css" />
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/jquery-easyui-1.5.4/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/jquery-easyui-1.5.4/demo/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/css/timeline.css" />
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/css/organograma.css" />
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/amcharts_3.21.12/amcharts/plugins/export/export.css" />
</head>
<body>
<div class="easyui-layout" fit="true">
	<div data-options="region:'north',border:false" style="height:38px;padding:0;">
	    <div class="easyui-panel" data-options="href:'<?php base_url();?>menu',border:false"></div>
	</div>
	<div data-options="region:'center',border:false">
        <div id="conteudo" class="easyui-tabs" fit="true">
            <div class="easyui-panel" title="Estatísticas" data-options="href:'<?php base_url();?>painel',border:false"></div>
	    </div>
	</div>
	<div data-options="region:'south',border:false" style="height:30px;padding:8px;">
        <div class="easyui-panel" data-options="href:'<?php base_url();?>rodape',border:false"></div>   
    </div>
</div>

<script type="text/javascript" src="<?php base_url();?>assets/jquery-easyui-1.5.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php base_url();?>assets/jquery-easyui-1.5.4/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php base_url();?>assets/jquery-easyui-1.5.4/locale/easyui-lang-pt_BR.js"></script>
<script type="text/javascript" src="<?php base_url();?>assets/amcharts_3.21.12/amcharts/amcharts.js"></script>
<script type="text/javascript" src="<?php base_url();?>assets/amcharts_3.21.12/amcharts/pie.js"></script>
<script type="text/javascript" src="<?php base_url();?>assets/amcharts_3.21.12/amcharts/serial.js"></script>
<script type="text/javascript" src="<?php base_url();?>assets/amcharts_3.21.12/amcharts/plugins/export/export.js"></script>
<script type="text/javascript" src="<?php base_url();?>assets/amcharts_3.21.12/amcharts/plugins/export/lang/pt.js"></script>

<script type="text/javascript">
    var index = 0;

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

    // VERIFICA SE AS TABS ESTÃO ABERTAS E ATUALIZA OS DATAGRIDS
    // DESSA FORMA, DESMARCA O ITEM SELCIONADO NO DATAGRID
    $('#conteudo').tabs({
        onSelect: function (title) {
            if ($('#conteudo').tabs('exists','Incidentes'))
            {
                $('#dgIncidentes').datagrid('reload');
            }

            if ($('#conteudo').tabs('exists','Requisições'))
            {
                $('#dgRequisicoes').datagrid('reload');
            }

            if ($('#conteudo').tabs('exists','Mudanças'))
            {
                $('#dgMudancas').datagrid('reload');
            }

            if ($('#conteudo').tabs('exists','Problemas'))
            {
                $('#dgProblemas').datagrid('reload');
            }
        }
    });

    function addPanel(titulo, link)
    {
        //VERIFICA SE A TAB ESTÀ ABERTA
        if ($('#conteudo').tabs('exists',titulo))
        {
            $('#conteudo').tabs('select', titulo);
        } else {
            index++;
            $('#conteudo').tabs('add',{
                title: titulo,
                href: link,
                closable: true
            });
        }
    }

    function removePanel()
    {
        var tab = $('#conteudo').tabs('getSelected');
        if (tab){
            var index = $('#conteudo').tabs('getTabIndex', tab);
            $('#conteudo').tabs('close', index);
        }
    }

    // DEFINIR TEMA
    function definirTema(){
        $('#dlgTema').dialog('open').dialog('center').dialog('setTitle','Definir tema');
        $('#formTema').form('clear');
    }

    // ABRIR DIALOG DEFINIR SENHA
    function abrirDialogDefinirSenha(){
        $('#dlgDefinirSenhaUsuario').dialog('open').dialog('center').dialog('setTitle','Definir senha');
        $('#formDefinirSenhaUsuario').form('clear');
    }

    // SALVAR TEMA
    function salvarTema(){
        $('#formTema').form('submit',{
            url: '<?php base_url();?>usuarios/salvarTema',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.errorMsg){
                    $.messager.show({
                        title:'Erro',
                        msg:'<strong style="color:red">'+result.errorMsg+'<i class="fa fa-check fa-2x"></i>Registro armazenado com sucesso!</strong>',
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
                    $('#dlgTema').dialog('close');
                    location.reload();
                }
            }
        });
    }

    //SALVAR DEFINIÇÃO DE SENHA
    function salvarDefinirSenhaUsuario(){
        if($("#senha_definir").val() == "")
        {
            $.messager.alert('Atenção','Informe sua senha!','error');
        } else if($("#senha_definir_confirma").val() == "") {
            $.messager.alert('Atenção','Confirme sua senha!','error');
        } else {
            if($("#senha_definir").val() == $("#senha_definir_confirma").val())
            {
                $('#formDefinirSenhaUsuario').form('submit',{
                    url: '<?php base_url();?>usuarios/definir_senha/'+<?php echo $this->session->userdata('id_usuario');?>,
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
                            $('#dlgDefinirSenhaUsuario').dialog('close');
                        }
                    }
                });
            } else {
                $.messager.alert('Atenção','Informações não conferem, favor digitar a mesma senha!','error');
            }
        }
    }

    // SALVAR DEMANDA
    function salvarDemandaInicio(){
        $('#formDemandaInicio').form('submit',{
            url: '<?php base_url();?>gweb/cadastrarDemandaInicio',
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

                    $('#dlgAbrirDemandaInicio').dialog('close');
                    $('#dgIncidentesRetorno').datagrid('reload');
                    $('#dgRequisicoesRetorno').datagrid('reload');
                    $('#dgIncidentesRetornoArea').datagrid('reload');
                    $('#dgRequisicoesRetornoArea').datagrid('reload');
                }
            }
        });
    }

    // ATUALIZAR CONFIGURAÇÕES GWEB
    function atualizarConfigGweb(){
        $('#formConfigGweb').form('submit',{
            url: '<?php base_url();?>gweb/atualizarConfigGweb',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.errorMsg){
                    $.messager.show({
                        title:'Erro',
                        msg:'<strong style="color:red">'+result.errorMsg+'<i class="fa fa-check fa-2x"></i>Registro armazenado com sucesso!</strong>',
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

                    $('#dlgConfigGweb').dialog('close');
                    location.reload();
                }
            }
        });
    }
</script>
</body>
</html>