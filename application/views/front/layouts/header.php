<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

   <!-- fancybox -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

   <!-- owl caraousel -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

   <link rel="shortcut icon" href="<?= base_url('asset/favicon.png') ?>" type="image/x-icon">

   <title>Kongres XX PMII</title>
   <style>
      body {
         padding-top: 4.5rem;
         padding-bottom: 4.5rem;
      }

      /* Paste this css to your style sheet file or under head tag */
      /* This only works with JavaScript, if it's not present, don't show loader */
      .no-js #loader {
         display: none;
      }

      .js #loader {
         display: block;
         position: absolute;
         left: 100px;
         top: 0;
      }

      .se-pre-con {
         position: fixed;
         left: 0px;
         top: 0px;
         width: 100%;
         height: 100%;
         z-index: 9999;
         background: url(<?= base_url('asset/loader.gif') ?>) center no-repeat #fff;
      }
   </style>
</head>

<body class="bg-light">
   <div class="se-pre-con"></div>
   <!-- As a heading -->
   <nav class="navbar navbar-light bg-primary fixed-top">
      <?php
      $url = $this->uri->segment(2);
      if ($url == "") {
      ?>
         <i class="fa fa-home text-white"></i>
      <?php } else { ?>
         <div onclick="back()"><i class="fa fa-arrow-left text-white"></i></div>
      <?php } ?>
      <span class="navbar-brand text-white mb-0 h1">
         Kongres PMII Ke-XX
      </span>
   </nav>

   <div class="container">