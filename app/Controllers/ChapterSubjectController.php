<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/20
 * Time: 22:43
 */

namespace App\controllers;
use App\Helper\DbHelper;

class ChapterSubjectController extends Controller
{
    public function get($id)
    {
        $cols = Array("*");
        $id = (int)$id;
        $subjects = $this->db->where('test_id', $id)->get("subjects", null, $cols);
        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', false);
        $this->smarty->assign('id', $id);
        return $this->smarty->display('chapter/subject.html');
    }

    public function post($id)
    {
        $cols = Array("*");
        $id = (int)$id;
        $subjects = $this->db->where('test_id', $id)->get("subjects", null, $cols);

        $static = DbHelper::checkSubject($this->db, $subjects,  $_POST['checked']);

        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', true);
        $this->smarty->assign('id', $id);
        $this->smarty->assign('msg', "共{$static['total']}道题，答对{$static['isTrue']}道，正确率{$static['trueApr']}%.");
        return $this->smarty->display('chapter/subject.html');
    }
}