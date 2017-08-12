<?php
/**
 * Created by PhpStorm.
 * User: huyang
 * Date: 2017/8/12
 * Time: 上午10:58
 */

class Home extends Web_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $data['base_url'] = $this->base_url;
        $this->load->view('home/chat0811', $data);
    }

    public function test() {
        $data['base_url'] = $this->config->item('base_url');
        $this->load->view('pages/home', $data);
    }
}