<?php
/**
 * Created by PhpStorm.
 * User: jason
 * Date: 11/30/13
 * Time: 11:16 AM
 */

class SingleController extends BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    protected $layout = 'layouts.master';

    public function postCreate() {
        $validator = Validator::make(Input::all(), Single::$rules);

        if ($validator->passes()) {
            // validation has passed, save user in DB

            $card = new Single;
            $card->card_id = Input::get('card_id');
            $card->user_id = Auth::user()->id;
            $card->condition_id = Input::get('condition_id');
            $card->save();

        if (Input::get('deck_id') != '') {

            $set = new DeckCard;
            $set->card_id = Input::get('card_id');
            $set->deck_id = Input::get('deck_id');
            $set->save();

            $userid = Auth::user()->id;

            $deckid = Input::get('deck_id');

            return Redirect::to('/users/decks')->with(array('deckid' => $deckid, 'userid' => $userid, 'message' => 'New card added.'));


        }

            return Redirect::to('/users/dashboard')->with('message', 'New card added.');
        } else {
            // validation has failed, display error messages
            return Redirect::to('decks/1/1')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

}