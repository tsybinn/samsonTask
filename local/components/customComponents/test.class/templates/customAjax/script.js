$(document).on('click', '.editResult', function (e) {
    var $id = $(this).data('id');
    e.preventDefault();
    $.ajax({
        type: "POST",
        cache: false,
        url: '/local/components/customComponents/form.result.list.Custom/templates/customAjax/ajax/seeResult.php',
        data: {'ID': $id},
        success: function (data) {
            // on success, post (preview) returned data in fancybox
            $.fancybox(data, {
                // fancybox API options
                fitToView: false,
                width: 700,
                height: 400,
                autoSize: true,
                closeClick: false,
                openEffect: 'none',
                closeEffect: 'none'
            }); // fancybox
            //console.log(data);
        } // success
    }); // ajax
}); // on

$(document).ready(function () {
    $(".modalbox").fancybox();
    $("#f_contact").submit(function () {
        return false;
    });
    $("#f_send").on("click", function () {
        $(".mes").remove();
        var formData = new FormData();
        formData.append('FIO', $('#FIO').val());
        formData.append('DESCR', $('#DESCR').val());
        formData.append('FILE', $('#FILE')[0].files[0]);

        jQuery.ajax({
            url: '/local/components/customComponents/form.result.list.Custom/templates/customAjax/ajax/result.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            dataType: 'html',
            success: function (response) {
                console.log(response);
                var res = $(response).filter('p').text();
                console.log(res);
                $("#f_contact").before('<p class="mes">' + res + '</p>');
                if ($(response).filter('p').hasClass('resOk')) {
                    $('#f_contact').trigger("reset");
                }
            }
        });
    });


});

$(document).on('change', 'select', function (e) {
    if ($('select').val() == 3) {
        $(this).next().show();
    } else {
        $(this).next().hide();
    }
})

$(document).on('click', '#seeSend', function (e) {

    $("#seeResult").submit(function () {
        return false;
    });
    if ($('#comment').val() == "" && $('select').val() == 3) {
        $('#comment').css('border-color', 'red');
    } else {
        var formData = new FormData();
        formData.append('ID', $("#seeResult").attr("data_id"));
        formData.append('DATA_CREATE', $("#seeResult").attr("data_create"));
        formData.append('USER', $('#user').val());
        formData.append('FIO', $('#5').val());
        formData.append('DESCR', $('#6').val());
        formData.append('FILE', $('#7').val());
        formData.append('TITLE', $('select').val());
        formData.append('COMMENT', $('#comment').val());

        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]);
        // }
        jQuery.ajax({
            url: '/local/components/customComponents/form.result.list.Custom/templates/customAjax/ajax/updateResult.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            dataType: 'html',
            success: function (response) {
                console.log(response);
                $.fancybox(response, {
                    // fancybox API options
                    fitToView: false,
                    width: 700,
                    height: 400,
                    autoSize: true,
                    closeClick: false,
                    openEffect: 'none',
                    closeEffect: 'none'
                }); // fancybox
                $(document).on('click', '.fancybox-close', function (e) {
                    location.reload();
                });
            }
        });
    }
});




