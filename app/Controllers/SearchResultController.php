<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/22
 * Time: 17:43
 */

namespace App\Controllers;

use App\Helper\DbHelper;

class SearchResultController extends Controller
{
    public function post($search) {
        $cols = Array("*");
        $search = trim(urldecode($search));
        $subjects = $this->db->where('name', "%{$search}%", 'LIKE', 'or')
            ->where('itemA', "%{$search}%", 'LIKE', 'or')
            ->where('itemB', "%{$search}%", 'LIKE', 'or')
            ->where('itemC', "%{$search}%", 'LIKE', 'or')
            ->where('itemD', "%{$search}%", 'LIKE', 'or')
            ->get("subjects", null, $cols);
        foreach ($subjects as &$subject) {
            $subject['name'] = str_replace($search, "<span style='color: red'>{$search}</span>", $subject['name']);
            $subject['itemA'] = str_replace($search, "<span style='color: red'>{$search}</span>", $subject['itemA']);
            $subject['itemB'] = str_replace($search, "<span style='color: red'>{$search}</span>", $subject['itemB']);
            $subject['itemC'] = str_replace($search, "<span style='color: red'>{$search}</span>", $subject['itemC']);
            $subject['itemD'] = str_replace($search, "<span style='color: red'>{$search}</span>", $subject['itemD']);
        }

        $static = DbHelper::checkSubject($this->db, $subjects,  $_POST['checked']);

        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', true);
        $this->smarty->assign('keyword', $search);
        $this->smarty->assign('msg', "共{$static['total']}道题，答对{$static['isTrue']}道，正确率{$static['trueApr']}%.");
        return $this->smarty->display('search/result.html');
    }
}