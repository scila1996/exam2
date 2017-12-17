<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />        
        <link rel="stylesheet" href="/libs/page/css/main.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title> Đăng nhập hệ thống </title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    <div class="top-25">
                        <form class="panel panel-info" method="post">
                            <div class="panel-heading">
                                <strong> Đăng nhập vào ứng dụng </strong>
                            </div>
                            <div class="panel-body">
                                <?php if ($message): ?>
                                    <div class="alert <?= "alert-{$message['type']}" ?>">
                                        <?= $message['str'] ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                        <input type="text" class="form-control" placeholder="Tài khoản" name="username" autofocus />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-book"></span></span>
                                        <select class="form-control" name="courseid">
                                            <option value="0"> -- Chọn bộ môn -- </option>
                                            <?php foreach ($courses as $course): ?>
                                                <option value="<?= $course->id ?>"> <?= $course->name ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-info"><strong><span class="fa fa-sign-in"></span> Đăng nhập </strong></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>