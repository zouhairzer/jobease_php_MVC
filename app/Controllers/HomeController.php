<?php
namespace App\Controllers;
use App\Models\UserModel;

class HomeController
{
    public function index()
    {
        $userModel = new UserModel();
    
        // Fetch data from the "users" table

        $jobs = $userModel->getAllJobs();
        // Your controller logic goes here
        $data = 'zouhair zerkhane';
        $collections = ['jobs' => $jobs , "data" => $data] ;
        require(__DIR__ .'../../../view/home.php');
      

    }
    // public function fetchMoreUsers()
    // {
       
    //     $moreUsers = [
    //         ['jobs' => 'test user A', 'email' => 'user1@example.com'],
    //         ['username' => 'test user B', 'email' => 'user2@example.com'],
    //     ];

    //     // Return the data as JSON
    //     header('Content-Type: application/json');
    //     echo json_encode(['jobs' => $moreUsers]);
    //     exit;
    // }
    
    public function dashboard()
    { 
        require(__DIR__ .'../../../view/dashboard.php');
    }

    public function articles()
    { 
        $userModel = new UserModel();
        $jobs = $userModel->getAllJobs();
        $collections = ['jobs' => $jobs ] ;
        require(__DIR__ .'../../../view/articles.php');
    }

    // public function addJ()
    // { 
    //     require(__DIR__ .'../../../view/addJob.php');
    // }

    // public function updateJob()
    // { 
    //     require(__DIR__ .'../../../view/addJob.php');
    // }


}
?>
