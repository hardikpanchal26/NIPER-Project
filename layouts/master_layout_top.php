<?php 
session_start();
include DIRNAME( __DIR__ ).'/database/config.php';
include DIRNAME( __DIR__ ).'/functions.php'; 
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
  <div style="transform: none;">
    <div id="wrapper" style="transform: none;">
      <?php 
        include DIRNAME( __DIR__ ).'/partials/header.php'; 
        include DIRNAME( __DIR__ ).'/partials/navbar.php';
      ?>

      <div id="content" >
        <?php include DIRNAME( __DIR__ ).'/partials/breadcrumb.php'; ?>
      </div> 
    
        <div class="m-5">
          
          <?php include DIRNAME( __DIR__ ).'/partials/sidebar.php'; ?>

