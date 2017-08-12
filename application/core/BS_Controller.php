<?php
/**
 * Created by PhpStorm.
 * User: huyang
 * Date: 2017/8/10
 * Time: 上午10:10
 */

class BS_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
}

// 自定义公用控制器
include APPPATH . 'core/Web_Controller.php';
include APPPATH . 'core/Api_Controller.php';