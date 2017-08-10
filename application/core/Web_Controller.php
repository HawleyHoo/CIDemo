<?php
/**
 * Created by PhpStorm.
 * User: huyang
 * Date: 2017/8/10
 * Time: 上午10:37
 */

class Web_Controller extends BS_Controller
{
    public $base_url = '';
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('json');
        $this->load->config('config');
        $this->base_url = $this->config->item('base_url');
    }

    public function response($data)
    {
        $this->load->helper('json_helper');
        echo api_jsonp_encode($data);
        exit;
    }
}