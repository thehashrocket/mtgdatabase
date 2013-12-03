<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    /**e
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.master';

    public function __construct() {

        $this->curl = new anlutro\cURL\cURL;
    }



	public function getIndex()
	{

        $data = array();



        $this->layout->with('data', $data);

        $this->layout->content = View::make('hello', $data);
	}

}