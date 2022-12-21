<?php
session_start();
ini_set("default_charset", "iso-8859-1");
require_once("Clases/ClsUsuario.php");

function login($usu, $pass)
{
     $usu = decode($usu);
     $pass = decode($pass);
     $ClsUsu = new ClsUsuario();
     $result = $ClsUsu->get_user('',$usu, $pass);
     if (is_array($result)) {
		foreach($result as $row){
               $_SESSION["nick"] = $row["nick"];
               $_SESSION["name"] = $row["name"];
               $_SESSION["id"] = $row["id"];
          }
          return true;
     } else {
          return false;
     }
}

//verifica si el usuario esta logeado o si no
function check_auth_user()
{
     global $_SESSION;
     if (isset($_SESSION['nick'])) {
          return true;
     } else {
          return false;
     }
}

//quitar caracteres especiales para evitar sqlinjection
function decode($string)
{
     $nopermitidos = array("'", '\\', '<', '>', "\"", "-", "%");
     $string = str_replace(" ", "", $string);
     $string = str_replace($nopermitidos, "", $string);
     return $string;
}


//muestra la pagina de login
function login_form($inv, $cont)
{
?>
     <!DOCTYPE html>
     <html lang="en">

     <head>

          <meta charset="utf-8" />
          <link rel="apple-touch-icon" sizes="76x76" href="https://image.flaticon.com/icons/png/512/633/633600.png">
          <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/633/633600.png">
          <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
          <title> Movie Center </title>
          <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
          <!--     Fonts and icons     -->
          <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
          <!-- CSS Files -->
          <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
          <!-- CSS Just for demo purpose, don't include it in your project -->
          <link href="assets/demo/demo.css" rel="stylesheet" />
          <!-- fontawesome -->
          <script src="https://kit.fontawesome.com/907a027ade.js" crossorigin="anonymous"></script>
          <!-- Swal -->
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

     </head>

     <body class="off-canvas-sidebar">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
               <div class="container">
                    <div class="navbar-wrapper">
                         <a class="navbar-brand" href="#pablo">Movie Center</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                         <span class="sr-only">Toggle navigation</span>
                         <span class="navbar-toggler-icon icon-bar"></span>
                         <span class="navbar-toggler-icon icon-bar"></span>
                         <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                         <ul class="navbar-nav">
                              <li class="nav-item ">
                                   <a href="register.php" class="nav-link">
                                        <i class="fas fa-users"></i> Registrarse
                                   </a>
                              </li>
                         </ul>
                    </div>
               </div>
          </nav>
          <!-- End Navbar -->
          <div class="wrapper wrapper-full-page">
               <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('../CONFIG/images/bgs/bgbusiness.jpg'); background-size: cover; background-position: top center;">
                    <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                    <div class="container">
                         <div class="row">
                              <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                                   <form class="form" action="login.php" method="post">
                                        <div class="card card-login card-hidden">
                                             <div class="card-header card-header-primary text-center">
                                                  <h4 class="card-title">
                                                       <img src="https://image.flaticon.com/icons/png/512/633/633600.png" alt="logo" width="120px">
                                                  </h4>
                                             </div>
                                             <div class="card-body ">
                                                  <p class="card-description text-center">Movie Center</p>
                                                  <?php if ($inv == 1) {
                                                       $cont++; ?>
                                                       <div class="alert alert-danger text-center ml-3"> Usuario o Contrase&ntilde;a invalida...</div>
                                                  <?php  } else if ($inv == 2) {
                                                       $cont++; ?>
                                                       <div class="alert alert-warning text-center ml-3" role="alert"> Uno o m&aacute;s campos est&aacute;n vacios...</b></div>
                                                  <?php } ?>
                                                  <span class="bmd-form-group">
                                                       <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                 <span class="input-group-text">
                                                                      <i class="fas fa-user"></i>
                                                                 </span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Usuario" name="nick" id="nick" required="" />
                                                       </div>
                                                  </span>
                                                  <span class="bmd-form-group">
                                                       <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                 <span class="input-group-text">
                                                                      <i class="fas fa-key"></i>
                                                                 </span>
                                                            </div>
                                                            <input type="password" class="form-control" placeholder="Contrase&ntilde;a" id="password" name="password" required="" />
                                                       </div>
                                                  </span>
                                             </div>
                                             <br>
                                             <div class="card-footer justify-content-center">
                                                  <button class="btn btn-primary btn-round btn-block" onclick="submit();"><i class="fa fa-fingerprint"></i> Continuar</button>
                                             </div>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <!--   Core JS Files   -->
          <script src="assets/js/core/jquery.min.js"></script>
          <script src="assets/js/core/popper.min.js"></script>
          <script src="assets/js/core/bootstrap-material-design.min.js"></script>
          <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
          <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
          <script src="assets/js/material-dashboard.js" type="text/javascript"></script>
          <!-- propios -->
          <script type="text/javascript" src="assets/js/modules/util.js"></script>
          <script>
               $(document).ready(function() {
                    md.checkFullPageBackgroundImage();
                    setTimeout(function() {
                         // after 1000 ms we add the class animated to the login/register card
                         $('.card').removeClass('card-hidden');
                    }, 300);
               });
          </script>
     </body>

     </html>
<?php } ?>