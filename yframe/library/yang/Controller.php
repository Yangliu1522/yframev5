<?php
/**
 * Created by PhpStorm.
 * User: yyang
 * Date: 18-1-13
 * Time: 上午2:57
 */

namespace yang;


class Controller {
    protected $request;

    public function __construct()
    {
        $this->request = Request::create();
    }

    public function display($name, $assign = []) {
        return View::fetch($name, $assign);
    }

    public function assign($name, $value) {
        View::assign($name, $value);
    }
}