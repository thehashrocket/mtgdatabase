<?php
/**
 * Created by PhpStorm.
 * User: jason
 * Date: 11/30/13
 * Time: 11:16 AM
 */

class UsersController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth', array('only'=>array('getDashboard')));
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    protected $layout = 'layouts.master';

    public function getDashboard() {

        $data = array();

        $data['decks'] = Deck::where('user_id', '=', Auth::user()->id)->get();

        $this->layout->with('data', $data);

        $this->layout->content = View::make('users.dashboard', $data);

    }

    public function getDecks() {

        $data = array();

        if (isset(Auth::user()->id)) {
            $data['decks'] = Deck::where('user_id', '=', Auth::user()->id)->get();
            $data['authorized'] = true;

        } else {

            $data['deckid'] = Session::get('deckid');

            $data['authorized'] = false;
            $data['decks'] = "";
        }

        $data['decks'] = Deck::where('user_id', '=', Auth::user()->id)->get();

        $this->layout->with('data', $data);

        $this->layout->content = View::make('users.decks', $data);

    }

    public function getLogin() {
        $this->layout->content = View::make('users.login');
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('users/login')->with('message', 'Your are now logged out!');
    }

    public function getRegister() {
        $this->layout->content = View::make('users.register');
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), User::$rules);

        if ($validator->passes()) {
            // validation has passed, save user in DB
            $user = new User;
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            return Redirect::to('users/login')->with('message', 'Thanks for registering!');
        } else {
            // validation has failed, display error messages
            return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

    public function postSignin() {

        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
            return Redirect::to('users/dashboard')->with('message', 'You are now logged in!');
        } else {
            return Redirect::to('users/login')
                ->with('message', 'Your username/password combination was incorrect')
                ->withInput();
        }

    }

}