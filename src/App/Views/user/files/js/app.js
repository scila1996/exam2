$(document).ready(function () {

    function Options(oitem) {
        var category = function ()
        {
            var s = `
            <li><a href="/user/category/${oitem.id}/create"><span class="fa fa-folder"></span> Tạo thư mục con </a></li>
`;
            if (oitem.id)
            {
                s += `
            <li><a href="/user/category/${oitem.id}/exam/create"><span class="fa fa-file"></span> Tạo đề thi </a></li>
            <li><a href="/user/category/${oitem.id}/edit"><span class="fa fa-edit"></span> Sửa danh mục </a></li>
            <li><a href="/user/category/${oitem.id}/delete?type=${oitem.type_id}" class="be-care"><span class="fa fa-remove"></span> Xóa danh mục này </a></li>      
`;
            }
            return s;
        };

        var file = function ()
        {
            return `
            <li><a href="/user/category/${oitem.parent_id}/exam/${oitem.id}/question"><span class="fa fa-cog"></span> Quản lý câu hỏi </a></li>
            <li><a href="/user/category/${oitem.parent_id}/exam/${oitem.id}/edit"><span class="fa fa-pencil"></span> Chỉnh sửa </a></li>
            <li><a href="#"><span class="fa fa-share"></span> Chia sẻ (phân quyền) </a></li>
            <li><a href="#"><span class="fa fa-copy"></span> Sao chép </a></li>
            <li><a href="#"><span class="fa fa-download"></span> Bốc câu hỏi </a></li>
            <li><a href="#" target="_blank"><span class="fa fa-list-alt"></span> Xuất bản </a></li>
            <li><a href="/user/category/${oitem.parent_id}/exam/${oitem.id}/delete" class="be-care"><span class="fa fa-trash"></span> Xóa </a></li>
`;
        }


        this.toString = function () {
            return `
            <li class="dropdown-header" id="file-title"> Tên: ${oitem.name} </li>
            <li class="divider"></li>
            ` + (function () {
                switch (oitem.type_id)
                {
                    case 0:
                    case 1:
                        return category();
                    case 2:
                        return file();
                }
            })();
        };
    }
    console.log(String(new Options(5)));
    (function () {
        var tree = $('#tree');
        var controls = $('#controls ul');
        var data = [];
        $.ajax({
            url: '/user/files/0/get/tree',
            method: 'GET',
            async: false,
            dataType: 'json'
        }).success(function (d) {
            data = [{
                    text: 'Thư mục gốc',
                    href: 'javascript:void(0)',
                    data: {
                        name: 'Thư mục gốc',
                        type_id: 0,
                        id: 0
                    },
                    nodes: d
                }];
        });
        tree.treeview({
            enableLinks: false,
            highlightSelected: true,
            selectedColor: '#669900',
            nodeIcon: 'fa fa-folder',
            collapseIcon: 'fa fa-chevron-down',
            expandIcon: 'fa fa-chevron-right',
            selectedBackColor: 'inherit',
            data: data,
            onNodeSelected: function (event, node) {
                $('#file-title').text(node.name);
                $('#controls button').removeClass('disabled');
                var s = String(new Options(node.data));
                controls.html(s);
            },
            onNodeUnselected: function (event, node) {
                controls.html('');
                $('#file-title').text('Chưa chọn file');
                $('#controls button').addClass('disabled');
            }
        });
        tree.treeview('expandAll', {levels: 5, silent: false});
        tree.treeview('selectNode', 0, {silent: false});
    })();
});