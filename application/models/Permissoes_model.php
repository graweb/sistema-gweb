<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissoes_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get(){
        return $this->db->get('tb_permissoes')->result();
    }

    public function pegarPorID($id){
        $this->db->where('id_permissao',$id);
        return $this->db->get('tb_permissoes')->row();
    }

    public function cadastrar()
    {
        return $this->db->insert('tb_permissoes',array(
            'nome'=>$this->input->post('nome',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function salvarAcessos()
    {
        $permissoes = array(
            'vCadastroIncReq' => $this->input->post('vCadastroIncReq'),
            'vGraficoDemandasArea' => $this->input->post('vGraficoDemandasArea'),
            'vGraficoAguardandoRetorno' => $this->input->post('vGraficoAguardandoRetorno'),
            'vGraficoDemandasPizza' => $this->input->post('vGraficoDemandasPizza'),

            'vIncidentes' => $this->input->post('vIncidentes'),
            'aIncidentes' => $this->input->post('aIncidentes'),
            'eIncidentes' => $this->input->post('eIncidentes'),
            'dIncidentes' => $this->input->post('dIncidentes'),

            'gerarMudancaIncidentes' => $this->input->post('gerarMudancaIncidentes'),
            'gerarProblemaIncidentes' => $this->input->post('gerarProblemaIncidentes'),

            'vRequisicoes' => $this->input->post('vRequisicoes'),
            'aRequisicoes' => $this->input->post('aRequisicoes'),
            'eRequisicoes' => $this->input->post('eRequisicoes'),
            'dRequisicoes' => $this->input->post('dRequisicoes'),

            'gerarMudancaRequisicoes' => $this->input->post('gerarMudancaRequisicoes'),
            'gerarProblemaRequisicoes' => $this->input->post('gerarProblemaRequisicoes'),

            'vProblemas' => $this->input->post('vProblemas'),
            'aProblemas' => $this->input->post('aProblemas'),
            'eProblemas' => $this->input->post('eProblemas'),
            'dProblemas' => $this->input->post('dProblemas'),

            'vMudancas' => $this->input->post('vMudancas'),
            'aMudancas' => $this->input->post('aMudancas'),
            'eMudancas' => $this->input->post('eMudancas'),
            'dMudancas' => $this->input->post('dMudancas'),

            'vDataHoraAbertura' => $this->input->post('vDataHoraAbertura'),
            'vDataHoraFechamento' => $this->input->post('vDataHoraFechamento'),

            'vCobit' => $this->input->post('vCobit'),
            'aCobit' => $this->input->post('aCobit'),
            'eCobit' => $this->input->post('eCobit'),
            'dCobit' => $this->input->post('dCobit'),

            'vHardware' => $this->input->post('vHardware'),
            'aHardware' => $this->input->post('aHardware'),
            'eHardware' => $this->input->post('eHardware'),
            'dHardware' => $this->input->post('dHardware'),

            'vSoftware' => $this->input->post('vSoftware'),
            'aSoftware' => $this->input->post('aSoftware'),
            'eSoftware' => $this->input->post('eSoftware'),
            'dSoftware' => $this->input->post('dSoftware'),

            'vRelatorioDemandas' => $this->input->post('vRelatorioDemandas'),
            'vRelatorioGraficos' => $this->input->post('vRelatorioGraficos'),

            'vConfigEmitente' => $this->input->post('vConfigEmitente'),
            'aConfigEmitente' => $this->input->post('aConfigEmitente'),

            'vConfigClientes' => $this->input->post('vConfigClientes'),
            'aConfigClientes' => $this->input->post('aConfigClientes'),
            'eConfigClientes' => $this->input->post('eConfigClientes'),
            'dConfigClientes' => $this->input->post('dConfigClientes'),

            'vConfigNivelAtendimento' => $this->input->post('vConfigNivelAtendimento'),
            'aConfigNivelAtendimento' => $this->input->post('aConfigNivelAtendimento'),
            'eConfigNivelAtendimento' => $this->input->post('eConfigNivelAtendimento'),
            'dConfigNivelAtendimento' => $this->input->post('dConfigNivelAtendimento'),

            'vConfigAcordoNivelServico' => $this->input->post('vConfigAcordoNivelServico'),
            'aConfigAcordoNivelServico' => $this->input->post('aConfigAcordoNivelServico'),
            'eConfigAcordoNivelServico' => $this->input->post('eConfigAcordoNivelServico'),
            'dConfigAcordoNivelServico' => $this->input->post('dConfigAcordoNivelServico'),

            'vConfigFluxoMudancas' => $this->input->post('vConfigFluxoMudancas'),
            'aConfigFluxoMudancas' => $this->input->post('aConfigFluxoMudancas'),
            'eConfigFluxoMudancas' => $this->input->post('eConfigFluxoMudancas'),
            'dConfigFluxoMudancas' => $this->input->post('dConfigFluxoMudancas'),

            'vConfigDepartamentos' => $this->input->post('vConfigDepartamentos'),
            'aConfigDepartamentos' => $this->input->post('aConfigDepartamentos'),
            'eConfigDepartamentos' => $this->input->post('eConfigDepartamentos'),
            'dConfigDepartamentos' => $this->input->post('dConfigDepartamentos'),

            'vConfigUsuarios' => $this->input->post('vConfigUsuarios'),
            'aConfigUsuarios' => $this->input->post('aConfigUsuarios'),
            'eConfigUsuarios' => $this->input->post('eConfigUsuarios'),
            'dConfigUsuarios' => $this->input->post('dConfigUsuarios'),

            'vConfigPermissoes' => $this->input->post('vConfigPermissoes'),
            'aConfigPermissoes' => $this->input->post('aConfigPermissoes'),
            'eConfigPermissoes' => $this->input->post('eConfigPermissoes'),
            'dConfigPermissoes' => $this->input->post('dConfigPermissoes'),

            'vConfigGweb' => $this->input->post('vConfigGweb'),
        );

        $permissoes = serialize($permissoes);

        $this->db->where('id_permissao', $this->input->post('id_permissao',true));
        return $this->db->update('tb_permissoes',array(
            'permissoes'=>$permissoes,
        ));
    }

    public function atualizar($id)
    {
        $this->db->where('id_permissao', $id);
        return $this->db->update('tb_permissoes',array(
            'nome'=>$this->input->post('nome',true),
            'permissoes'=>$this->input->post('permissoes',true),
            'situacao'=>$this->input->post('situacao',true)
        ));
    }

    public function desativar($id)
    {
        $this->db->where('id_permissao', $id);
        return $this->db->update('tb_permissoes',array(
            'situacao'=>$this->input->post('situacao_ativar_desativar',true)
        ));
    }
    
    public function deletar($id)
    {
        return $this->db->delete('tb_permissoes', array('id_permissao' => $id)); 
    }

    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id_permissao';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;

        $id_permissao = isset($_POST['id_permissao']) ? strval($_POST['id_permissao']) : '';
        $nome = isset($_POST['nome']) ? strval($_POST['nome']) : '';
        
        $this->db->select('*');
        $this->db->from('tb_permissoes');
        $this->db->limit($rows, $offset);
        $this->db->order_by($sort, $order);
        $this->db->like('id_permissao', $id_permissao);
        $this->db->like('nome', $nome);

        $criteria = $this->db->get();

        $result = array();
        $result['total'] = $criteria->num_rows();
        $row = array();
        
        foreach($criteria->result_array() as $data)
        {
            $row[] = array(
                'id_permissao'=>$data['id_permissao'],
                'nome'=>$data['nome'],
                'permissoes'=>$data['permissoes'],
                'situacao'=>$data['situacao']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
}