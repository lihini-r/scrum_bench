<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dev Dashboard</title>
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
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('page_styles')

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
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini" style="font-size:14px"><b>Dv</b>Dsh</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Dev </b>Dashboard</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the messages -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <!-- User Image -->
                                                <?php

                                                use App\Profile;

                                                $profile = Profile::where('id', '=', Auth::user()->id)->first(); ?>

                                                @if ($profile === null)

                                                    <img src="{{ URL::asset('dist/img/pm.png')}}" class="img-circle" alt="User Image">

                                                @endif
                                                @if ($profile !== null)
                                                    <img src="{{ URL::asset('dist/img/'.$profile->profile_pic)}}" class="img-circle" alt="User Image" >



                                                @endif

                                            </div>
                                            <!-- Message title and timestamp -->
                                            <h4>
                                                Project Manager
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <!-- The message -->
                                            <p>Next Release has been scheduled</p>
                                        </a>
                                    </li><!-- end message -->
                                </ul><!-- /.menu -->$sprints = Sprint::all();
                                return view('sprints.index', array('sprints' => $sprints));
                                $accounts = Account::all();
                                return view('accounts.index', array('accounts' => $accounts));
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li><!-- /.messages-menu -->

                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">
                                    <li><!-- start notification -->
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> User Story WPS-112 Approved
                                        </a>
                                    </li><!-- end notification -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks Menu -->
                    <li class="dropdown tasks-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- Inner menu: contains the tasks -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <!-- Task title and progress text -->
                                            <h3>
                                                WPS-123 Validate Offline DB Identifiers
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <!-- The progress bar -->
                                            <div class="progress xs">
                                                <!-- Change the css width attribute to simulate progress -->
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                     role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                     aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            {{-- <img src="{{ URL::asset('dist/img/pm.png')}}" class="img-circle" alt="User Image">--}}
                            <?php



                            $profile = Profile::where('id', '=', Auth::user()->id)->first(); ?>

                            @if ($profile === null)

                                <img src="{{ URL::asset('dist/img/pm.png')}}" class="img-circle" alt="User Image" height="20" width="20">

                            @endif
                            @if ($profile !== null)
                                <img src="{{ URL::asset('dist/img/'.$profile->profile_pic)}}" class="img-circle" alt="User Image" height="20" width="20">



                                @endif

                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <?php



                                $profile = Profile::where('id', '=', Auth::user()->id)->first(); ?>

                                @if ($profile === null)

                                    <img src="{{ URL::asset('dist/img/pm.png')}}" class="img-circle" alt="User Image">

                                @endif
                                @if ($profile !== null)
                                    <div><img src="{{ URL::asset('dist/img/'.$profile->profile_pic)}}" class="img-circle" alt="User Image" height="96" width="96">


                                    </div>
                                @endif



                                {{--<img src="{{ URL::asset('dist/img') }}/{{ Auth::user()->name }}.png" class="img-circle" alt="User Image">--}}
                                <p>
                                    {{ Auth::user()->name }} - {{ Auth::user()->designation }}

                                    {{--DB::table('users')
                                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                                    ->join('role', role_user.role_id', '=', 'role.id')
                                    ->select('role.display_name')
                                    ->get();--}}
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div>
                                    <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <?php



                    $profile = Profile::where('id', '=', Auth::user()->id)->first(); ?>

                    @if ($profile === null)

                        <img src="{{ URL::asset('dist/img/pm.png')}}" class="img-circle" alt="User Image">

                    @endif
                    @if ($profile !== null)
                        <div><img src="{{ URL::asset('dist/img/'.$profile->profile_pic)}}" class="img-circle" alt="User Image" height="50" width="50">


                        </div>
                    @endif

                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- search form (Optional) -->








            <!-- search form (Optional) -->



            {!! Form::open(['route' => 'search.store','class' => 'sidebar-form']) !!}
            <div class="input-group">

                {!! Form::text('searchinput', null, ['class' => 'form-control' ,'placeholder' => 'Search...']) !!}

                <span class="input-group-btn">
                    <button class='btn btn-flat' type='submit' >
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            {!! Form::close() !!}






                    <!-- /.search form -->







            <!-- /.search form -->

            <!-- Sidebar Menu -->
            {{-- <ul class="sidebar-menu">
                 <li class="header">Favourites</li>
                 <!-- Optionally, you can add icons to the links -->
                 <li class="active"><a href="#" class="page-link" name="pages/Projects.html"><i class="fa fa-link"></i>
                     <span>Projects</span></a></li>

 --}}{{----}}






            {{--GRANTING PERMISSION SANJANI LINKS--}}

            @if(\Auth::user()->can('create_accounts'))

                <li class="active"><a href="{{ url('/accounts') }}"> <i class="fa fa-link"></i> Accounts</a>
                </li>
            @endif


            @if(\Auth::user()->can('view_activity_log'))

                <li class="active"><a href="{{ url('/activities') }}"> <i class="fa fa-link"></i> Activity Log</a>
                </li>

            @endif


            @if(\Auth::user()->can('create_profile'))

                <li class="active"><a href="{{ url('/profiles') }}"> <i class="fa fa-link"></i> Profile</a>
                </li>

            @endif


            @if(\Auth::user()->can('view_users'))

                <li class="active"><a href="{{ url('/users') }}"> <i class="fa fa-link"></i> Users</a>
                </li>

            @endif




            @if(\Auth::user()->can('create_idea'))


                <?php $results = DB::table('assign_projects')->get();
                $status=false;

                foreach($results as $result)
                {
                    if($result->ProjectManager==\Auth::user()->name)
                    {
                        $status=true;
                        break;
                    }

                    else
                    {
                        $status=false;
                    }
                }

                ?>


                    @if($status==true)

                        <li class="active"><a href="{{ url('/ideas') }}"> <i class="fa fa-link"></i> Ideas Backlog</a>
                        </li>

                    @endif



            @endif



        @if(\Auth::user()->can('view_super_admin_dashboard'))
                <li class="active"><a href="{{ url('home') }}"><i class="fa fa-link"></i> Dashboard</a></li>
            @endif



            @if(\Auth::user()->can('view_user_roles'))

                <li class="active"><a href="{{ url('/roles') }}"><i class="fa fa-link"></i> User Roles</a>
                </li>
            @endif


            @if(\Auth::user()->can('edit_permissions'))

                <li class="active"><a href="{{ url('/permissions') }}"><i class="fa fa-link"></i> Permissions</a>

                </li>
                @endif





             {{--HASINI LINKS           --}}


            @if(\Auth::user()->can('view_projects'))

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Projects</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">

                        <!-- <li class="active"><a href="#" class="page-link" name="{{ URL::asset('pages/Projects.html') }}">Projects</a></li>
-->





                        <li class="active"><a href="{{ url('/projects') }}">Projects</a>
                        </li>


                        <li class="active"><a href="{{ url('/projects/create') }}">Add Projects</a>


                        <li class="active"><a href="{{ url('/assign_teams') }}">view with hidden projects</a>




                        <li class="active"><a href="{{ url('/assign/create') }}">Assign Project Managers</a>



                        <li class="active"><a href="{{ url('/assign_lead/create') }}">Assign Project Leads</a>





                        <li class="active"><a href="{{ url('/release_backlog') }}"> Release Backlog</a>



                        </li>
                    </ul>
                </li>

                @endif


            @if(\Auth::user()->can('create_teams'))

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Teams</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <!-- <li class="active"><a href="#" class="page-link" name="{{ URL::asset('pages/Projects.html') }}">Projects</a></li>
-->
                        <li class="active"><a href="{{ url('/teams') }}">Teams</a>
                        </li>

                        <li class="active"><a href="{{ url('/teams/create') }}">Create Teams</a>



                        <li class="active"><a href="{{ url('/assign_teams/create') }}">Assign Teams</a>






                        </li>
                    </ul>
                </li>
                @endif



            @if(\Auth::user()->can('view_pm_dashboard'))

                <li class="active"><a href="{{ url('/hide') }}"><i class="fa fa-link"></i> Project Manager
                        Dashboard</a></li>
                @endif


        {{--LIHINI LINKS--}}


                @if(\Auth::user()->can('view_userstories'))
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>User Story</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">

                        @if(\Auth::user()->can('view_userstories'))
                                <!--<li class="active"><a href="#" class="page-link" name="{{ URL::asset('pages/backlog.php') }}">Backlog</a></li>-->
                        <li class="active"><a href="{{ url('/user_stories') }}">Backlog</a>
                        </li>
                        <li class="active"><a href="{{ url('/sprints') }}">Sprint</a>
                        </li>
                        <li class="active"><a href="{{ url('/sprint_schedules') }}">Scrum Board</a>
                        </li>
                        <li class="active"><a href="{{ url('/story_search') }}">Search</a>
                        </li>
                        @endif

                        @if(\Auth::user()->can('create_testcases'))

                            <li class="active"><a href="{{ url('/test_case') }}"> Test Lodge</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif



            @if(\Auth::user()->can('view_devdashboard'))
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Dashboards</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        //This link -> only developers
                        <li class="active"><a href="{{ url('/dev_dashboard') }}">My Dashboard</a>
                        </li>
                    </ul>
                </li>
                @endif


                        {{--DANUSHKA LINKS--}}


            @if(\Auth::user()->can('view_acchead_dashboard'))
                <li class="active"><a href="{{ url('home') }}"><i class="fa fa-link"></i> Account Head Dashboard</a></li>
                @endif




                        <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="dev-dash-content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>

                <br/>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        @yield('content')

    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">

        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="#">SLIIT</a>.</strong> All rights reserved.
    </footer>

</div><!-- ./wrapper -->

@yield('page_script1')


        <!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('dist/js/app.min.js') }}"></script>
<script src="{{ URL::asset('bootstrap/js/content.load.js') }}"></script>

<script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

@yield('page_script2')


        <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
