<?php
namespace Cheatze\Library;
use \DateTimeImmutable;

class AuthenticationController
{
    //initialise AuthenticationService

    private AuthenticationService $authenticationService;

    public function __construct()
    {
        $this->authenticationService = new AuthenticationService();
    }

    public function showLogin()
    {
        include_once "html/login.html";
    }

    public function showRegistration()
    {
        include_once "html/register.html";
    }

    public function login($data)
    {
        $username = $data['username'];
        $password = $data['password'];//
        $checker = $this->authenticationService->login($username);
        $checkAr = $checker->toArray();
        $valid = false;

        if (isset($checkAr['Password'])) {
            if (password_verify($password, $checkAr['Password'])) {
                $valid = true;
            }
        }

        if ($valid) {
            echo "Logged in!";
            $_SESSION['Login'] = true;
            $_SESSION['user'] = $username;
            include_once "html/menu.html";
        } else {
            echo "<script>alert('Login failed');</script>";
            echo $checkAr['Password'];
            include_once "html/login.html";
        }
    }

    public function logout()
    {
        echo "Logged out!";
        $_SESSION['Login'] = false;
        unset($_SESSION['user']);
        include_once "html/menu.html";
    }

    /**
     * Adds a user to the users database table and shows the login page
     * @param mixed $data
     * @return void
     */
    public function register($data)
    {
        $username = $data['username'];
        $password = $data['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $email = $data['email'];
        $user = new User($username, $hashed_password, $email);
        $this->authenticationService->register($user);
        include_once "html/login.html";
    }
}