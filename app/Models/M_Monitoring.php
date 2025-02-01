<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Monitoring extends Model
{
    protected $table = 'monitoring'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['customer_id', 'task_name', 'model_id', 'pic_id', 'status', 'remark', 'start_plan', 'start_actual', 'finish_plan', 'finish_actual', 'gap_sd', 'gap_fd', 'leap_time_planning', 'leap_time_actual'];


    public function getMonitoringByTask($task_name)
    {
        $builder = $this->db->table($this->table)
            ->select('monitoring.*, models.model_name, customers.customer_name, models.size, models.product, models.material, models.jenis, models.die_go') //isi data yang ingin dipanggil
            ->join('models', 'monitoring.model_id = models.id', 'left') //Join tabel Models
            ->join('customers', 'monitoring.customer_id = customers.id', 'left') //Join tabel customers
            ->where('monitoring.task_name', $task_name); // Filter berdasarkan task_name (sesuai role)
    
        return $builder->get()->getResultArray(); 
    }
    

}
