<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Projeto Vizinhança Solidária</title>
	 <link rel="stylesheet" href="<?php echo base_url().'assets/css/normalize.css'; ?>">
 	 <link rel="stylesheet" href="<?php echo base_url().'assets/css/foundation.css'; ?>">
 	 <link rel="stylesheet" href="<?php echo base_url().'assets/css/main.css'; ?>">
   <script src="<?php echo base_url().'assets/js/vendor/modernizr.js'; ?>"></script>
</head>
<body>
<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="<?php echo base_url(); ?>"><b>Projeto Vizinhança Solidária</b></a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="active"><a href="<?php echo base_url().'lista_chamadas'; ?>">Listagem de chamadas</a></li>
      <li class="has-dropdown">
        <a href="#">Outras opções</a>
        <ul class="dropdown">
          <li><a href="<?php echo base_url().'chamada/teste_contatos'; ?>">Teste de validação de contatos</a></li>
          <li><a href="<?php echo base_url().'chamada/teste_fone'; ?>">Teste de validação de fones</a></li>
          <li><a href="<?php echo base_url().'lista_logs'; ?>">Listagem de logs</a></li>
        </ul>
      </li>
    </ul>
  </section>
</nav>
