<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
	class C_Aluno extends CI_Controller {
		function __construct(){
			parent::__construct();
			if($this->session->userdata('logado') != TRUE):
				redirect('index.php/c_login/sair','refresh');
			endif;
			$this->load->helper('form');
			$this->load->model('auxiliar');
		}

		function index() {
			$this->gerenciar();
		}

		function cadastrar() {

			$campos = array(
				'nome'  => array(
					'type'  => 'text',
                    'name'  => 'nome',
                    'class' => 'form-control'
				),
				'email' => array(
					'type'  => 'email',
                    'name'  => 'email',
                    'class' => 'form-control'
				),
				'login' => array(
					'type'  => 'text',
                    'name'  => 'login',
                    'class' => 'form-control'
				),
				'senha' => array(
					'type'  => 'password',
                    'name'  => 'senha',
                    'class' => 'form-control'
				)			
			);
			
			$componentes = array(
				'urlContoroller'=>'c_aluno/cadastrar',
				'mensagem_retorno'=>NULL,
				'camposHTML'=>$campos
			);

			if($this->input->post()){
				$validarCampos = array( 
		        array ( 
		                'field'  =>  'login' , 
		                'label'  =>  'Login' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'senha' , 
		                'label'  =>  'Senha' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'nome' , 
		                'label'  =>  'Nome' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'email' , 
		                'label'  =>  'E-mail' , 
		                'rules'  =>  'trim|required' 
		        ) 
			);

				$this->form_validation->set_rules($validarCampos);
					if($this->form_validation->run() == FALSE){
					$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');							
					}else{
						$dados['nome'] = $this->input->post('nome');
						$dados['login'] = $this->input->post('login');
						$dados['email'] = $this->input->post('email');
						$dados['senha'] = md5($this->input->post('senha'));	

						$retorno = $this->auxiliar->inserir('aluno',$dados);
							if($retorno){
								$componentes['mensagem_retorno'] = array('tipo'=>'alert-success','msg'=>'Aluno cadastrado com sucesso');
							}else {
								$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'Erro no Cadastro');
							}
					}

			} 

			$paginasColecao['conteudo'] = $this->load->view('pages/v_cadastro',$componentes,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);

		}

		function editar($id) {
			//bloqueio para redirecionar quando o id for nullo ou literal
			if(empty($id) || !intval($id)){
				redirect('c_aluno/gerenciar');
			}
			
			//carregar infromaçãoes do usuario 
			$retorno = $this->auxiliar->selectClausula('aluno','nome,email,login',array('id'=>$id));
			if(count($retorno)==0){
				redirect('c_aluno/gerenciar');
			}
			$rs = $retorno[0];

			/**/
			$campos = array(
				'nome'  => array(
					'type'  => 'text',
                    'name'  => 'nome',
                    'class' => 'form-control',
                    'value' => $rs['nome']
				),
				'email' => array(
					'type'  => 'email',
                    'name'  => 'email',
                    'class' => 'form-control',
                    'value' => $rs['email']
				),
				'login' => array(
					'type'  => 'text',
                    'name'  => 'login',
                    'class' => 'form-control',
                    'value' => $rs['login']
				),
				'senha' => array(
					'type'  => 'password',
                    'name'  => 'senha',
                    'class' => 'form-control'
				)			
			);
			$hidden = array('id' => $id);
			
			$componentes = array(
				'urlContoroller'=>'c_aluno/editar/'.$id,
				'mensagem_retorno'=>NULL,
				'camposHTML'=>$campos,
				'hidden'=>$hidden
			);

			if($this->input->post()) {
				$validarCampos = array( 
		        array ( 
		                'field'  =>  'login' , 
		                'label'  =>  'Login' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'nome' , 
		                'label'  =>  'Nome' , 
		                'rules'  =>  'trim|required' 
		        ), 
		        array ( 
		                'field'  =>  'email' , 
		                'label'  =>  'E-mail' , 
		                'rules'  =>  'trim|required' 
		        ) 
			);

				$this->form_validation->set_rules($validarCampos);
					if($this->form_validation->run() == FALSE){
					$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'erro no cadastro, campos incorretos');							
					}else{
						//trata daddos
						$id = $this->input->post('id');
						$dados['nome'] = $this->input->post('nome');
						$dados['login'] = $this->input->post('login');
						$dados['email'] = $this->input->post('email');
							if($this->input->post('senha') != ''){
								$dados['senha'] = md5($this->input->post('senha'));	
							}
							//clausulas
								$where = array('id'=>$id);
								//retorno da query
								$retorno = $this->auxiliar->atualizar('aluno',$dados,$where);
									/**/
								if($retorno){
									$this->session->set_userdata('mensagem_retorno',array('tipo'=>'alert-info','msg'=>'Aluno Atualizado com sucesso'));
										redirect('c_aluno/gerenciar');
								}else {
									$componentes['mensagem_retorno']=array('tipo'=>'alert-danger','msg'=>'Erro na Atualização');
								}
									/**/
					}
			} 

			$paginasColecao['conteudo'] = $this->load->view('pages/v_editar',$componentes,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
			/**/
		}
		function teste(){
			echo 'teste';
			$this->auxiliar->selectSimples('aluno');
			$retrun = $this->auxiliar->atualizar2();
			echo $retrun;
		}
		function gerenciar() {
			$paginasColecao['cabecalho'] = array('titulo'=>'Aluno','subtitulo'=>'Gerenciador de Aluno');
			$paginasColecao['conteudo'] = $this->load->view('pages/v_gerenciar',NULL,TRUE);
			$this->load->view('v_conteiner',$paginasColecao);
		}

		function deletar($id) {
			if(empty($id) || !intval($id)){
				$this->session->set_userdata('mensagem_retorno',array('tipo'=>'alert-danger','msg'=>'id não localizado'));
				redirect('c_aluno/gerenciar');
			}
			
			$retorno = $this->auxiliar->excluir('aluno',array('id'=>$id));
				if($retorno){
					$this->session->set_userdata('mensagem_retorno',array('tipo'=>'alert-info','msg'=>'Aluno excluido com sucesso'));
					    redirect('c_aluno/gerenciar');
				}else {
					$this->session->set_userdata('mensagem_retorno',array('tipo'=>'alert-danger','msg'=>'Erro na Exclusão'));
					redirect('c_aluno/gerenciar');
				}


		}

		function listar_jsonEncode() {

			$conteudo = $this->auxiliar->selectCampos('aluno','id,nome,email');
			$data = array('data'=>$conteudo);
			//echo var_dump($data);				
			echo json_encode($data);

		}
	}
?>