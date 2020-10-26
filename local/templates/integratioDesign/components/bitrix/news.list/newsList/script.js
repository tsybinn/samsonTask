

    $(document).ready(function () {
    $('.content_toggle').click(function () {
        button = $(this);
        button.prev().slideToggle(300, function () {
            button.html("Cкрыть все");
            if (($(this).css("display") == "none")) {
                button.html("Показать все");
            }
            ;
        });
    });
});

