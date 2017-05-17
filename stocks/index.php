<!DOCTYPE html>
<html class="" lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="Sistema Administrativo Soto GoodYear">
  <meta name="author" content="Sturio">
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
  <title>Administración Soto GoodYear</title>
  <link href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet" type="text/css">
  <link href="assets/css/style.css" rel="stylesheet"> <!-- MANDATORY -->
  <link href="assets/css/theme.css" rel="stylesheet"> <!-- MANDATORY -->
  <link href="assets/css/ui.css" rel="stylesheet"> <!-- MANDATORY -->
  <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <![endif]-->
</head>
<!-- BEGIN BODY -->
<body class="fixed-sidebar color-primary bg-light-blue theme-sltl color-default">

  <section>
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar">
        <div class="logopanel">
          <h1><a href="views/initial.html">&nbsp;</a></h1>
        </div>
        <div class="sidebar-inner">
          <div class="sidebar-top">
            <div class="userlogged clearfix">
              <i class="icon icons-faces-users-01"></i>
              <div class="user-details">
                <h4>Usuario</h4>
                <div class="dropdown user-login">
                  <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                    <i class="online"></i><span>Conectado</span><i class="fa fa-angle-down"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="menu-title">
            <span class="">Sistema</span>
          </div>
          <ul class="nav nav-sidebar">
            <li id="index" class="tm nav-active active"><a href="#"><i class="icon-home"></i><span>Inicio</span></a></li>
            <li class="tm nav-parent">
              <a href="#"><i class="icon-puzzle"></i><span>Registros</span> <span class="fa arrow"></span></a>
              <ul class="children collapse" style="display: none;">
                <li id="users"><a href="submenu1.html">Usuarios</a></li>
                <li id="clients"><a href="submenu2.html">Clientes</a></li>
                <li id="products"><a href="submenu3.html">Productos</a></li>
              </ul>
            </li>
            <li class="tm nav-parent">
              <a href="#"><i class="icon-puzzle"></i><span>Movimientos</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li id="list"><a href="submenu1.html">Listado</a></li>
                <li id="quoter"><a href="submenu2.html">Cotizador</a></li>
                <li id="stock"><a href="submenu3.html">Inventarios</a></li>
                <li id="items_input"><a href="submenu3.html">Entrada Mercancia</a></li>
              </ul>
            </li>
            <li class="tm nav-parent">
              <a href="#"><i class="icon-bulb"></i><span>Utilerias</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li id="credit-collection"><a href="submenu1.html">Credito y Cobranza</a></li>
              </ul>
            </li>
          </ul>
          <div class="sidebar-widgets"></div>
          <div class="sidebar-footer clearfix" style="">
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
            <i class="icon-size-fullscreen"></i></a>
            <a class="pull-left" href="#" data-rel="tooltip" data-placement="top" data-original-title="Lockscreen">
            <i class="icon-lock"></i></a>
            <a class="pull-left btn-effect" href="logout.php" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">
            <i class="icon-power"></i></a>
          </div>
        </div>
      </div>
      <div class="main-content">
        <div class="topbar">
          <div class="header-left">
            <div class="topnav">
            <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
          </div>
        </div>

        <div id="content" class="page-content">
          <div class="header">
            <h2><strong>Cotizador</strong></h2>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="panel">
                <div class="panel-content clearfix">
                  <div id="list2" class="quick-link">
                    <div class="row">
                      <div class="icon">
                        <i class="icon-bulb bg-green"></i>
                      </div>
                      <p class="text">Listado</p>
                    </div>
                  </div>
                  <div id="products2" class="quick-link">
                    <div class="row">
                      <div class="icon">
                        <i class="icon-tag bg-aero"></i>
                      </div>
                      <p class="text">Productos</p>
                    </div>
                  </div>
                  <div id="clients2" class="quick-link">
                    <div class="row">
                      <div class="icon">
                        <i class="icon-users bg-orange"></i>
                      </div>
                      <p class="text">Clientes</p>
                    </div>
                  </div>
                  <div id="credit-collection2" class="quick-link">
                    <div class="row">
                      <div class="icon">
                        <i class="icon-calendar bg-blue"></i>
                      </div>
                      <p class="text">Credito y Cobranza</p>
                    </div>
                  </div>
                  <div id="stock2" class="quick-link">
                    <div class="row">
                      <div class="icon">
                        <i class="icon-bar-chart bg-dark"></i>
                      </div>
                      <p class="text">Inventarios</p>
                    </div>
                  </div>
                  <div id="users2" class="quick-link">
                    <div class="row">
                      <div class="icon">
                        <i class="icon-users bg-yellow"></i>
                      </div>
                      <p class="text">Usuarios</p>
                    </div>
                  </div>
                  <div id="quoter2" class="quick-link">
                    <div class="row">
                      <div class="icon">
                        <i class="icon-basket bg-blue-dark"></i>
                      </div>
                      <p class="text">Cotizador</p>
                    </div>
                  </div>
                  <div id="items_input2" class="quick-link">
                    <div class="row">
                      <div class="icon">
                        <i class="icon-cloud-upload bg-aero"></i>
                      </div>
                      <p class="text">Entrada Mercancia</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="widget widget_calendar bg-primary">
                <div class="multidatepicker"></div>
              </div>
            </div>
          </div>



          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset"> <span>Copyright <span class="copyright">©</span> 2016 </span> <span>Sturio</span>. <span>Soto GoodYear, todos los derechos reservados.. </span> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="loader-overlay">
  <div class="spinner">
    <div class="bounce1">Soto</div>
    <div class="bounce2">Goodyear</div>
    <div class="bounce3"></div>
  </div>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="assets/plugins/jquery/jquery.2.2.2.min.js"></script>
