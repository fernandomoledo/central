<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		if(!$this->session->userdata('usuario'))
			redirect(base_url());

		$this->load->model('model_painel');
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
	public function index()
	{
		
		$usuario = $this->session->userdata('usuario');

		//echo getenv("USERNAME");
		
		$meus_dados = $this->model_painel->get_lotacao($usuario);
		$this->session->set_userdata('lotacao', $meus_dados['ID']);

		$this->data['dados'] = $meus_dados;

		//var_dump(($meus_dados));
		$this->load->view('view_topo');
		$this->load->view('view_painel', $this->data);
		$this->load->view('view_rodape');
	}

	public function chat(){
		$usuario = $this->session->userdata('usuario');
		$meus_dados = $this->model_painel->get_lotacao($usuario);
		
	}

	public function add_aviso(){
		$dados = $this->input->post();
		$dados['usuario'] = $this->session->userdata('usuario');

		if($this->model_painel->add_aviso($dados)){
			$this->get_avisos();
		}

	}
	public function get_avisos(){
		$retorno = "";
		$chats = $this->model_painel->lista_avisos_recentes();

			for ($i = 4; $i >= 0; $i--) {
				$retorno .=  '<div class="alert alert-warning  fade in">
	              <strong>'.date('d/m/Y H:i:s',strtotime($chats[$i]['data_chat'])).' - '.$chats[$i]['usuario_chat'].':</strong><br />'.$chats[$i]['texto_chat'].'
	            </div>';
	         }
	         echo $retorno;
	}

	public function avisos(){
		$this->data['avisos'] = $this->model_painel->lista_avisos_full();
		$this->load->view('view_topo');
		$this->load->view('view_avisos', $this->data);
		$this->load->view('view_rodape');
	}

	public function get_todo(){
		$lotacao = $this->session->userdata('lotacao');
		$todo = $this->model_painel->get_todo($lotacao);

		$retorno = "<h3>A Fazer</h3>";
        if(!$todo) $retorno .= "Não existem chamados a fazer hoje ".date('d/m/Y'); 

        foreach ($todo as $td){               
            if(substr($td['NOME'],0,8) == 'GABINETE' || stripos($td['NOME'], 'PRESIDÊNCIA' !== false)){ 
	             $retorno .= "<a href='https://www.trt15.jus.br/centralChamados/chamado.do?acao=editarChamado&idChamado=".$td['ID']."' target='_blank' title='Clique para abrir na Central de Chamados. Lembre-se de estar logado na Central de Chamados para poder visualizar o chamado...'>";
	             $retorno .= " <div class='alert alert-danger'>
	                <strong>".$td['NUMERO']. "/" . $td['ANO']."</strong>
	                <div class='push05'></div>
	                  <strong>".utf8_encode($td['NOME'])."</strong>
	                <div class='push05'></div>".utf8_encode(substr($td['TEXTO'],0,100))."(...)
	              </div>
	              </a>";           
            }else{
                continue;
            }
          }//fecha o fereach
           
         foreach ($todo as $td){
               
            if(substr($td['NOME'],0,8) != 'GABINETE' || stripos($td['NOME'], 'PRESIDÊNCIA' === false)){ 
          
                $retorno .= "<a href='https://www.trt15.jus.br/centralChamados/chamado.do?acao=editarChamado&idChamado=".$td['ID']."' target='_blank' title='Clique para abrir na Central de Chamados. Lembre-se de estar logado na Central de Chamados para poder visualizar o chamado...'>";
                $retorno .= "<div class='alert alert-warning'>
                <strong>".$td['NUMERO'] . "/" . $td['ANO']. "</strong>
                <div class='push05'></div>
                  <strong>".utf8_encode($td['NOME'])."</strong>
                <div class='push05'></div>".utf8_encode(substr($td['TEXTO'],0,100))."(...)
              </div>
              </a>";
                 }else{
                   continue;
                 }
           }//fecha o foreach
           echo $retorno;
	}

	public function get_doing(){
		$lotacao = $this->session->userdata('lotacao');
		$doing = $this->model_painel->get_doing($lotacao);

		$retorno = "<h3>Em andamento</h3>";
        if(!$doing) $retorno .= "Não existem chamados em andamento hoje ".date('d/m/Y'); 

        foreach ($doing as $dn){               
	             $retorno .= "<a href='https://www.trt15.jus.br/centralChamados/chamado.do?acao=editarChamado&idChamado=".$dn['ID']."' target='_blank' title='Clique para abrir na Central de Chamados. Lembre-se de estar logado na Central de Chamados para poder visualizar o chamado...'>";
	             $retorno .= " <div class='alert alert-success'>
	                <strong>".$dn['NUMERO']. "/" . $dn['ANO']."</strong>
	                <div class='push05'></div>
	                  <strong>".utf8_encode($dn['NOME'])."</strong>
	                <div class='push05'></div>".utf8_encode(substr($dn['TEXTO'],0,100))."(...)
	              </div>
	              </a>";           
          }//fecha o fereach
           echo $retorno;
	}

	public function get_done(){
		$lotacao = $this->session->userdata('lotacao');
		$done = $this->model_painel->get_done($lotacao);

		$retorno = "<h3>Concluídos</h3>";
        if(!$done) $retorno .= "Não existem chamados concluídos hoje ".date('d/m/Y'); 

        foreach ($done as $d){               
	             $retorno .= "<a href='https://www.trt15.jus.br/centralChamados/chamado.do?acao=editarChamado&idChamado=".$d['ID']."' target='_blank' title='Clique para abrir na Central de Chamados. Lembre-se de estar logado na Central de Chamados para poder visualizar o chamado...'>";
	             $retorno .= " <div class='alert alert-info'>
	                <strong>".$d['NUMERO']. "/" . $d['ANO']."</strong>
	                <div class='push05'></div>
	                  <strong>".utf8_encode($d['NOME'])."</strong>
	                <div class='push05'></div>".utf8_encode(substr($d['TEXTO'],0,100))."(...)
	              </div>
	              </a>";           
          }//fecha o fereach
           echo $retorno;
	}

/*
	public function teste(){
		$texto = "O rato roeu a roupa do rei de Roma";
		$parte = substr($texto, (stripos($texto, "rei") - 10), 10);
		//echo stripos($texto, "rei");
		//echo "<br />";
		
		//str_replace(search, replace, subject)
			
		//echo "<br />";
		$parte .= substr($texto, stripos($texto, "rei"), 10);

		echo "(...)" . str_replace("rei", "<mark>rei</mark>", $parte ) . "(...)";
	}
	
	*/
}
