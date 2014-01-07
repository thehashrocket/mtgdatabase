<?php
/**
 * Created by PhpStorm.
 * User: jason
 * Date: 11/30/13
 * Time: 11:16 AM
 */

class DecksController extends BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    protected $layout = 'layouts.master';

    public function getDecks($deck="") {

        $data = array();

        /* A deck id was passed */
        if (isset($deck) && strlen($deck) > 0) {

            /* Get deck info */
            $reqdeck =  Deck::find($deck);

            /* is the visitor logged in? */
            if (isset(Auth::user()->id)) {

                $data['decks'] = Deck::where('user_id', '=', Auth::user()->id)->get();

                /* Does the visitor have permission to edit this deck */
                if ($reqdeck->user_id == Auth::user()->id) {
                    $data['authorized'] = true;
                } else {
                    $data['deck'] = Deck::find($deck);
                    $data['owner'] = User::find($reqdeck->user_id);
                    $data['authorized'] = false;
                }
            } else {
                $data['deck'] = Deck::find($deck);
                $data['owner'] = User::find($reqdeck->user_id);
                $data['authorized'] = false;
            }

        } else {
            if (isset(Auth::user()->id)) {
                $data['decks'] = Deck::where('user_id', '=', Auth::user()->id)->get();
            } else {
                echo 'hello';
                exit;
            }

        }

        $deck = Deck::find($deck);

        foreach($deck->cards as $card) {

            $cards[] = DB::table('singlecards')
                ->where('singlecards.id', $card->id)
                ->leftJoin('cards', 'singlecards.card_id', '=', 'cards.card_id')
                ->get();
        }

        if (isset($cards) && count($cards) > 0) {
            $data['cards'] = $cards;

        } else {
            $data['cards'] = 0;
        }

        $this->layout->with('data', $data);

        $this->layout->content = View::make('users.decks', $data);

    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), Deck::$rules);

        if ($validator->passes()) {
            // validation has passed, save user in DB

            $deck = new Deck;
            $deck->name = Input::get('deckName');
            $deck->user_id = Auth::user()->id;
            $deck->save();

            return Redirect::to('users/decks')->with('message', 'New deck created.');
        } else {
            // validation has failed, display error messages
            return Redirect::to('users/decks')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

}