<?php

namespace App\Models;

use CodeIgniter\Model;

class M_User extends Model
{
    protected $table = 'users';
    protected $primaryKey = "user_id";
    protected $allowedFields = ['username','nama','no_hp', 'password', 'role'];
}