<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
   <meta name="generator" content="Jekyll v3.8.6">
   <title><?= TITLE ?></title>

   <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/floating-labels/">

   <!-- Bootstrap core CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

   <!-- Favicons -->
   <link rel="shortcut icon" href="<?= base_url('asset/favicon.png') ?>" type="image/x-icon">

   <style>
      .bd-placeholder-img {
         font-size: 1.125rem;
         text-anchor: middle;
         -webkit-user-select: none;
         -moz-user-select: none;
         -ms-user-select: none;
         user-select: none;
      }

      @media (min-width: 768px) {
         .bd-placeholder-img-lg {
            font-size: 3.5rem;
         }
      }
   </style>
   <!-- Custom styles for this template -->
   <link href="https://getbootstrap.com/docs/4.4/examples/floating-labels/floating-labels.css" rel="stylesheet">
</head>

<body class="bg-light">
   <form class="form-signin" method="POST" action="<?= site_url('auth/login') ?>">
      <div class="text-center mb-4">
         <img class="mb-4" src="<?= base_url('asset/favicon.png') ?>" alt="" width="72" height="72">
         <h1 class="h3 mb-3 font-weight-normal">HALAMAN LOGIN</h1>
         <p class="lead">Kongres PMII Ke-XX Balikpapan, Kalimantan Timur</p>
      </div>

      <div class="form-label-group">
         <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
         <label for="username">Username</label>
      </div>

      <div class="form-label-group">
         <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
         <label for="password">Password</label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">
         <i class="fa fa-unlock-alt"></i> &nbsp; M A S U K
      </button>
      <p class="mt-5 mb-3 text-muted text-center">Muhammad Irfan Permana <br> &copy; 2020</p>
   </form>
</body>

</html>