<?php

namespace App\Models;

use CodeIgniter\Model;

class ExchangeHistoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'exchange_history';
    protected $primaryKey       = 'exchange_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                     'voucher','person_id', 'rewards_id', 'points_used', 'processed_by','status'
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
    
    public function Get5RecordsbyUser($PersonID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('exchange_history as ex');
        $builder->select('ex.points_used, ex.voucher, ex.status, ex.created_at, r.rewards_name');
        $builder->join('rewards as r', 'ex.rewards_id = r.rewards_id', 'left');
        $builder->where('ex.person_id', $PersonID); 
        $builder->orderBy('ex.created_at', 'DESC'); // Order by created_at in descending order
        $builder->limit(5); // Limit to 5 results
        $query = $builder->get();
        $Transactions = $query->getResult();
        
        return $Transactions; 
    }
    public function GetAllRecordsbyUser($PersonID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('exchange_history as ex');
        $builder->select('ex.points_used, ex.voucher, ex.status, ex.created_at, r.rewards_name');
        $builder->join('rewards as r', 'ex.rewards_id = r.rewards_id', 'left');
        $builder->where('ex.person_id', $PersonID); 
        $builder->orderBy('ex.created_at', 'DESC'); // Order by created_at in descending order
      
        $query = $builder->get();
        $Transactions = $query->getResult();
        
        return $Transactions; 
    }
    public function GetAllRecords()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('exchange_history as ex');
        $builder->select('ex.points_used, ex.voucher, ex.status, ex.created_at, r.rewards_name, p.fname, p.lname, p.mname, CONCAT(ua.fname, " ", ua.lname) as admin');
        $builder->join('rewards as r', 'ex.rewards_id = r.rewards_id', 'left');
        $builder->join('persons as p', 'ex.person_id = p.person_id', 'left');
        $builder->join('users_account as ua', 'ex.processed_by = ua.user_id', 'left');
        $builder->orderBy('ex.created_at', 'DESC'); 
    
        $query = $builder->get();
        $Transactions = $query->getResult();
        
        return $Transactions; 
    }

    public function GetRecordsbyVoucher($voucher)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('exchange_history as ex');
        $builder->select('ex.exchange_id,ex.points_used, ex.voucher, ex.status, ex.created_at, r.rewards_name, r.rewards_description,r.rewards_image,p.fname, p.lname, p.mname');
        $builder->join('rewards as r', 'ex.rewards_id = r.rewards_id', 'left');
        $builder->join('persons as p', 'ex.person_id = p.person_id', 'left');
        $builder->where('ex.voucher', $voucher); 
        $builder->where('ex.status', "Pending"); 
        $query = $builder->get();
        $Transactions = $query->getResult();
        
        return $Transactions; 

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
