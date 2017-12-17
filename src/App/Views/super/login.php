<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/asset/default/icon.png" />
        <link rel="stylesheet" href="/extension/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="/extension/bootstrap/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="/extension/owner/css/custom.css" />
        <script src="/extension/jquery/jquery-1.12.4.min.js"></script>
        <script src="/extension/bootstrap/js/bootstrap.js"></script>
        <title> Exam Management </title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    <div class="top-25">
                        <form class="panel panel-success" method="post">
                            <div class="panel-heading">
                                <span class="glyphicon glyphicon-cog"></span> Hệ thống này dành riêng cho quản trị viên
                            </div>
                            <div class="panel-body">
                                {{ msg }}
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="text" class="form-control" placeholder="Tài khoản" name="user" autofocus />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="password" class="form-control" placeholder="Mật khẩu" name="pass" />
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success" name="submit" value="1"><strong><span class="glyphicon glyphicon-check"></span> Đăng nhập </strong></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>