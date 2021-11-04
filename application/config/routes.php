<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'gweb';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ROTAS DE LAYOUT
$route['menu'] = 'gweb/menu';
$route['painel'] = 'gweb/painel';
$route['rodape'] = 'gweb/rodape';

// ROTAS DE ACESSO/SAIR DO SITEMA
$route['autenticar'] = 'gweb/autenticar';
$route['login'] = 'gweb/login';
$route['logout'] = 'gweb/sair';

// ROTAS INCIDENTES
$route['incidentes_listar'] = 'incidentes/listar';

// ROTAS REQUISIÇÕES
$route['requisicoes_listar'] = 'requisicoes/listar';

// ROTAS PROBLEMAS
$route['problemas_listar'] = 'problemas/listar';

// ROTAS MUDANÇAS
$route['mudancas_listar'] = 'mudancas/listar';
