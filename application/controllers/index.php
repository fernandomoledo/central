<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model('model_categoria');
		$this->load->model('model_usuario');
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
		$this->load->view('view_topo_index');
		$this->load->view('view_index');
		$this->load->view('view_rodape');
	}

	public function login(){
		$dados = $this->input->post();

		$retorno = $this->model_usuario->get_login($dados['txt_usuario']);

		$retorno = 1;
		
		if($retorno){
			$this->session->set_userdata('usuario', $dados['txt_usuario']);
			redirect(base_url().'painel');
		}else{
			$this->session->set_flashdata('erro', 'Usuário não encontrado.');	
			redirect(base_url());
		}
	}

	public function logout(){
		$this->session->unset_userdata('usuario');
		$this->session->unset_userdata('dados');
		redirect(base_url());
	}
	
}
