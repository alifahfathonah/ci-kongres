<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="shortcut icon" href="<?= base_url('asset/favicon.png') ?>" type="image/x-icon">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">

   <!-- font awesome -->
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

   <title><?= TITLE ?></title>
   <style>
      body {
         padding-top: 4.5rem;
         padding-bottom: 4.5rem;
      }
   </style>
</head>

<body class="bg-light">
   <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-primary">
      <a class="navbar-brand text-white" href="#">
         <img src="<?= base_url('asset/favicon.png') ?>" alt="pmii" width="25" height="25">
         Kongres PMII Ke-XX
      </a>

      <div class="collapse navbar-collapse">
         <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
               <a class="nav-link text-white" href="<?= site_url('admin/beranda') ?>">
                  <i class="fa fa-home"></i>&nbsp;Beranda
               </a>
            </li>
            <li class="nav-item active">
               <a class="nav-link text-white" href="<?= site_url('admin/korcab') ?>">
                  <i class="fa fa-map"></i>&nbsp;Koord.Cabang
               </a>
            </li>
            <li class="nav-item active">
               <a class="nav-link text-white" href="<?= site_url('admin/cabang') ?>">
                  <i class="fa fa-map-pin"></i>&nbsp;Cabang
               </a>
            </li>
            <li class="nav-item active">
               <a class="nav-link text-white" href="<?= site_url('admin/peserta') ?>">
                  <i class="fa fa-users"></i>&nbsp;Peserta
               </a>
            </li>
            <li class="nav-item active">
               <a class="nav-link text-white" href="<?= site_url('admin/galeri') ?>">
                  <i class="fa fa-file-image-o"></i>&nbsp;Galeri
               </a>
            </li>
            <li class="nav-item active">
               <a class="nav-link text-white" href="<?= site_url('admin/tor') ?>">
                  <i class="fa fa-list-alt"></i>&nbsp;T O R
               </a>
            </li>
         </ul>
         <ul class="navbar-nav">
            <li class="nav-item active">
               <a class="nav-link text-white" href="<?= site_url('auth/logout') ?>">
                  <i class="fa fa-sign-out"></i>&nbsp;Keluar
               </a>
            </li>
         </ul>
      </div>
   </nav>

   <div class="container">