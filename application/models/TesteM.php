<?php 
	class TesteM extends CI_Model{
		function __construct(){
                        parent::__construct();
                }
  
                /* Método responsável por atualizar os dados de uma pessoa
                 * Devemos atribuir o id do pessoa que queremos atualizar
                 * e o CI se responsabiliza por fazer a atualização
                 */
                function selecionar(){
                        $rs = $this->db->query('select * from aluno');
                        
                        echo var_dump($rs->result_array());
                }

                function atualizar(){
                        $this->db->where('id', 1);
                        $conteudo = array('nome'=>'don pedroka');
                        $this->db->update('aluno', $conteudo);
                }

	}
?>