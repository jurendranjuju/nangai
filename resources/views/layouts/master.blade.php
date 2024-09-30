
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NANGAI DESIGN STUDIO</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/compiled.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/style.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Arsenal&family=Noto+Sans+JP&display=swap" rel="stylesheet">
  <link rel="icon" href="img/fav.jpg">
</head>
<body style="font-family: 'Noto Sans JP', sans-serif!important;">

@include('layouts.header')

    <div class="container-fluid px-0 mx-0">
    @yield('contents')
    </div>

@include('layouts.footer')


<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/compiled.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script src=" https://use.fontawesome.com/8ecc8799e1.js"></script>

</body>

</html>