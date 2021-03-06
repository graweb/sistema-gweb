<div class="easyui-panel" fit="true" style="padding:5px;">
    <?php 
        if($this->permission->checkPermission($this->session->userdata('permissao'),'vIncidentes') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vRequisicoes') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vMudancas') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vProblemas') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vRelatorioIncidentes') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vRelatorioRequisicoes') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vRelatorioMudancas') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vRelatorioProblemas') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigEmitente') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigClientes') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigNivelAtendimento') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigNivelAtendimento') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigAcordoNivelServico') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigFluxoMudancas') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigDepartamentos') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigPermissoes') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigUsuarios')){ ?>
    <a href="#" class="easyui-menubutton" data-options="menu:'#menuPadrao',iconCls:'fa fa-home fa-lg'">Painel</a>
    <?php } ?>
    <a href="#" class="easyui-menubutton" data-options="menu:'#menuUsuario',iconCls:'fa fa-user fa-lg'"><?php echo $this->session->userdata('nome');?></a>
    <a href="<?php base_url()?>logout" class="easyui-linkbutton" data-options="iconCls:'fa fa-sign-out fa-lg', plain:'false'">Sair</a>

    <div id="menuPadrao" style="width:150px;">
        <?php 
            if($this->permission->checkPermission($this->session->userdata('permissao'),'vIncidentes') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vRequisicoes') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vMudancas') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vProblemas')){ ?>
            <div>
                <span>Demandas</span>
                <div>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vIncidentes')){ ?>
                    <div onclick="addPanel('Incidentes','<?php base_url();?>incidentes')">Incidentes</div>
                    <?php } ?>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vRequisicoes')){ ?>
                    <div onclick="addPanel('Requisi????es','<?php base_url();?>requisicoes')">Requisi????es</div>
                    <?php } ?>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vMudancas')){ ?>
                    <div onclick="addPanel('Mudan??as','<?php base_url();?>mudancas')">Mudan??as</div>
                    <?php } ?>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vProblemas')){ ?>
                    <div onclick="addPanel('Problemas','<?php base_url();?>problemas')">Problemas</div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php 
            if($this->permission->checkPermission($this->session->userdata('permissao'),'vRelatorioDemandas')) { ?>
            <div>
                <span>Relat??rios</span>
                <div>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vRelatorioDemandas')){ ?>
                    <div onclick="addPanel('Relat??rios - Demandas','<?php base_url();?>relatorios/demandas')">Demandas</div>
                    <?php } ?>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vRelatorioGraficos')){ ?>
                    <div onclick="addPanel('Relat??rios - Gr??ficos','<?php base_url();?>graficos/graficos')">Gr??ficos</div>
                    <?php } ?>
                </div>
            </div>
        <div class="menu-sep"></div>
        <?php } ?>
        <?php 
            if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigEmitente') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigClientes') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigNivelAtendimento') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigNivelAtendimento') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigAcordoNivelServico') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigFluxoMudancas') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigDepartamentos') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigPermissoes') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigUsuarios')){ ?>
            <div>
                <span>Configura????es</span>
                <div>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigEmitente')){ ?>
                    <div onclick="addPanel('Emitente','<?php base_url();?>emitente')">Emitente</div>
                    <?php } ?>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigClientes')){ ?>
                    <div onclick="addPanel('Clientes','<?php base_url();?>clientes')">Clientes</div>
                    <?php } ?>
                    <?php 
                        if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigNivelAtendimento') ||
                        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigAcordoNivelServico') ||
                        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigFluxoMudancas')){ ?>
                        <div>
                            <span>Demandas</span>
                            <div>
                                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigNivelAtendimento')){ ?>
                                <div onclick="addPanel('N??vel de Atendimento','<?php base_url();?>nivel_de_atendimento')">N??vel de Atendimento</div>
                                <?php } ?>
                                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigAcordoNivelServico')){ ?>
                                <div onclick="addPanel('Acordo de N??vel de Servi??o','<?php base_url();?>acordo_de_nivel_de_servico')">Acordo de N??vel de Servi??o</div>
                                <?php } ?>
                                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigFluxoMudancas')){ ?>
                                <div onclick="addPanel('Fluxo de Mudan??as','<?php base_url();?>fluxo_de_mudancas')">Fluxo de Mudan??as</div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigDepartamentos')){ ?>
                    <div onclick="addPanel('Departamentos','<?php base_url();?>departamentos')">Departamentos</div>
                    <div class="menu-sep"></div>
                    <?php } ?>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigPermissoes')){ ?>
                    <div onclick="addPanel('Permiss??es','<?php base_url();?>permissoes')">Permiss??es</div>
                    <?php } ?>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigUsuarios')){ ?>
                    <div onclick="addPanel('Usu??rios','<?php base_url();?>usuarios')">Usu??rios</div>
                    <?php } ?>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigGweb')){ ?>
                    <div class="menu-sep"></div>
                    <div onclick="$('#dlgConfigGweb').dialog('open')">Gweb</div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <div id="menuUsuario" style="width:150px;">
        <div onclick="abrirDialogDefinirSenha()">Definir senha</div>
        <div onclick="$('#dlgTema').dialog('open')">Configurar tema</div>
    </div>
    
</div>