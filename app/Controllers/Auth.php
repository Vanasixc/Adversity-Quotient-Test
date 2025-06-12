<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Authdb;

class Auth extends BaseController
{
    protected $authdb;
    public function __construct()
    {
        $this->authdb = new Authdb();
    }
    public function getIndex()
    {
        return view('home/pages/login');
    }

    public function getHome()
    {
        $data = [
            'title' => 'Home',
        ];
        return view('home/pages/Home_v', $data);
    }

    public function getRegister()
    {
        $data = [
            'title' => 'Register',
        ];
        return view('home/pages/register', $data);
    }
    public function postProcesslogin()
    {
        $authModel = new AuthDb();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $authModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->to('/auth')->with('error', 'Akun tidak ditemukan. Silakan lakukan Sign Up.');
        }

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'isLoggedIn' => true,
            ]);
            return redirect()->to('questions')->with('message', 'Login berhasil!');

        } else {
            return redirect()->to('auth')->with('error', 'Email atau password salah.');
        }
    }

    public function postProcesssignup()
    {
        $authModel = new AuthDb();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $rePassword = $this->request->getPost('re-password');
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);


        if ($password !== $rePassword) {
            return redirect()->back()->withInput()->with('error', 'Password tidak sama!');
        }

        $data = [
            'username' => $username,
            'password' => $hashedPass,
        ];

        $authModel->insert($data);

        return redirect()->to('auth')->with('message', 'Registrasi berhasil!');
    }
}
