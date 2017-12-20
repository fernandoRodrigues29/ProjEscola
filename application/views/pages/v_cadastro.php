            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <?php echo validation_errors(); ?>
             <?php 
                if($mensagem_retorno):
                  echo '<div class="alert '.$mensagem_retorno['tipo'].' alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        '.$mensagem_retorno['msg'].'  
                        </div>';
                endif;
             ?>
            
             <?php echo form_open($urlContoroller,array('class'=>'login-form')); ?>
            <div class="box-body">
                <?php

                  foreach ($camposHTML as $key => $value) {
                    echo '<div class="form-group">';
                      echo form_label($key);
                      echo form_input($value);
                    echo '</div>';
                  }
               ?>
            </div><!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="../c_aluno" class="btn btn-info">Voltar</a>
            </div><!-- /.box-footer-->
            <?php 
              echo form_close();
            ?>