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

        $validator = Validator::make(Input::all(), Singlecard::$rules);

        if ($validator->passes()) {
            // validation has passed, save user in DB

            $num_cards = Input::get('num_cards');

            $x = 1;

            while ($x <= $num_cards) {

                $card = new Singlecard;
                $card->card_id = Input::get('card_id');
                $card->user_id = Auth::user()->id;
                $card->deck_id = Input::get('deck_id');
                $card->condition_id = Input::get('condition_id');
                $card->save();

                $id = $card->id;

                $checkboxes = Input::get('attributes');

                if(is_array($checkboxes))
                {
                    foreach($checkboxes as $check) {

                        $attr = new AttributeCard;
                        $attr->singlecard_id = $id;
                        $attr->attribute_id = $check;
                        $attr->save();

                    }

                }

                if (Input::get('deck_id') != '') {

                    $set = new DeckCard;
                    $set->singlecard_id = $id;
                    $set->deck_id = Input::get('deck_id');
                    $set->save();

                }

                $x = $x + 1;
            }

        if (Input::get('deck_id') != '') {

            $userid = Auth::user()->id;

            $deckid = Input::get('deck_id');

            return Redirect::back()->with(array('deckid' => $deckid, 'userid' => $userid, 'message' => 'New card added.'));

        }

            return Redirect::back()->with('message', 'New card added.');
        } else {
            // validation has failed, display error messages
            return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

    public function postUpdate() {

        $validator = Validator::make(Input::all(), Singlecard::$rules);

        if ($validator->passes()) {

            $card = Singlecard::find(Input::get('card_id'));
            $card->deck_id = Input::get('deck_id');
            $card->condition_id = Input::get('condition_id');
            $card->save();

            $checkboxes = Input::get('attributes');

            if(is_array($checkboxes))
            {
                $attr = AttributeCard::where('singlecard_id', '=', Input::get('card_id'))->delete();

                foreach($checkboxes as $check) {

                    $attr = new AttributeCard;
                    $attr->singlecard_id = Input::get('card_id');
                    $attr->attribute_id = $check;
                    $attr->save();

                }

            }

            return Redirect::back()->with('message', 'Card updated.');
        }



        else {

        }

    }

}