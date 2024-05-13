<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Telephones extends BaseController
{
    public function index()
    {
        $session = session();
        $telephoneModel = model('TelephoneModel');

        // Retrieve telephone numbers associated with the current user
        $telephones = $telephoneModel->getByUser($session->get('id'));

        // Prepare JSON response
        $response = [
            'status' => 'success',
            'telephones' => $telephones
        ];

        // Set content type header to application/json
        $this->response->setContentType('application/json');

        // Return JSON response
        return $this->response->setJSON($response);
    }
}
