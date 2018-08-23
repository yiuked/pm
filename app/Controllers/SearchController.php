<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/22
 * Time: 17:17
 */

namespace App\Controllers;


class SearchController extends Controller
{
    public function get() {
        return $this->smarty->display('search/search.html');
    }

    public function post() {
        $cols = Array("*");
        $search = trim($_POST['search']);
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
        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', false);
        $this->smarty->assign('keyword', $search);
        return $this->smarty->display('search/result.html');
    }
}