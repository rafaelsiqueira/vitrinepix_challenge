<?php

class Game extends Custom_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render('game/index');
    }

    public function start()
    {
        $this->prepareNewGame();
        $this->render('game/start');
    }

    public function initiative()
    {
        // load resources
        $this->load->model('player', '', true);

        do {
            $initiatives = array();

            // loop through the players and determine the attack order
            $players = $this->player->list_available_players();
            foreach($players as $player) {

                // keep the initiative number to use later
                $initiative = $this->dice->next(range(1,20)) + $player->agility;
                $initiatives[$initiative] = $player;
            }

        } while (sizeof($initiatives) == 1);

        $sortedNumbers = array_keys($initiatives);

        $first  = $initiatives[ max($sortedNumbers) ];
        $second = $initiatives[ min($sortedNumbers) ];

        // save ordered players in session
        $players = ['players' => array($first, $second)];
        $this->session->gamedata = $players;

        print json_encode($players['players']);
    }

    public function attack()
    {
        // prepare players to the fight!
        $players = $this->preparePlayers();

        // keep track of rounds
        $rounds = array();

        //
        $current_attacker = 0;
        $current_defender = 1;

        do {

            // if the attack was successful
            if ($players[$current_attacker]->attack($players[$current_defender])) {

                // calculate the damage...
                $players[$current_defender]->makeDamage($players[$current_attacker]->getWeapon());

                // and check if the opponent is dead
                if (!$players[$current_defender]->isHealthy()) {

                    // if so, the player is the winner!
                    break;
                }
            }

            // switch the attacker/defender
            $current_attacker = (int) !$current_attacker;
            $current_defender = (int) !$current_defender;

        } while ($players[$current_attacker]->isHealthy() && $players[$current_defender]->isHealthy());
    }

    private function prepareNewGame()
    {
        // cleanup game session
        $this->session->gamedata = array();

    }

    private function preparePlayers()
    {
        $this->load->model('weapon', '', true);
        $this->load->model('player', '', true);

        $players = array();

        foreach($this->session->gamedata['players'] as $p) {

            $weapon = new Weapon();
            $weapon->setData([
                'strike_force' => $p->strike_force,
                'defense' => $p->defense,
                'damage' => $p->damage
            ]);

            $player = new Player();
            $player->setData([
                'health' => $p->health,
                'strength' => $p->strength,
                'agility' => $p->agility,
                'weapon' => $weapon
            ]);

            $players[] = $player;
        }

        return $players;
    }

    public function admin()
    {
        $this->render('game/admin');

    }

}