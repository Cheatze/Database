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
        $password = $data['password'];
        $checker = $this->authenticationService->login($username, $password);
        if ($checker == true) {
            echo "Logged in!";
            $_SESSION['Login'] = true;
            include_once "html/menu.html";
        } else {
            echo "<script>alert('Login failed');</script>";
            include_once "html/login.html";
        }
    }

    public function logout()
    {
        echo "Logged out!";
        $_SESSION['Login'] = false;
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
        $email = $data['email'];
        $user = new User($username, $password, $email);
        $this->authenticationService->register($user);
        include_once "html/login.html";
    }
}