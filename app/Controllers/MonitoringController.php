<?php

namespace App\Controllers;

use App\Models\M_Customer;
use App\Models\M_Model;
use App\Models\M_Monitoring;
use App\Models\M_User;

class MonitoringController extends BaseController
{
    protected $customerModel;
    protected $modelModel;
    protected $monitoringModel;
    protected $ModelUser;

    public function __construct()
    {
        $this->customerModel = new M_Customer();
        $this->modelModel = new M_Model();
        $this->monitoringModel = new M_Monitoring();
        $this->ModelUser = new M_User();
    }

    public function index()
    {
        $data['customers'] = $this->modelModel->select('customer_id, customer_name')->distinct()->findAll();
        $data['jenis'] = $this->modelModel->distinct()->findColumn('jenis');
        $data['title'] = 'Model Data';

        return view('development/monitoring/index', $data);
    }   

    public function tambahMonitoring()
    {
        $data['users'] = $this->ModelUser
            ->select('user_id, role, nama')
            ->notLike('role', 'admin')// Kecualikan role admin
            ->distinct()
            ->findAll();

        $data['customers'] = $this->modelModel
            ->select('customer_id, customer_name')
            ->distinct()
            ->findAll();

        $data['jenis'] = $this->modelModel
            ->distinct()
            ->findColumn('jenis');

        $data['title'] = 'Add Task pic';

        return view('development/monitoring/tambahMonitoring', $data);
    }


    public function saveMonitoring()
    {
        // Validasi input dari form
        $validation = $this->validate([
            'customer_id' => 'required',
            'model_id'    => 'required', 
            'pic_id'      => 'required', 
            'start_plan'  => 'required|valid_date',
            'finish_plan' => 'required|valid_date',
        ]);

        if (!$validation) {
            // Debugging: Lihat error jika validasi gagal
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data pengguna berdasarkan pic_id
        $picId = $this->request->getPost('pic_id');
        $user = $this->ModelUser->find($picId);
    
        // Jika pengguna tidak ditemukan, kembalikan error
        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'PIC tidak ditemukan.');
        }

        $taskName = $user['role'];

        // Ambil data dari form
        $data = [
            'customer_id'        => $this->request->getPost('customer_id'),
            'model_id'           => $this->request->getPost('model_id'), // Sesuaikan
            'pic_id'             => $this->request->getPost('pic_id'),   // Sesuaikan
            'start_plan'         => $this->request->getPost('start_plan'),
            'finish_plan'        => $this->request->getPost('finish_plan'),
            'task_name'          => $taskName,
            'status'             => $this->request->getPost('status') ?? 'PENDING',
            'start_actual'       => $this->request->getPost('start_actual'),
            'finish_actual'      => $this->request->getPost('finish_actual'),
            'gap_sd'             => 0,
            'gap_fd'             => 0,
            'leap_time_planning' => 0,
            'leap_time_actual'   => 0,
        ];

        // Simpan data ke database
        if ($this->monitoringModel->save($data)) {
            return redirect()->to('/dev/monitoring')->with('success', 'Task PIC berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan Task PIC.');
        }
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

    public function getPlanFinish($projectId)
    {
        $project = $this->modelModel->select('id, plan_finish, die_go')->find($projectId);
    
        if ($project) {
            return $this->response->setJSON($project);
        } else {
            return $this->response->setJSON(['error' => 'Project not found'], 404);
        }
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
