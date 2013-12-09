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


    public function cards()
    {
        return $this->hasMany('Card');
    }










}