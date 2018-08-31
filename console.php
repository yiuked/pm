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
