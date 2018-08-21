<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/20
 * Time: 22:43
 */

namespace App\controllers;


class PdfController extends Controller
{
    public function get($start, $end)
    {
        $start = (int)$start / 100;
        $end = (int)$end / 100;
        $cols = Array("*,ROUND(true_count/answer_count,2) as true_apr");
        $chapters = $this->db->having("true_apr BETWEEN {$start} AND {$end}")->get("subjects", null, $cols);
        $this->smarty->assign('subjects', $chapters);
        $this->smarty->assign('show', false);
        $this->smarty->assign('start', $start * 100);
        $this->smarty->assign('end', $end * 100);
        return $this->smarty->display('pdf.html');
    }

    public function post($start, $end)
    {

        $start = (int)$start / 100;
        $end = (int)$end / 100;
        $cols = Array("*,ROUND(true_count/answer_count,2) as true_apr");
        $subjects = $this->db->having("true_apr BETWEEN {$start} AND {$end}")->get("subjects", null, $cols);

        $total = count($subjects);
        $isOK = 0;
        if (isset($_POST['checked'])) {
            $checked = $_POST['checked'];
            foreach ($subjects as $key => &$subject) {
                if (array_key_exists($subject['id'], $checked) && $subject['result'] == $checked[$subject['id']]) {
                    $subject['is_ok'] = true;
                    $isOK++;
                }
            }
        }

        $this->smarty->assign('subjects', $subjects);
        $this->smarty->assign('show', true);
        $this->smarty->assign('start', $start * 100);
        $this->smarty->assign('end', $end * 100);
        $this->smarty->assign('msg', "共{$total}道题，答对{$isOK}道，正确率" . round($isOK / $total, 2) . "%.");
        return $this->smarty->display('pdf.html');
    }

}