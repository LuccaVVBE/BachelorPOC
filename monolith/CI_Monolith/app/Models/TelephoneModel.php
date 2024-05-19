<?php
namespace App\Models;

use CodeIgniter\Model;


class TelephoneModel extends Model
{
    protected $table = 'Telephone_Number';
    protected $primaryKey = 'id';
    
    function getByuser($userid)
    {
        $query = $this->query("SELECT * FROM Telephone_Number WHERE user_id = '$userid'");
        $response = $query->getResult();
        return $response;
    }
}