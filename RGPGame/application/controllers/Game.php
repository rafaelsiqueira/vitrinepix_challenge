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
        $players = $this->player->list_available_players();

        do {
            $initiatives = array();

            // loop through the players and determine the attack order
            foreach($players as $player) {

                // keep the initiative number to use later
                $initiative = $this->dice->next(range(1,20)) + $player->agility;

                $player->initiative_point = $initiative;
                $initiatives[$initiative] = $player;
            }

        } while (sizeof($initiatives) == 1);

        $sortedNumbers = array_keys($initiatives);

        $first  = $initiatives[ max($sortedNumbers) ];
        $second = $initiatives[ min($sortedNumbers) ];

        // save ordered players in session
        $this->session->gamedata = ['players' => array($first, $second)];

        print json_encode($this->session->gamedata['players']);
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

            // prepare round data
            $round = [
                'attacker' => $players[$current_attacker]->getName(),
                'defender' => $players[$current_defender]->getName(),
                'attack' => [
                    'remaining_health' => $players[$current_defender]->getHealth()
                ]
            ];

            $attack = $players[$current_attacker]->attack($players[$current_defender]);

            $round['attack']['success'] = $attack['success'];
            $round['attack']['attack_points'] = $attack['attack_points'];
            $round['attack']['defense_points'] = $attack['defense_points'];

            // if the attack was successful
            if ($attack['success']) {

                // calculate the damage...
                $damage = $players[$current_defender]->makeDamage($players[$current_attacker]->getWeapon());

                $round['attack']['damage'] = $damage['damage'];
                $round['attack']['remaining_health'] = $damage['remaining_health'];

                // and check if the opponent is dead
                if (!$players[$current_defender]->isHealthy()) {

                    // if so, the player is the winner!
                    $round['attack']['is_defender_dead'] = true;
                    $rounds[] = $round;

                    break;
                }
            }

            // switch the attacker/defender
            $current_attacker = (int) !$current_attacker;
            $current_defender = (int) !$current_defender;

            // add to round's list
            $rounds[] = $round;

        } while ($players[$current_attacker]->isHealthy() && $players[$current_defender]->isHealthy());

        print json_encode($rounds);
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
                'name' => $p->player_name,
                'health' => $p->health,
                'strength' => $p->strength,
                'agility' => $p->agility,
                'weapon' => $weapon
            ]);

            $players[] = $player;
        }

        return $players;
    }
}