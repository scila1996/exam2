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
            <input type="text" name="name" placeholder="Nhập tên đề thi" class="form-control" autocomplete="off" autofocus />
        </div>
        <label> Header </label>
        <div class="form-group">
            <textarea name="header"><table align="center" border="0" cellpadding="1" cellspacing="1" style="width:100%"><tbody><tr><td style="text-align:center"><strong>BỘ <u>GIÁO DỤC VÀ ĐÀO T</u>ẠO</strong></td><td style="text-align:center"><strong>KỲ THI TRUNG HỌC PHỔ THÔNG QUỐC GIA NĂM 2017</strong></td></tr><tr><td>&nbsp;</td><td style="text-align:center"><strong>Môn thi : TOÁN</strong></td></tr><tr><td style="text-align:center"><strong>ĐỀ THI MINH HỌA</strong></td><td style="text-align:center"><em>Thời <u>gian làm bài: 120 phút, không kể thời gian phát</u> đề</em></td></tr><tr><td style="text-align:center"><em>(Đề thi có 01 trang)</em></td><td style="text-align:center">&nbsp;</td></tr><tr><td style="vertical-align:top">&nbsp;</td><td style="vertical-align:top"><table align="center" border="1" cellpadding="10" cellspacing="1" style="width:150px"><tbody><tr><td style="text-align:center"><strong>Mã đề thi 012</strong></td></tr></tbody></table></td></tr></tbody></table></textarea>
        </div>
        <label> Footer </label>
        <div class="form-group">
            <textarea name="footer"><table align="center" border="0" cellpadding="1" cellspacing="1" style="width:100%"><tbody><tr><td style="text-align:center"><strong>---------------------------------------- HẾT&nbsp;----------------------------------------</strong></td></tr><tr><td style="text-align:center"><em>Thí sinh không được phép sử dụng tài liệu</em></td></tr></tbody></table>​​​​​</textarea>
        </div>
        <label><input type="checkbox" name="event" value="true" /> Ngày thi </label>
        <div class="form-group">
            <input type="text" name="date" placeholder="Ngày giờ thi" class="form-control" autocomplete="off" disabled="disabled" />
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-primary" name="insert" value="1" title="Thêm mới"><span class="fa fa-check-square-o"></span> Xác nhận </button>
    </div>
</form>
