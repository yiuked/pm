<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/21
 * Time: 9:34
 */

namespace App\controllers;


class ErrorsController extends Controller
{
    public function get()
    {
        return $this->smarty->display('errors/errors.html');
    }
}