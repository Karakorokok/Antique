<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersAccountModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users_account';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                     'person_id','fname', 'mname', 'lname', 'username', 'password', 'last_login','role'
                                  ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['setCreated_at'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['setUpdated_at'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function VerifyUser($username,$password)
    {  
        $acc = $this->where('username', $username)->first();
        
        if ($acc && password_verify($password, $acc['password'])) 
        {
            return $acc;
        }

        return null;
    }
    public function GetPersonIDbyUserID($user_id)
    {
        return $this->select('person_id')->where('user_id',$user_id)->first();
    }
    public function GetIDbyPersonId($person_id)
    {
        return $this->select('user_id')->where('person_id',$person_id)->first();
    }
    public function GetLastLogin($id)
    {
        $result = $this->select('last_login')->where('user_id', $id)->first();
        return !is_null($result['last_login']);
    }
    public function GetAllAdminRecords()
    {
        return $this->where('role !=',0 )->findAll();
    }
    public function CreateRecords($data)
    {
        return $this->insert($data);
    }
    public function UpdateRecords($id,$data)
    {
        return $this->update($id,$data);
    }
    public function DeleteRecords($id)
    {
        return $this->delete($id);
    }



    // Audit_Trail

    public function setCreated_at(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d-h:i:sa');
        return $data;
    }
    public function setUpdated_at(array $data)
    {
        $data['data']['updated_at'] = date('Y-m-d-h:i:sa');
        return $data;
    }
}
