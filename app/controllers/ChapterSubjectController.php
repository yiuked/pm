<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/20
 * Time: 22:43
 */

namespace App\controllers;


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

        $total = count($subjects);
        $isOK = 0;
        if (isset($_POST['checked'])) {
            $checked = $_POST['checked'];
            foreach ($subjects as $key => &$subject) {
                if (array_key_exists($subject['id'], $checked)) {
                    $subject['checked'] = $checked[$subject['id']];
                    if ($subject['result'] == $checked[$subject['id']]) {
                        $subject['is_ok'] = true;
                        $isOK++;
                    }
                }
            }
        }

        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', true);
        $this->smarty->assign('id', $id);
        $this->smarty->assign('msg', "共{$total}道题，答对{$isOK}道，正确率" . round($isOK / $total, 2) . "%.");
        return $this->smarty->display('chapter/subject.html');
    }
}