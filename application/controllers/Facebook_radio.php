<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Facebook_radio extends CI_Controller
{
    public
    function index()
    {
        $dados = array('titulo' => 'Streaming Rádio - Player para Facebook', 't_pagina' => 'Facebook');
        $this->load->view('includes/header');
        $this->load->view('gerador_facebook', $dados);
        $this->load->view('includes/footer');
    }

}