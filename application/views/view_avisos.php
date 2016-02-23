<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<META HTTP-EQUIV="REFRESH" CONTENT="60" />
  <!-- Conteúdo da página -->
    <div class="container-fluid">
      <!-- Título -->
      <div class="row">
        <div class="col-md-12 text-center">
          <h1><a href="base.html" style="text-decoration: none">Painel de Chamados - Avisos</a></h1>
        </div>
      </div>
      <div class="push2"></div>
      <!-- Classificação por períodos -->
  
      <div class="row text-center">
        <h4><?php echo utf8_encode($dados['LOTACAO']);?></h4>
      </div>
     
      <div class="push2"></div>
      <div class="row">
        <table>
            <thead>
              <tr><th>Data</th><th>Usuário</th><th>Aviso</th></tr>
            </thead>
            <tbody>
              <?php foreach ($avisos as $a): ?>
                <tr>
                  <td><?php echo date('d/m/Y H:i:s',strtotime($a['data_chat'])); ?></td>
                  <td><?php echo $a['usuario_chat']; ?></td>
                  <td><?php echo $a['texto_chat']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
      </div>
    </div>