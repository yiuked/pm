<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/23
 * Time: 11:41
 */

namespace App\Controllers;

use App\Helper\CtoHelper;

class CtoErrorsController extends Controller
{
    public function get()
    {
        $cols = Array("*");
        $subjects = $this->db->where('is_error', 1)->get("cto_subjects", null, $cols);
        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', false);
        return $this->smarty->display('51cto/errors.html');
    }

    public function post()
    {
        $cols = Array("*");
        $subjects = $this->db->where('is_error', 1)->get("cto_subjects", null, $cols);

        $static = CtoHelper::checkErrorsSubject($this->db, $subjects,  $_POST['checked']);

        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', true);
        $this->smarty->assign('msg', "共{$static['total']}道题，答对{$static['isTrue']}道，正确率{$static['trueApr']}%.");
        return $this->smarty->display('51cto/errors.html');
    }
}