<script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/plugins/gsap/main-gsap.min.js"></script> <!-- HTML Animations -->
<script src="assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
<script src="assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
<script src="assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
<script src="assets/plugins/bootbox/bootbox.min.js"></script>
<script src="assets/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom Scrollbar sidebar -->
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script> <!-- Show Dropdown on Mouseover -->
<script src="assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <!-- Animated Progress Bar -->
<script src="assets/plugins/switchery/switchery.min.js"></script> <!-- IOS Switch -->
<script src="assets/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->
<script src="assets/plugins/retina/retina.min.js"></script>  <!-- Retina Display -->
<script src="assets/plugins/jquery-cookies/jquery.cookies.js"></script> <!-- Jquery Cookies, for theme -->
<script src="assets/plugins/bootstrap/js/jasny-bootstrap.min.js"></script> <!-- File Upload and Input Masks -->
<script src="assets/plugins/select2/select2.min.js"></script> <!-- Select Inputs -->
<script src="assets/plugins/bootstrap-tags-input/bootstrap-tagsinput.min.js"></script> <!-- Select Inputs -->
<script src="assets/plugins/bootstrap-loading/lada.min.js"></script> <!-- Buttons Loading State -->
<script src="assets/plugins/timepicker/jquery-ui-timepicker-addon.min.js"></script> <!-- Time Picker -->
<script src="assets/plugins/multidatepicker/multidatespicker.min.js"></script> <!-- Multi dates Picker -->
<script src="assets/plugins/colorpicker/spectrum.min.js"></script> <!-- Color Picker -->
<script src="assets/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script> <!-- A mobile and touch friendly input spinner component for Bootstrap -->
<script src="assets/plugins/autosize/autosize.min.js"></script> <!-- Textarea autoresize -->
<script src="assets/plugins/icheck/icheck.min.js"></script> <!-- Icheck -->
<script src="assets/plugins/bootstrap-editable/js/bootstrap-editable.min.js"></script> <!-- Inline Edition X-editable -->
<script src="assets/plugins/bootstrap-context-menu/bootstrap-contextmenu.min.js"></script> <!-- File Upload and Input Masks -->
<script src="assets/plugins/prettify/prettify.min.js"></script> <!-- Show html code -->
<script src="assets/plugins/slick/slick.min.js"></script> <!-- Slider -->
<script src="assets/plugins/countup/countUp.min.js"></script> <!-- Animated Counter Number -->
<script src="assets/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
<script src="assets/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
<script src="assets/plugins/charts-chartjs/Chart.min.js"></script>  <!-- ChartJS Chart -->
<script src="assets/plugins/bootstrap-slider/bootstrap-slider.js"></script> <!-- Bootstrap Input Slider -->
<script src="assets/plugins/visible/jquery.visible.min.js"></script> <!-- Visible in Viewport -->
<script src="assets/js/builder.js"></script>
<script src="assets/js/sidebar_hover.js"></script>
<script src="assets/js/application.js"></script> <!-- Main Application Script -->
<script src="assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
<script src="assets/js/widgets/notes.js"></script>
<script src="assets/js/quickview.js"></script> <!-- Quickview Script -->
<script src="assets/js/pages/search.js"></script> <!-- Search Script -->
<!-- BEGIN PAGE SCRIPTS -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
<script src="assets/plugins/summernote/summernote.js"></script>
<script src="assets/plugins/skycons/skycons.js"></script>
<script src="assets/plugins/simple-weather/jquery.simpleWeather.min.js"></script>
<script src="assets/js/widgets/widget_weather.js"></script>
<script src="assets/js/widgets/todo_list.js"></script>
<script src="assets/js/views.js"></script>
<!-- END PAGE SCRIPTS -->
</body>
</html>
