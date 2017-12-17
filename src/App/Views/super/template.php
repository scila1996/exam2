<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/asset/default/icon.png" />
        <link rel="stylesheet" href="/extension/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="/extension/owner/css/custom.css" />
        <link rel="stylesheet" href="/extension/jquery-confirm/jquery-confirm.min.css" />

        <script src="/extension/jquery/jquery-1.12.4.min.js"></script>
        <script src="/extension/jquery/jquery.validate.js"></script>
        <script src="/extension/bootstrap/js/bootstrap.min.js"></script>
        <script src="/extension/jquery-confirm/jquery-confirm.min.js"></script>
        <script src="/extension/owner/js/app.js"></script>

        <title> {{ title }} </title>
    </head>
    <body>
        <div class="container frame-style">
            <div class="row">
                <div class="col-xs-12 no-padding" id="main-navbar">
                    <nav class="navbar navbar-default navbar-static-top no-margin">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-collapse-navbar-menu" aria-expanded="false">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a href="/super" class="navbar-brand" id="about"><strong class="text-muted"> Site for Admin </strong></a>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-collapse-navbar-menu">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-cog"></span> Quản lý <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-header"> Danh mục tùy chọn <span class="caret"></span></li>
                                            <li class="divider"></li>
                                            <li><a href="/super/course"><span class="fa fa-book"></span>&nbsp; Quản lý bộ môn </a></li>
                                            <li><a href="/super/user"><span class="fa fa-user"></span>&nbsp; Quản lý tài khoản </a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-user"></span> <?php echo $user->user ?> <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-header"> <?php echo $user->name ?> </li>
                                            <li class="divider"></li>
                                            <li><a href="#"><span class="fa fa-id-badge"></span> Quản lý tài khoản </a></li>
                                            <li><a href="/super/logout"><span class="fa fa-sign-out"></span> Đăng xuất  </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-xs-12 no-padding">
                    <div class="inner-content">
                        {{ content }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>