<?php
session_start();
require_once 'config/db.php'; 
require_once 'controllers/AuthController.php'; 
require 'vendor/autoload.php';

$auth = new AuthController($conn); 
$action = $_GET['action'] ?? 'login';

// Initialize Google Client
$google_client = new Google_Client();
$google_client->setClientId('12345');
$google_client->setClientSecret('12345');
$google_client->setRedirectUri('http://localhost/php-email-auth/oauth2callback.php');
$google_client->addScope("email");
$google_client->addScope("profile");
$login_url = $google_client->createAuthUrl(); 

switch ($action) {
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = $auth->register($_POST['email'], $_POST['password']); 
        }
        include 'views/register.php'; 
        break;

    case 'verify':
        $code = $_GET['code'] ?? ''; 
        $message = $auth->verify($code); 
        include 'views/verify.php'; 
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = $auth->login($_POST['email'], $_POST['password']); 
        }
        include 'views/login.php'; 
        break;

    case 'home':
        if (!isset($_SESSION['user'])) { 
            header("Location: index.php?action=login"); 
        }
        include 'views/home.php'; 
        break;

    case 'logout':
        $auth->logout(); 
        break;
}
?>