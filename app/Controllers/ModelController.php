<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\M_Model;
use App\Models\M_Customer;

class ModelController extends BaseController
{

    protected $M_Model;
    protected $M_Customer;
    public function __construct()
    {
        
        $this->M_Model = new M_Model();
        $this->M_Customer = new M_Customer();
    }

    public function model()
{
    $data = [
        'title' => 'Model Data',
        'validation' => \Config\Services::validation(),
        'model' => $this->M_Model->getModel() 
    ];
    return view('development/model/index', $data);
}


    public function tambahModel()
    {
        $data = [
            'title' => 'Tambah Model',
            'validation' => \Config\Services::validation(),
            'customers' => $this->M_Customer->findAll()
        ];
        return view('development/model/tambahModel', $data);
    }

    public function save()
    {
        if(!$this->validate([
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
            'plan_finish' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
                ],
        ])){
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
            'plan_finish' => $this->request->getVar('plan_finish'),
            'plan_mp' => $this->request->getVar('plan_mp'),

        ]);

         // Debugging: Tampilkan data yang diterima
        //var_dump($data); // Menampilkan data yang akan disimpan
        //exit(); // Menghentikan eksekusi untuk melihat hasilnya

        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan.');
        return redirect()->to('/dev/model');
    }
}