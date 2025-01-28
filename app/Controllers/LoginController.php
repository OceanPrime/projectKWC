<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\M_User;

class LoginController extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new M_User();
    }

    public function index()
    {
        return view('login');
    }

    public function Auth()
    {
        $UserModel = new M_User();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $UserModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session = session();
                $session->set([
                    'user_id' => $user['user_id'],
                    'username' => $user['username'],
                    'nama' => $user['nama'],
                    'no_hp' => $user['no_hp'],
                    'role' => $user['role'],
                    'logged_in' => true,
                ]);

                if ($user['role'] == 'admin') {
                    return redirect()->to('/dev/dashboard');

                } elseif ($user['role'] == 'ReDrawing') {
                    return redirect()->to('/PIC/ReDrawing');

                } elseif ($user['role'] == 'ApprovalReDraw') {
                    return redirect()->to('/PIC/ApprovalRedraw');

                } elseif ($user['role'] == 'DevelopmentSchedule') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'MoldManufacture') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'MoldShipment') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'MoldArrival') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'DevelopmentBox') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'DevelopCap') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'MoldAssy') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'TrialCasting') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'Machining') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'Painting') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'TestImpact') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'TestBending') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'TestRadial') {
                    return redirect()->to('/belum ada');//vbelum

                } elseif ($user['role'] == 'Packing&Delivery') {
                    return redirect()->to('/belum ada');//vbelum
                } else {
                    // Masih dalam pengembangan
                    return redirect()->to('/login');
                }
            } else {
                session()->setFlashdata('error', 'Password salah!');
                return redirect()->to('/');
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to('/');
        }
    }

     // Manajemen Akun PIC
   public function pic()
   {
        $data = [
            'title' => 'Data akun',
            'Usermodel' => $this->UserModel->getUser() 
        ];
        return view('development/manajemenAkun/index', $data);
   }

   public function tambahPIC()
   {
    $UserModel = new M_User();
            $data = [
                'title' => 'Tambah Akun',
                'validation' => \Config\Services::validation(),
            ];
        return view('development/manajemenAkun/tambahPIC', $data);
   }

   public function editPIC($user_id)
   {
        $UserModel = new M_User();
        $data = [
            'user' => $UserModel->find($user_id),
            'title' => 'Edit Akun',
            'validation' => \Config\Services::validation(),
        ];
        return view('development/manajemenAkun/editPIC', $data);
   }

    public function savePic()
    {
        $validation = \Config\Services::validation();
        if(!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username Harus di Isi!',
                    'is_unique' =>'Username Sudah Terdaftar atau sudah Ada Coba username lain yah'
                ]
                ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password Harus di Isi!',
                    'min_length' => 'Password Minimal 8 Karakter'
                ]
                ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Harus di Isi!',
                ]
                ],
            'no_hp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No HP Harus di Isi!',
                ]
                ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role harus di pilih.'
                ]
            ],
        ])) {
            // Jika validasi gagal, kirim pesan kesalahan validasi ke halaman view
            session()->setFlashdata('error_validation', $validation->listErrors());
            //$validation = \Config\Services::validation();
           // return redirect()->to('/dev/tambahPIC')->withInput()->with('validation', $validation);
            return redirect()->to('/dev/tambahPIC')->withInput();
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama' => $this->request->getPost('nama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'role' => $this->request->getPost('role')
        ];
        $UserModel = new M_User();

        $UserModel->save($data);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan.');
        return redirect()->to('/dev/manajemenPIC');
    }

    public function updatePIC()
{
    $user_id = $this->request->getPost('user_id');

    $UserModel = new M_User();
    $userLama = $UserModel->find($user_id);

    if (!$userLama) {
        session()->setFlashdata('error', 'User tidak ditemukan.');
        return redirect()->to('/dev/manajemenPIC');
    }

    $usernameLama = $userLama['username'];
    $usernameBaru = $this->request->getPost('username');

    // Tentukan aturan validasi untuk username
    $rule_username = ($usernameLama === $usernameBaru) 
        ? 'required' 
        : 'required|is_unique[users.username]';

    $validation = \Config\Services::validation();

    if (!$this->validate([
        'username' => [
            'rules' => $rule_username,
            'errors' => [
                'required' => 'Username Harus di Isi!',
                'is_unique' => 'Username Sudah Terdaftar atau sudah Ada Coba username lain yah'
            ]
        ],
        'password' => [
            'rules' => 'permit_empty|min_length[8]',
            'errors' => [
                'min_length' => 'Password Minimal 8 Karakter'
            ]
        ],
        'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Harus di Isi!'
            ]
        ],
        'no_hp' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'No HP Harus di Isi!'
            ]
        ],
        'role' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Role harus di pilih.'
            ]
        ],
    ])) {
        // Jika validasi gagal, kirim pesan kesalahan validasi ke halaman view
        session()->setFlashdata('error_validation', $validation->listErrors());
        return redirect()->to('/dev/tambahPIC')->withInput();
    }

    // Data untuk update
    $data = [
        'username' => $usernameBaru,
        'nama' => $this->request->getPost('nama'),
        'no_hp' => $this->request->getPost('no_hp'),
        'role' => $this->request->getPost('role')
    ];

    // Jika password diisi, maka update password
    if ($this->request->getPost('password')) {
        $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
    }

    $UserModel->update($user_id, $data);
    session()->setFlashdata('pesan', 'Data user berhasil diubah.');
    return redirect()->to('/dev/manajemenPIC');
}


    public function logout()
    {
        session()->destroy();
        ?>
        <script>
            alert("Anda Telah Logout!!");
            document.location = "<?= base_url('/'); ?>";
        </script>
        <?php
    }
}
