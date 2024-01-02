<?php
namespace App\Controllers;
use App\Models\Database;
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
    
    $connexion = Database::getInstance();
    $conn = $connexion->getConnection();
    session_start();
    if (isset($_SESSION["user_id"])){
            $user_id = $_SESSION["user_id"];
    }
    else{
        header("Location:?route=login");
    }

    $sql =  "SELECT approve.*, users.username AS name
    FROM approve
    INNER JOIN users ON users.id = approve.id_user
    INNER JOIN jobs ON jobs.job_id = approve.id_job
    WHERE users.id = '$user_id';
    ";
    $res = $conn->query($sql);

    if(isset($_GET["aprv"])) {
        $aprv = $_GET['aprv'];
        $apprv =  "UPDATE `approve` SET `approved`='1',`notification`='1' WHERE id = '$aprv'";
        $apprvRes = $conn->query($apprv);
        

    } else if(isset($_GET['inaprv'])) {
        $aprv = $_GET['inaprv'];
        $apprv =  "UPDATE `approve` SET `approved`='-1',`notification`='1' WHERE id = '$aprv'";
        $apprvRes = $conn->query($apprv);
    }
    

        require(__DIR__ .'../../../view/offre.php');
    }
}
