<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="{{ URL::asset('dist/css/skins/skin-purple.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-purple layout-top-nav">
    <div>

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Dev </b>Dashboard</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">          
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">              
              <!-- User Account Menu -->
              <li>
                <!-- Menu Toggle Button -->
                <a href="{{ url('/auth/login') }}">                  
                  <span class="hidden-xs">Login</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" id="dev-dash-content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          
        </section>

        <!-- Main content -->
        <section class="content">


          <!-- Your Page Content Here -->


          <img src="{{ URL::asset('dist/img/background-birchbox.jpg') }}" style="opacity: 1" width="1455" height="625">
          <p style="position: absolute;top: 120px ;left:140px"><img src="{{ URL::asset('dist/img/sdgjkl.png') }}"  width="100" height="120"> </p>
          <p style="position: absolute;top: 250px ;left:140px;font-family:Helvetica; font-size: 50px;;color: white">Developer Dashboard
          </p>
          <p style="position: absolute;top: 320px ;left: 140px;;font-family:Helvetica; font-size: 50px;color: white">Agile Project Development </p>
          <p style="position: absolute;top: 440px ;left: 140px;;font-family:Helvetica; font-size: 15px;;color: white">
            <b>Visually manage complex work </b>and <b>focus on the things that matter</b>-Scrum Bench gives the visibility </p>
          <p style="position: absolute;top: 470px ;left: 140px;;font-family:Helvetica; font-size: 15px;;color: white">and transparency you need across your organization.
            Scrum Bench flexibly adapts to your management approach </p>
          <p style="position: absolute;top: 500px ;left: 140px;;font-family:Helvetica; font-size: 15px;;color: white">and organizational structure.</p>







































        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">         
        
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="#">SLIIT</a>.</strong> All rights reserved.
      </footer>
      
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('dist/js/app.min.js') }}"></script>
	<script src="{{ URL::asset('bootstrap/js/content.load.js') }}"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>