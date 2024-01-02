<?php
namespace App\Controllers;
use App\Models\UserModel;

class LoginController
{
    public function login()
    { 
        $userRegister = new UserModel();
        $register = $userRegister->login();
        require(__DIR__ .'../../../view/login.php');
    }
}
?>
