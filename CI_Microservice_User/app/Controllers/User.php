<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function login()
    {
        // Check if user is already logged in
        if (session()->get('id') != null) {
            // Return JSON response indicating user is already logged in
            return $this->respond(['status' => 'error', 'message' => 'User is already logged in'], 400);
        }

        // Return JSON response indicating successful login
        return $this->respond(['status' => 'success', 'message' => 'User login page']);
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
            return $this->respond(['status' => 'success', 'message' => 'Login successful', 'user_id' => $login[0]->id]);
        } else {
            // Return JSON response indicating failed login attempt
            return $this->respond(['status' => 'error', 'message' => 'Invalid username or password'], 401);
        }
    }

    public function logout()
    {
        // Destroy session for logged-out user
        $session = session();
        $session->destroy();

        // Return JSON response indicating successful logout
        return $this->respond(['status' => 'success', 'message' => 'Logout successful']);
    }
}
