<?php
/**
 * Created by PhpStorm.
 * User: huyang
 * Date: 2017/8/10
 * Time: 上午10:15
 */

class BS_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }
}