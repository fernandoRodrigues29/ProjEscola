<?php
class C_login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}	
	public function index() {
		$this->load->view('login',array('msgErro'=>FALSE));
	}
	public function autenticacao(){
		$this->load->model('auxiliar');
        // $this->load->library('pessoa');


		$config = array( 
	        array ( 
	                'field'  =>  'usuario' , 
	                'label'  =>  'Usuario' , 
	                'rules'  =>  'trim|required' 
	        ), 
	        array ( 
	                'field'  =>  'senha' , 
	                'label'  =>  'Senha' , 
	                'rules'  =>  'trim|required' 
	        ) 
		);
		$this->form_validation->set_rules($config);
			if($this->form_validation->run() == FALSE){
				$this->load->view('login',array('msgErro'=>FALSE));			
			}else{
				$dados['login'] = $this->input->post('usuario');
				$dados['senha'] = md5($this->input->post('senha'));
					 
					 $tabela = 'aluno';
					 $campos = 'nome,email';
					 $clausulas = $dados;
					 $resultSet =  $this->auxiliar->selectClausula($tabela,$campos,$clausulas);
					
						 if(count($resultSet) == 1):
						 	$dadosUsuario = $resultSet[0];
						 	$this->session->set_userdata('logado',TRUE);
						 	
						 	$colecaoUsuaro = array('nome' => $dadosUsuario['nome'],
						 		  'email' => $dadosUsuario['email']);

						 	$this->session->set_userdata('usuario',$colecaoUsuaro);
						 	redirect('index.php/maincontroller'); 
						 else:
						 	$this->load->view('login',array('msgErro'=>'Acesso negado!'));
						 endif;	
			}	
		
	}
	function sair(){
		$this->session->sess_destroy();
		redirect('index.php/c_login','refresh');
	}
}
?>