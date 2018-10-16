<?php 
session_start();
require DIRNAME(__DIR__).'/database/config.php';
require DIRNAME(__DIR__).'/functions.php'; 
?>
<html>  
<head>
  <title>
    Instrument List and Charges
  </title>
    <?php head(); ?>
</head>

<body style="font-size:93.8%">
    <?php setlocale(LC_MONETARY, 'en_IN'); ?>
  <div class="loader-bg">
    <ul class="loader">
      <li>N</li><li>I</li><li>P</li><li>E</li><li>R</li>
    </ul>
  </div>
  
  <div style="transform: none;">
    <div id="wrapper" style="transform: none;">
        <?php 
        require DIRNAME(__DIR__).'/partials/header.php'; 
        require DIRNAME(__DIR__).'/partials/navbar.php';
        ?>

      <div id="content" >
        <?php require DIRNAME(__DIR__).'/partials/breadcrumb.php'; ?>
      </div> 
    
        <div class="m-5">
          
            <?php require DIRNAME(__DIR__).'/partials/sidebar.php'; ?>

