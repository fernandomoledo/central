<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 <!-- Conteúdo da página -->
    <div class="container-fluid">
      <!-- Título -->
      <div class="row">
      <div class="push3"></div>
        <div class="col-md-12 text-center">
          <h1>Central de Chamados - CAU</h1>
        </div>
      </div>
      <div class="push3"></div>
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="col-md-3"></div>
          <div class="col-md-6">
          <?php alerta(); ?>
           <form method="post" action="<?php echo base_url().'index/login'; ?>">
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2">Usuário:</span>
              <input type="text" name="txt_usuario" id="txt_usuario" class="form-control" placeholder="Informe seu usuário da extranet..." aria-describedby="sizing-addon2" required />
            </div>
            <div class="push2"></div> 
            <div class="text-right">
                <input type="submit" class="btn btn-primary" value="Entrar" />
            </div>
            </form>
          <div class="col-md-3"></div>
        </div>
      </div>           
    </div>
    <!-- Fim Conteúdo da página -->