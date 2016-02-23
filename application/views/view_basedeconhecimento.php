<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 <!-- Conteúdo da página -->
    <div class="container-fluid">
      <!-- Título da Página -->
      <div class="row">
        <div class="col-md-12 text-center">
          <h1>Base de Conhecimento</h1>
        </div>
      </div>
      <!-- Pula 30px -->
      <div class="push3"></div>
      <div class="row">
        <!-- Container dos painéis -->
        <div class="col-md-12">
          <!-- Painel de busca e categorias -->
          <div class="col-md-4 separator">
            <form method="post" action="<?php echo base_url().'basedeconhecimento/busca'; ?>">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Digite o termo e tecle ENTER..." id="txt_busca" name="txt_busca" required />
              <span class="input-group-btn">
                <input type="submit" value="Buscar" class="btn btn-default" />
              </span>
              </form>
            </div>
            <div class="push3"></div>
            <ol class="breadcrumb">
            <?php foreach ($breadcrumb as $b): ?>
              <li><a href="<?php echo $b['link'];?>"><?php echo utf8_encode($b['valor']);?></a></li>
            <?php endforeach; ?>
            </ol>
            <div class="push1"></div>
            <div class="list-group">
              <a href="#" class="list-group-item active">
                <?php echo $categorias == null ? 'Chamados' : 'Categorias'; ?>
              </a>
              <?php foreach ($categorias as $c): ?>
              <a href="<?php echo $url.$c['id_categoria'];?>" class="list-group-item"><?php echo $c['nome_categoria'];?></a>
              <?php endforeach; ?>
              <?php 
                if(!$tem_chamados && $termo_busca != "") echo "Não foram encontrados chamados relacionados ao termo <b>$termo_busca</b>";

                elseif ($tem_chamados){
                    echo "<table id='tbl_chamados'>";
                    echo "<thead>";
                    echo "<tr><th>Número/Descrição</th></tr>";
                    echo "</thead>";
                    echo "<tbody>";
                foreach ($chamados as $c): ?>
                  <tr><td>
              <a href="javascript:ver_detalhe(<?php echo $c['ID']; ?>);" class="list-group-item lista">
                <!--<h4 class="list-group-item-heading"><?php echo $c['numero'].'/'.$c['ano'].'<br /><small>'.$c['dt_andamento'].'</small>'; ?></h4>-->
                 <h4 class="list-group-item-heading"><?php echo $c['NUMERO']; ?></h4>
                <p class="list-group-item-text"><?php echo utf8_encode($c['NOME']); ?></p>
              </a>
              </td></tr>
            <?php 
             
            endforeach; 
              echo "</tbody>";
              echo "</table>";
             }
            ?>

            </div>

            <div class="push1"></div>
             
          </div>
          <!-- Fim Painel de busca e categorias -->

          <!-- Painel de chamados -->
          <div class="col-md-8" id="tbl">
            
          </div>
          <!-- Fim Painel de chamados -->
        </div>
        <!-- Fim Container dos painéis -->
    </div>

    <!-- Fim Conteúdo da página -->