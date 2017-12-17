<script src="/extension/owner/js/user/form.js"></script>
<h4> Thêm mới bộ môn </h4>
<hr />
<form method="post" id="user">
    <div class="form-group">
        <label><p> Tên tài khoản </p></label>
        <div class="form-inline">
            <input type="text" name="user" placeholder="Nhập tên tài khoản" class="form-control" autofocus />
        </div>
    </div>
    <div class="form-group">
        <label><p> Họ tên đầy đủ của giáo viên </p></label>
        <div class="form-inline">
            <input type="text" name="name" placeholder="Nhập tên giáo viên" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label><p> Chọn bộ môn </p></label>
        <div class="form-inline">
            <select class="form-control" name="course">
                <?php
                foreach ($course as $c)
                {
                    ?>
                    <option value="<?php echo $c->id ?>"> <?php echo $c->name ?> </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <em> Mật khẩu mặc định : <strong class="text-success">12345678</strong> </em>
    </div>
    <button type="submit" class="btn btn-primary" name="insert" value="1" title="Thêm mới"><span class="fa fa-check"></span> Xác nhận </button>

</form>
