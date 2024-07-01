<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}


//login
$routes->match(['get', 'post'], '/', 'LoginController::index');
$routes->match(['get', 'post'], '/VerifyLogin', 'LoginController::VerifyLogin');
$routes->match(['get', 'post'], '/SetUpAccount', 'LoginController::SetupAcc');
$routes->match(['get', 'post'], '/Setup', 'LoginController::UpdateAccount');

$routes->match(['get', 'post'], '/Logout', 'LoginController::logout');



$routes->match(['get', 'post'], '/admin', 'AdminController::index');

//accounts
$routes->match(['get', 'post'], '/admin/Accounts', 'AdminController::accounts');
$routes->match(['get', 'post'], '/AddAccount', 'AdminController::AddAccounts');
$routes->match(['get', 'post'], '/EditAccount', 'AdminController::EditAccounts');
$routes->match(['get', 'post'], '/DeleteAccount', 'AdminController::DeleteAccount');

//rewards
$routes->match(['get', 'post'], '/admin/Rewards', 'AdminController::rewards');
$routes->match(['get', 'post'], '/AddRewards', 'AdminController::AddRewards');
$routes->match(['get', 'post'], '/EditRewards', 'AdminController::EditRewards');
$routes->match(['get', 'post'], '/DeleteRewards', 'AdminController::DeleteRewards');




$routes->match(['get', 'post'], '/admin/Exchange', 'AdminController::Exchange');
$routes->match(['get', 'post'], '/getRewardDetails', 'AdminController::GetRewards');
$routes->match(['get', 'post'], '/ClaimRedeem', 'AdminController::ApproveRewards');





$routes->match(['get', 'post'], '/admin/exchangehistory', 'AdminController::ExchangeHistory');




$routes->match(['get', 'post'], '/admin/User', 'AdminController::User');
$routes->match(['get', 'post'], '/AddAdminAcc', 'AdminController::AddAdmin');
$routes->match(['get', 'post'], '/EditAdminAcc', 'AdminController::EditAdminAccount');
$routes->match(['get', 'post'], '/DeleteAdminAcc', 'AdminController::DeleteAdminAccount');


//Users
$routes->match(['get', 'post'], '/User/Home', 'UserController::index');
$routes->match(['get', 'post'], '/User/Redeem', 'UserController::Redeem');
$routes->match(['get', 'post'], '/User/RedeemHistory', 'UserController::ExchangeHistoryByUser');

$routes->match(['get', 'post'], '/RedeemRewards', 'UserController::RedeemRewards');


