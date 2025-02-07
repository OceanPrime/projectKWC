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
        $session = session();
        if ($session->get('role') !== 'Development') {
            return redirect()->to('/');
        }

        $data = [
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
        ];

        $data['customers'] = $this->modelModel->select('customer_id, customer_name')->distinct()->findAll();
        $data['jenis'] = $this->modelModel->distinct()->findColumn('jenis');
        $data['title'] = 'Monitoring Data';

        return view('development/monitoring/index', $data);
    }
    
    //tambahan baru view project
    public function view()
    {
        $session = session();
        if ($session->get('role') !== 'Development') {
            return redirect()->to('/');
        }

        $data = [
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
            'view' => $this->monitoringModel->findAll(),  
        ];

        $data['customers'] = $this->modelModel->select('customer_id, customer_name')->distinct()->findAll();
        $data['jenis'] = $this->modelModel->distinct()->findColumn('jenis');
        $data['title'] = 'Monitoring Data';

        return view('development/monitoring/view', $data);
    }

    public function editView()
    {
        $session = session();
        if ($session->get('role') !== 'Development') {
            return redirect()->to('/');
        }

        $data = [
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
            'view' => $this->monitoringModel->findAll(),  
        ];

        $data['customers'] = $this->modelModel->select('customer_id, customer_name')->distinct()->findAll();
        $data['jenis'] = $this->modelModel->distinct()->findColumn('jenis');
        $data['title'] = 'Monitoring Data';

        return view('development/monitoring/editView', $data);
    }
    //end view project

    public function tambahMonitoring()
    {
        $session = session();
        if ($session->get('role') !== 'Development') {
            return redirect()->to('/');
        }

        $data = [
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
        ];

        $data['users'] = $this->ModelUser
            ->select('user_id, role, nama')
            ->notLike('role', 'Development') // Kecualikan role Development
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
        // Ambil data utama
        $customer_id = $this->request->getPost('customer_id');
        $model_id = $this->request->getPost('model_id');
        $die_go = $this->request->getPost('die_go');

        // Ambil array dari multiple input task PIC
        $picIds = $this->request->getPost('pic_id');
        $planStarts = $this->request->getPost('planStart');
        $planFinishes = $this->request->getPost('planFinish');

        // Validasi utama
        $validation = $this->validate([
            'customer_id' => 'required',
            'model_id'    => 'required',
            'die_go'      => 'required|valid_date',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // **Validasi setiap task (PIC)**
        if (empty($picIds) || empty($planStarts) || empty($planFinishes)) {
            return redirect()->back()->withInput()->with('swal_error', 'Minimal satu Task PIC harus diisi.');
        }

        foreach ($picIds as $index => $picId) {
            if (empty($picId) || empty($planStarts[$index]) || empty($planFinishes[$index])) {
                return redirect()->back()->withInput()->with('swal_error', 'Semua Task PIC harus memiliki PIC, Plan Start, dan Plan Finish.');
            }
        }

        // **Simpan data task ke database**
        foreach ($picIds as $index => $picId) {
            // **Ambil role dari PIC**
            $user = $this->ModelUser->find($picId);
            $taskName = $user ? $user['role'] : 'UNKNOWN';

            // **Hitung leap_time_planning (selisih hari antara start_plan dan finish_plan)**
            $startDate = new \DateTime($planStarts[$index]);
            $finishDate = new \DateTime($planFinishes[$index]);
            $leapTimePlanning = $startDate->diff($finishDate)->days; // Hitung selisih hari

            // Simpan ke database
            $this->monitoringModel->save([
                'customer_id'        => $customer_id,
                'model_id'           => $model_id,
                'pic_id'             => $picId,
                'task_name'          => $taskName,
                'start_plan'         => $planStarts[$index],
                'finish_plan'        => $planFinishes[$index],
                'status'             => 'PENDING',
                'gap_sd'             => 0,
                'gap_fd'             => 0,
                'leap_time_planning' => $leapTimePlanning, // Tambahkan hasil perhitungan
                'leap_time_actual'   => 0,
            ]);
        }

        return redirect()->to('/dev/monitoring')->with('swal_success', 'Task PIC berhasil ditambahkan.');
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
        $project = $this->modelModel->select('id, die_go')->find($projectId);

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
