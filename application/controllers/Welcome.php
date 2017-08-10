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

        $this->load->view('home/select_chat', $data);

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


//class Pages extends CI_Controller {
//    public function view($page = 'home') {
//        if (!file_exists(APPPATH.'views/pages'.$page.'.php')) {
//            show_404();
//        }
//
//        $data["title"] = ucfirst($page);
//
//        $this->load->view('templates/header', $data);
//        $this->load->view('pages/'.$page, $data);
//        $this->load->view('templates/fotter', $data);
//
//    }
//
//}
?>