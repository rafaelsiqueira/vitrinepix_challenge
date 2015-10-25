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

        $this->load->model('player', '', true);
        $this->load->model('weapon', '', true);

        // list available players

        $players = $this->player->list_available_players();
        $weapons = $this->weapon->db->get('weapon')->result();

        $this->render('admin/admin', [
            'players' => $players,
            'weapons' => $weapons
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

    public function create_player() {
        $this->authenticationCheck();

        $this->load->model('player', '', true);
        $data = $this->input->post('player')['new'];

        if(!isset($data['weapon_id']) || (int)$data['weapon_id'] <= 0) {
            print json_encode(['success' => false, 'message' => 'Invalid weapon']);
            exit;
        }

        if($this->player->create($data)) {
            print json_encode(['success' => true]);

        } else {
            print json_encode(['success' => false, 'message' => 'Error when trying to create']);
        }
    }

    public function delete_player() {
        $this->authenticationCheck();

        $this->load->model('player', '', true);

        $id = $this->input->post('player_id');

        if($this->player->delete($id)) {
            print json_encode(['success' => true]);

        } else {
            print json_encode(['success' => false, 'message' => 'Error when trying to delete']);
        }
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