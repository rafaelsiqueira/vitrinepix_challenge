<?php

class Custom_Model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function setData($data) {
        foreach($data as $key => $value) {
            $this->{'set' . ucfirst($key)}($value);
        }
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update(strtolower(get_class($this)), $data);
    }

}