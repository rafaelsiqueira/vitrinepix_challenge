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

    public function initiative() {
        $this->load->library('dice');
        $this->load->library('session');

        do {

            $initiatives = array();

            // loop through the players and determine the attack order
            $players = $this->session->gamedata['players'];
            foreach($players as $player) {

                // keep the initiative number to use later
                $initiative = $this->dice->next(range(1,20)) + $player->agility;
                $initiatives[$initiative] = $player;
            }

        } while (sizeof($initiatives) == 1);

        $sortedNumbers = array_keys($initiatives);

        $first  = $initiatives[ max($sortedNumbers) ];
        $second = $initiatives[ min($sortedNumbers) ];

        $this->session->gamedata['players'] = array($first, $second);
    }

    public function attack() {
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