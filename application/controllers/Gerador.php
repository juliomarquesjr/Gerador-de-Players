<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Gerador extends CI_Controller
{
    public
    function facebook_radio()
    {
        $dados = array('titulo' => 'Streaming Rádio - Player para Facebook', 't_pagina' => 'Facebook', 'item_menu' => 'facebook_radio');
        $this->load->view('includes/header', $dados);
        $this->load->view('facebook_radio', $dados);
        $this->load->view('includes/footer');
    }

    public
    function facebook_tv()
    {
        $dados = array('titulo' => 'Streaming TV - Player para Facebook', 't_pagina' => 'Facebook', 'item_menu' => 'facebook_tv');
        $this->load->view('includes/header', $dados);
        $this->load->view('facebook_tv', $dados);
        $this->load->view('includes/footer');
    }

    public
    function player_barra()
    {
        $dados = array('titulo' => 'Streaming Rádio - Player topo site', 't_pagina' => 'Web Rádio', 'item_menu' => 'player_barra');
        $this->load->view('includes/header', $dados);
        $this->load->view('player_barra', $dados);
        $this->load->view('includes/footer');
    }

    public
    function player_box()
    {
        $dados = array('titulo' => 'Streaming Rádio - Player Box (Caixa)', 't_pagina' => 'Web Rádio', 'item_menu' => 'player_box');
        $this->load->view('includes/header', $dados);
        $this->load->view('player_box', $dados);
        $this->load->view('includes/footer');
    }

    public
    function player_html5()
    {
        $dados = array('titulo' => 'Streaming Rádio - Player HTML5', 't_pagina' => 'Web Rádio', 'item_menu' => 'player_html5');
        $this->load->view('includes/header', $dados);
        $this->load->view('player_html5', $dados);
        $this->load->view('includes/footer');
    }

}