$(document).ready(function () {
    $('[data-toggle="popover"]').popover({
        trigger: 'hover'
    });
    $('body').tooltip({
        selector: 'button[title], a[title]',
        container: 'body'
    });
    $('body').on('focus', 'button, a', function () {
        $(this).blur();
    });
    $(document).on('click', 'a.be-care', function (e) {
        e.preventDefault();
        var that = this;
        try
        {
            $.confirm({
                title: 'Xác nhận',
                content: 'Bạn có chắc chắn muốn xóa ?',
                type: 'red',
                buttons: {
                    OK: {
                        text: 'Có',
                        action: function () {
                            window.location.href = $(that).prop('href');
                            return false;
                        }
                    },
                    NO: {
                        text: 'Không'
                    }
                }
            });
        } catch (err)
        {
            console.log(err);
        }
    });
});
