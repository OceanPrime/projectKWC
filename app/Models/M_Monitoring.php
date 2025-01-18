<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Monitoring extends Model
{
    protected $table = 'monitoring'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['customer_id', 'task_name', 'model_id', 'pic_id', 'status', 'start_plan', 'start_actual', 'finish_plan', 'finish_actual', 'gap_sd', 'gap_fd', 'leap_time_planning', 'leap_time_actual'];
}
