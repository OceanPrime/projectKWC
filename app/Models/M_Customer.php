<?php
namespace App\Models;

use CodeIgniter\Model;

class M_Customer extends Model
{
    protected $table = "customers";
    protected $primaryKey = "id";
    protected $allowedFields = ['customer_name'];

    public function getCustomer($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}