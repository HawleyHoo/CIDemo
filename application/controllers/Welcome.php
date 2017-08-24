<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {


        $data['base_url'] = $this->config->item('base_url');

//        $this->load->view('home/select_chat', $data);
        $this->load->view('home/homepage', $data);
//        $this->load->view('pages/home', $data);

//		echo $this->getIP().'<br>';
//
//		echo '-------'.$this->getIpyy().'<br>';
//
//        echo '----88888---'.$this->GetIPhhhhh().'<br>';
//
//        echo $this->getip_out().'<br>';
//        echo $this->get_takeid();

    }




}



?>