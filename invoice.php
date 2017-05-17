<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <title>Make Admin Template &amp; Builder</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet">
    <link href="assets/css/ui.css" rel="stylesheet">
    <script src="assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body class="fixed-topbar fixed-sidebar theme-sdtl color-default">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section>
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar">
        <div class="logopanel">
          <h1>
            <a href="dashboard.html"></a>
          </h1>
        </div>
        <div class="sidebar-inner">
          <div class="sidebar-top">
            <form action="search-result.html" method="post" class="searchform" id="search-results">
              <input type="text" class="form-control" name="keyword" placeholder="Search...">
            </form>
            <div class="userlogged clearfix">
              <i class="icon icons-faces-users-01"></i>
              <div class="user-details">
                <h4>Mike Mayers</h4>
                <div class="dropdown user-login">
                  <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                  <i class="online"></i><span>Available</span><i class="fa fa-angle-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="#"><i class="busy"></i><span>Busy</span></a></li>
                    <li><a  href="#"><i class="turquoise"></i><span>Invisible</span></a></li>
                    <li><a href="#"><i class="away"></i><span>Away</span></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="menu-title">
            Navigation
            <div class="pull-right menu-settings">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
              <i class="icon-settings"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a href="#" id="reorder-menu" class="reorder-menu">Reorder menu</a></li>
                <li><a href="#" id="remove-menu" class="remove-menu">Remove elements</a></li>
                <li><a href="#" id="hide-top-sidebar" class="hide-top-sidebar">Hide user &amp; search</a></li>
              </ul>
            </div>
          </div>
          <ul class="nav nav-sidebar">
            <li><a href="dashboard.html"><i class="icon-home"></i><span data-translate="dashboard">Dashboard</span></a></li>
            <li class="nav-parent">
              <a href="#"><i class="icon-puzzle"></i><span data-translate="builder">Builder</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a target="_blank" href="../builder/admin-builder/index.html"> Admin</a></li>
                <li><a href="../builder/page-builder/index.html"> Page</a></li>
                <li><a href="ecommerce-pricing-table.html"> Pricing Table</a></li>
              </ul>
            </li>
            <li class=""><a href="../frontend/one-page.html" target="_blank"><i class="fa fa-laptop"></i><span class="pull-right badge badge-primary hidden-st">New</span><span data-translate="Frontend">Frontend</span></a></li>
            <li class="nav-parent">
              <a href="#"><i class="icon-bulb"></i><span data-translate="Mailbox">Mailbox</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="mailbox.html"> Inbox</a></li>
                <li><a href="mailbox-send.html"> Send Email</a></li>
                <li><a href="mailbox-emails.html"><span class="pull-right badge badge-danger">Hot</span> Email Templates</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="icon-screen-desktop"></i><span data-translate="ui elements">UI Elements</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="ui-buttons.html" data-translate="buttons"> Buttons</a></li>
                <li><a href="ui-components.html" data-translate="components"> Components</a></li>
                <li><a href="ui-tabs.html" data-translate="tabs"> Tabs</a></li>
                <li><a href="ui-animations.html" data-translate="animations css3"> Animations CSS3</a></li>
                <li><a href="ui-icons.html" data-translate="icons"> Icons</a></li>
                <li><a href="ui-portlets.html" data-translate="portlets"> Portlets</a></li>
                <li><a href="ui-nestable-list.html" data-translate="nestable list"> Nestable List</a></li>
                <li><a href="ui-tree-view.html" data-translate="tree view"> Tree View</a></li>
                <li><a href="ui-modals.html" data-translate="modals"> Modals</a></li>
                <li><a href="ui-notifications.html" data-translate="notifications"> Notifications</a></li>
                <li><a href="ui-typography.html" data-translate="typography"> Typography</a></li>
                <li><a href="ui-helper.html" data-translate="helper"> Helper Classes</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="icon-layers"></i><span data-translate="layouts">Layouts</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="layouts-api.html" data-translate=""> Layout API</a></li>
                <li><a href="layout-topbar-mega-menu.html" data-translate=""> Topbar Menu</a></li>
                <li><a href="layout-topbar-mega-menu.html" data-translate=""> Topbar Mega Menu</a></li>
                <li><a href="layout-topbar-mega-menu-dark.html" data-translate=""> Topbar Mega Dark</a></li>
                <li><a href="layout-sidebar-top.html" data-translate=""> Sidebar on Top</a></li>
                <li><a href="layout-sidebar-hover.html" data-translate=""> Sidebar on Hover</a></li>
                <li><a href="layout-submenu-hover.html" data-translate=""> Sidebar Submenu Hover</a></li>
                <li><a href="layout-sidebar-condensed.html" data-translate=""> Sidebar Condensed</a></li>
                <li><a href="layout-sidebar-light.html" data-translate=""> Sidebar Light</a></li>
                <li><a href="layout-right-sidebar.html" data-translate=""> Right Sidebar</a></li>
                <li><a href="layout-boxed.html" data-translate=""> Boxed Layout</a></li>
                <li><a href="layout-collapsed-sidebar.html" data-translate=""> Collapsed Sidebar</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="icon-note"></i><span data-translate="forms">Forms </span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="forms.html"> Forms Elements</a></li>
                <li><a href="forms-validation.html"> Forms Validation</a></li>
                <li><a href="forms-plugins.html"> Advanced Plugins</a></li>
                <li><a href="forms-wizard.html"> <span class="pull-right badge badge-danger">low</span> <span data-translate="form-wizard">Form Wizard</span></a></li>
                <li><a href="forms-sliders.html" data-translate="sliders"> Sliders</a></li>
                <li><a href="forms-editors.html" data-translate="text editors"> Text Editors</a></li>
                <li><a href="forms-input-masks.html" data-translate="input masks"> Input Masks</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="fa fa-table"></i><span data-translate="medias manager">Tables</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="tables.html" data-translate="tables styling"> Tables Styling</a></li>
                <li><a href="tables-dynamic.html" data-translate="tables dynamic"> Tables Dynamic</a></li>
                <li><a href="tables-filter.html" data-translate="tables filter"> Tables Filter</a></li>
                <li><a href="tables-editable.html" data-translate="tables editable"> Tables Editable</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="icon-bar-chart"></i><span data-translate="charts">Charts </span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="charts.html" data-translate="image croping"> Charts</a></li>
                <li><a href="charts-finance.html" data-translate="gallery sortable"> Financial Charts</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="icon-picture"></i><span data-translate="medias manager">Medias</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="medias-image-croping.html" data-translate="image croping"> Images Croping</a></li>
                <li><a href="medias-gallery-sortable.html" data-translate="gallery sortable"> Gallery Sortable</a></li>
                <li><a href="medias-hover-effects.html" data-translate="hover effects"> <span class="pull-right badge badge-primary">12</span> Hover Effects</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="icon-docs"></i><span data-translate="pages">Pages </span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="page-timeline.html"> Timeline</a></li>
                <li><a href="page-404.html"> Error 404</a></li>
                <li><a href="page-500.html"> Error 500</a></li>
                <li><a href="page-blank.html"> Blank Page</a></li>
                <li><a href="page-contact.html"> Contact</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="icon-user"></i><span data-translate="pages">User </span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="user-profil.html"> <span class="pull-right badge badge-danger">Hot</span> Profil</a></li>
                <li><a href="user-lockscreen.html"> Lockscreen</a></li>
                <li><a href="user-login-v1.html"> Login / Register</a></li>
                <li><a href="user-login-v2.html"> Login / Register v2</a></li>
                <li><a href="user-session-timeout.html"> Session Timeout</a></li>
              </ul>
            </li>
            <li class="nav-parent nav-active active">
              <a href=""><i class="icon-basket"></i><span data-translate="pages">eCommerce </span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="ecommerce-cart.html"> Shopping Cart</a></li>
                <li class="active"><a href="ecommerce-invoice.html"> Invoice</a></li>
                <li><a href="ecommerce-pricing-table.html"><span class="pull-right badge badge-success">5</span> Pricing Table</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="icon-cup"></i><span>Extra </span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href="extra-fullcalendar.html"><span class="pull-right badge badge-primary">New</span> Fullcalendar</a></li>
                <li><a href="extra-widgets.html"> Widgets</a></li>
                <li><a href="page-coming-soon.html"> Coming Soon</a></li>
                <li><a href="extra-sliders.html"> Sliders</a></li>
                <li><a href="maps-google.html"> Google Maps</a></li>
                <li><a href="maps-vector.html"> Vector Maps</a></li>
              </ul>
            </li>
          </ul>
          <!-- SIDEBAR WIDGET FOLDERS -->
          <div class="sidebar-widgets">
            <p class="menu-title widget-title">Folders <span class="pull-right"><a href="#" class="new-folder"> <i class="icon-plus"></i></a></span></p>
            <ul class="folders">
              <li>
                <a href="#"><i class="icon-doc c-primary"></i>My documents</a>
              </li>
              <li>
                <a href="#"><i class="icon-picture"></i>My images</a>
              </li>
              <li><a href="#"><i class="icon-lock"></i>Secure data</a>
              </li>
              <li class="add-folder">
                <input type="text" placeholder="Folder's name..." class="form-control input-sm">
              </li>
            </ul>
          </div>
          <div class="sidebar-footer clearfix">
            <a class="pull-left footer-settings" href="#" data-rel="tooltip" data-placement="top" data-original-title="Settings">
            <i class="icon-settings"></i></a>
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
            <i class="icon-size-fullscreen"></i></a>
            <a class="pull-left" href="#" data-rel="tooltip" data-placement="top" data-original-title="Lockscreen">
            <i class="icon-lock"></i></a>
            <a class="pull-left btn-effect" href="#" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">
            <i class="icon-power"></i></a>
          </div>
        </div>
      </div>
      <!-- END SIDEBAR -->
      <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
          <div class="header-left">
            <div class="topnav">
              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
              <ul class="nav nav-icons">
                <li><a href="#" class="toggle-sidebar-top"><span class="icon-user-following"></span></a></li>
                <li><a href="mailbox.html"><span class="octicon octicon-mail-read"></span></a></li>
                <li><a href="#"><span class="octicon octicon-flame"></span></a></li>
                <li><a href="builder-page.html"><span class="octicon octicon-rocket"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="language-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-globe"></i>
                <span>Language</span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="#" data-lang="en"><img src="assets/images/flags/usa.png" alt="flag-english"> <span>English</span></a>
                  </li>
                  <li>
                    <a href="#" data-lang="es"><img src="assets/images/flags/spanish.png" alt="flag-english"> <span>Español</span></a>
                  </li>
                  <li>
                    <a href="#" data-lang="fr"><img src="assets/images/flags/french.png" alt="flag-english"> <span>Français</span></a>
                  </li>
                </ul>
              </li>
              <!-- END USER DROPDOWN -->
              <!-- BEGIN NOTIFICATION DROPDOWN -->
              <li class="dropdown" id="notifications-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-bell"></i>
                <span class="badge badge-danger badge-header">6</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header clearfix">
                    <p class="pull-left">12 Pending Notifications</p>
                  </li>
                  <li>
                    <ul class="dropdown-menu-list withScroll" data-height="220">
                      <li>
                        <a href="#">
                        <i class="fa fa-star p-r-10 f-18 c-orange"></i>
                        Steve have rated your photo
                        <span class="dropdown-time">Just now</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-heart p-r-10 f-18 c-red"></i>
                        John added you to his favs
                        <span class="dropdown-time">15 mins</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-file-text p-r-10 f-18"></i>
                        New document available
                        <span class="dropdown-time">22 mins</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-picture-o p-r-10 f-18 c-blue"></i>
                        New picture added
                        <span class="dropdown-time">40 mins</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-bell p-r-10 f-18 c-orange"></i>
                        Meeting in 1 hour
                        <span class="dropdown-time">1 hour</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-bell p-r-10 f-18"></i>
                        Server 5 overloaded
                        <span class="dropdown-time">2 hours</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-comment p-r-10 f-18 c-gray"></i>
                        Bill comment your post
                        <span class="dropdown-time">3 hours</span>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                        <i class="fa fa-picture-o p-r-10 f-18 c-blue"></i>
                        New picture added
                        <span class="dropdown-time">2 days</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown-footer clearfix">
                    <a href="#" class="pull-left">See all notifications</a>
                    <a href="#" class="pull-right">
                    <i class="icon-settings"></i>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- END NOTIFICATION DROPDOWN -->
              <!-- BEGIN MESSAGES DROPDOWN -->
              <li class="dropdown" id="messages-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-paper-plane"></i>
                <span class="badge badge-primary badge-header">
                8
                </span>
                </a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header clearfix">
                    <p class="pull-left">
                      You have 8 Messages
                    </p>
                  </li>
                  <li class="dropdown-body">
                    <ul class="dropdown-menu-list withScroll" data-height="220">
                      <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="assets/images/avatars/avatar3.png" alt="avatar 3">
                        </span>
                        <div class="clearfix">
                          <div>
                            <strong>Alexa Johnson</strong>
                            <small class="pull-right text-muted">
                            <span class="glyphicon glyphicon-time p-r-5"></span>12 mins ago
                            </small>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur...</p>
                        </div>
                      </li>
                      <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="assets/images/avatars/avatar4.png" alt="avatar 4">
                        </span>
                        <div class="clearfix">
                          <div>
                            <strong>John Smith</strong>
                            <small class="pull-right text-muted">
                            <span class="glyphicon glyphicon-time p-r-5"></span>47 mins ago
                            </small>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur...</p>
                        </div>
                      </li>
                      <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="assets/images/avatars/avatar5.png" alt="avatar 5">
                        </span>
                        <div class="clearfix">
                          <div>
                            <strong>Bobby Brown</strong>
                            <small class="pull-right text-muted">
                            <span class="glyphicon glyphicon-time p-r-5"></span>1 hour ago
                            </small>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur...</p>
                        </div>
                      </li>
                      <li class="clearfix">
                        <span class="pull-left p-r-5">
                        <img src="assets/images/avatars/avatar6.png" alt="avatar 6">
                        </span>
                        <div class="clearfix">
                          <div>
                            <strong>James Miller</strong>
                            <small class="pull-right text-muted">
                            <span class="glyphicon glyphicon-time p-r-5"></span>2 days ago
                            </small>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur...</p>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown-footer clearfix">
                    <a href="mailbox.html" class="pull-left">See all messages</a>
                    <a href="#" class="pull-right">
                    <i class="icon-settings"></i>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- END MESSAGES DROPDOWN -->
              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img src="assets/images/avatars/user1.png" alt="user image">
                <span class="username">Hi, John Doe</span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="#"><i class="icon-user"></i><span>My Profile</span></a>
                  </li>
                  <li>
                    <a href="#"><i class="icon-calendar"></i><span>My Calendar</span></a>
                  </li>
                  <li>
                    <a href="#"><i class="icon-settings"></i><span>Account Settings</span></a>
                  </li>
                  <li>
                    <a href="#"><i class="icon-logout"></i><span>Logout</span></a>
                  </li>
                </ul>
              </li>
              <!-- END USER DROPDOWN -->
              <!-- CHAT BAR ICON -->
              <li id="quickview-toggle"><a href="#"><i class="icon-bubbles"></i></a></li>
            </ul>
          </div>
          <!-- header-right -->
        </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2><strong>Invoice</strong> n°12658757</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li><a href="dashboard.html">Make</a>
                </li>
                <li><a href="#">Pages</a>
                </li>
                <li class="active">Dashboard</li>
              </ol>
            </div>
          </div>
          <div class="m-t-10 m-b-10 no-print">
            <button type="button" class="btn btn-primary m-r-10 m-b-10"><i class="fa fa-dollar m-r-10"></i> Make A Payment</button>
            <button type="button" class="btn btn-white m-r-10 m-b-10"><i class="fa fa-print m-r-10"></i> Print Invoice</button>
            <button type="button" class="btn btn-white m-r-10 m-b-10"><i class="fa fa-file-text m-r-10"></i> Export as PDF</button>
            <button type="button" class="btn btn-white m-r-10 m-b-10"><i class="fa fa-envelope m-r-10"></i> Send by email</button>
          </div>
          <div class="row invoice-page">
            <div class="col-md-12 p-t-0">
              <div class="row">
                <div class="col-md-12">
                   <div class="col-xs-4 ">
                    <h4 class="w-500 c-gray f-14"><strong>MATRIZ</strong></h4>

                    <address>
                      <p class="width-300"><strong>Amanda Valenciano Avila</strong></p>
                      <p class="width-300 m-t-10"><strong>VAAA671004LY0</strong></p>
                      <p class="width-300">Medina Ascencio 649</p>
                      <p class="width-300">Santa Barbara, 47180</p>
                      <p class="width-300">Arandas, Jal. México</p>
                      <p class="width-300">(01) 34 8784 7733</p>
                    </address>
                  </div>

                  <div class="col-xs-4 ">
                    <h4 class="w-500 c-gray f-14"><strong>CLIENTE</strong></h4>

                    <address>
                      <p class="width-300 m-t-10"><strong>Themes Lab, Inc.</strong></p>
                      <p class="width-300">795 Folsom Ave, Suite 600</p>
                      <p class="width-300">San Francisco, CA 94107</p>
                      <abbr title="Phone">P:</abbr> (123) 456-789
                    </address>
                  </div>

                  <div class="col-xs-4 ">
                    <h4 class="w-500 c-gray f-14"><strong>FACTURA</strong></h4>

                    <address>
                      <p class="width-300 m-t-10"><strong>Themes Lab, Inc.</strong></p>
                      <p class="width-300">795 Folsom Ave, Suite 600</p>
                      <p class="width-300">San Francisco, CA 94107</p>
                      <abbr title="Phone">P:</abbr> (123) 456-789
                    </address>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12 m-t-20 m-b-20">
                      <p><strong>Invoice Date:</strong> <span>May 4, 2014</span></p>
                      <p><strong>Due Date:</strong> <span>Mai 16, 2014</span></p>
                    </div>
                  </div>
                  <table class="table table-striped tablet-tools">
                    <thead>
                      <tr>
                        <th>Clave</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Cliente</th>
                        <th>Usuario</th>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                      </tr>
                       <tr>
                         <td class="no-border"></td>
                         <td class="no-border"></td>
                         <td class="no-border"></td>
                         <td class="no-border"></td>
                         <td class="no-border"></td>


                           <td class="text-right no-border"><strong>Subtotal</strong></td>
                           <td class="text-right" id="subtotal">$464.00</td>
                         </tr>
                         <tr>
                           <td class="no-border"></td>
                           <td class="no-border"></td>
                           <td class="no-border"></td>
                           <td class="no-border"></td>
                           <td class="no-border"></td>


                             <td class="text-right no-border"><strong>IVA 16%</strong></td>
                             <td class="text-right" id="subtotal">$0.00</td>
                           </tr>
                           <tr>
                             <td class="no-border" ></td>
                             <td class="no-border"></td>
                             <td class="no-border"></td>
                             <td class="no-border"></td>
                             <td class="no-border"></td>


                               <td class="text-right no-border"><strong>Total</strong></td>
                               <td class="text-right" id="subtotal">$464.00</td>
                             </tr>


                    </thead>
                    <tbody id="table">

                    </tbody>
                  </table>
                  <div class="well bg-white">
                    Thank you for your business. Please make sure all cheques payable to <strong>ThemeForest Web Services, Inc.</strong> Account No. 35757745
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
                <span>Copyright <span class="copyright">©</span> 2015 </span>
                <span>THEMES LAB</span>.
                <span>All rights reserved. </span>
              </p>
              <p class="pull-right sm-pull-reset">
                <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
              </p>
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->
      <!-- BEGIN BUILDER -->
      <div class="builder hidden-sm hidden-xs" id="builder">
        <a class="builder-toggle"><i class="icon-wrench"></i></a>
        <div class="inner">
          <div class="builder-container">
            <a href="#" class="btn btn-sm btn-default" id="reset-style">reset default style</a>
            <h4>Layout options</h4>
            <div class="layout-option">
              <span> RTL</span>
              <label class="switch pull-right">
              <input data-layout="rtl" id="switch-rtl" type="checkbox" class="switch-input">
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span> Fixed Sidebar</span>
              <label class="switch pull-right">
              <input data-layout="sidebar" id="switch-sidebar" type="checkbox" class="switch-input" checked>
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span> Sidebar on Hover</span>
              <label class="switch pull-right">
              <input data-layout="sidebar-hover" id="switch-sidebar-hover" type="checkbox" class="switch-input">
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span> Submenu on Hover</span>
              <label class="switch pull-right">
              <input data-layout="submenu-hover" id="switch-submenu-hover" type="checkbox" class="switch-input">
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span> Sidebar on Top</span>
              <label class="switch pull-right">
              <input data-layout="sidebar-top" id="switch-sidebar-top" type="checkbox" class="switch-input">
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span>Fixed Topbar</span>
              <label class="switch pull-right">
              <input data-layout="topbar" id="switch-topbar" type="checkbox" class="switch-input" checked>
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <div class="layout-option">
              <span>Boxed Layout</span>
              <label class="switch pull-right">
              <input data-layout="boxed" id="switch-boxed" type="checkbox" class="switch-input">
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
              </label>
            </div>
            <h4 class="border-top">Color</h4>
            <div class="row">
              <div class="col-xs-12">
                <div class="theme-color bg-dark" data-main="default" data-color="#2B2E33"></div>
                <div class="theme-color background-primary" data-main="primary" data-color="#319DB5"></div>
                <div class="theme-color bg-red" data-main="red" data-color="#C75757"></div>
                <div class="theme-color bg-green" data-main="green" data-color="#1DA079"></div>
                <div class="theme-color bg-orange" data-main="orange" data-color="#D28857"></div>
                <div class="theme-color bg-purple" data-main="purple" data-color="#B179D7"></div>
                <div class="theme-color bg-blue" data-main="blue" data-color="#4A89DC"></div>
              </div>
            </div>
            <h4 class="border-top">Theme</h4>
            <div class="row row-sm">
              <div class="col-xs-6">
                <div class="theme clearfix sdtl" data-theme="sdtl">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-light"></div>
                  <div class="theme-sidebar-dark"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="theme clearfix sltd" data-theme="sltd">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-dark"></div>
                  <div class="theme-sidebar-light"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="theme clearfix sdtd" data-theme="sdtd">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-dark"></div>
                  <div class="theme-sidebar-dark"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="theme clearfix sltl" data-theme="sltl">
                  <div class="header theme-left"></div>
                  <div class="header theme-right-light"></div>
                  <div class="theme-sidebar-light"></div>
                  <div class="bg-light"></div>
                </div>
              </div>
            </div>
            <h4 class="border-top">Background</h4>
            <div class="row">
              <div class="col-xs-12">
                <div class="bg-color bg-clean" data-bg="clean" data-color="#F8F8F8"></div>
                <div class="bg-color bg-lighter" data-bg="lighter" data-color="#EFEFEF"></div>
                <div class="bg-color bg-light-default" data-bg="light-default" data-color="#E9E9E9"></div>
                <div class="bg-color bg-light-blue" data-bg="light-blue" data-color="#E2EBEF"></div>
                <div class="bg-color bg-light-purple" data-bg="light-purple" data-color="#E9ECF5"></div>
                <div class="bg-color bg-light-dark" data-bg="light-dark" data-color="#DCE1E4"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END BUILDER -->
    </section>
    <!-- BEGIN QUICKVIEW SIDEBAR -->
    <div id="quickview-sidebar">
      <div class="quickview-header">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#chat" data-toggle="tab">Chat</a></li>
          <li><a href="#notes" data-toggle="tab">Notes</a></li>
          <li><a href="#settings" data-toggle="tab" class="settings-tab">Settings</a></li>
        </ul>
      </div>
      <div class="quickview">
        <div class="tab-content">
          <div class="tab-pane fade active in" id="chat">
            <div class="chat-body current">
              <div class="chat-search">
                <form class="form-inverse" action="#" role="search">
                  <div class="append-icon">
                    <input type="text" class="form-control" placeholder="Search contact...">
                    <i class="icon-magnifier"></i>
                  </div>
                </form>
              </div>
              <div class="chat-groups">
                <div class="title">GROUP CHATS</div>
                <ul>
                  <li><i class="turquoise"></i> Favorites</li>
                  <li><i class="turquoise"></i> Office Work</li>
                  <li><i class="turquoise"></i> Friends</li>
                </ul>
              </div>
              <div class="chat-list">
                <div class="title">FAVORITES</div>
                <ul>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar13.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Bobby Brown</div>
                      <div class="user-txt">On the road again...</div>
                    </div>
                    <div class="user-status">
                      <i class="online"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar5.png" alt="avatar" />
                      <div class="pull-right badge badge-danger">3</div>
                    </div>
                    <div class="user-details">
                      <div class="user-name">Alexa Johnson</div>
                      <div class="user-txt">Still at the beach</div>
                    </div>
                    <div class="user-status">
                      <i class="away"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar10.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Bobby Brown</div>
                      <div class="user-txt">On stage...</div>
                    </div>
                    <div class="user-status">
                      <i class="busy"></i>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="chat-list">
                <div class="title">FRIENDS</div>
                <ul>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar7.png" alt="avatar" />
                      <div class="pull-right badge badge-danger">3</div>
                    </div>
                    <div class="user-details">
                      <div class="user-name">James Miller</div>
                      <div class="user-txt">At work...</div>
                    </div>
                    <div class="user-status">
                      <i class="online"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar11.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Fred Smith</div>
                      <div class="user-txt">Waiting for tonight</div>
                    </div>
                    <div class="user-status">
                      <i class="offline"></i>
                    </div>
                  </li>
                  <li class="clearfix">
                    <div class="user-img">
                      <img src="assets/images/avatars/avatar8.png" alt="avatar" />
                    </div>
                    <div class="user-details">
                      <div class="user-name">Ben Addams</div>
                      <div class="user-txt">On my way to NYC</div>
                    </div>
                    <div class="user-status">
                      <i class="offline"></i>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="chat-conversation">
              <div class="conversation-header">
                <div class="user clearfix">
                  <div class="chat-back">
                    <i class="icon-action-undo"></i>
                  </div>
                  <div class="user-details">
                    <div class="user-name">James Miller</div>
                    <div class="user-txt">On the road again...</div>
                  </div>
                </div>
              </div>
              <div class="conversation-body">
                <ul>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:38pm</span>
                      <div class="conversation-img">
                        <img src="assets/images/avatars/avatar4.png" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Hi you!</span>
                      </div>
                    </div>
                  </li>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:45pm</span>
                      <div class="conversation-img">
                        <img src="assets/images/avatars/avatar4.png" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Are you there?</span>
                      </div>
                    </div>
                  </li>
                  <li class="img">
                    <div class="chat-detail">
                      <span class="chat-date">today, 10:51pm</span>
                      <div class="conversation-img">
                        <img src="assets/images/avatars/avatar4.png" alt="avatar 4"/>
                      </div>
                      <div class="chat-bubble">
                        <span>Send me a message when you come back.</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="conversation-message">
                <input type="text" placeholder="Your message..." class="form-control form-white send-message" />
                <div class="item-footer clearfix">
                  <div class="footer-actions">
                    <i class="icon-rounded-marker"></i>
                    <i class="icon-rounded-camera"></i>
                    <i class="icon-rounded-paperclip-oblique"></i>
                    <i class="icon-rounded-alarm-clock"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="notes">
            <div class="list-notes current withScroll">
              <div class="notes ">
                <div class="row">
                  <div class="col-md-12">
                    <div id="add-note">
                      <i class="fa fa-plus"></i>ADD A NEW NOTE
                    </div>
                  </div>
                </div>
                <div id="notes-list">
                  <div class="note-item media current fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Reset my account password</p>
                      </div>
                      <p class="note-desc hidden">Break security reasons.</p>
                      <p><small>Tuesday 6 May, 3:52 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Call John</p>
                      </div>
                      <p class="note-desc hidden">He have my laptop!</p>
                      <p><small>Thursday 8 May, 2:28 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Buy a car</p>
                      </div>
                      <p class="note-desc hidden">I'm done with the bus</p>
                      <p><small>Monday 12 May, 3:43 am</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Don't forget my notes</p>
                      </div>
                      <p class="note-desc hidden">I have to read them...</p>
                      <p><small>Wednesday 5 May, 6:15 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media current fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Reset my account password</p>
                      </div>
                      <p class="note-desc hidden">Break security reasons.</p>
                      <p><small>Tuesday 6 May, 3:52 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Call John</p>
                      </div>
                      <p class="note-desc hidden">He have my laptop!</p>
                      <p><small>Thursday 8 May, 2:28 pm</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Buy a car</p>
                      </div>
                      <p class="note-desc hidden">I'm done with the bus</p>
                      <p><small>Monday 12 May, 3:43 am</small></p>
                    </div>
                  </div>
                  <div class="note-item media fade in">
                    <button class="close">×</button>
                    <div>
                      <div>
                        <p class="note-name">Don't forget my notes</p>
                      </div>
                      <p class="note-desc hidden">I have to read them...</p>
                      <p><small>Wednesday 5 May, 6:15 pm</small></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="detail-note note-hidden-sm">
              <div class="note-header clearfix">
                <div class="note-back">
                  <i class="icon-action-undo"></i>
                </div>
                <div class="note-edit">Edit Note</div>
                <div class="note-subtitle">title on first line</div>
              </div>
              <div id="note-detail">
                <div class="note-write">
                  <textarea class="form-control" placeholder="Type your note here"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="settings">
            <div class="settings">
              <div class="title">ACCOUNT SETTINGS</div>
              <div class="setting">
                <span> Show Personal Statut</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="setting">
                <span> Show my Picture</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="setting">
                <span> Show my Location</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
                <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
              </div>
              <div class="title">CHAT</div>
              <div class="setting">
                <span> Show User Image</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Fullname</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Location</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="setting">
                <span> Show Unread Count</span>
                <label class="switch pull-right">
                <input type="checkbox" class="switch-input" checked>
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
              </div>
              <div class="title">STATISTICS</div>
              <div class="settings-chart">
                <div class="clearfix">
                  <div class="chart-title">Stat 1</div>
                  <div class="chart-number">82%</div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-primary setting1" data-transitiongoal="82"></div>
                </div>
              </div>
              <div class="settings-chart">
                <div class="clearfix">
                  <div class="chart-title">Stat 2</div>
                  <div class="chart-number">43%</div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-primary setting2" data-transitiongoal="43"></div>
                </div>
              </div>
              <div class="m-t-30" style="width:100%">
                <canvas id="setting-chart" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END QUICKVIEW SIDEBAR -->
    <!-- BEGIN SEARCH -->
    <div id="morphsearch" class="morphsearch">
      <form class="morphsearch-form">
        <input class="morphsearch-input" type="search" placeholder="Search..."/>
        <button class="morphsearch-submit" type="submit">Search</button>
      </form>
      <div class="morphsearch-content withScroll">
        <div class="dummy-column user-column">
          <h2>Users</h2>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar1_big.png" alt="Avatar 1"/>
            <h3>John Smith</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar2_big.png" alt="Avatar 2"/>
            <h3>Bod Dylan</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar3_big.png" alt="Avatar 3"/>
            <h3>Jenny Finlan</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar4_big.png" alt="Avatar 4"/>
            <h3>Harold Fox</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar5_big.png" alt="Avatar 5"/>
            <h3>Martin Hendrix</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/avatars/avatar6_big.png" alt="Avatar 6"/>
            <h3>Paul Ferguson</h3>
          </a>
        </div>
        <div class="dummy-column">
          <h2>Articles</h2>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/1.jpg" alt="1"/>
            <h3>How to change webdesign?</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/2.jpg" alt="2"/>
            <h3>News From the sky</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/3.jpg" alt="3"/>
            <h3>Where is the cat?</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/4.jpg" alt="4"/>
            <h3>Just another funny story</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/5.jpg" alt="5"/>
            <h3>How many water we drink every day?</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/6.jpg" alt="6"/>
            <h3>Drag and drop tutorials</h3>
          </a>
        </div>
        <div class="dummy-column">
          <h2>Recent</h2>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/7.jpg" alt="7"/>
            <h3>Design Inspiration</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/8.jpg" alt="8"/>
            <h3>Animals drawing</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/9.jpg" alt="9"/>
            <h3>Cup of tea please</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/10.jpg" alt="10"/>
            <h3>New application arrive</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/11.jpg" alt="11"/>
            <h3>Notification prettify</h3>
          </a>
          <a class="dummy-media-object" href="#">
            <img src="assets/images/gallery/12.jpg" alt="12"/>
            <h3>My article is the last recent</h3>
          </a>
        </div>
      </div>
      <!-- /morphsearch-content -->
      <span class="morphsearch-close"></span>
    </div>
    <!-- END SEARCH -->
    <!-- BEGIN PRELOADER -->
    <div class="loader-overlay">
      <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>
    <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
    <script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="assets/plugins/gsap/main-gsap.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
    <script src="assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
    <script src="assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
    <script src="assets/plugins/bootbox/bootbox.min.js"></script> <!-- Modal with Validation -->
    <script src="assets/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom Scrollbar sidebar -->
    <script src="assets/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script> <!-- Show Dropdown on Mouseover -->
    <script src="assets/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->
    <script src="assets/plugins/retina/retina.min.js"></script> <!-- Retina Display -->
    <script src="assets/plugins/select2/select2.min.js"></script> <!-- Select Inputs -->
    <script src="assets/plugins/icheck/icheck.min.js"></script> <!-- Checkbox & Radio Inputs -->
    <script src="assets/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
    <script src="assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <!-- Animated Progress Bar -->
    <script src="assets/plugins/charts-chartjs/Chart.min.js"></script>
    <script src="assets/js/builder.js"></script> <!-- Theme Builder -->
    <script src="assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="assets/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="assets/js/quickview.js"></script> <!-- Chat Script -->
    <script src="assets/js/pages/search.js"></script> <!-- Search Script -->
    <script src="assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="assets/js/application.js"></script> <!-- Main Application Script -->
  </body>
</html>
