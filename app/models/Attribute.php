<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Attribute extends Eloquent {

    public function __construct() {

    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attributes';

    public static $rules = array(
        'deckName'=>'required|min:2'
    );

    public function cards()
    {
        return $this->belongsToMany('Singlecard');
    }

}