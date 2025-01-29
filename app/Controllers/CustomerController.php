<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\M_Customer;
use App\Models\M_Model;


class CustomerController extends BaseController
{
    protected $customerModel;
    protected $modelModel;
    public function __construct()
    {
        $this->customerModel = new M_Customer();
        $this->modelModel = new M_Model();
    }

    public function customer()
    {
        $data = [
            'title' => 'Tambah Customer',
            'validation' => \Config\Services::validation(),
            'customer' => $this->customerModel->getCustomer()
        ];
        return view('development/costumer/index', $data);
    }

    public function tambahCustomer()
    {
        $data = [
            'title' => 'Tambah Customer',
            'validation' => \Config\Services::validation()
        ];
        return view('development/costumer/tambahCostumer', $data);
    }

    //simpan data
    public function save()
    {
        // Ambil data dari input
        $customerName = $this->request->getVar('customer_name');
        $customerNameCustom = $this->request->getVar('customer_name_custom');

        // Gunakan input manual jika ada
        if (!empty($customerNameCustom)) {
            $customerName = $customerNameCustom;
        }

        // Debugging
        //log_message('info', 'Data customer_name yang diterima: ' . $customerName);
        //dd($customerName);

        // Validasi
        if (!$this->validate([
            'customer_name' => [
                'rules' => 'required|is_unique[customers.customer_name]',
                'errors' => [
                    'required' => 'Customer harus diisi!',
                    'is_unique' => 'Customer sudah ada.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }

        // Simpan data ke database
        $this->customerModel->save([
            'customer_name' => $customerName
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/dev/costumer');
    }

    // Backend edit Customer
    public function editCustomer($id)
    {
        $customerModel = new M_Customer();
        $data = [
            'title' => 'Update Customer',
            'validation' => \Config\Services::validation(),
            'customer' => $customerModel->find($id),
        ];
        return view('development/costumer/editCostumer', $data);
    }

    public function updateCustomer($id)
    {
        // Ambil data dari input
        $customer_id = $this->request->getPost('id');

        $customerModel = new M_Customer();
        $customerLama = $customerModel->find($customer_id);

        if (!$customerLama) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to('/dev/costumer');
        }

        $customerLama = $this->request->getVar('customer_id');
        $customerName = $this->request->getVar('customer_name');

        if (!$this->validate([
            'customer_name' => [
                'rules' => "required|is_unique[customers.customer_name,id, $id]",
                'errors' => [
                    'required' => 'Customer harus diisi!',
                    'is_unique' => 'Customer sudah ada.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }

        // Update data customer ke database
        $this->customerModel->update($id, [
            'customer_name' => $customerName
        ]);

        session()->setFlashdata('pesan', 'Data customer berhasil diupdate.');
        return redirect()->to('/dev/costumer');
    }

    public function delete($id)
    {
        $customerModel = new M_Customer();
        $modelModel = new M_Model();

        // Periksa apakah ada data terkait di tabel model
        $isRelated = $modelModel->where('customer_id', $id)->countAllResults();

        if ($isRelated > 0) {
            // Kirim pesan error ke view
            return redirect()->to('/dev/costumer')->with('swal_error', 'Tidak dapat menghapus customer karena masih digunakan dalam model, Hapus data model terkait terlebih dahulu!');
        }

        // Hapus data jika tidak ada relasi
        $data = $customerModel->find($id);
        if ($data) {
            $customerModel->delete($id);
            return redirect()->to('/dev/costumer')->with('swal_success', 'Data berhasil dihapus.');
        } else {
            return redirect()->to('/dev/costumer')->with('swal_error', 'Data tidak ditemukan.');
        }
    }

    // End
}
