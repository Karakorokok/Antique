<?php

namespace App\Models;

use CodeIgniter\Model;

class RewardsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'rewards';
    protected $primaryKey       = 'rewards_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                     'rewards_name', 'rewards_description', 'rewards_image', 
                                      'points_required', 'added_by'

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
    public function GetRewardsbyID($id)
    {
        return $this->where('rewards_id',$id)->first();
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
