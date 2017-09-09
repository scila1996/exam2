<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
<script src="/libs/user/files/js/app.js"></script>
<?php if ($message): ?>
    <div class="alert <?= "alert-{$message['type']}" ?>">
        <?= $message['str'] ?>
    </div>
<?php endif; ?>
<div class="container-fixed">
    <div class="row">
        <div class="col-xs-12">
            <div id="controls" class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Tùy chọn &nbsp;<span class="caret"></span></button>
                <ul class="dropdown-menu">
                </ul>
            </div>
            <hr />
            <div id="tree"></div>
        </div>
    </div>
</div>
