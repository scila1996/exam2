{{ mathjax }}
<!--
here: http://markgx.github.io/jquery-check-all/
-->
<script src="/libs/plugin/js/jquery-check-all.min.js"></script>
<script src="/libs/user/files/exam/question/js/main.js"></script>
<form method="post" class="require-checkbox-from-table">
    <div class="form-group">
        <span class="dropdown">
            <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"> Thêm mới <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li class="dropdown-header"> Trắc nghiệm </li>
                <li><a href="{{ link->mc }}"> Chọn đáp án </a></li>
                <li><a href="{{ link->link }}"> Ghép nối </a></li>
                <li><a href="{{ link->fill }}"> Điền khuyết </a></li>
                <li class="divider"></li>
                <li class="dropdown-header"> Khác </li>
                <li><a href="{{ link->normal }}"> Tự luận </a></li>
            </ul>
        </span>
        <button type="submit" class="btn btn-warning btn-xs" name="delete" value="1" > Xóa câu hỏi </button>
    </div>
    {{ table }}
</form>
