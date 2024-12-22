<?php

namespace Clinic\Models;

class User extends Model{

    protected $table = "users";

    public function add($data) {
        return $this->insert($this->table, $data);
    }


    public function allUsers() {
        return $this->getAll($this->table);
    }

    public function edit($data, $id) {
        $data["id"] = $id;
        return $this->update("$this->table.id", $data);
    }

}