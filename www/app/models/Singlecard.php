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
        return $this->hasMany('AttributeCard', 'singlecard_id');
    }



    /**
     * @return
     */

    public function decks()
    {
        return $this->belongsToMany('Deck');
    }

}