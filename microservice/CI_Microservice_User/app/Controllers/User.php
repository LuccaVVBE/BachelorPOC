<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function login()
    {
        $this->response->setContentType('application/json');
        // Check if user is already logged in
        if (session()->get('id') != null) {
            // Return JSON response indicating user is already logged in
            $this->response->setContentType('application/json');
            return $this->response->setJSON(['status' => 'error', 'message' => 'User is already logged in'], 400);
        }

        // Return JSON response indicating successful login
        return $this->response->setJSON(['status' => 'success', 'message' => 'User login page']);
    }

    public function validate_login()
    {
        $this->response->setContentType('application/json');
      
        // Get raw input from the request
    $rawInput = file_get_contents('php://input');

    // Decode JSON input
    $requestData = json_decode($rawInput, true);

    // Check if JSON decoding was successful and required fields exist
    if (!is_array($requestData) || !isset($requestData['username']) || !isset($requestData['password'])) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid JSON input'], 400);
    }

    // Retrieve username and password from JSON data
    $user = $requestData['username'];
    $pass = $requestData['password'];

        // Load user model
        $userModel = model('UserModel');

        // Validate login credentials
        $login = $userModel->login($user, $pass);
        
        if (!empty($login)) {
            // Create session for logged-in user
            $session = session();
            $session->set('username', $user);
            $session->set('id', $login[0]['id']);

            // Return JSON response indicating successful login
            // Set content type header to application/json
            return $this->response->setJSON(['status' => 'success', 'message' => 'Login successful' . json_encode($login), 'user_id' => $login[0]['id'], 'username' => $user],200);
        } else {
            // Return JSON response indicating failed login attempt
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid username or password' . json_encode($login)], 401);
        }
    }

    public function logout()
    {
        $this->response->setContentType('application/json');
        // Destroy session for logged-out user
        $session = session();
        $session->destroy();

        // Return JSON response indicating successful logout
        return $this->response->setJSON(['status' => 'success', 'message' => 'Logout successful']);
    }
}
