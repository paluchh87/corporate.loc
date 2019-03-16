jQuery(document).ready(function ($) {

    $('.commentlist li').each(function (i) {
        $(this).find('div.commentNumber').text('#' + (i + 1));
    });

    $('#commentform').on('click', '#submit', function (e) {
        e.preventDefault();
        var comParent = $(this);

        $('.wrap_result').css('color', 'green').text('Saving comment...').fadeIn(500, function () {
            var data = $('#commentform').serializeArray();
            $.ajax({
                url: $('#commentform').attr('action'),
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                datatype: 'JSON',
                success: function (html) {
                    console.log(html);
                    if (html.error) {
                        $('.wrap_result').css('color', 'red').append('<br /><strong>ERROR: </strong>' + html.error.join('<br />'));
                        $('.wrap_result').delay(2000).fadeOut(500);
                    }
                    else if (html.success) {
                        $('.wrap_result')
                            .append('<br /><strong>Saved!</strong>')
                            .delay(2000)
                            .fadeOut(500, function () {
                                if (html.data.parent_id > 0) {
                                    comParent.parents('div#respond').prev().after('<ul class="children">' + html.comment + '</ul>');
                                }
                                else {
                                    if ($('#comments-title').attr('data-comment')!=='0') {
                                        alert ($('#comments-title').attr('data-comment'));
                                        $('ol.commentlist').append(html.comment);
                                    }
                                    else {
                                        alert (2);
                                        $('#respond').before('<ol class="commentlist group">' + html.comment + '</ol>');
                                    }
                                }
                                $('#cancel-comment-reply-link').click();
                            })
                    }
                },
                error: function (data) {
                    var str = '';
                    var data=$.parseJSON(data.responseText);
                    $.each(data.errors, function (index, value) {
                        str = str + index + ': ' + value + '<br>';
                    });

                    $('.wrap_result').css('color', 'red').append('<br /><strond>ERROR: <br>'+str+'</strong>');
                    $('.wrap_result').delay(2000).fadeOut(500, function () {
                        $('#cancel-comment-reply-link').click();
                    });
                }
            });
        });
    });
});