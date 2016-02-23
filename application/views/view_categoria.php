<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 <!-- Conteúdo da página -->
    <div class="container-fluid">
      <!-- Título -->
      <div class="row">
        <div class="col-md-12 text-center">
          <h1>Categorias</h1>
        </div>
      </div>
      <div class="push3"></div>
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="col-md-3"></div>
          <div class="col-md-6">
          <?php alerta(); ?>
           <form method="post" action="<?php echo base_url().'categoria/adicionar'; ?>">
           <input type="hidden" value="<?= isset($c_editar) ? $c_editar['id_categoria'] : 0 ?>" name="id_categoria" id="id_categoria" />
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2">Descrição da Categoria</span>
              <input type="text" name="nome_categoria" id="nome_categoria" class="form-control" placeholder="Digite o nome da categoria..." aria-describedby="sizing-addon2" value="<?= isset($c_editar) ? $c_editar['nome_categoria'] : '' ?>" required />
            </div>
            <div class="push1"></div> 
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2">Termo de busca</span>
              <input type="text" name="termo_categoria" id="termo_categoria" class="form-control" placeholder="Digite um termo para busca" aria-describedby="sizing-addon2" value="<?= isset($c_editar) ? $c_editar['termo_categoria'] : '' ?>">
            </div>
            <div class="alert alert-info" id="termo_helper" style="display:none; margin-top: 5px;">
              <strong>Dica!</strong> Aqui você pode informar termos de busca adicionais separados por | se forem vários termos distintos ou por & se forem termos unificados. Ex: Memória RAM | Memória ou Banco & Caixa
            </div>            
            <div class="push2"></div> 
            <div class="text-right">
                <input type="submit" class="btn btn-primary" value="Salvar" />
            </div>
            </form>
            <div class="push2"></div>
            <h4>Definir amarração de categorias</h4>
            <form method="post" action="<?php echo base_url().'categoria/amarrar'; ?>">
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2">Categoria Filha</span>
              <input type="text" name="categoria_filha" id="categoria_filha"  class="form-control" placeholder="Digite o nome da categoria filha" aria-describedby="sizing-addon2" required>
            </div>
             <div class="push1"></div> 
            <div class="input-group">
              <span class="input-group-addon" id="sizing-addon2">Categoria Pai</span>
              <input type="text" name="categoria_pai" id="categoria_pai"  class="form-control" placeholder="Digite o nome da categoria pai" aria-describedby="sizing-addon2" required>
            </div>
            <div class="push2"></div> 
            <div class="text-right">
                <input type="submit" class="btn btn-primary" value="Salvar" />
            </div>
            </form>
            <div class="push3"></div>           
            <table class="table table-striped" id="example">
              <thead>
                <tr>
                  <th class="th_center">Id</th><th class="th_center">Categoria</th><th class="th_center">Termo de busca</th><th class="th_center">Pai</th><th class="th_center">&nbsp;</th><th class="th_center">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($categorias_sem_pai as $c): ?>
                <tr>
                  <td><?php echo $c['id_categoria']; ?></td><td><?php echo $c['nome_categoria']; ?></td><td><?php echo $c['termo_categoria']; ?></td><td>&nbsp;</td><td><a href="<?php echo base_url().'categoria/editar/'.$c["id_categoria"]; ?>" title="Editar categoria <?php echo $c['nome_categoria']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td><td><a href="<?php echo base_url().'categoria/excluir/'.$c["id_categoria"]; ?>" onclick="return confirm('Tem certeza que deseja excluir a categoria <?php echo $c['nome_categoria']; ?>?');" title="Excluir Amarração"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>  
              <?php endforeach; ?> 
              <?php foreach($categorias_com_pai as $c): ?>
                <tr>
                  <td><?php echo $c['id_categoria']; ?></td><td><?php echo $c['nome_categoria']; ?></td><td><?php echo $c['termo_categoria']; ?></td><td><?php echo $c['nome_pai']; ?></td><td><a href="<?php echo base_url().'categoria/editar/'.$c["id_categoria"]; ?>" title="Editar categoria <?php echo $c["nome_categoria"]; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a><td><a href="<?php echo base_url().'categoria/excluir_amarracao/'.$c["id_pai"].'/'.$c["id_categoria"]; ?>" onclick="return confirm('Tem certeza que deseja excluir a amarração entre <?php echo $c['nome_categoria']; ?> e <?php echo $c['nome_pai']; ?>?');" title="Excluir Amarração"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>  
              <?php endforeach;//fecha for categorias com pai ?>                                      
              </tbody>
            </table>                     
          </div>
          <div class="col-md-3"></div>
        </div>
      </div>           
    </div>
    
    <!-- Fim Conteúdo da página -->