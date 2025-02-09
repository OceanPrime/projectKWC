<?php

namespace App\Controllers;
use DateTime;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\M_Monitoring;
use App\Models\M_Customer;
use App\Models\M_Model;

class DashboardController extends BaseController
{

    protected $monitoringModel;
    protected $modelModel;

    public function __construct()
    {
        $this->monitoringModel = new M_Monitoring();
        $this->modelModel = new M_Model();
    }
    public function index() // Admin
{
    $session = session();
    if ($session->get('role') !== 'admin') {
        return redirect()->to('/');
    }

    $monitoringModel = new M_Monitoring(); // Gunakan model Monitoring
    $customers = $monitoringModel->select('DISTINCT(customer_id), customers.customer_name')
                                 ->join('customers', 'monitoring.customer_id = customers.id', 'left')
                                 ->findAll(); // Ambil daftar customer unik dari monitoring

    $data = [
        'title' => 'Dashboard',
        'nama' => $session->get('nama'),
        'role' => $session->get('role'),
        'customers' => $customers // Kirim data customer ke view
    ];

    return view('development/dashboard', $data);
}



// KHUSUS ROLE PIC

    public function dashboardPIC()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/');
        }

        $role = $session->get('role');

        // **Mapping nama dashboard per role**
        $dashboardTitles = [
            'admin'       => 'Dashboard Development',
            'ReDrawing'         => 'Dashboard ReDrawing',
            'ApprovalReDraw'    => 'Dashboard Approval ReDraw',
            'DevelopmentSchedule' => 'Dashboard Development Schedule',
            'MoldManufacture'   => 'Dashboard Mold Manufacture',
            'MoldShipment'      => 'Dashboard Mold Shipment',
            'MoldArrival'       => 'Dashboard Mold Arrival',
            'DevelopmentBox'    => 'Dashboard Development Box',
            'DevelopCap'        => 'Dashboard Develop Cap',
            'MoldAssy'          => 'Dashboard Mold Assy',
            'TrialCasting'      => 'Dashboard Trial Casting',
            'Machining'         => 'Dashboard Machining',
            'Painting'          => 'Dashboard Painting',
            'TestImpact'        => 'Dashboard Test Impact',
            'TestBending'       => 'Dashboard Test Bending',
            'TestRadial'        => 'Dashboard Test Radial',
            'Packing&Delivery'  => 'Dashboard Packing & Delivery',
        ];

        $title = $dashboardTitles[$role] ?? 'Dashboard';

        // **Kirim data ke view**
        $data = [
            'title'      => $title,
            'nama'       => $session->get('nama'),
            'role'       => $role,
        ];

        return view('PIC/dashboard', $data);
    }
    
    public function Task()
    {
        $session = session();
        $role = $session->get('role'); // Ambil role user dari session
    
        // List role yang sudah memiliki halaman
        $validRoles = ['ReDrawing',
        'ApprovalReDraw',
        'DevelopmentSchedule',
        'MoldManufacture',
        'MoldShipment',
        'MoldArrival',
        'DevelopmentBox',
        'DevelopCap',
        'MoldAssy',
        'TrialCasting',
        'Machining',
        'Painting',
        'TestImpact',
        'TestBending',
        'TestRadial',
        'Packing&Delivery'];
    
        // Jika role tidak ada dalam list validRoles, redirect ke halaman default
        if (!in_array($role, $validRoles)) {
            return redirect()->to('/belum-ada');
        }
    
        // Ambil data monitoring hanya untuk role yang login
        $data = [
            'title' => 'Task - ' . $role,
            'validation' => \Config\Services::validation(),
            'monitoring' => $this->monitoringModel->getMonitoringByTask($role), // Hanya data sesuai role
        ];
    
        return view('PIC/task/index', $data);
    }
    
    public function editTask($id)
    {
        $session = session();
        $role = $session->get('role');
    
        // Ambil data task berdasarkan ID
        $task = $this->monitoringModel->find($id);
    
        if (!$task) {
            return redirect()->to('/PIC/TASK')->with('error', 'Task tidak ditemukan!');
        }
    
        // Pastikan user hanya bisa mengedit task sesuai dengan task_name yang sesuai dengan rolenya
        if ($task['task_name'] !== $role) {
            return redirect()->to('/PIC/TASK')->with('error', 'Anda tidak memiliki akses untuk mengedit task ini!');
        }
    
        // Cari task sebelumnya dalam model yang sama (dengan ID lebih kecil)
        $prevTask = $this->monitoringModel
            ->where('model_id', $task['model_id'])
            ->where('id <', $task['id'])
            ->orderBy('id', 'DESC')
            ->first();
    
        // Hitung GAP S.D (Days) dan GAP F.D (Days)
        $gapSD = 0;
        $gapFD = 0;
    
        if (!empty($task['start_plan']) && !empty($task['start_actual'])) {
            $gapSD = (new DateTime($task['start_actual']))->diff(new DateTime($task['start_plan']))->days;
        }
    
        if (!empty($task['finish_plan']) && !empty($task['finish_actual'])) {
            $gapFD = (new DateTime($task['finish_actual']))->diff(new DateTime($task['finish_plan']))->days;
        }
    
        $data = [
            'title' => 'Edit Task - ' . $role,
            'validation' => \Config\Services::validation(),
            'task' => $task, // Kirim data task ke view
            'prevTask' => $prevTask, // Kirim data task sebelumnya untuk validasi form
            'gapSD' => $gapSD, // Kirim nilai gap start date
            'gapFD' => $gapFD, // Kirim nilai gap finish date
        ];
    
        return view('PIC/task/edit', $data);
    }
    

    
        public function update($id)
    {
        $session = session();
        $role = $session->get('role');

        // Daftar role dalam urutan yang benar
        $roles = [
            'ReDrawing', 'ApprovalReDraw', 'DevelopmentSchedule', 'MoldManufacture',
            'MoldShipment', 'MoldArrival', 'DevelopmentBox', 'DevelopCap', 'MoldAssy',
            'TrialCasting', 'Machining', 'Painting', 'TestImpact', 'TestBending',
            'TestRadial', 'Packing&Delivery'
        ];

        // Cek apakah user memiliki role yang valid
        if (!in_array($role, $roles)) {
            return redirect()->to('/belum-ada')->with('error', 'Anda tidak memiliki akses!');
        }

        $taskModel = new M_Monitoring();
        $task = $taskModel->find($id);

        if (!$task) {
            return redirect()->to('/PIC/TASK')->with('swal_error', 'Task tidak ditemukan!');
        }

        // Cari index role saat ini dalam daftar roles
        $currentIndex = array_search($role, $roles);
        
        // Cek apakah ada role sebelumnya
        $prevTask = null;
        if ($currentIndex > 0) {
            $previousRole = $roles[$currentIndex - 1];
            $prevTask = $taskModel->where('task_name', $previousRole)->where('id', $id)->first();
        }

        // Jika ada role sebelumnya dan tasknya belum selesai, larang update
        if ($prevTask && empty($prevTask['finish_actual'])) {
            return redirect()->to('/PIC/TASK')->with('swal_error', 'Task sebelumnya belum selesai!');
        }

        // Validasi form
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'start_plan'    => 'required|valid_date',
            'finish_plan'   => 'required|valid_date',
            'start_actual'  => 'required|valid_date',
            'finish_actual' => 'required|valid_date',
            'remark'        => 'required|min_length[3]',
            'status'        => 'required|in_list[COMPLETED,COMPLETED DELAY]',
        ])) {
            session()->setFlashdata('error_validation', $validation->listErrors());
            return redirect()->back()->withInput();
        }

        // Hitung leap_time_actual (selisih hari antara start_actual dan finish_actual)
        $startActual = new \DateTime($this->request->getPost('start_actual'));
        $finishActual = new \DateTime($this->request->getPost('finish_actual'));
        $leapTimeActual = $startActual->diff($finishActual)->days;

        // Update data ke database
        $taskModel->update($id, [
            'start_plan'      => $this->request->getPost('start_plan'),
            'finish_plan'     => $this->request->getPost('finish_plan'),
            'start_actual'    => $this->request->getPost('start_actual'),
            'finish_actual'   => $this->request->getPost('finish_actual'),
            'remark'          => $this->request->getPost('remark'),
            'status'          => $this->request->getPost('status'),
            'leap_time_actual' => $leapTimeActual,
        ]);




        session()->setFlashdata('swal_success', 'Task berhasil diperbarui!');
        return redirect()->to('/PIC/TASK');
    }





    // END KHUSUS ROLE PIC

    public function getModelsByCustomer($customerId)
{
    $models = $this->modelModel->where('customer_id', $customerId)->findAll();
    return $this->response->setJSON($models);
}
    






