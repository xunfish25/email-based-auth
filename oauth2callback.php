<?php
session_start();
require 'vendor/autoload.php';
require_once 'config/db.php';
require_once 'models/User.php';

$client = new Google_Client();
$client->setClientId('12345');
$client->setClientSecret('12345');
$client->setRedirectUri('http://localhost/php-email-auth/oauth2callback.php');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        
        // Use User model to handle Google login
        $user = new User($conn);
        $userResult = $user->googleLogin(
            $google_account_info->email,
            $google_account_info->name,
            $google_account_info->id
        );
        
        if ($userResult) {
            // Set session variables
            $_SESSION['user'] = $userResult['email'];
            $_SESSION['email'] = $userResult['email'];
            $_SESSION['name'] = $userResult['name'];
            
            header('Location: index.php?action=home');
            exit();
        } else {
            $_SESSION['error'] = "Error logging in with Google.";
            header('Location: index.php?action=login');
            exit();
        }
    } else {
        $_SESSION['error'] = "Error logging in with Google.";
        header('Location: index.php?action=login');
        exit();
    }
} else {
    header('Location: index.php?action=login');
    exit();
}
?>
