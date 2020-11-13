
$(document).ready(function () {
    $('.arrow-up').on('click', function() {
        $('.userList tr').sort(function(a, b) { // сортируем
           return +$(a).find('[data-name=sort]').attr('data-value') - +$(b).find('[data-name=sort]').attr('data-value');
        })
            .appendTo('.userList');// возвращаем в контейнер
    });
    $('.arrow-down').on('click', function() {
        $('.userList tr').sort(function(a, b) { // сортируем
            return +$(b).find('[data-name=sort]').attr('data-value') - +$(a).find('[data-name=sort]').attr('data-value');
        })
            .appendTo('.userList');// возвращаем в контейнер
    });

    var $result = $('#search_box-result');
//console.log($result);
    $('#search').on('keyup', function () {
        var search = $(this).val();
        if ((search != '') && (search.length > 1)) {
            // console.log(search);
            $.ajax({
                type: "POST",
                url: "/local/ajax/ajaxSearchEmail.php",
                data: {'search': search},
                success: function (msg) {
                    console.log(msg);
                    $result.html(msg);
                    if (msg != '') {
                        $result.fadeIn();
                    } else {
                        $result.fadeOut(100);
                    }
                }
            });
        } else {
            $result.html('');
            $result.fadeOut(100);
        }
    });
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.search_box').length) {
            $result.html('');
            $result.fadeOut(100);
        }
    });
});
