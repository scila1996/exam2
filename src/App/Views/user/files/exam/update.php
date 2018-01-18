<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="/asset/user/files/exam/js/form.js"></script>

<?= $ckeditor ?>

<form method="post" class="panel panel-default" id="exam-form">
    <div class="panel-heading">
        <span class="text-muted"> Nhập thông tin cho đề thi </span>
    </div>
    <div class="panel-body">
        <div class="form-hint"></div>
        <label> Tên đề thi </label>
        <div class="form-group">
            <input type="text" name="name" value="<?= $data->name ?>" placeholder="Nhập tên đề thi" class="form-control" autocomplete="off" autofocus />
        </div>
        <label> Header </label>
        <div class="form-group">
            <textarea name="header"> <?= $data->header ?> </textarea>
        </div>
        <label> Footer </label>
        <div class="form-group">
            <textarea name="footer"> <?= $data->footer ?> </textarea>
        </div>
        <label><input type="checkbox" name="event" value="true" <?= $data->date !== null ? 'checked' : '' ?> /> Ngày thi </label>
        <div class="form-group">
            <input type="text" name="date" value="<?= $data->date ?>" placeholder="Ngày giờ thi" class="form-control" autocomplete="off" <?= $data->date === null ? 'disabled' : '' ?> />
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-primary" title="Cập nhật thay đổi"><span class="fa fa-check-square-o"></span> Xác nhận </button>
    </div>
</form>
