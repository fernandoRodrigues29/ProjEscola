<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Maincontroller extends CI_Controller {
	private $nomeUsuario;
	private $emailUsuario;
	function Maincontroller(){
		parent::__construct();
		if($this->session->userdata('logado') != TRUE):
			redirect('c_login/sair','refresh');
		endif;
		//$this->load->library('Pessoa');
	}

	public function index() {
		$dadosUsuario = $this->session->userdata('usuario');
			/**
			$pessoa = new Pessoa();
			$pessoa->setNome($dadosUsuario['nome']);
			$pessoa->setContato($dadosUsuario['email']);
			**/	
			$this->load->view('v_conteiner');		
	}
}
?>
