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

    public function getDecks($deck="", $user_id = "") {

        $data = array();

        if (isset(Auth::user()->id)) {
            if ($user_id == Auth::user()->id) {
                $data['decks'] = Deck::where('user_id', '=', Auth::user()->id)->get();
                $data['authorized'] = true;
            }

        } else {

            $data['authorized'] = false;
            $data['decks'] = "";
        }



        $data['deck'] = Deck::where('id', '=', $deck)->get();

//        $data['cards'] = Single::where('id', '=', $deck)->get();

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