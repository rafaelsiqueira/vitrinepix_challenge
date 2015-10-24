<?php

class Admin extends Custom_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function authenticationCheck()
    {
        if (!$this->session->admin['authenticated']) {
            header('Location: /admin/login');
            return;
        }
    }

    public function index()
    {
        $this->authenticationCheck();

        // list available players
        $this->load->model('player', '', true);
        $players = $this->player->list_available_players();

        $weapons = function() use ($players) {
            $v = [];
            foreach($players as $player) {
                $w = new stdClass();
                $w->weapon_id = $player->weapon_id;
                $w->weapon_name = $player->weapon_name;
                $w->strike_force = $player->strike_force;
                $w->defense = $player->defense;
                $w->damage = $player->damage;
                $v[] = $w;
            }
            return $v;
        };

        $this->render('admin/admin', [
            'players' => $players,
            'weapons' => $weapons()
        ]);
    }

    public function login()
    {
        $data = array();
        unset($_SESSION['userdata']['admin']);

        if (!isset($this->session->admin)) {
            $this->session->admin = ['authenticated' => false];
        }

        $typed_password = $this->input->post('password');
        if(!empty($typed_password)) {

            if($typed_password == '1234') {
                $this->session->admin = ['authenticated' => true];
                header('Location: /admin');

            } else {
                $data['message'] = 'Invalid password';
            }
        }

        $this->render('admin/login', $data);
    }

    public function update_player()
    {
        $this->load->model('player', '', true);
        $this->update('player', $this->player);
    }

    public function update_weapon()
    {
        $this->load->model('weapon', '', true);
        $this->update('weapon', $this->weapon, function($data){
            if(!preg_match('/[0-9]+d[0-9]+/', $data['damage'])) {
                print (json_encode(['success' => false, 'message' => 'Invalid damage']));
                exit;
            }
        });
    }

    private function update($item, $model, Closure $validator = null)
    {
        $this->authenticationCheck();

        $data = $this->input->post($item);
        $id = array_keys($data)[0];

        if($validator != null) {
            $validator($data[$id]);
        }

        if($model->update($id, $data[$id])) {
            print json_encode(['success' => true]);

        } else {
            print json_encode(['success' => false, 'message' => 'Error when trying to update']);
        }
    }
}