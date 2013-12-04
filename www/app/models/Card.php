<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Card extends Eloquent {

    public function __construct() {


    }


    /**
     * Generate random number,
     * @return mixed
     */
    public static function getCardOfTheDay()
	{
        $curl = new anlutro\cURL\cURL;

        $id = rand ( 1 , 8872 );

        $url = $curl->buildUrl('http://mtgapi.com/api/v1/fetch/id/' . $id, ['token' => '0821d5019178107cbc66331573280f7c1346550a']);

        $card = json_decode($curl->get($url));

		return $card;
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}