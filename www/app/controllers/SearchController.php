<?php

class SearchController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    protected $layout = 'layouts.blank';

    public function doSearch( $card_id )
    {

        $card = Singlecard::find($card_id);

//        $cardSetsQuery = DB::table( 'cards' )->where( 'name', '=', $card->name )->get();

        $data = array();
        $data['card_data'] = $card;
        $data['condition'] = Condition::all();

        if (isset(Auth::user()->id)) {
            $data['decks'] = Deck::where('user_id', '=', Auth::user()->id)->get();
        } else {

        }

        $data['attributes'] = Attribute::all();

        $this->layout->content = View::make( 'cards.single', $data );

    }

    public function showSearch()
    {

        $maxRows = Input::get( "maxRows" );
        $variable = Input::get( "name_startsWith" );

        $cardsArray = array();

        $cardsQuery = DB::table( 'cards' )->where( 'name', 'like', '%' . $variable . '%' )->orderBy( 'released_at', 'desc' )->groupBy( 'name' )->take( $maxRows )->get();

        foreach( $cardsQuery as $data ){
            array_push( $cardsArray, array( 'name' => $data->name, 'id' => $data->id ) );
        }

        $jsonObj = json_encode( $cardsArray, JSON_FORCE_OBJECT );

        header( 'Content-Type: application/json; charset=utf8' );

        if( ! isset( $_GET[ 'callback' ] ) )
            exit( $jsonObj );

        if( $this->is_valid_callback( $_GET[ 'callback' ] ) )
            exit( "{$_GET['callback']}($jsonObj)" );

        # Otherwise, bad request
        header( 'status: 400 Bad Request', true, 400 );

    }

    public function is_valid_callback( $subject )
    {
        $identifier_syntax = '/^[$_\p{L}][$_\p{L}\p{Mn}\p{Mc}\p{Nd}\p{Pc}\x{200C}\x{200D}]*+$/u';

        $reserved_words = array( 'break', 'do', 'instanceof', 'typeof', 'case',
            'else', 'new', 'var', 'catch', 'finally', 'return', 'void', 'continue',
            'for', 'switch', 'while', 'debugger', 'function', 'this', 'with',
            'default', 'if', 'throw', 'delete', 'in', 'try', 'class', 'enum',
            'extends', 'super', 'const', 'export', 'import', 'implements', 'let',
            'private', 'public', 'yield', 'interface', 'package', 'protected',
            'static', 'null', 'true', 'false' );

        return preg_match ($identifier_syntax, $subject ) && ! in_array( mb_strtolower ($subject, 'UTF-8' ), $reserved_words );
    }

}