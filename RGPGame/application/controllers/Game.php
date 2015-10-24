<?php

class Game extends Custom_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->render('game/index');
    }

    public function start()
    {
        $this->prepareNewGame();
        $this->session->gamedata = [
            'players' => $this->player->list_available_players()
        ];

        $this->render('game/start');
    }

    private function prepareNewGame() {

        // load resources
        $this->load->library('session');
        $this->load->model('player', '', true);

        // cleanup game session
        $this->session->gamedata = array();

    }

    public function admin()
    {
        $this->render('game/admin');

    }

}