    <div class="box-header">
      <div class="row">
        <div class="col-md-4">
          <a href="<?php echo base_url('c_aluno/cadastrar');?>" class="btn-success btn-lg">Cadastrar</a>  
        </div>
      </div>
      <div class="row">
        <?php 
                if($mensagem_retorno = $this->session->userdata('mensagem_retorno')):
                  echo '<div class="alert '.$mensagem_retorno['tipo'].' alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        '.$mensagem_retorno['msg'].'  
                        </div>';
                 $this->session->unset_userdata('mensagem_retorno');       
                endif;
             ?> 
      </div>
       
    </div><!-- /.box-header -->
    <div class="box-body">
       <table class="table table-hover" id="tabelaJSON">
          <thead>
            <tr>
              <th>ID</th>
              <th>nome</th>
              <th>email</th>
              <th><span class="label bg-info" style="color:#000">editar</span></th>
              <th><span class="label bg-danger" style="color:#000">excluir</span></th>
             </tr>
          </thead>
       </table>
    </div><!-- /.box-body -->
<script type="text/javascript">
  $(document).ready(function() {
   $('#tabelaJSON').DataTable({
       "ajax": "<?php echo base_url('c_aluno/listar_jsonEncode');?>",
       "columns": [
        {"data": "id" },
        {"data": "nome" },
        {"data": "email" },
        { render: function(data, type, row){
            return "<a href='editar/"+row.id+"''>Editar</a>"
          } 
        },
        { render: function(data, type, row){
            return "<a href='c_aluno/deletar/"+row.id+"''>excluir</a>"
          } 
        }
       ]
    });
   /**
    $('#tabelaJSON').DataTable({
       "ajax": "<?php echo base_url('c_aluno/listar_jsonEncode');?>",
       "columns": [
        {"data": "id" },
        {"data": "nome" },
        {"data": "email" },
        {"defaultContent":"<a href=''>X</a>" }
       ]
    });
    /**
    $('#tabelaJSON').DataTable({
       "ajax": "<?php echo base_url('c_aluno/listar_jsonEncode');?>",
         "columnDefs": [ {
          "targets": -1,
          "data": null,
          "defaultContent": "Click to edit"
        } ]
    });
    /**/
    /*{ render : function() {
             return '<button>edit</button>'
         }
       }*/
});
</script>