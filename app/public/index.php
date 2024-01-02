<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\UserController;
use App\Controllers\adminController;

$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Instantiate the controller based on the route
switch ($route) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    case 'fetchMoreUsers':
        $controller = new HomeController();
        $controller->fetchMoreUsers();
        break;
    case 'login':
        $logincontroller = new LoginController();
        $logincontroller->login();
        break;
    case 'register':
        $registercontroller = new RegisterController();
        $registercontroller->register();
        break;
    case 'dashboard':
        $dashboardController = new HomeController();
        $dashboardController->dashboard();
        break;
    case 'articles':
        $articlesController = new HomeController();
        $articlesController->articles();
        break;
    case 'addJob':
        $addJobController = new adminController();
        $addJobController->addJobs();
        break;
    case 'delete':
        $addJobController = new adminController();
        $addJobController->deleteJobs();
        break;
    case 'update':
        $updateJobController = new adminController();
        $updateJobController->updateJobs();
        break;
    case 'search':
        $searchJobController = new adminController();
        $searchJobController->searchJobs();
        break;
    case 'offre':
        $searchJobController = new adminController();
        $searchJobController->offres();
         break;
    case 'indexCandidat':
        $searchJobController = new HomeController();
        $searchJobController->candidat();
        break;
    default:
        // Handle 404 or redirect to the default route
        header('HTTP/1.0 404 Not Found');
        exit('Page not found');
}

// Execute the controller action

?>
