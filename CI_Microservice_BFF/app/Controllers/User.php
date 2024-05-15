<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;

    public function login()
    {
        // Check if user is already logged in
        if (session()->get('id') != null) {
            // Redirect to dashboard if user is already logged in
            return redirect()->to('/dashboard');
        }

        // Return JSON response indicating login page
        return view('login');
    }

    public function validate_login()
    {
        // Retrieve username and password from request
        $user = $this->request->getPost('username');
        $pass = $this->request->getPost('password');

        // Load user model
        $userModel = model('UserModel');

        // Validate login credentials
        $login = $userModel->login($user, $pass);
        if (!empty($login)) {
            // Create session for logged-in user
            $session = session();
            $session->set('username', $login[0]->username);
            $session->set('id', $login[0]->id);

            // Return JSON response indicating successful login
            return redirect()->to('/dashboard');
        } else {
            // Return JSON response indicating failed login attempt
            return view('login', ['error' => 'Invalid username or password']);
        }
    }

    public function logout()
    {
        // Destroy session for logged-out user
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}
