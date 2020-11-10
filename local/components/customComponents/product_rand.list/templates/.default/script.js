$(document).ready(function () {
    //* ajax pagination
    $(document).on('click', '.load_more', function () {
        var idIgnor = [];
        $(".news-item").each(function () {
            idIgnor.push($(this).attr("id-ignor"));
        });
        var targetContainer = $('.news-list_elem');        //  Контейнер, в котором хранятся элементы
        $.ajax({
            type: 'POST',
            url: "/local/components/customComponents/product_rand.list/ajax/getRandProd.php",
            data: {'ID': idIgnor},
            dataType: 'html',
            success: function (data) {
                var elements = $(data).filter('.news-item');  //  Ищем элементы
                var pagination = $(data).find('.load_more').attr("data-url");//  Ищем навигацию
                $('.load_more').attr("data-url", pagination);
                targetContainer.append(elements);   //  Добавляем посты в конец контейнера
            }
        })
    });
    let result = {}; // array with modified elements
    $(window).scroll(function () {
        var elems = $(".news-item");
        elems.each(function () {
            var scrollTop = $(window).scrollTop();
            var windowHeight = $(window).height();
            offset = $(this).offset(); // вычисляем позицию элемента
            if (scrollTop <= offset.top && (($(this).height() * 0.7 + offset.top)) < (scrollTop + windowHeight)) {
                result[$(this).attr("id-ignor")] = $(this).find(".voitingRes").html();
            }
        })
    });
    /*
    request in php file for change data base
    */
    function request() {
        url = '/local/components/customComponents/product_rand.list/ajax/updateProperty.php'  //  URL, file with code change data base
        // if (url !== undefined  && result.length !== 0) { // if correct url and  array not empty
        $.ajax({
            type: 'POST',
            url: url,
            data: result, //"array with changed data",
        })
        //   }
    };
    $(window).on('beforeunload unload ', request); // beforeunload  unload вместе для корректной работы в всез браузерах
});


