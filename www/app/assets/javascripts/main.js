$(function() {

    // http://jqueryui.com/autocomplete/#remote-jsonp
    $( '#search' ).autocomplete({
        source: function( request, response ){

            $.ajax({
                url: "/search/AjaxSearch",
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
                url: "/search/lookup/" + ui.item.id
            }).done(function(html_form) {
                    if(('#cardsList > #addCard').length > 0) {
                        $('#addCard').css('display', 'none');
                    }
                    $('#search').after($('#addCard').html(html_form).css('display', 'block'));
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

    $('a.close-reveal-modal').trigger('click');

    $('#addCard').on('click', 'a.delete', function(e) {
        e.preventDefault();

        origin = $(this);

        item = $(this).attr('href');

        $.ajax({
            type: "GET",
            url: "/card/deleteCard/" + item
        }).done(function(d){

                $(origin).closest('#addCard').fadeOut();

            })

        $('a[href=' + item + ']').fadeOut();
    });

    $('#cardsList').on('click','.singlecard a', function(e) {
        e.preventDefault();
        item = $(this).attr('href');
        var link = $(this);


        $.ajax({
            type: "GET",
            url: "/search/card/" + item
        }).done(function(html_form) {

            if(('#cardsList > #addCard').length > 0) {
                $('#addCard').css('display', 'none');
            }
                if($('#cardsList').hasClass('ul1')) {
                    $(link).parent('.singlecard').before($('#addCard').html(html_form).css('display', 'block'));
                } else {
                    console.log('hello');
                    $('#addCard').html(html_form);
                    $('#addCard').foundation('reveal', 'open');
                }



            });
    })

    $('#addCard').on('click','a.close', function(e){
        e.preventDefault();

        $('#addCard').css('display','none');
    })

    $('a.deck').hover(
        // mouseover
        function(){
            item = $(this).attr('data-deck');

            $('a.deckDelete').fadeOut('fast');

            $('a.deckDelete.' + item ).fadeIn('fast');
        },
        // mouseout
        function(){
            item = $(this).attr('data-deck');
            setTimeout( function(){
                $('a.deckDelete.' + item ).fadeOut('fast')
            }, 2500 );
        }
    );

    $('#decksList').on('click', 'a.deckDelete', function(e){

        e.preventDefault();

        origin = $(this);

        item = $(this).attr('href');

        $.ajax({
            type: "GET",
            url: "/decks/deleteDeck/" + item
        }).done(function(d){

                console.log(item);
                $("[data-deck='" + item + "']").fadeOut('slow');

            })

        $('a[href=' + item + ']').fadeOut();

    })

    $(document).foundation();
});
