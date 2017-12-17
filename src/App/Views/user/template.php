<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css" />
        <link rel="stylesheet" href="/libs/page/css/main.css" />

        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>                        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script src="/libs/page/js/main.js"></script>

        <title> <?= $title ?> </title>
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
                                <a href="/" class="navbar-brand" id="about"><strong class="text-muted"><span class="fa fa-home"></span> Home </strong></a>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-collapse-navbar-menu">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-cog"></span> Danh mục <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-header"> Danh mục tùy chọn <span class="caret"></span></li>
                                            <li class="divider"></li>
                                            <li><a href="<?= $url->home ?>"><span class="fa fa-calendar"></span>&nbsp; Xem lịch thi </a></li>
                                            <li><a href="<?= $url->files ?>"><span class="fa fa-book"></span>&nbsp; Quản lý đề thi </a></li>
                                            <li><a href="#"><span class="fa fa-address-card-o"></span>&nbsp; Liên hệ </a></li>
                                            <li><a href="#"><span class="fa fa-desktop"></span>&nbsp; Thông tin </a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-user"></span> <?= $user->user ?> <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-header">Giáo viên : <?= $user->name ?> </li>
                                            <li class="divider"></li>
                                            <li><a href="#"><span class="fa fa-cog"></span> Quản lý tài khoản </a></li>
                                            <li><a href="<?= $url->logout ?>"><span class="fa fa-sign-out"></span> Đăng xuất  </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-xs-12 no-padding">
                    <div class="inner-content">
                        <div>
                            <h4> <?= $category ?> </h4>
                            <hr />
                        </div>
                        <div>
                            <?php if ($message): ?>
                                <div class="alert <?= "alert-{$message['type']}" ?>">
                                    <?= $message['str'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?= $content ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>