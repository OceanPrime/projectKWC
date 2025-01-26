<?php
namespace App\Models;

use CodeIgniter\Model;

class M_Model extends Model
{
    protected $table = "models";
    protected $primaryKey = "id";
    protected $allowedFields = ['customer_id' , 'customer_name',  'model_name' , 'size' , 'product' , 'material' , 'jenis' , 'status' , 'die_go' , 'plan_finish',  'plan_mp' , 'days_plan' , 'days_act'];

    public function getModel($id = false)
{
    $builder = $this->db->table($this->table)
        ->select('models.*, customers.customer_name') // Pilih kolom dari tabel `models` dan `customer_name` dari tabel `customers`
        ->join('customers', 'models.customer_id = customers.id', 'left'); // JOIN tabel `customers`

    if ($id === false) {
        return $builder->get()->getResultArray(); // Ambil semua data
    }

    return $builder->where('models.id', $id)->get()->getRowArray(); // Ambil data berdasarkan ID
}

}