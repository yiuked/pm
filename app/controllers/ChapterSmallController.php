<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/20
 * Time: 22:43
 */

namespace App\controllers;


class ChapterSmallController extends Controller
{
    public function get($id)
    {
        $cols = Array ("*");
        $chapters = $this->db->where('type_small_id', $id)->get ("testtype", null, $cols);
        $this->smarty->assign('chapters', $chapters);
        return $this->smarty->display('chapter.html');
    }
}