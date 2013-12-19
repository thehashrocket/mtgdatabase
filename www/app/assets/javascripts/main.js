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

            window.location = "/search/" + ui.item.id

        },
        open: function(){
//			$( this ).removeClass().addClass();
        },
        close: function() {
//			$( this ).removeClass().addClass();
        }
    });


    $(document).foundation();
});
