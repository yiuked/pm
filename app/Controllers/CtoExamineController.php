<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/23
 * Time: 11:41
 */

namespace App\Controllers;

use App\Helper\CtoHelper;

class CtoExamineController extends Controller
{
    public function get($examine_id)
    {
        $cols = Array("*");
        $subjects = $this->db->where('examine_id', $examine_id)->get("cto_question", null, $cols);
        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('examine_id', $examine_id);
        $this->smarty->assign('show', false);
        return $this->smarty->display('51cto/examine.html');
    }

    public function post($examine_id)
    {
        $cols = Array("*");
        $subjects = $this->db->where('examine_id', $examine_id)->get("cto_question", null, $cols);

        $static = CtoHelper::checkExamineSubject($this->db, $subjects,  $_POST['checked']);

        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('examine_id', $examine_id);
        $this->smarty->assign('show', true);
        $this->smarty->assign('msg', "共{$static['total']}道题，答对{$static['isTrue']}道，正确率{$static['trueApr']}%.");
        return $this->smarty->display('51cto/examine.html');
    }
}