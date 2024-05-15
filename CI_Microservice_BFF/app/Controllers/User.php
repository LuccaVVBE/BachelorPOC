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

        // Validate login credentials
        $login = login_fetch($user, $pass);

        if ($login['status'] == 'success') {
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
        logout_fetch();
        $session->destroy();

        return redirect()->to('/');
    }

    private function login_fetch($username, $password){
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://localhost:8084/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                'username' => $username,
                'password' => $password
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ]
        ]);

        $result = json_decode(curl_exec($curl), true);

        return $result;

    }
    
    private function logout_fetch(){
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://localhost:8084/api/logout',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ]
        ]);

        $result = json_decode(curl_exec($curl), true);

        return $result;
    }
}
