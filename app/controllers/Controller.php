<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/20
 * Time: 21:49
 */

namespace App\Controllers;

use Respect\Rest\Routable;

class Controller implements Routable
{
    public $smarty;
    public $db;

    public function __construct()
    {
        global $smarty, $db;
        if (!is_object($smarty)) {
            exit('Smarty class is not load!');
        }
        $this->smarty = $smarty;
        if (!is_object($db)) {
            exit('Db class is not load!');
        }
        $this->db = $db;
    }
}