<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\M_User;
use App\Models\M_Monitoring;

class LoginController extends BaseController
{
    protected $UserModel;
    protected $MonitoringModel;
    public function __construct()
    {
        $this->UserModel = new M_User();
        $this->MonitoringModel = new M_Monitoring();
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

    if (!$user) {
        session()->setFlashdata('error', 'Username tidak ditemukan!');
        return redirect()->to('/');
    }

    if (!password_verify($password, $user['password'])) {
        session()->setFlashdata('error', 'Password salah!');
        return redirect()->to('/');
    }

    // Set sesi login
    $session = session();
    $session->set([
        'user_id'   => $user['user_id'],
        'username'  => $user['username'],
        'nama'      => $user['nama'],
        'no_hp'     => $user['no_hp'],
        'role'      => $user['role'],
        'logged_in' => true,
    ]);

    // Jika role = Development, arahkan ke halaman Development
    if ($user['role'] == 'admin') {
        return redirect()->to('/dev/dashboard');
    } 

    // Jika role adalah PIC, arahkan ke satu halaman dashboard
    $rolePIC = [
        'ReDrawing',
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
        'Packing&Delivery',
    ];

    if (in_array($user['role'], $rolePIC)) {
        return redirect()->to('/PIC'); // Semua PIC masuk ke satu dashboard
    }

    // Jika role tidak dikenali
    session()->setFlashdata('error', 'Gagal Login, Role tidak ditemukan');
    return redirect()->to('/');
}


    // Manajemen Akun PIC
    public function pic()
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Data akun',
            'Usermodel' => $this->UserModel->getUser(),
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
        ];
        return view('development/manajemenAkun/index', $data);
    }

    public function tambahPIC()
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        $UserModel = new M_User();
        $data = [
            'title' => 'Tambah Akun',
            'validation' => \Config\Services::validation(),
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
        ];
        return view('development/manajemenAkun/tambahPIC', $data);
    }

    public function editPIC($user_id)
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        $UserModel = new M_User();
        $data = [
            'user' => $UserModel->find($user_id),
            'title' => 'Edit Akun',
            'validation' => \Config\Services::validation(),
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
        ];
        return view('development/manajemenAkun/editPIC', $data);
    }

    public function savePic()
    {
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username Harus di Isi!',
                    'is_unique' => 'Username Sudah Terdaftar atau sudah Ada Coba username lain yah'
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

    public function delete($user_id)
    {
        $UserModel = new M_User();
        $MonitoringModel = new M_Monitoring();

        // Periksa apakah ada data terkait di tabel monitoring
        $isRelated = $MonitoringModel->where('pic_id', $user_id)->countAllResults();

        if ($isRelated > 0) {
            // Kirim pesan error ke view
            return redirect()->to('/dev/manajemenPIC')->with('swal_error', 'Tidak dapat menghapus user karena masih digunakan dalam monitoring, Hapus data monitoring terkait terlebih dahulu!');
        }

        // Hapus data jika tidak ada relasi
        $data = $UserModel->find($user_id);
        if ($data) {
            $UserModel->delete($user_id);
            return redirect()->to('/dev/manajemenPIC')->with('swal_success', 'Data berhasil dihapus.');
        } else {
            return redirect()->to('/dev/manajemenPIC')->with('swal_error', 'Data tidak ditemukan.');
        }
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
