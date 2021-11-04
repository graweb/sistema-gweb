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
<link rel="shortcut icon" href="<?php base_url()?>assets/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/jquery-easyui-1.5.4/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/jquery-easyui-1.5.4/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/jquery-easyui-1.5.4/demo/demo.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<script type="text/javascript" src="<?php base_url();?>assets/jquery-easyui-1.5.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php base_url();?>assets/jquery-easyui-1.5.4/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php base_url();?>assets/jquery-easyui-1.5.4/locale/easyui-lang-pt_BR.js"></script>
</head>
<body background="https://images8.alphacoders.com/378/378096.jpg">
    <div align="center">
        <form action="<?php base_url()?>autenticar" method="post">
            <div class="easyui-panel" title="Informe seus dados" style="width:100%;max-width:400px;padding:20px 20px;">
                <div style="margin-bottom:10px">
                    <input id="email" name="email" class="easyui-textbox" style="width:100%;height:40px;padding:12px" data-options="prompt:'E-mail',iconCls:'icon-man',iconWidth:38,required:true, validType:'email'">
                </div>
                <div style="margin-bottom:20px">
                    <input id="senha" name="senha" class="easyui-passwordbox" prompt="Password" style="width:100%;height:40px;padding:12px" data-options="prompt:'Senha',iconCls:'icon-lock',iconWidth:38,required:true">
                </div>
                <div>
                    <button type="submit" class="easyui-linkbutton" data-options="iconCls:'icon-ok'" style="padding:5px 0px;width:100%;">
                        <span style="font-size:14px;">Acessar</span>
                    </button>
                </div>
                <br>
                <div align="center">
                    <a href="" class="easyui-linkbutton" data-options="plain:true">lembrar dados</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<?php if(isset($_SESSION['warning'])) { ?>
    <script type="text/javascript">
        $.messager.show({
            title:'Atenção',
            msg: '<div align="center" style="color:#DBA901;"><i class="fa fa-ban fa-2x"></i> <h4><?php echo $_SESSION['warning']; ?></h4></div>',
            timeout: 2000,
            showType:'show',
            height: 20,
            resizable: true,
            style:{
                left:'',
                right:0,
                top:document.body.scrollTop+document.documentElement.scrollTop,
                bottom:''
            }
        });
    </script>
<?php } ?>
<?php if(isset($_SESSION['danger'])) { ?>
    <script type="text/javascript">
        $.messager.show({
            title:'Atenção',
            msg: '<div align="center" style="color:#FF0000;"><i class="fa fa-ban fa-2x"></i> <h4><?php echo $_SESSION['danger']; ?></h4></div>',
            timeout: 2000,
            showType:'show',
            height: 20,
            resizable: true,
            style:{
                left:'',
                right:0,
                top:document.body.scrollTop+document.documentElement.scrollTop,
                bottom:''
            }
        });
    </script>
<?php } ?>