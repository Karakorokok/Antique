<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'persons';
    protected $primaryKey       = 'person_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                         'fname', 'mname', 'lname', 'real_timepoints', 'accumulated_points'

                                  ];

    // Dates
    protected $useTimestamps = false;
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

    public function GetRecordsbyId($id)
    {
        return $this->where('person_id',$id)->first();
    }
    
    public function GetAllRecords()
    {
        return $this->findAll();
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
