<?php

class Custom_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    protected function render($view, $data = NULL)
    {
        $this->load->view('layout/fixed/head');
        $this->load->view('layout/header', $data);
        $this->load->view($view, $data);
        $this->load->view('layout/fixed/footer', $data);
    }
}