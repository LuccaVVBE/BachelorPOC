<?php


namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'id';

    function login($username, $password)
    {        
        $query = $this->query("SELECT * FROM User WHERE username = '$username' AND password = '$password'");
        $response = $query->getResult();
        return $response;
    }
}