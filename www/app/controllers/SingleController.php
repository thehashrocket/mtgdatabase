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

            return Redirect::to('decks/1/1')->with('message', 'New card added.');
        } else {
            // validation has failed, display error messages
            return Redirect::to('decks/1/1')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

}