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


            $url = Request::url();

            var_dump($url);

            exit;

            $card = new Card;
            $card->name = Input::get('card_id');
            $card->user_id = Auth::user()->id;
            $card->save();

            return Redirect::to('decks')->with('message', 'New card added.');
        } else {
            // validation has failed, display error messages
            return Redirect::to('decks')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

}