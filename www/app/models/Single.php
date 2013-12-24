<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Single extends Eloquent {

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




    public function decks()
    {
        return $this->belongsToMany('Deck');
    }

}