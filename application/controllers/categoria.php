<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		if(!$this->session->userdata('usuario'))
			redirect(base_url());

		$this->load->model('model_categoria');
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
		$sem_pai = $this->model_categoria->lista_categorias_sem_pai('');
		$com_pai = $this->model_categoria->lista_categorias_com_pai('');		

		//var_dump(($com_pai)); die();
		$this->data['categorias_sem_pai']= $sem_pai;
		$this->data['categorias_com_pai']= $com_pai;

	
		$this->load->view('view_topo');
		$this->load->view('view_categoria', $this->data);
		$this->load->view('view_rodape');
	}

	public function adicionar(){
		$dados_form = $this->input->post();

		$dados = array();
		$dados['nome_categoria'] = $dados_form['nome_categoria'];
		$dados['termo_categoria'] = $dados_form['termo_categoria'];

		if($dados_form['id_categoria'] > 0){
			$dados['id_categoria'] = $dados_form['id_categoria'];
			if($this->model_categoria->update_categoria($dados)){
				$this->session->set_flashdata('sucesso', 'Categoria alterada com sucesso.');
			}else{
				$this->session->set_flashdata('erro', 'Houve um erro ao alterar a categoria...');			
			}
		}else if($this->model_categoria->insere_categoria($dados)){
			$this->session->set_flashdata('sucesso', 'Categoria salva com sucesso.');
		}else{
			$this->session->set_flashdata('erro', 'Houve um erro ao salvar a categoria. Verifique se ela já existe.');			
		}
		redirect(base_url().'categoria');
	}

	public function editar($id = 0){
		$dados = $this->model_categoria->busca_categoria_por_id($id);
		$this->data['c_editar'] = $dados;

		$this->index();
	}

	public function excluir($id = 0){
		if($this->model_categoria->remove_categoria($id)){
			$this->session->set_flashdata('sucesso', 'Categoria excluída com sucesso.');
		}else{
			$this->session->set_flashdata('erro', 'Houve um erro ao excluir a categoria. Verifique se a mesma não é pai de outra categoria.');			
		}
		redirect(base_url().'categoria');
	}

	public function excluir_amarracao($pai = 0, $filha = 0){
		$dados = array();
		$dados['pai'] = $pai;
		$dados['filha'] = $filha;

		if($this->model_categoria->remove_amarracao($dados)){
			$this->session->set_flashdata('sucesso', 'Amarração removida com sucesso.');
		}else{
			$this->session->set_flashdata('erro', 'Houve um erro ao excluir a amarração.');			
		}
		redirect(base_url().'categoria');
	}

	public function listar($termo = ""){
		$retorno = $this->model_categoria->lista_categorias($termo);

		$this->data['categorias']= array();

		foreach($retorno as $r){
			if($r['categoria_pai'] != null)
				$pai = $this->model_categoria->busca_categoria_por_id($r['categoria_pai']);
			else
				$pai = $this->model_categoria->busca_categoria_por_id(0);
			$r['categoria_pai'] = isset($pai['nome_categoria']) ? $pai['nome_categoria'] : '---';

			$this->data['categorias'][] = $r;
		}

		$this->load->view('view_topo');
		$this->load->view('view_categoria', $this->data);
		$this->load->view('view_rodape');
	}

	public function categorias_complete(){
		$termo = $this->input->get('term');
		$dados = $this->model_categoria->lista_categorias($termo);
		//var_dump($dados);
		$dados2 = array();
		foreach ($dados as $d) {
			$dados2[] = $d['nome_categoria'];
		}
		echo  json_encode($dados2);
	}

	public function amarrar(){
		$dados_form = $this->input->post();

		$pai = $this->model_categoria->busca_categoria_por_nome($dados_form['categoria_pai']);
		$filha = $this->model_categoria->busca_categoria_por_nome($dados_form['categoria_filha']);

		$dados = array();
		$dados['pai'] = $pai['id_categoria'];
		$dados['filha'] = $filha['id_categoria'];

		if($dados['pai'] == $dados['filha'])
			$this->session->set_flashdata('erro', 'Categorias PAI e FILHA não podem ser iguais.');	
		else if($this->model_categoria->insere_amarracao($dados))
			$this->session->set_flashdata('sucesso', 'Amarração realizada com sucesso.');
		else
			$this->session->set_flashdata('erro', 'Houve um erro ao realizar a amarração das categorias.');			
		redirect(base_url().'categoria');
	}
}
