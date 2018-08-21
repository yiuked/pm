<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/20
 * Time: 21:49
 */

namespace App\Controllers;

class FormController extends Controller
{
    public function get($id) {
        return $this->smarty->display('form.html');
    }
}