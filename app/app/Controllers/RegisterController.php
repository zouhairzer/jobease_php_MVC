<?php
    namespace App\Controllers;
    use App\Models\UserModel;

    class RegisterController
    {
        public function register()
        {
            $userRegister = new UserModel();
            $register = $userRegister->register();
        require(__DIR__ .'../../../view/candidat/register.php');
        }
}
?>