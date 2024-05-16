<?php


namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'id';

    function login($username, $password)
    {        
        $this->where('username',$username);
        $this->where('password',$password);
        return $this->findAll();
    }
}