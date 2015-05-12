<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Gerador extends CI_Controller
{
    public
    function index()
    {
        $dados = array('titulo' => 'Player para Facebook', 't_pagina' => 'Facebook');
        $this->load->view('gerador', $dados);
    }

}