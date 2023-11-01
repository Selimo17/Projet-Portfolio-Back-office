<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Meyawo landing page.">
    <meta name="author" content="Devcrud">
    <title>Portfolio Salim Oueslati</title>
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + Meyawo main styles -->
	<link rel="stylesheet" href="assets/css/meyawo.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

<?php require_once('assets\php\header.php'); ?>

    <!-- about section -->
    <?php require_once('assets\php\about_me.php'); ?>
   <!-- end of about section -->


   <?php require_once('assets\php\services.php'); ?>
    
    
    <!-- portfolio section -->
    <?php require_once('assets\php\portfolio.php'); ?>
  <!-- end of portfolio section -->


  <?php require_once('assets\php\hire_me.php'); ?>

    <?php require_once('assets\php\testimonial.php'); ?>
    
    <?php require_once('assets\php\blog.php'); ?>

    <?php require_once('assets\php\contact.php'); ?>

    <?php require_once('assets\php\footer.php'); ?>
	
	<!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap 3 affix -->
	<script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- Meyawo js -->
    <script src="assets/js/meyawo.js"></script>

</body>
</html>
