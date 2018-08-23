<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/23
 * Time: 11:41
 */

namespace App\Controllers;

class CtoController extends Controller
{
    public function get()
    {
        $cols = Array("*");
        $examines = $this->db->get("cto_examine", null, $cols);
        $this->smarty->assign('examines', $examines);
        return $this->smarty->display('51cto/index.html');
    }
}