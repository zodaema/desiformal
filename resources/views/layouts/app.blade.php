<!-- Design by DESIFORMAL -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Desiformal - High-End Website Design</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
        <link href="{{ asset('plugin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/hover-min.css') }}" rel="stylesheet">

        <!-- Plugins -->
        <link href="{{ asset('plugin/animate.css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('plugin/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugin/ladda-bootstrap/dist/ladda.css') }}" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/ie8.css">
        <![endif]-->

    </head>

    <body>
        <header id="top" class="header">
            <!-- Navigation -->
            <nav id="mainNav" class="navbar navbar-desiformal" data-spy="affix" data-offset-top="50">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="btn-text menu">Menu</span>
                            <span class="btn-text closemenu">Close</span>
                            <span class="btn-bars">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li>
                                <a class="page-scroll" href="#about"><span data-title="About me">About me</span></a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#feature1"><span data-title="What's feature">What's feature</span></a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#pricing"><span data-title="Pricing">Pricing</span></a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#portfolio"><span data-title="Portfolio">Portfolio</span></a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#contact"><span data-title="Contact">Contact</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="text-vertical-center">
                <ul id="scene" class="scene unselectable" data-friction-x="0.1" data-friction-y="0.1" data-scalar-x="25" data-scalar-y="15">
                    <li class="layer" data-depth="0.03">
                        <div class="logo">
                            <h1>Desiformal.</h1>
                            <h3>High-End Website Design</h3><br>
                            <a href="#about" class="btn btn-primary loading">Freelance Web Design</a>
                        </div>
                    </li>
                    <li class="layer" data-depth="0.23"><div class="element cloud1 position1"></div></li>
                    <li class="layer" data-depth="0.23"><div class="element cloud2 position2"></div></li>
                    <li class="layer" data-depth="0.12"><div class="element cloud3 position3"></div></li>
                    <li class="layer" data-depth="0.12"><div class="element cloud4 position4"></div></li>
                </ul>
            </div>
        </header>

        <!-- Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <div class="footer1">
                <div class="container">
                    <center>
                        <div class="col-md-4">
                            <h3>Desiformal.</h3>
                            <hr>
                            <p>Mr.Nuttaphon Suphasri<br>
                                Email : tcprofessionals5@gmail.com<br>
                                Line : desiformal<br>
                                Mobile : 0846263528<br>
                                จันทร์ - ศุกร์ ตลอด 24 ชม.
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h4>ตารางคิวงาน</h4>
{{--                            {{ showqueue(); }}--}}
                        </div>
                        <div class="col-md-4">
                            <h4>ร่วมติดตามในเฟสบุค</h4>
                            <div class="fb-page"
                                 data-href="https://www.facebook.com/desiformal"
                                 data-width="300"
                                 data-hide-cover="false"
                                 data-show-facepile="false"
                                 data-show-posts="false"></div>
<!--                            <div id="fb-root"></div>-->
<!--                            <div class="fb-page" style="border:none; overflow:hidden; width:100%;" data-href="https://www.facebook.com/desiformal" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">-->
<!--                                <div class="fb-xfbml-parse-ignore"></div>-->
<!--                            </div>-->
                        </div>
                    </center>
                </div>
            </div>

            <div class="footer2">
                <div class="container">
                    &copy; Desiformal. (c) All rights reserved. <a href="#">desiformal.com</a>
                </div>
            </div>
        </footer>

        <a href="#" class="back-to-top hvr-back-pulse" style="display: inline;visibility: hidden;"><i class="fa fa-chevron-up"></i><a>

        <!-- jQuery -->
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('plugin/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
        <!-- Plugin -->

        <script src="{{ asset('plugin/jquery-scrolla/dist/scrolla.jquery.min.js') }}"></script>
        <script src="{{ asset('plugin/ladda-bootstrap/dist/ladda.jquery.min.js') }}"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/parallax.min.js') }}"></script>
        <script src="{{ asset('js/jqBootstrapValidation.js') }}"></script>
        <script src="{{ asset('js/contact_me.js') }}"></script>

        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
