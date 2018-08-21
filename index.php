
<?php
require "vendor/autoload.php";
require_once('libs/Smarty.class.php');
use Respect\Rest\Router;

$smarty = new Smarty();
$smarty->setTemplateDir('dist/demos/');
$smarty->setCompileDir('smarty/compile/');
$smarty->setConfigDir('smarty/configs/');
$smarty->setCacheDir('smarty/cache/');

$db = new MysqliDb (Array (
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db'=> 'pmp',
    'port' => 3306,
    'prefix' => 'pm_',
    'charset' => 'utf8'));

$r3 = new Router;
$r3->any('/', 'App\Controllers\IndexController');
$r3->any('/test/*', 'App\Controllers\TestController');
$r3->any('/form/*', 'App\Controllers\FormController');
$r3->any('/chapter/small/*', 'App\Controllers\ChapterSmallController');
$r3->any('/chapter/subject/*/*', 'App\Controllers\ChapterSubjectController');
$r3->any('/chapter/test/*', 'App\Controllers\ChapterTestController');
$r3->any('/err/*', 'App\Controllers\PdfController');
$r3->any('/pdf/*', 'App\Controllers\PdfController');