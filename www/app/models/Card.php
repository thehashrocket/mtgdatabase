<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Card extends Eloquent {

    public function __construct() {


    }


	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public static function getCardOfTheDay()
	{
        $curl = new anlutro\cURL\cURL;

        $url = $curl->buildUrl('http://mtgapi.com/api/v1/fetch/id/1', ['token' => '0821d5019178107cbc66331573280f7c1346550a']);

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