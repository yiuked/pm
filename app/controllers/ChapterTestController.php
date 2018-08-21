<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/20
 * Time: 22:43
 */

namespace App\controllers;


class ChapterTestController extends Controller
{
    public function get($id)
    {
        $cols = Array ("*");
        $subjects = $this->db->where('test_id', $id)->get ("subjects", null, $cols);
        $this->smarty->assign('subjects', json_encode($subjects));
        return $this->smarty->display('chapter/subject.html');
    }
}