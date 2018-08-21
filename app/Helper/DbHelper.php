<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/21
 * Time: 13:28
 */

namespace App\Helper;


class DbHelper
{
    public static function checkSubject($db, &$subjects, $checked)
    {
        $total = count($subjects);
        $isOK = 0;
        $errorID = array();
        $isTrueID = array();
        if (!empty($checked)) {
            foreach ($subjects as $key => &$subject) {
                if (array_key_exists($subject['id'], $checked)) {
                    $subject['checked'] = $checked[$subject['id']];
                    if ($subject['result'] == $checked[$subject['id']]) {
                        $subject['is_ok'] = true;
                        $isOK++;
                        if ($subject['true_percent'] == 1) {
                            $isTrueID[] = $subject['id'];
                        }
                    } else {
                        if ($subject['true_percent'] == 0) {
                            $errorID[] = $subject['id'];
                        }
                    }
                }
            }
        }
        if (!empty($errorID)) {
            $db->where('id', $errorID, 'in')->update('subjects', array('true_percent' => '1'));
        }
        if (!empty($isTrueID)) {
            $db->where('id', $isTrueID, 'in')->update('subjects', array('true_percent' => '0'));
        }

        return array('total' => $total, 'checked' => count($checked), 'isTrue' => $isOK, 'trueApr' => round($isOK / $total, 4) * 100);
    }
}