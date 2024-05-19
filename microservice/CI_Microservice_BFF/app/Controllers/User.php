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
            return redirect()->to('public/dashboard');
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
        $login = $this->login_fetch($user, $pass);

        if (!empty($login['status']) && $login['status'] == 'success') {
            // Create session for logged-in user
            $session = session();
            $session->set('username', $login['username']);
            $session->set('id', $login['user_id']);

            // Return JSON response indicating successful login
            return redirect()->to('public/dashboard');
        } else {
            // Return JSON response indicating failed login attempt
            return view('login', ['error' => 'Invalid username or password']);
        }
    }

    public function logout()
    {
        // Destroy session for logged-out user
        $session = session();
        $this->logout_fetch();
        $session->destroy();

        return redirect()->to('/');
    }

    private function login_fetch($username, $password){
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://apache4/public/api/user/validate_login',
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
        var_dump($result);
        var_dump(curl_error($curl));

        return $result;

    }
    
    private function logout_fetch(){
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://apache4/public/api/user/logout',
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
