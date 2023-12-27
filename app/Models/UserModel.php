<?php


namespace App\Models;
session_start();
class UserModel
{
    private $db;

    public function __construct()
    {
        // Get an instance of the Database class
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllJobs()
    {
        // Fetch data from the "users" table
        $result = $this->db->query("SELECT * FROM jobs order by date_created desc");
        
        // Check for errors
        if (!$result) {
            die("Error: " . $this->db->error);
        }
        
        // Fetch data as an associative array
        $jobs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $jobs[] = $row;
        }
       
        return $jobs;
    }

    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = htmlspecialchars($_POST['username'],ENT_QUOTES);
            $email = htmlspecialchars($_POST['email'],ENT_QUOTES);
            $password = htmlspecialchars($_POST['password'],ENT_QUOTES);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $role_name = htmlspecialchars("candidat",ENT_QUOTES);
            $sql="SELECT * FROM users WHERE email = '$email'";
            $res=$this->db->query($sql);

            if(mysqli_num_rows($res)>0){
                echo '<script language="javascript">';
                echo 'alert("Compt already exists")';
                echo '</script>';
            }
            else{
                $result = $this->db->query("INSERT INTO users (username, email,password,role_name) VALUES ('$username', '$email','$hashedPassword','$role_name')");
                if($result){
                    header ('location : ?route=login');
                } 
                else{
                    header ('location : ?route=register');
                }
            }

        }
    }


    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = htmlspecialchars($_POST['email'],ENT_QUOTES);
        $password = htmlspecialchars($_POST['password'],ENT_QUOTES);
        
        $result = $this->db->query("SELECT * FROM users WHERE email='$email'");
        if ($result) {
            $user = mysqli_fetch_assoc($result);
            $hashedPassword =  $user['password'];
            if ($user && password_verify($password, $hashedPassword)) {
                
                $role = $user['role_name']; 
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $role;

                // print_r($_SESSION);

                if ($role === 'candidat') {
                    header ('location:?route=indexCandidat');
                } 
                elseif($role === 'admin') {
                    header ('location:?route=dashboard');
                }
            }
        }
    }}


    public function postuler(){
        if (isset($_SESSION['role'])) {
            header ('location:?route=');
        } 
    }


    public function addjob()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $directory = "assets/img/";
            $title = $_POST['title'];
            $description = $_POST['description'];
            $location = $_POST['location'];
            $name = $_FILES["img"]["name"];
            $path = $directory . $name;
            $fileType = pathinfo($path, PATHINFO_EXTENSION);
            $allowedExtensions = array("jpg", "jpeg", "png", "gif", "svg");
        
            if (in_array($fileType, $allowedExtensions)) {
                move_uploaded_file($_FILES["img"]["tmp_name"], $path);
        
                $result = $this->db->query("INSERT INTO `jobs`(`title`, `description`,`location`,`image_path`) VALUES('$title', '$description','$location','$path')");
        
                if ($result == 0) {
                    echo "<script>alert('Invalid Add');</script>";
                } elseif ($result == 1) {
                    header ('location:?route=articles');
                } else {
                    echo "Error";
                }
            } else {
                echo "Only JPG, JPEG, PNG, and GIF are allowed.";
            }
        }
    }  

    public function delete()
    {
        if (isset($_GET['job_id'])) {
            $jobId = $_GET['job_id'];
            $result = $this->db->query("DELETE FROM jobs WHERE job_id='$jobId'");
            if($result) {
                header ('location:?route=articles');
            }
            else{
                echo "Failed to delete the job.";
            }
        }
    }
    public function fetchUpdatejob()
    {
    
        if (isset($_GET['job_id'])) {
            $jobid = $_GET['job_id'];
            $query = "SELECT * FROM jobs WHERE job_id = '$jobid'";
            $result = $this->db->query($query);
            $jobs = [];
            $rows = mysqli_fetch_assoc($result);
            $jobs = $rows;
            return $jobs;
        }

        if(isset($_POST['submit'])){ 
            $title = $_POST['title'];
            $description = $_POST['description'];
            $location = $_POST['location'];
            $jobId = $_POST['jobid'];
            
            $quer = "UPDATE `jobs` SET `title`='$title',`description`='$description',`location`='$location' WHERE job_id = '$jobId' ";
            $resul = $this->db->query($quer);
            
            if (isset($resul)) {
                return 1; 
            } else {
                return 0; 
            }
        }

    }

    public function getUser()
    {
        // Fetch data from the "users" table
        $result = $this->db->query("SELECT * FROM users order by id desc");
        
        // Check for errors
        if (!$result) {
            die("Error: " . $this->db->error);
        }
        
        // Fetch data as an associative array
        $user = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $user[] = $row;
        }
       
        return $user;
    }

}
?>
