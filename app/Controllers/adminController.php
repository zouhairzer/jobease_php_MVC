<?php
namespace App\Controllers;
use App\Models\UserModel;

class adminController
{
    public function deleteJobs()
    {
        $deleteOffre = new UserModel();
        $delete = $deleteOffre->delete();
        require(__DIR__ .'../../../view/delete.php');
    }

    public function addJobs()
    {
        $addJob = new UserModel();
        $addjob = $addJob->addjob();
        require(__DIR__ .'../../../view/addJob.php');
    }

    public function updateJobs()
    {
        $updateJob = new UserModel();
        $jobs = $updateJob->fetchUpdatejob();
        require(__DIR__ .'../../../view/update.php');
    }
    
    public function searchJobs()
    {
        require(__DIR__ .'../../../view/search.php');
    }

    public function offres()
    {
        $userModel = new UserModel();
        $jobs = $userModel->getUser();
        $collections = ['jobs' => $jobs ] ;
        require(__DIR__ .'../../../view/offre.php');
    }
}
