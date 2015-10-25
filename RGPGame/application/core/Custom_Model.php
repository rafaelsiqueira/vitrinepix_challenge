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

    public function create($data) {
        if($this->db->insert(strtolower(get_class($this)), $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update(strtolower(get_class($this)), $data);
    }

    public function delete($id) {
        return $this->db->delete(strtolower(get_class($this)), ['id' => $id]);
    }
}