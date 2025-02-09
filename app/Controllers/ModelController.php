<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\M_Model;
use App\Models\M_Customer;
use App\Models\M_Monitoring;

class ModelController extends BaseController
{
    protected $M_Model;
    protected $M_Customer;
    public function __construct()
    {
        $this->M_Model = new M_Model();
        $this->M_Customer = new M_Customer();
        $this->MonitoringModel = new M_Monitoring();
    }

    public function model()
    {
        $session = session();
        if ($session->get('role') !== 'Development') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Model Data',
            'validation' => \Config\Services::validation(),
            'model' => $this->M_Model->getModel(),
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
        ];
        return view('development/model/index', $data);
    }


    public function tambahModel()
    {
        $session = session();
        if ($session->get('role') !== 'Development') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Tambah Model',
            'validation' => \Config\Services::validation(),
            'customers' => $this->M_Customer->findAll(),
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
        ];
        return view('development/model/tambahModel', $data);
    }

    public function save()
    {
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'model_name' => [
                'rules' => 'required|is_unique[models.model_name]',
                'errors' => [
                    'required' => '{field} Harus di isi!',
                    'is_unique' => '{field} Sudah terdaftar atau sudah ada <br> coba {field} lain yah!'
                ]
            ],
            'customer_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus di isi!',
                ]
            ],
            'size' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus di isi!'
                ]
            ],
            'product' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus di isi'
                ]
            ],
            'material' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'die_go' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'plan_mp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('error_validation', $validation->listErrors());
            return redirect()->to('/dev/model-tambah')->withInput();
        }

        // Ambil customer_name berdasarkan customer_id
        $customerId = $this->request->getVar('customer_id');
        $customer = $this->M_Customer->find($customerId);

        $this->M_Model->save([
            'model_name' => $this->request->getVar('model_name'),
            'customer_id' => $this->request->getVar('customer_id'),
            'customer_name' => $customer['customer_name'],
            'size' => $this->request->getVar('size'),
            'product' => $this->request->getVar('product'),
            'material' => $this->request->getVar('material'),
            'jenis' => $this->request->getVar('jenis'),
            'status' => $this->request->getVar('status'),
            'die_go' => $this->request->getVar('die_go'),
            'plan_mp' => $this->request->getVar('plan_mp'),

        ]);

        // Debugging: Tampilkan data yang diterima
        //var_dump($data); // Menampilkan data yang akan disimpan
        //exit(); // Menghentikan eksekusi untuk melihat hasilnya

        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan.');
        return redirect()->to('/dev/model');
    }

    public function editModel($id)
    {
        $session = session();
        if ($session->get('role') !== 'Development') {
            return redirect()->to('/');
        }

        $model = new M_Model();
        $customerModel = new M_Customer();

        $data = [
            'title' => 'Edit Model',
            'validation' => \Config\Services::validation(),
            'customers' => $customerModel->findAll(),
            'model' => $model->find($id),
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
        ];
        return view('development/model/editModel', $data);
    }

    public function updateModel($id)
    {
        $modelBaru = new M_Model();
        $modelLama = $modelBaru->find($id);

        // Validasi data yang dikirimkan dari form
        if (!$this->validate([
            'model_name' => [
                'rules' => "required|is_unique[models.model_name,id,{$id}]",
                'errors' => [
                    'required' => 'Model harus diisi!',
                    'is_unique' => 'Model sudah ada.'
                ]
            ],
            'customer_id' => 'required',
            'size' => 'required',
            'product' => 'required',
            'material' => 'required',
            'jenis' => 'required',
            'status' => 'required',
            'die_go' => 'required|valid_date',
            'plan_mp' => 'required|valid_date',
        ])) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }

        // Ambil nama customer berdasarkan customer_id
        $customer_id = $this->request->getVar('customer_id');
        $customer = $this->M_Customer->find($customer_id);

        if (!$customer) {
            session()->setFlashdata('error', 'Customer tidak ditemukan.');
            return redirect()->back();
        }


        // Update data model
        $modelBaru->update($id, [
            'model_name' => $this->request->getVar('model_name'),
            'customer_id' => $customer_id,
            'customer_name' => $customer['customer_name'],
            'size' => $this->request->getVar('size'),
            'product' => $this->request->getVar('product'),
            'material' => $this->request->getVar('material'),
            'jenis' => $this->request->getVar('jenis'),
            'status' => $this->request->getVar('status'),
            'die_go' => $this->request->getVar('die_go'),
            'plan_mp' => $this->request->getVar('plan_mp'),
        ]);

        session()->setFlashdata('swal_success', 'Data model berhasil diupdate.');
        return redirect()->to('/dev/model');
    }



    public function delete($id)
    {
        $modelModel = new M_Model();
        $MonitoringModel = new M_Monitoring();

        // Periksa apakah ada data terkait di tabel monitoring
        $isRelated = $MonitoringModel->where('model_id', $id)->countAllResults();

        if ($isRelated > 0) {
            // Kirim pesan error ke view
            return redirect()->to('/dev/model')->with('swal_error', 'Tidak dapat menghapus model karena masih digunakan dalam monitoring, Hapus data monitoring terkait terlebih dahulu!');
        }

        // Hapus data jika tidak ada relasi
        $data = $modelModel->find($id);
        if ($data) {
            $modelModel->delete($id);
            return redirect()->to('/dev/model')->with('swal_success', 'Data berhasil dihapus.');
        } else {
            return redirect()->to('/dev/model')->with('swal_error', 'Data tidak ditemukan.');
        }
    }
}
