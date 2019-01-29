<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Desiformal - Portfolio Admin Control Panal</title>

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/vendor/bootstrap/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/vendor/dropzone/basic.css') }}" />
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/vendor/dropzone/dropzone.css') }}">

        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/vendor/font-awesome/css/font-awesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />

        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/vendor/select2/css/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/vendor/select2-bootstrap-theme/select2-bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/vendor/pnotify/pnotify.custom.css') }}" />
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/vendor/morris.js/morris.css') }}" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/stylesheets/theme.css') }}" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{{ asset('admincp_plugin/assets/stylesheets/theme-custom.css') }}">

        <!-- Head Libs -->
        <script src="{{ asset('admincp_plugin/assets/vendor/modernizr/modernizr.js') }}"></script>

        <!-- Vendor -->
        <script src="{{ asset('admincp_plugin/assets/vendor/jquery/jquery.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/jquery-cookie/jquery-cookie.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/jquery-placeholder/jquery-placeholder.js') }}"></script>

        <!-- Specific Page Vendor -->
        <script src="{{ asset('admincp_plugin/assets/vendor/select2/js/select2.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/pnotify/pnotify.custom.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/dropzone/dropzone.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/flot/jquery.flot.pie.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/raphael/raphael.js') }}"></script>
        <script src="{{ asset('admincp_plugin/assets/vendor/morris.js/morris.js') }}"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="{{ asset('admincp_plugin/assets/javascripts/theme.js') }}"></script>

        <!-- Theme Custom -->
        <script src="{{ asset('admincp_plugin/assets/javascripts/theme.custom.js') }}"></script>

        <!-- Theme Initialization Files -->
        <script src="{{ asset('admincp_plugin/assets/javascripts/theme.init.js') }}"></script>

        {{--<!-- Bootstrap Core CSS -->--}}
        {{--<link href="{{ asset('admincp_plugin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">--}}
        {{----}}
        {{--<!-- Datatables Core CSS -->--}}
        {{--<link href="{{ asset('admincp_plugin/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet">--}}

        {{--<!-- MetisMenu CSS -->--}}
        {{--<link href="{{ asset('admincp_plugin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">--}}

        {{--<!-- Custom CSS -->--}}
        {{--<link href="{{ asset('admincp_plugin/dist/css/sb-admin-2.css') }}" rel="stylesheet">--}}

        {{--<!-- Custom Fonts -->--}}
        {{--<link href="{{ asset('admincp_plugin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">--}}

        {{--<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->--}}
        {{--<!-- WARNING: Respond.js doesnt work if you view the page via file:// -->--}}
        {{--<!--[if lt IE 9]>--}}
        {{--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>--}}
        {{--<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}
        {{--<![endif]-->--}}

        {{--<!-- jQuery -->--}}
        {{--<script src="{{ asset('admincp_plugin/bower_components/jquery/dist/jquery.min.js') }}" ></script>--}}

    </head>

    <body>
        <section class="body">
            @guest

            @else
            <header class="header">
                <div class="logo-container">
                    <a href="{{route('portfolio')}}" class="logo">
                        <img src="{{ asset('admincp_plugin/assets/images/logo.png') }}" height="35" alt="Desiformal - Admin Control Panel" />
                    </a>
                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>

                <!-- start: search & user box -->
                <div class="header-right">

                    <span class="separator"></span>

                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="{{ asset('admincp_plugin/assets/images/user.png') }}" alt="{{ Auth::user()->name }}" class="img-circle" data-lock-picture="{{ asset('admincp_plugin/assets/images/user.png') }}" />
                            </figure>
                            <div class="profile-info" data-lock-name="{{ Auth::user()->name }}" data-lock-email="{{ Auth::user()->email }}">
                                <span class="name">
                                        {{ Auth::user()->name }}
                                </span>
                                <span class="role">Administrator</span>
                            </div>

                            <i class="fa custom-caret"></i>
                        </a>

                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a id="edit_profile" role="menuitem" tabindex="-1" href="#"><i class="fa fa-user"></i> แก้ไขข้อมูล</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end: search & user box -->
            </header>

            <div class="inner-wrapper">
                <aside id="sidebar-left" class="sidebar-left">

                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            Navigation
                        </div>
                        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>

                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">
                                <ul class="nav nav-main">
                                    <li>
                                        <a href="{{ route('portfolio') }}">
                                            <i class="fa fa-table" aria-hidden="true"></i>
                                            <span>ตารางข้อมูลผลงาน</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('queue') }}">
                                            <i class="fa fa-table" aria-hidden="true"></i>
                                            <span>จัดการคิวงาน</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <span>จัดการสมาชิก</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="?p=member">
                                                    รายชื่อสมาชิก
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?p=member&s=group">
                                                    จัดการกลุ่ม
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>

                            <hr class="separator" />
                        </div>

                    </div>

                </aside>
            @endguest

                <!-- Content -->
                <section role="main" class="content-body">
                    @yield('content')
                </section>

            </div>
        </section>

    </body>

</html>
