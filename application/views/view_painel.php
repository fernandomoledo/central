<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Conteúdo da página -->
    <div class="container-fluid">
      <!-- Título -->
      <div class="row">
        <div class="col-md-12 text-center">
          <h1><a href="base.html" style="text-decoration: none">Painel de Chamados</a></h1>
        </div>
      </div>
      <div class="push2"></div>
      <!-- Classificação por períodos -->
  
      <div class="row text-center">
        <h4><?php echo utf8_encode($dados['LOTACAO']);?></h4>
      </div>
     
      <div class="push2"></div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-9 separator">
            <div class="col-md-4 text-center" id="chamados-todo"></div>
            <div class="col-md-4 text-center" id="chamados-doing"></div>
            <div class="col-md-4 text-center" id="chamados-done"></div>
          </div>
          <div class="col-md-3">
            <div class="text-center"><h3>Avisos</h3></div>
            <div class="text-center"><a href="painel/avisos" target="_blank">Ver avisos anteriores</a></div>
            <div id="avisos_chat"></div>
            <textarea class="form-control" rows="2" placeholder="Digite o texto do aviso e tecle Enter..." id="txt_aviso" name="txt_aviso"></textarea>
            <div class="push1"></div>
            <div class="text-center">
              <input type="button" class="btn btn-success" id="btn-aviso" value="Avisar" />
            </div>
        </div>
      </div>
    </div>