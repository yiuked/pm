<?php
$config = require "app/config/global.php";
if ($config['debug'] == true) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

require "vendor/autoload.php";

$db = new MysqliDb (Array(
    'host' => $config['db']['host'],
    'username' => $config['db']['username'],
    'password' => $config['db']['password'],
    'db' => $config['db']['db'],
    'port' => $config['db']['port'],
    'prefix' => $config['db']['prefix'],
    'charset' => $config['db']['charset']));

$args = array();
foreach ($argv as $key => $v) {
    if ($key == 0) {
        continue;
    }
    $lines = explode(":", $v);
    if (count($lines) != 2) {
        exit("解析参数:{$v} 出错\n");
    }
    $args[$lines[0]] = $lines[1];
}

if (isset($args['custom'])) {
    $jsonFiles = glob("storage/custom/*.json");
    foreach ($jsonFiles as $json) {
        $string = file_get_contents($json);
        $object = json_decode($string, true);
        if (isset($object['examine'])) {
            $result = $db->where('examine_id', $object['examine']['examine_id'])->getOne('cto_examine', 'id');
            if (empty($result)) {
                $db->insert('cto_examine', ['examine_id' => $object['examine']['examine_id'], 'title' => $object['examine']['title']]);
            }
        }
        if (isset($object['question']) && count($object['question']) > 0) {
            $question = $object['question'];
            foreach ($question as $subject) {
                $result = $db->where('question_id', $subject['question_id'])->getOne('cto_question', 'id');
                if (empty($result)) {
                    $insertData = array(
                        "question_id" =>  $subject['question_id'],
                        "examine_id" =>  $object['examine']['examine_id'],
                        "question_title" => strip_tags($subject['question_title']),
                        "question_type" => $subject['question_type'],
                        "is_right" => $subject['is_right'],
                        "answer" => $subject['answer'],
                        "single_score" => $subject['single_score'],
                        "erid" => $subject['erid'],
                        "knowledge" => $subject['knowledge'],
                        "analyze" => $subject['analyze'],
                        "is_review" => '0',
                        "every_score" => $subject['every_score'],
                        "answer_file" => $subject['answer_file'],
                        "answer_file_name" => $subject['answer_file_name'],
                        "itemA" => strip_tags($subject['itemA']),
                        "itemB" => strip_tags($subject['itemB']),
                        "itemC" => strip_tags($subject['itemC']),
                        "itemD" => strip_tags($subject['itemD']),
                        "user_answer" => $subject['user_answer']
                    );
                    $db->insert('cto_question', $insertData);
                    if ($db->getLastErrno())
                        echo 'Error: '. $db->getLastError() . '\n';
                }
            }
        }
    }
}
if (isset($args['test'])) {
    $jsonFiles = glob("storage/test/*.json");
    foreach ($jsonFiles as $json) {
        $string = file_get_contents($json);
        $object = json_decode($string, true);
        if (isset($object['examine'])) {
            $result = $db->where('examine_id', $object['examine']['examine_id'])->getOne('cto_examine', 'id');
            if (empty($result)) {
                $db->insert('cto_examine', ['examine_id' => $object['examine']['examine_id'], 'title' => $object['examine']['title']]);
            }
        }
        if (isset($object['question']['radio']['data']) && count($object['question']['radio']['data']) > 0) {
            $question = $object['question']['radio']['data'];
            foreach ($question as $subject) {
                $result = $db->where('question_id', $subject['question_id'])->getOne('cto_question', 'id');
                if (empty($result)) {
                    $insertData = array(
                        "question_id" =>  $subject['question_id'],
                        "examine_id" =>  $object['examine']['examine_id'],
                        "question_title" => strip_tags($subject['question_title']),
                        "question_type" => $subject['question_type'],
                        "is_right" => $subject['is_right'],
                        "answer" => $subject['answer'][0],
                        "single_score" => $subject['single_score'],
                        "erid" => $subject['erid'],
                        "knowledge" => $subject['knowledge'],
                        "analyze" => $subject['analyze'],
                        "is_review" => '0',
                        "every_score" => $subject['every_score'],
                        "answer_file" => $subject['answer_file'],
                        "answer_file_name" => $subject['answer_file_name'],
                        "itemA" => strip_tags($subject['option'][0]),
                        "itemB" => strip_tags($subject['option'][1]),
                        "itemC" => strip_tags($subject['option'][2]),
                        "itemD" => strip_tags($subject['option'][3]),
                        "user_answer" => $subject['user_answer'][0]
                    );
                    //print_r($insertData);exit();
                    $db->insert('cto_question', $insertData);
                    if ($db->getLastErrno())
                        echo 'Error: '. $db->getLastError() . '\n';
                }
            }
        }
    }
}
if (isset($args['json'])) {
    $jsonFiles = glob("storage/json/*.json");
    foreach ($jsonFiles as $json) {
        $string = file_get_contents($json);
        $object = json_decode($string, true);
        if (isset($object['data']) && count($object['data']) > 0) {
            foreach ($object['data'] as $subject) {
                $result = $db->where('question_id', $subject['question_id'])->getOne('cto_subjects', 'question_id');

                $string = str_replace("\",\"", "^", $subject['option']);
                $string = strip_tags($string);
                $string = trim($string, '["');
                $string = trim($string, '"]');
                $items = explode('^', $string);
                $insertData = array(
                    "wid" => $subject['wid'],
                    "myanswer" => $subject['myanswer'],
                    "question_id" => $subject['question_id'],
                    "title" => strip_tags($subject['title']),
                    "option" => $subject['option'],
                    "itemA" => $items[0],
                    "itemB" => $items[1],
                    "itemC" => $items[2],
                    "itemD" => $items[3],
                    "answer" => $subject['answer'],
                    "type" => $subject['type'],
                    "knowledge" => $subject['knowledge'],
                    "analyze" => $subject['analyze'],
                    "is_error" => 1
                );
                if (empty($result)) {
                    $db->insert('cto_subjects', $insertData);
                }
            }
        }
    }
}
if (isset($args['qinhui'])) {
    $jsonFiles = glob("storage/custom/*.json");
    foreach ($jsonFiles as $json) {
        $string = file_get_contents($json);
        $object = json_decode($string, true);
        if (isset($object) && count($object) > 0) {
            $question = $object;
            foreach ($question as $subject) {
                $result = $db->where('question_id', $subject['question_id'])->getOne('cto_question', 'id');
                if (empty($result)) {
                    $insertData = array(
                        "question_id" =>  $subject['question_id'],
                        "examine_id" =>  $subject['examine_id'],
                        "question_title" => strip_tags($subject['question_title']),
                        "question_type" => $subject['question_type'],
                        "is_right" => $subject['is_right'],
                        "answer" => $subject['answer'],
                        "single_score" => $subject['single_score'],
                        "erid" => $subject['erid'],
                        "knowledge" => $subject['knowledge'],
                        "analyze" => $subject['analyze'],
                        "is_review" => '0',
                        "every_score" => $subject['every_score'],
                        "answer_file" => $subject['answer_file'],
                        "answer_file_name" => $subject['answer_file_name'],
                        "itemA" => strip_tags($subject['itemA']),
                        "itemB" => strip_tags($subject['itemB']),
                        "itemC" => strip_tags($subject['itemC']),
                        "itemD" => strip_tags($subject['itemD']),
                        "user_answer" => $subject['user_answer']
                    );
                    $db->insert('cto_question', $insertData);
                    if ($db->getLastErrno())
                        echo 'Error: '. $db->getLastError() . '\n';
                }
            }
        }
    }
}
if (isset($args['batch'])) {
    $jsonFiles = glob("curl/tmp/*.json");
    foreach ($jsonFiles as $json) {
        $string = file_get_contents($json);
        $object = json_decode($string, true);
        if (isset($object) && count($object) > 0) {
            if (empty($object['data'])) {
                echo "File:{$json} is empty\n";
                continue;
            }
            if (isset($object['data']['list'])) {
                $question = $object['data']['list'];
                foreach ($question as $subject) {
                    $result = $db->where('id', $subject['id'])->getOne('subjects', 'id');
                    if (empty($result)) {
                        $insertData = array(
                            "id" => $subject['id'],
                            "no" => $subject['no'],
                            "name" => $subject['name'],
                            "itemA" => $subject['itemA'],
                            "itemB" => $subject['itemB'],
                            "itemC" => $subject['itemC'],
                            "itemD" => $subject['itemD'],
                            "result" => $subject['result'],
                            "jiexi" => $subject['jiexi'],
                            "type_id" => $subject['type_id'],
                            "type_small_id" => $subject['type_small_id'],
                            "test_id" => $subject['test_id'],
                            "true_percent" => $subject['true_percent'],
                            "answer_count" => $subject['answer_count'],
                            "true_count" => $subject['true_count'],
                            "is_fav" => $subject['is_fav']
                        );
                        $db->insert('subjects', $insertData);
                        if ($db->getLastErrno())
                            echo 'Error: '. $db->getLastError() . '\n';
                    }
                }
            } else {
                $testType = $object['data'];
                foreach ($testType as $type) {
                    $result = $db->where('id', $type['id'])->getOne('testtype', 'id');
                    if (empty($result)) {
                        $insertData = array(
                            "id" => $type['id'],
                            "type_small_id" => $type['type_small_id'],
                            "name" => $type['name'],
                            "is_free" => $type['is_free'],
                            "price" => $type['price'],
                            "type_id" => $type['type_id'],
                            "time_limit" => $type['time_limit'],
                            "count" => $type['count'],
                            "is_upload" => $type['is_upload'],
                            "group_id" => $type['group_id'],
                            "buy_uid" => $type['buy_uid'],
                            "balance" => $type['balance'],
                            "test_order" => $type['test_order'],
                            "coupon" => $type['coupon'],
                            "answer_status" => $type['id'],
                            "test_count" => $type['answer_status'],
                            "test_percent" => (int)$type['test_percent'],
                            "creat_time" => (int)$type['creat_time'],
                            "last_index" => $type['last_index'],
                            "user_answer" => $type['user_answer'],
                            "err_count" => $type['err_count'],
                            "rest_time" => $type['rest_time'],
                            "is_buy" => $type['is_buy']
                        );
                        $db->insert('testtype', $insertData);
                        if ($db->getLastErrno())
                            echo 'Error: '. $db->getLastError() . '\n';
                    }
                }
            }
        }
    }
}