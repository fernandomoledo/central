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
   