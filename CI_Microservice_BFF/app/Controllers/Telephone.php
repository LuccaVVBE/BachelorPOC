<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class TelephoneBFF_Controller extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        // Get user ID from session
        $userId = session()->get('id');

        // Proxy request to telephone number microservice to fetch telephone numbers for the current user
        $telephone_data = $this->fetchTelephoneNumbersFromMicroservice($userId);

        if ($telephone_data['status'] == 'success') {
            // Prepare aggregated data to be passed to the view
            $data = [
                'telephone' => $telephone_data['telephones']
            ];

            // Return JSON response containing aggregated data
            return view('dashboard', $data);
        } else {
            // Return error response if telephone numbers are not found
            return view('error/404');
        }
    }

    private function fetchTelephoneNumbersFromMicroservice($userId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://localhost:8080/api/telephones/' . $userId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ]
        ]);

        $telephoneNumbers = json_decode(curl_exec($curl), true);

        return $telephoneNumbers;
    }
}
