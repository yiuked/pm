<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/20
 * Time: 22:43
 */

namespace App\controllers;


class SubjectController extends Controller
{
    public function get($id)
    {
        $cols = Array ("*");
        $chapters = $this->db->where('testid', $id)->get ("subjects", null, $cols);
        $this->smarty->assign('subjects', $chapters);
        return $this->smarty->display('subject.html');
    }
}