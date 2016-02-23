<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Monitor Central de Chamados</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url().'resources/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo base_url().'resources/css/main.css'; ?>" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="<?php echo base_url().'resources/css/datatables.css'; ?>" rel="stylesheet">    
    <style>
      body {
        padding-top: 40px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      .push05{height: 5px;}
      .push1{height: 10px;}
      .push2{height: 20px;}
      .push3{height: 30px;}
      .push4{height: 40px;}
      .push5{height: 50px;}
      .sizebtn100{width: 100px;}
      .sizebtn150{width: 150px;}
      .sizebtn200{width: 200px;}
      .separator{border-right: 1px solid #E0E0E0;}
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Barra de navegação -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Central de Chamados CAU</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url().'categoria'; ?>">Categorias<span class="sr-only">(current)</span></a></li>
            <li><a href="<?php echo base_url().'basedeconhecimento'; ?>">Base de conhecimento</a></li>
             <li><a href="<?php echo base_url().'painel'; ?>">Painel</a></li>
          </ul>
          <form class="navbar-form navbar-left" role="search" method="post" action="<?php echo base_url().'basedeconhecimento/busca'; ?>">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Buscar..." name="txt_busca" id="txt_busca" required />
            </div>
             <input type="submit" value="Buscar" class="btn btn-default" />
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#">Bem-vindo(a), <b><?php echo $this->session->userdata('usuario'); ?></b></a>
            </li>
            <li><a href="<?php echo base_url().'index/logout'; ?>" title='Clique para sair do sistema' onclick="return confirm('Tem certeza que deseja sair?');">Sair</a>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <!-- Fim Barra de navegação -->