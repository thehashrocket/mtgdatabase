<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Deck extends Eloquent {

    public function __construct() {

    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deck';

    public static $rules = array(
        'deckName'=>'required|min:2'
    );


    public function cards()
    {
        return $this->hasMany('Card');
    }

    public function decks() {
        $decks = DB::table('deck')->where('votes', '>', 100)->get();
    }

}