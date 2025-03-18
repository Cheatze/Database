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

    /**
     * Shows the login page
     * @return void
     */
    public function showLogin()
    {
        include_once "html/login.html";
    }

    /**
     * Shows the registration page
     * @return void
     */
    public function showRegistration()
    {
        include_once "html/register.html";
    }


    /**
     * Login with the login form data
     * Gets the user with the given username from the database and checks the hash on the password
     * If successful sets the Login and user session variables and returns to the menu
     * If unsuccesful shows an alert and returns tot he login page
     * @param mixed $data
     * @return void
     */
    public function login($data)
    {
        $username = $data['username'];
        $password = $data['password'];//
        $checker = $this->authenticationService->login($username);
        $checkAr = $checker->toArray();
        $valid = isset($checkAr['Password']) && password_verify($password, $checkAr['Password']);

        if ($valid) {
            echo "Logged in!";
            $_SESSION['Login'] = true;
            $_SESSION['user'] = $username;
            include_once "html/menu.html";
        } else {
            echo "<script>alert('Login failed');</script>";
            include_once "html/login.html";
        }
    }

    /**
     * Logs the user out by unsetting the login session variable and returns view back to the menu
     * @return void
     */
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
        $user = new User($username, $hashed_password, $email, 0);
        $this->authenticationService->register($user);
        include_once "html/login.html";
    }
}
