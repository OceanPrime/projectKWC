<?php

namespace App\Controllers;

use App\Models\M_Customer;
use App\Models\M_Model;
use App\Models\M_Monitoring;

class MonitoringController extends BaseController
{
    protected $customerModel;
    protected $modelModel;
    protected $monitoringModel;

    public function __construct()
    {
        $this->customerModel = new M_Customer();
        $this->modelModel = new M_Model();
        $this->monitoringModel = new M_Monitoring();
    }

    
    
    public function index()
{
    $data['customers'] = $this->modelModel->select('customer_id, customer_name')->distinct()->findAll();
    $data['jenis'] = $this->modelModel->distinct()->findColumn('jenis');
    $data['title'] = 'Model Data';

    return view('development/monitoring/index', $data);
}



    public function getProjects($customerId)
    {
        $projects = $this->modelModel->where('customer_id', $customerId)->findAll();
        return $this->response->setJSON($projects);
    }

    public function getDetails($projectId)
    {
        $project = $this->modelModel->find($projectId);
        return $this->response->setJSON($project);
    }

    public function getTasks($projectId)
{
    $tasks = $this->monitoringModel
        ->select('monitoring.*, models.model_name, users.nama AS pic_name') // Ambil nama PIC
        ->join('models', 'models.id = monitoring.model_id', 'left')
        ->join('users', 'users.user_id = monitoring.pic_id', 'left') // join ke tabel users
        ->where('monitoring.model_id', $projectId)
        ->findAll();

    return $this->response->setJSON($tasks);
}

}