public function getLeadTimeComparison($customerId, $modelId)
{
    $totalPlan = $this->monitoringModel
        ->selectSum('leap_time_planning')
        ->where('customer_id', $customerId)
        ->where('model_id', $modelId)
        ->get()
        ->getRow()
        ->leap_time_planning ?? 0;

    $totalActual = $this->monitoringModel
        ->selectSum('leap_time_actual')
        ->where('customer_id', $customerId)
        ->where('model_id', $modelId)
        ->get()
        ->getRow()
        ->leap_time_actual ?? 0;

    // Total lead time keseluruhan
    $totalLeadTime = $totalPlan + $totalActual;

    // Menghindari pembagian dengan nol
    $percentagePlan = $totalLeadTime > 0 ? round(($totalPlan / $totalLeadTime) * 100, 2) : 0;
    $percentageActual = $totalLeadTime > 0 ? round(($totalActual / $totalLeadTime) * 100, 2) : 0;

    return $this->response->setJSON([
        'leap_time_planning' => (int) $totalPlan,
        'leap_time_actual' => (int) $totalActual,
        'percentage_plan' => $percentagePlan,
        'percentage_actual' => $percentageActual
    ]);
}

public function getLeadTimeComparisonData($customerId, $modelId)
{
    // Labels untuk chart
    $labels = [
        "ReDrawing", "ApprovalReDraw", "DevelopmentSchedule", "MoldManufacture", 
        "MoldShipment", "MoldArrival", "DevelopmentBox", "Develop Cap", 
        "MoldAssy", "TrialCasting", "Machining", "Painting", 
        "TestImpact", "TestBending", "TestRadial", "Packing&Delivery"
    ];

    // Ambil data dari database
    $query = $this->monitoringModel
        ->select('task_name, leap_time_planning, leap_time_actual')
        ->where('customer_id', $customerId)
        ->where('model_id', $modelId)
        ->findAll();

    // Jika data kosong, isi dengan array kosong
    if (empty($query)) {
        return $this->response->setJSON([
            "labels" => $labels,
            "leap_time_planning" => array_fill(0, count($labels), 0),
            "leap_time_actual" => array_fill(0, count($labels), 0)
        ]);
    }

    // Inisialisasi array
    $planData = array_fill(0, count($labels), 0);
    $actualData = array_fill(0, count($labels), 0);

    // Isi array sesuai task_name
    foreach ($query as $row) {
        $taskIndex = array_search($row['task_name'], $labels);
        if ($taskIndex !== false) {
            $planData[$taskIndex] = (int) ($row['leap_time_planning'] ?? 0);
            $actualData[$taskIndex] = (int) ($row['leap_time_actual'] ?? 0);
        }
    }

    // Debugging JSON output
    log_message('debug', json_encode([
        "labels" => $labels,
        "leap_time_planning" => $planData,
        "leap_time_actual" => $actualData
    ]));

    // Kirim data ke frontend
    return $this->response->setJSON([
        "labels" => $labels,
        "leap_time_planning" => $planData,
        "leap_time_actual" => $actualData
    ]);
}








    
}
