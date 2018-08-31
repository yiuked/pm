<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/21
 * Time: 13:28
 */

namespace App\Helper;


class CtoHelper
{
    public static function checkErrorsSubject($db, &$subjects, $checked)
    {
        $total = count($subjects);
        $isOK = 0;
        $errorID = array();
        $isTrueID = array();
        if (!empty($checked)) {
            foreach ($subjects as $key => &$subject) {
                if (array_key_exists($subject['question_id'], $checked)) {
                    $subject['checked'] = $checked[$subject['question_id']];
                    if ($subject['answer'] == $checked[$subject['question_id']]) {
                        $subject['is_ok'] = true;
                        $isOK++;
                        if ($subject['is_error'] == 1) {
                            $isTrueID[] = $subject['id'];
                        }
                    } else {
                        if ($subject['is_error'] == 0) {
                            $errorID[] = $subject['id'];
                        }
                    }
                }
            }
        }
        if (!empty($errorID)) {
            $db->where('id', $errorID, 'in')->update('cto_subjects', array('is_error' => '1'));
        }
        if (!empty($isTrueID)) {
            $db->where('id', $isTrueID, 'in')->update('cto_subjects', array('is_error' => '0'));
        }

        return array('total' => $total, 'checked' => count($checked), 'isTrue' => $isOK, 'trueApr' => round($isOK / $total, 4) * 100);
    }

    public static function checkExamineSubject($db, &$subjects, $checked)
    {
        $total = count($subjects);
        $isOK = 0;
        $errorID = array();
        $isTrueID = array();
        if (!empty($checked)) {
            foreach ($subjects as $key => &$subject) {
                if (array_key_exists($subject['question_id'], $checked)) {
                    $subject['checked'] = $checked[$subject['question_id']];
                    if ($subject['answer'] == $checked[$subject['question_id']]) {
                        $subject['is_ok'] = true;
                        $isOK++;
                        if ($subject['is_right'] == 0) {
                            $isTrueID[] = $subject['id'];
                        }
                    } else {
                        if ($subject['is_right'] == 1) {
                            $errorID[] = $subject['id'];
                        }
                    }
                }
            }
        }
        if (!empty($errorID)) {
            $db->where('id', $errorID, 'in')->update('cto_question', array('is_right' => '0'));
        }
        if (!empty($isTrueID)) {
            $db->where('id', $isTrueID, 'in')->update('cto_question', array('is_right' => '1'));
        }

        return array('total' => $total, 'checked' => count($checked), 'isTrue' => $isOK, 'trueApr' => round($isOK / $total, 4) * 100);
    }
}