<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/20
 * Time: 21:49
 */

namespace App\Controllers;

class IndexController extends Controller
{
    public function get() {
        return $this->smarty->display('index.html');
    }
}