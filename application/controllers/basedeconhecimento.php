<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basedeconhecimento extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario'))
			redirect(base_url());
		
		$this->load->model('model_categoria');
		$this->load->model('model_basedeconhecimento');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($p1 = 0, $p2 = 0, $p3 = 0, $p4 = 0)
	{
		$url = base_url();
		$i = 0;
		$this->data['breadcrumb'] = array();
		foreach ($this->uri->segment_array() as $s) {
			$url .= $s.'/';
	
			if($i > 0){
				$categoria = $this->model_categoria->busca_categoria_por_id($s);
				$this->data['breadcrumb'][] = array('link' => base_url().'basedeconhecimento/'.$categoria['pai'].'/'.$s, 'valor' => utf8_decode($categoria['nome_categoria']));
			}else{
				$this->data['breadcrumb'][] = array('link' => base_url().'basedeconhecimento', 'valor' => 'In&iacute;cio');
			}
			$i++;
		}


		$ultimo =  $this->uri->segment(count($this->uri->segment_array()));

		$retorno = $this->model_categoria->lista_geral_por_pai($ultimo);

		$this->data['categorias'] = $retorno;

		$this->data['chamados'] = array();
		$tipo = $this->uri->segment(2);
	
		$dados_termo = array();
		$termo = "";
		$chamados = array();

		if($tipo == '1' && $retorno == null){
			$id_termo = $this->uri->segment(count($this->uri->segment_array())-1);
			$id_equipamento = $this->uri->segment(count($this->uri->segment_array()));
			
			$dados_termo = $this->model_categoria->busca_categoria_por_id($id_termo);
			$dados_equipamento = $this->model_categoria->busca_categoria_por_id($id_equipamento);

			$termo = $dados_termo['termo_categoria'] != "" ? $dados_termo['termo_categoria'] : $dados_termo['nome_categoria'];
			$equipamento = $dados_equipamento['termo_categoria'] != "" ? $dados_equipamento['termo_categoria'] : $dados_equipamento['nome_categoria'];

			$chamados = $this->model_basedeconhecimento->busca_base_com_tombo(strtoupper(utf8_decode($termo)), strtoupper(utf8_decode($equipamento)));

			/*foreach ($chamados as $ch) {
				$c = $this->model_basedeconhecimento->busca_chamado($ch['ID']);
				$ch['numero'] = $c['NUMERO'];
				$ch['ano'] = $c['ANO'];
				$ch['dt_andamento'] = $c['DT_ANDAMENTO'];
				$this->data['chamados'][] = $ch;
			}*/
				$this->data['chamados'] = $chamados;

			if(stripos($dados_termo['nome_categoria'], " ") !== false)
				$termo = substr($dados_termo['nome_categoria'], 0, stripos($dados_termo['nome_categoria'], " ") );
			else
				$termo = $dados_termo['nome_categoria'];

		}else if($tipo == '2' && $retorno == null){
			$id_termo = $this->uri->segment(count($this->uri->segment_array()));
			
			$dados_termo = $this->model_categoria->busca_categoria_por_id($id_termo);

			$termo = $dados_termo['termo_categoria'] != "" ? $dados_termo['termo_categoria'] : $dados_termo['nome_categoria'];

			$chamados = $this->model_basedeconhecimento->busca_base_sem_tombo(strtoupper(utf8_decode($termo)));

			/*foreach ($chamados as $ch) {
				$c = $this->model_basedeconhecimento->busca_chamado($ch['ID']);
				$ch['numero'] = $c['NUMERO'];
				$ch['ano'] = $c['ANO'];
				$ch['dt_andamento'] = $c['DT_ANDAMENTO'];
				$this->data['chamados'][] = $ch;
			}*/
			$this->data['chamados'] = $chamados;
			if(stripos($dados_termo['nome_categoria'], " ") !== false)
				$termo = substr($dados_termo['nome_categoria'], 0, stripos($dados_termo['nome_categoria'], " ") );
			else
				$termo = $dados_termo['nome_categoria'];
		}

		$this->session->set_userdata('termo', $termo);
		$this->data['termo_busca'] =  $termo;
		if($chamados) $this->data['tem_chamados'] = true; else $this->data['tem_chamados'] = false;
		$this->data['url'] = $url;
		$this->load->view('view_topo');
		$this->load->view('view_basedeconhecimento', $this->data);
		$this->load->view('view_rodape');
	}

	public function busca()
	{
		$termo_busca = $this->input->post('txt_busca');

		$this->data['breadcrumb'] = array();
		$this->data['breadcrumb'][] = array('link' => base_url().'basedeconhecimento', 'valor' => 'In&iacute;cio');
		$this->data['breadcrumb'][] = array('link' => '#!', 'valor' => 'Busca');
		$this->data['breadcrumb'][] = array('link' => '#!', 'valor' => utf8_decode($termo_busca));

		$this->data['categorias'] = array();
		//var_dump($termo_busca); //die();
		$chamados = array();
		$chamados = $this->model_basedeconhecimento->busca_geral($termo_busca);

		if($chamados != null){
			$this->data['tem_chamados'] = true;
			foreach ($chamados as $ch) {
					$c = $this->model_basedeconhecimento->busca_chamado($ch['ID']);
					$ch['numero'] = $c['NUMERO'];
					$ch['ano'] = $c['ANO'];
					$ch['dt_andamento'] = $c['DT_ANDAMENTO'];
					$this->data['chamados'][] = $ch;
			}
		}else{
			$this->data['chamados'] = array();
			$this->data['tem_chamados'] = false;
		}

		$this->session->set_userdata('termo', utf8_encode($termo_busca));
		$this->data['termo_busca'] = $termo_busca;
		$this->load->view('view_topo');
		$this->load->view('view_basedeconhecimento', $this->data);
		$this->load->view('view_rodape');
	}

	public function detalhe($id = 0){
		sleep(1);

		$informacoes = $this->model_basedeconhecimento->info_chamado($id);

		//var_dump($this->session->userdata('termo'));
		//var_dump(($informacoes));

		$informacoes['TEXTO'] = str_ireplace(utf8_decode($this->session->userdata('termo')), "<span class='destaque'>".(utf8_decode($this->session->userdata('termo')))."</span>", ($informacoes['TEXTO']));
		$informacoes['NOME'] = str_ireplace(utf8_decode($this->session->userdata('termo')), "<span class='destaque'>".(utf8_decode($this->session->userdata('termo')))."</span>", ($informacoes['NOME']));

		//var_dump(utf8_encode(strtolower(utf8_decode($this->session->userdata('termo'))).'#'.$informacoes['TEXTO']));

		$retorno = '<h3>Chamado '.$informacoes['NUMERO'].'/'.$informacoes['ANO'].'</h3>
		<a href="https://www.trt15.jus.br/centralChamados/chamado.do?acao=editarChamado&idChamado='.$id.'" target="_blank" title="Lembre-se de estar logado na Central de Chamados para poder visualizar o chamado...">Ver na Central de Chamados</a><div class="push2"></div>
            <h4>Data de Abertura</h4>
            <p>'.$informacoes['DT_ANDAMENTO'].'</p><div class="push05"></div>
            <h4>Lotação</h4>
            <p>'.utf8_encode($informacoes['NOME']).'</p><div class="push05"></div>
            <h4>Problema relatado</h4>
            <p>'.utf8_encode($informacoes['TEXTO']).'</p><div class="push05"></div>
            <h4>Equipamentos</h4>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nº Tombo</th><th>Nº Série</th><th>Garantia</th><th>Descrição</th>
                </tr>
              </thead>
              <tbody>';
        $tombos = $this->model_basedeconhecimento->tombos_chamado($id);
        foreach ($tombos as $t) {
        	$t['DESCRICAO'] = str_ireplace(utf8_decode($this->session->userdata('termo')), "<span class='destaque'>".(utf8_decode($this->session->userdata('termo')))."</span>", ($t['DESCRICAO']));
        	$t['SERIE'] = str_ireplace(utf8_decode($this->session->userdata('termo')), "<span class='destaque'>".(utf8_decode($this->session->userdata('termo')))."</span>", ($t['SERIE']));
        	$t['NRO_TOMBO'] = str_ireplace(utf8_decode($this->session->userdata('termo')), "<span class='destaque'>".(utf8_decode($this->session->userdata('termo')))."</span>", ($t['NRO_TOMBO']));
        	 $retorno .= '<tr>
        				<td>'.$t['NRO_TOMBO'].'</td>
        				<td>'.$t['SERIE'].'</td>
        				<td>'.$t['DT_GARANTIA'].'</td>
        				<td>'.utf8_encode($t['DESCRICAO']).'</td>
               		 </tr>';
        }
       	
       	$andamentos = $this->model_basedeconhecimento->andamentos_chamado($id);

       	$retorno .= '</tbody></table>';
       	$retorno .= '<h4>Último atendimento</h4>
            <p>'.$andamentos[0]['DT_ANDAMENTO'].' - '.$andamentos[0]['NOME'].'</p><div class="push05"></div>
            <h4>Andamentos do Chamado</h4><table class="table table-striped">
              <thead>
                <tr>
                  <th>Data/Hora</th><th>Status</th><th>Usuário</th><th>Descrição</th>
                </tr>
              </thead>
              <tbody>';

         foreach ($andamentos as $a) {
         	$a['TEXTO'] = str_ireplace(utf8_decode($this->session->userdata('termo')), "<span class='destaque'>".(utf8_decode($this->session->userdata('termo')))."</span>", ($a['TEXTO']));
         	$retorno .= '<tr>
                  			<td>'.$a['DT_ANDAMENTO'].'</td>
                  			<td>'.utf8_encode($a['CLASSIFICACAO']).'</td>
                  			<td>'.utf8_encode($a['NOME']).'</td>
                  			<td>'.utf8_encode($a['TEXTO']).'.</td>
                		</tr>';
         }

         $retorno .= '</tbody></table>';      


            echo $retorno;
	}
}
