<?php
/**
 * Created by PhpStorm.
 * User: jason
 * Date: 11/30/13
 * Time: 11:16 AM
 */

class CardsController extends BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    protected $layout = 'layouts.master';

    public function postCreate() {
        $validator = Validator::make(Input::all(), Card::$rules);


        if ($validator->passes()) {
            // validation has passed, save user in DB

            $deck = new Card;
            $deck->name = Input::get('cardName');
            $deck->user_id = Auth::user()->id;
            $deck->save();

            return Redirect::to('users/decks')->with('message', 'New card created.');
        } else {
            // validation has failed, display error messages
            return Redirect::to('users/decks')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

}