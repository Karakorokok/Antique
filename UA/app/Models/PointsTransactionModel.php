<?php

namespace App\Models;

use CodeIgniter\Model;

class PointsTransactionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'points_transaction_history';
    protected $primaryKey       = 'points_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'person_id', 'points', 'processed_by'];

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
