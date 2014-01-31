<?php
/**
 * Created by PhpStorm.
 * User: jason
 * Date: 11/30/13
 * Time: 11:16 AM
 */

class CardsController extends BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    protected $layout = 'layouts.master';

    public function getSingle($card="") {
        var_dump($card);
        exit;
    }

    public function postDeleteCard($card="") {
        if ($card != "") {
            $foo = Singlecard::find($card);

            $foo->delete();

            return $foo;
        } else {
            return false;
        }
    }



}