<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\M_Customer;


class CustomerController extends BaseController
{
    protected $customerModel;
    public function __construct()
    {
        $this->customerModel = new M_Customer();
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

}