<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\M_Monitoring;

class DashboardController extends BaseController
{

    protected $monitoringModel;

    public function __construct()
    {
        $this->monitoringModel = new M_Monitoring();
    }
    public function index() //admin
    {
        $session = session();
        if ($session->get('role') !== 'Development') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Dashboard',
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
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
            'Development'       => 'Dashboard Development',
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
        $validRoles = ['ReDrawing', 'ApprovalReDraw'];

        // Jika role tidak ada dalam list validRoles, redirect ke halaman default
        if (!in_array($role, $validRoles)) {
            return redirect()->to('/belum-ada');
        }

        // Ambil data monitoring hanya untuk role yang login
        $data = [
            'title' => 'Task - ' . $role,
            'validation' => \Config\Services::validation(),
            'monitoring' => $this->monitoringModel->getMonitoringByTask($role),
            'nama'       => $session->get('nama'),
            'role'       => $role, // Hanya data sesuai role
        ];

        return view('PIC/task/index', $data);
    }

    public function editTask($id) // Ambil $id task yang akan diedit
    {
        $session = session();
        $role = $session->get('role');

        // List role yang sudah memiliki halaman
        $validRoles = ['ReDrawing', 'ApprovalReDraw'];

        if (!in_array($role, $validRoles)) {
            return redirect()->to('/belum-ada');
        }

        // Ambil data task berdasarkan ID
        $task = $this->monitoringModel->find($id);

        if (!$task) {
            return redirect()->to('/PIC/TASK')->with('error', 'Task tidak ditemukan!');
        }

        $data = [
            'title' => 'Edit Task - ' . $role,
            'validation' => \Config\Services::validation(),
            'task' => $task,
            'nama'       => $session->get('nama'),
            'role'       => $role, // Kirim data task ke view
        ];

        return view('PIC/task/edit', $data);
    }

    public function update($id)
    {
        $session = session();
        $role = $session->get('role');

        // Cek apakah role memiliki akses
        $validRoles = ['ReDrawing', 'ApprovalReDraw'];
        if (!in_array($role, $validRoles)) {
            return redirect()->to('/belum-ada')->with('error', 'Anda tidak memiliki akses!');
        }

        $taskModel = new M_Monitoring();
        $task = $taskModel->find($id);
        $validation = \Config\Services::validation();

        if (!$task) {
            return redirect()->to('/PIC/TASK')->with('swal_error', 'Task tidak ditemukan!');
        }

        // Validasi data yang dikirimkan dari form
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
        $leapTimeActual = $startActual->diff($finishActual)->days; // Selisih hari

        // Update data ke database
        $taskModel->update($id, [
            'start_plan'      => $this->request->getPost('start_plan'),
            'finish_plan'     => $this->request->getPost('finish_plan'),
            'start_actual'    => $this->request->getPost('start_actual'),
            'finish_actual'   => $this->request->getPost('finish_actual'),
            'remark'          => $this->request->getPost('remark'),
            'status'          => $this->request->getPost('status'),
            'leap_time_actual' => $leapTimeActual, // Simpan hasil perhitungan
        ]);

        session()->setFlashdata('swal_success', 'Task berhasil diperbarui!');
        return redirect()->to('/PIC/TASK');
    }



    // END KHUSUS ROLE PIC
}
