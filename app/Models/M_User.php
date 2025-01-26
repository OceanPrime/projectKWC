<?php

namespace App\Models;

use CodeIgniter\Model;

class M_User extends Model
{
    protected $table = 'users';
    protected $primaryKey = "user_id";
    protected $allowedFields = ['username','nama','no_hp', 'password', 'role'];


    public function getUser($user_id = false)
    {
         if ($user_id === false) {
            return $this->findAll();
        } 

        return $this->where(['user_id' => $user_id])->first();
    }
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];


    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}