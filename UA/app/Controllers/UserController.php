<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// Models
use App\Models\PersonsModel;
use App\Models\RewardsModel;
use App\Models\ExchangeHistoryModel;
use App\Models\UsersAccountModel;

class UserController extends BaseController
{
    public function index()
    {
        $ExchangeHistoryModel = new ExchangeHistoryModel();
        $PersonsModel = new PersonsModel();
        $UsersAccountModel = new UsersAccountModel();
        $session = session();
        $id = $session->get('userid');
        $PersonID = $UsersAccountModel->GetPersonIDbyUserID($id);
        $UserDetails = $PersonsModel->GetRecordsbyId($PersonID);

        $middleInitial = !empty($UserDetails['mname']) ? substr($UserDetails['mname'], 0, 1) . '.' : '';
        $UserFullName = $UserDetails['fname'] . ' ' . $middleInitial . ' ' . $UserDetails['lname'];

        $Transactions = $ExchangeHistoryModel->GetAllRecordsbyUser($PersonID);
       
        $data['Transactions'] = $Transactions;
        $data['UserFullName'] = $UserFullName;
        $data['UserDetails'] = $UserDetails;

        return view('User/userhome',$data);
    }
    
    public function Redeem ()
    {
        $PersonsModel = new PersonsModel();
        $UsersAccountModel = new UsersAccountModel();
        $RewardsModel = new RewardsModel();
        $session = session();
        $id = $session->get('userid');
        $PersonID = $UsersAccountModel->GetPersonIDbyUserID($id);
        $UserDetails = $PersonsModel->GetRecordsbyId($PersonID);
    
        $data['UserDetails'] = $UserDetails;
        
        $Rewards = $RewardsModel->GetAllRecords();
        foreach ($Rewards as &$Reward) {
            $Reward['rewards_image_url'] = base_url('Rewards_Images/' . $Reward['rewards_image']);
        }
        $data['Rewards'] = $Rewards;
        
        return view('User/UserRedeem',$data);
    }
    public function ExchangeHistoryByUser()
    {
        $ExchangeHistoryModel = new ExchangeHistoryModel();
        $PersonsModel = new PersonsModel();
        $UsersAccountModel = new UsersAccountModel();
        $session = session();
        $id = $session->get('userid');  
        $PersonID = $UsersAccountModel->GetPersonIDbyUserID($id);

        $Transactions = $ExchangeHistoryModel->GetAllRecordsbyUser($PersonID);
       
        $data['Transactions'] = $Transactions;

    

        return view('User/userhistory',$data);
    }
    public function RedeemRewards()
    {
        $RewardsModel = new RewardsModel();
        $ExchangeHistoryModel = new ExchangeHistoryModel();
        $UsersAccountModel = new UsersAccountModel();
        $PersonsModel = new PersonsModel();

        // Getting the Details of the Rewards
        $rewardId = $this->request->getPost('RedeemReward_id');
        $RewardsDetails = $RewardsModel->GetRewardsbyID($rewardId);
        $PointsRequired = $RewardsDetails['points_required'];
    
        $Voucher = $this->GenerateVoucher();
    
        // Getting the Details of the user
        $session = session();
        $userId = $session->get('userid');
        $PersonID = $UsersAccountModel->GetPersonIDbyUserID($userId);
        $UserDetails = $PersonsModel->GetRecordsbyId($PersonID);
    
        $PrevPoints = $UserDetails['real_timepoints'];
        $NewBal = $PrevPoints - $PointsRequired;
    
        if ($PrevPoints < $PointsRequired) {
            session()->setFlashdata('fail-redeem', "Insufficient points to redeem the reward.");
            return redirect()->to('/User/Redeem');
        }
    
        $dataExchange = [
            'person_id' => $PersonID,
            'rewards_id' => $rewardId,
            'points_used' => $PointsRequired,
            'voucher' => $Voucher,
            'processed_by' => "999",
            'status' => 'Pending'
        ];
    
        $Exchange = $ExchangeHistoryModel->CreateRecords($dataExchange);
        if (!$Exchange) {
            session()->setFlashdata('fail-redeem', "There was an error redeeming the reward.");
            return redirect()->to('/User/Redeem');
        }
    
        // Update User Balance
        $dataUser = [
            'real_timepoints' => $NewBal
        ];
    
        $UserUpdate = $PersonsModel->UpdateRecords($PersonID, $dataUser);
    
        session()->setFlashdata('voucher', $Voucher);
        return redirect()->to('/User/Redeem');
    }
    


    private function GenerateVoucher()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $voucherCode = '';
        for ($i = 0; $i < 8; $i++) {
          
            $voucherCode .= $characters[rand(0, $charactersLength - 1)];
        } 
        return $voucherCode;
    }
    
}
