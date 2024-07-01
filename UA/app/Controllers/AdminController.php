<?php

namespace App\Controllers;

use App\Controllers\BaseController;

// Models
use App\Models\PersonsModel;
use App\Models\RewardsModel;
use App\Models\ExchangeHistoryModel;
use App\Models\UsersAccountModel;

class AdminController extends BaseController
{
    public function index()
    {
        $data['Page'] = "Dashboard";
        return view('admin_homepage',$data);
    }

   //Accounts 
    public function accounts()
    {
        $PersonsModel  = new PersonsModel();
        $Persons = $PersonsModel->GetAllRecords();
        foreach ($Persons as &$Person) {
            $middleInitial = !empty($Person['mname']) ? substr($Person['mname'], 0, 1) . '.' : '';
            $Person['PersonName'] = $Person['fname'] . ' ' . $middleInitial . ' ' . $Person['lname'];
        }
        $data['Persons'] = $Persons;
        $data['Page'] = "Accounts";
        return view('accounts',$data);
    }

    public function AddAccounts()
    { 
        $PersonsModel  = new PersonsModel();
        $UsersAccountModel = new UsersAccountModel();
        $data = 
        [
            'fname' =>$this->request->getPost('fname'),
            'mname' =>$this->request->getPost('mname'),
            'lname' =>$this->request->getPost('lname')
        ];
        $UserAcc = $PersonsModel->CreateRecords($data);
        if(!$UserAcc)
        {   
            session()->setFlashdata('fail-accounts', 'There are some erorr Creating the Account');
            return redirect()->to('/admin/Accounts');
        }
        $password = "TrashToCash";
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $dataAccount = 
        [
            'person_id' =>$UserAcc,
            'username' =>$this->request->getPost('fname'),
            'password' =>$hashedPassword,
            'role' => 0
        ];
        $Account = $UsersAccountModel->CreateRecords($dataAccount);
        if(!$Account)
        {   
            session()->setFlashdata('fail-accounts', 'There are some erorr Creating the Account');
            return redirect()->to('/admin/Accounts');
        }

        session()->setFlashdata('success-accounts', 'The Account has been Created');
        return redirect()->to('/admin/Accounts');

    }
    public function EditAccounts()
    {
        $PersonsModel  = new PersonsModel();
        $UsersAccountModel = new UsersAccountModel();

        $id = $this->request->getPost('account_id');
        $data = 
        [
            'fname' =>$this->request->getPost('editfname'),
            'mname' =>$this->request->getPost('editmname'),
            'lname' =>$this->request->getPost('editlname')
        ];
        $UserAcc = $PersonsModel->UpdateRecords($id,$data);
        if(!$UserAcc)
        {   
            session()->setFlashdata('fail-accounts', 'There are some erorr Editing the Account');
            return redirect()->to('/admin/Accounts');
        }
        $AccountID = $UsersAccountModel->GetIDbyPersonId($id);
        $dataAccount = 
        [
            'username' =>$this->request->getPost('editfname')
        ];
        $Account = $UsersAccountModel->UpdateRecords($AccountID,$dataAccount);
        if(!$Account)
        {   
            session()->setFlashdata('fail-accounts', 'There are some erorr Editing the Account');
            return redirect()->to('/admin/Accounts');
        }
        session()->setFlashdata('success-accounts', 'The Account has been edited');
        return redirect()->to('/admin/Accounts');

    }
    public function DeleteAccount()
    {
        $PersonsModel  = new PersonsModel();
        $UsersAccountModel = new UsersAccountModel();
        $id = $this->request->getPost('deleteId');
    
        $UserAcc = $PersonsModel->DeleteRecords($id);
        if(!$UserAcc)
        {   
            session()->setFlashdata('fail-accounts', 'There are some erorr Deleting the User Account!!!');
            return redirect()->to('/admin/Accounts');
        }
        $accountId =$UsersAccountModel->GetIDbyPersonId($UserAcc);
        $DeleteAcc =$UsersAccountModel->DeleteRecords($accountId);
        if(!$DeleteAcc)
        {   
            session()->setFlashdata('fail-accounts', 'There are some erorr Deleting the User Account!!!');
            return redirect()->to('/admin/Accounts');
        }
        session()->setFlashdata('success-accounts', 'The User Account has been Deleted');
        return redirect()->to('/admin/Accounts');

    }



