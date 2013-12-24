$(function() {

    // http://jqueryui.com/autocomplete/#remote-jsonp
    $( '#search' ).autocomplete({
        source: function( request, response ){

            $.ajax({
                url: "/search",
                dataType: "jsonp",
                data: {
                    featureClass: "P",
                    style: "full",
                    maxRows: 10,
                    name_startsWith: request.term
                },
                success: function( data ){
                    response( $.map( data, function( item ){
                        return {
                            label: item.name,
                            value: item.name,
                            id: item.id
                        }
                    }));
                }
            });

        },
        minLength: 2,
        select: function( event, ui ){

            $.ajax({
                type: "GET",
                url: "/search/" + ui.item.id
            }).done(function(html_form) {
                    $('#addCard').html(html_form);
                    $('#addCard').css('display', 'block');
//                    $('#myModal').show();
                });

        },
        open: function(){
            $('ul.ui-autocomplete').removeAttr('style').hide().appendTo('#results').show();

//			$( this ).removeClass().addClass();
        },
        close: function() {
//			$( this ).removeClass().addClass();
        }
    });

    $('a.singlecard').hover(function(e) {
        e.preventDefault();
        console.log($(this).attr('href'));


        item = $(this).attr('href');



        $.ajax({
            type: "GET",
            url: "/search/" + item
        }).done(function(html_form) {
                $('#addCard').html(html_form);
                $('#addCard').css('display', 'block');
//                    $('#myModal').show();
            });

    })


    $(document).foundation();
});
