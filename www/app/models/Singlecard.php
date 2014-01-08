<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Singlecard extends Eloquent {

    public function __construct() {


    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'singlecards';

    public static $rules = array(
        'card_id'=>'required|min:1',
        'num_cards'=>'required|min:1',
        'condition_id' =>'required|min:1'
    );

    /**
     * @return
     */

    public function attributes()
    {
        return $this->belongsToMany('Attribute', 'attribute_singlecard','singlecard_id', 'attribute_id');
    }

    public function info()
    {
        return $this->hasOne('Card', 'card_id');
    }

    public function user() {
        return $this->belongsTo('User');
    }



    /**
     * @return
     */

    public function decks()
    {
        return $this->belongsToMany('Deck', 'deck_singlecard','singlecard_id', 'deck_id');
    }

}