    public function rewards()
    {
        $RewardsModel = new RewardsModel();
        $Rewards = $RewardsModel->GetAllRecords();
        foreach ($Rewards as &$Reward) {
            $Reward['rewards_image_url'] = base_url('Rewards_Images/' . $Reward['rewards_image']);
        }
        $data['Rewards'] = $Rewards;

        $data['Page'] = "Rewards";
        return view('rewards',$data);
    }
    public function AddRewards()
    {
        
        $RewardsModel = new RewardsModel();

        $file = $this->request->getFile('rewards_image');
        if ($file->isValid() && !$file->hasMoved()) 
        {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'Rewards_Images', $newName);
            $imageName = $file->getName();


            $data = [
                'rewards_name' => $this->request->getPost('reward_name'),
                'rewards_description' =>$this->request->getPost('reward_description'),
                'rewards_image' =>$imageName,
                'points_required' =>$this->request->getPost('points'),
                'added_by' =>'1',
            ];
            $AddReward = $RewardsModel ->CreateRecords($data);
            if(!$AddReward)
            {   
                session()->setFlashdata('fail-rewards', 'There are some erorr adding the Reward!');
                return redirect()->to('/admin/Rewards');
            }
            session()->setFlashdata('success-rewards', 'The Reward has been Addded');
            return redirect()->to('/admin/Rewards');
        }
        else
        {
            $session->setFlashdata('fail-rewards', 'There was an error uploading the Rewards Image...');  
            return redirect()->to('/admin/Rewards');
        }
    }

    public function EditRewards()
    {
        $RewardsModel = new RewardsModel();

        $id = $this->request->getPost('rewards_id');
        $file = $this->request->getFile('editRewardsImage');
          
        if($file == "")
        {
                $data = [
                    'rewards_name' => $this->request->getPost('editRewards_name'),
                    'points_required' =>$this->request->getPost('editRewardsPoints'),
                    'rewards_description' =>$this->request->getPost('EditRewardsDesc')
                ];
                $EditRewards = $RewardsModel ->UpdateRecords($id,$data);
                if(!$EditRewards)
                {   
                    session()->setFlashdata('fail-rewards', 'There are some erorr Editing the Rewards!!!');
                    return redirect()->to('/admin/Rewards');
                }
                session()->setFlashdata('success-rewards', 'The Rewards has been Edited');
                return redirect()->to('/admin/Rewards');
        }
        else
        {
            if ($file->isValid() && !$file->hasMoved()) 
            {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'Rewards_Images', $newName);
                $imageName = $file->getName();
                $data = [
                    'rewards_name' => $this->request->getPost('editRewards_name'),
                    'points_required' =>$this->request->getPost('editRewardsPoints'),
                    'rewards_image'=>$imageName,
                    'rewards_description' =>$this->request->getPost('EditRewardsDesc') 
                ];
               
                $EditRewards = $RewardsModel ->UpdateRecords($id,$data);
                if(!$EditRewards)
                {   
                    session()->setFlashdata('fail-rewards', 'There are some erorr Editing the Rewards!!!');
                    return redirect()->to('/admin/Rewards');
                }
                session()->setFlashdata('success-rewards', 'The Rewards has been Edited');
                return redirect()->to('/admin/Rewards');
            
            }
            else
            {
                $session->setFlashdata('fail-rewards', 'There was an error uploading the Rewards Image...');  
                return redirect()->to('/admin/Rewards');
            }
        }
    }
    public function DeleteRewards()
    {
        $RewardsModel = new RewardsModel();
        $id = $this->request->getPost('deleteRewardID');
    
        $Rewards = $RewardsModel->DeleteRecords($id);
        if(!$Rewards)
        {   
            session()->setFlashdata('fail-rewards', 'There are some erorr Deleting the Rewards!!!');
            return redirect()->to('/admin/Rewards');
        }
        session()->setFlashdata('success-rewards', 'The Rewards has been Deleted');
        return redirect()->to('/admin/Rewards');


    }

    public function Exchange()
    {
        $data['Page'] = "Exchange";
        return view('exchange',$data);
    }

    public function GetRewards()
    {
        $ExchangeHistoryModel = new ExchangeHistoryModel();

        $voucher = $this->request->getPost('voucher');
        
        $RewardsDetails = $ExchangeHistoryModel->GetRecordsbyVoucher($voucher);
        if ($RewardsDetails) {
            foreach ($RewardsDetails as &$RewardsDetail) {
                $middleInitial = !empty($RewardsDetail->mname) ? substr($RewardsDetail->mname, 0, 1) . '.' : '';
                $RewardsDetail->Accountname = $RewardsDetail->fname . ' ' . $middleInitial . ' ' . $RewardsDetail->lname;
                $RewardsDetail->image_url = base_url('Rewards_Images/' . $RewardsDetail->rewards_image); // Adjust image path as needed
                
            }
            return $this->response->setJSON(['success' => true, 'data' => $RewardsDetails[0]]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'No reward found or It has already been claimed']);
        }
    }

    public function ApproveRewards()
    {
        $ExchangeHistoryModel = new ExchangeHistoryModel();
        $id = $this->request->getPost('exchangeId');
        $session = session();
        $userId = $session->get('userid');

        $data =  [
                    'processed_by' => $userId,
                    'status' => "Claimed"
        ];
        $Redeem = $ExchangeHistoryModel->UpdateRecords($id,$data);  
        session()->setFlashdata('claimed', 'The Rewards has been Claimed successfully');
        return redirect()->to('/admin/Exchange');

    }
    public function ExchangeHistory()
    {

        $ExchangeHistoryModel = new ExchangeHistoryModel();

        
        $Transactions = $ExchangeHistoryModel->GetAllRecords();
        foreach ($Transactions as &$Transaction) {
            $middleInitial = !empty($Transaction->mname) ? substr($Transaction->mname, 0, 1) . '.' : '';
            $Transaction->Accountname = $Transaction->fname . ' ' . $middleInitial . ' ' . $Transaction->lname;
        }

        $data['Transactions'] = $Transactions;


        $data['Page'] = "Exchange History";
        return view('exchangehistory',$data);
    }
     





    public function User()
    {
        $UsersAccountModel = new UsersAccountModel();

        $Accounts = $UsersAccountModel->GetAllAdminRecords();
        foreach ($Accounts as &$Account) {
            $middleInitial = !empty($Account['mname']) ? substr($Account['mname'], 0, 1) . '.' : '';
            $Account['Accountname'] = $Account['fname'] . ' ' . $middleInitial . ' ' . $Account['lname'];
        }
        $data['Accounts'] = $Accounts;
        $data['Page'] = "Admin Accounts";
        return view('user',$data);
    }

    public function AddAdmin()
    {
        $UsersAccountModel = new UsersAccountModel();

        $password = "TrashToCash";
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = 
        [
            'fname' =>$this->request->getPost('fname'),
            'mname' =>$this->request->getPost('mname'),
            'lname' =>$this->request->getPost('lname'),
            'username'=>$this->request->getPost('fname'),
            'password' =>$hashedPassword,
            'role' => $this->request->getPost('role')
        ];
        $UserAcc = $UsersAccountModel->CreateRecords($data);
        if(!$UserAcc)
        {   
            session()->setFlashdata('fail-accounts', 'There are some erorr Creating the Account');
            return redirect()->to('/admin/User');
        }
        session()->setFlashdata('success-accounts', 'The User Account has been Created');
        return redirect()->to('/admin/User');
    }
    public function EditAdminAccount()
    {
        $UsersAccountModel = new UsersAccountModel();
        $id = $this->request->getPost('account_id');
        $isAlreadyLogged = $UsersAccountModel->GetLastLogin($id);
        if($isAlreadyLogged ==false)
        {
            $data = 
            [
                'fname' =>$this->request->getPost('editfname'),
                'mname' =>$this->request->getPost('editmname'),
                'lname' =>$this->request->getPost('editlname'),
                'username'=>$this->request->getPost('editfname'),
                'role' => $this->request->getPost('editrole')
            ];
        }
        else{
            $data = 
            [
                'fname' =>$this->request->getPost('editfname'),
                'mname' =>$this->request->getPost('editmname'),
                'lname' =>$this->request->getPost('editlname'),
                'role' => $this->request->getPost('editrole')
            ];
        }
   
        $UserAcc = $UsersAccountModel->UpdateRecords($id,$data);
        if(!$UserAcc)
        {   
            session()->setFlashdata('fail-accounts', 'There are some erorr Updating the Account');
            return redirect()->to('/admin/User');
        }
        session()->setFlashdata('success-accounts', 'The User Account has been Updated');
        return redirect()->to('/admin/User');
    }


    public function DeleteAdminAccount()
    {
        $UsersAccountModel = new UsersAccountModel();
        $id = $this->request->getPost('deleteId');
    
        $UserAcc = $UsersAccountModel->DeleteRecords($id);
        if(!$UserAcc)
        {   
            session()->setFlashdata('fail-accounts', 'There are some erorr Deleting the Account!!!');
            return redirect()->to('/admin/User');
        }
        session()->setFlashdata('success-accounts', 'The Account has been Deleted');
        return redirect()->to('/admin/User');
    }
}
