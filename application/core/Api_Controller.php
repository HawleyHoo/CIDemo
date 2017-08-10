<?php
/**
 * Created by PhpStorm.
 * User: huyang
 * Date: 2017/8/10
 * Time: 上午10:37
 */
class Api_Controller extends BS_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('json');
    }

    public function response($data)
    {
        $this->load->helper('json_helper');
        echo api_jsonp_encode($data);
        exit;
    }
}