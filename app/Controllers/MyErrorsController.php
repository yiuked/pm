<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/20
 * Time: 22:43
 */

namespace App\controllers;

use App\Helper\DbHelper;

class MyErrorsController extends Controller
{
    public function get()
    {
        $cols = Array("*");
        $subjects = $this->db->where('true_percent', 1)->get("subjects", null, $cols);
        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', false);
        return $this->smarty->display('errors/my.html');
    }

    public function post()
    {
        $cols = Array("*");
        $subjects = $this->db->where('true_percent', 1)->get("subjects", null, $cols);

        $static = DbHelper::checkSubject($this->db, $subjects,  $_POST['checked']);

        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', true);
        $this->smarty->assign('msg', "共{$static['total']}道题，答对{$static['isTrue']}道，正确率{$static['trueApr']}%.");
        return $this->smarty->display('errors/my.html');
    }
}