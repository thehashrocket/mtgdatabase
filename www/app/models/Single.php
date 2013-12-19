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
    protected $table = 'singlecard';

    public static $rules = array(
        'card_id'=>'required|alpha|min:1',
        'num_cards'=>'required|alpha|min:1'
    );


    public function decks()
    {
        return $this->hasMany('Deck');
    }

}