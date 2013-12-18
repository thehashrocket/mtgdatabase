<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Card extends Eloquent {

    public function __construct() {


    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cards';


    public function decks()
    {
        return $this->hasMany('Deck');
    }


    /**
     * Generate random number,
     * @return mixed
     */
    public static function getCardOfTheDay()
	{

        $curl = new anlutro\cURL\cURL;

        $id = rand ( 1 , 21303 );

        $card = DB::table('cards')->where('id', $id)->first();

//        $url = $curl->buildUrl('http://mtgapi.com/api/v1/fetch/id/' . $id, ['token' => '0821d5019178107cbc66331573280f7c1346550a']);
//
//        $card = json_decode($curl->get($url));

		return $card;
	}

}