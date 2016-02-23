<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('alerta')){
	function alerta(){
		$CI =& get_instance();
		if($CI->session->flashdata('sucesso')){
			echo '<div class="alert alert-success">
			  '.$CI->session->flashdata('sucesso').'
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}else if($CI->session->flashdata('erro')){
			echo '<div class="alert alert-danger">
			  '.$CI->session->flashdata('erro').'
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}else if($CI->session->flashdata('alerta')){
			echo '<div class="alert alert-warning">
			  '.$CI->session->flashdata('alerta').'
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			</div>';
		}
	}
}