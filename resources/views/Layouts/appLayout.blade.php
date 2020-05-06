<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ReaEda - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/plugins/icomoon/style.css" rel="stylesheet">
    <link href="/css/space.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
</head>
<body>
<div class="page-container">
    <div class="page-sidebar">
        <a class="logo-box" href="/">
            <span>ReaEda</span>
            <i class="icon-close" id="sidebar-toggle-button-close"></i>
        </a>
        <div class="page-sidebar-inner">
            <div class="page-sidebar-menu">
                <ul class="accordion-menu">
                    <li style="margin-left: 50px; font-size: 1.2em;">Администрирование</li>
                    <li>
                        <a href="/">
                            <i class="menu-icon icon-download"></i><span>Заказы</span>
                        </a>
                    </li>
                    <li>
                        <a href="/">
                            <i class="menu-icon icon-user"></i><span>Пользователи</span>
                        </a>
                    </li>
                    <li style="margin-left: 50px; font-size: 1.2em;">Справочники</li>
                        <li class="{{ Request::is('places*') ? 'active-page' : '' }}">
                            <a href="/places" class="active-page">
                                <i class="menu-icon icon-format_list_bulleted"></i><span>Столовые</span>
                            </a>
                        </li>
                    <li class="{{ Request::is('categorys*') ? 'active-page' : '' }}">
                        <a href="/categorys">
                            <i class="menu-icon icon-format_list_bulleted"></i><span>Категории</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('products*') ? 'active-page' : '' }}">
                        <a href="/products">
                            <i class="menu-icon icon-format_list_bulleted"></i><span>Продукты</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="page-header">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="logo-sm">
                            <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
                            <a class="logo-box" href="/"><span>REAEDA</span></a>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown user-dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="/avatar.png" alt="" class="img-circle"></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Профиль</a></li>
                                    <li>
                                        <form id="logoutForm" method="post" action="/logout">
                                            @csrf
                                            <a href="/logout" onclick="logout(event)">Выйти</a>
                                        </form>
                                        <script>
                                            function logout(e) {
                                                e.preventDefault();
                                                document.querySelector('#logoutForm').submit();
                                            }
                                        </script>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="page-inner">

            <div class="page-title">
                <h3 class="breadcrumb-header">@yield('title')</h3>
            </div>
            <div id="main-wrapper">
                @yield('content')
            </div>
            <div class="page-footer">
                <p>COPYRIGHT &copy UVC 2020</p>
            </div>
        </div>
    </div>
</div>
<script src="/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/plugins/datatables/js/jquery.datatables.min.js"></script>
<script src="/js/space.min.js"></script>
</body>
</html>
