
<?php
$config = require "app/config/global.php";
if ($config['debug'] == true) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

require "vendor/autoload.php";
require_once('libs/Smarty.class.php');
use Respect\Rest\Router;

$smarty = new Smarty();
$smarty->setTemplateDir('dist/demos/');
$smarty->setCompileDir('smarty/compile/');
$smarty->setConfigDir('smarty/configs/');
$smarty->setCacheDir('smarty/cache/');


$db = new MysqliDb (Array (
    'host' => $config['db']['host'],
    'username' => $config['db']['username'],
    'password' => $config['db']['password'],
    'db'=> $config['db']['db'],
    'port' => $config['db']['port'],
    'prefix' => $config['db']['prefix'],
    'charset' => $config['db']['charset']));

$r3 = new Router;
$r3->any('/', 'App\Controllers\IndexController');
$r3->any('/chapter/small/*', 'App\Controllers\ChapterSmallController');
$r3->any('/chapter/subject/*/*', 'App\Controllers\ChapterSubjectController');
$r3->any('/errors/', 'App\Controllers\ErrorsController');
$r3->any('/errors/top/*/*', 'App\Controllers\TopErrorsController');
$r3->any('/errors/my', 'App\Controllers\MyErrorsController');