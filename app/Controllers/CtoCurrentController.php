<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/23
 * Time: 11:41
 */

namespace App\Controllers;

use App\Helper\CtoHelper;

class CtoCurrentController extends Controller
{
    public function get()
    {
        $cols = Array("*");
        $subjects = $this->db->where('is_right', 0)->get("cto_question", null, $cols);
        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', false);
        return $this->smarty->display('51cto/current.html');
    }

    public function post()
    {
        $cols = Array("*");
        $subjects = $this->db->where('is_right', 0)->get("cto_question", null, $cols);

        $static = CtoHelper::checkExamineSubject($this->db, $subjects,  $_POST['checked']);

        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', true);
        $this->smarty->assign('msg', "共{$static['total']}道题，答对{$static['isTrue']}道，正确率{$static['trueApr']}%.");
        return $this->smarty->display('51cto/current.html');
    }
}