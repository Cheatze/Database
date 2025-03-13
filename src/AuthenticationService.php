<?php
namespace Cheatze\Library;

class AuthenticationService
{

    //initialise UserRepository
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function register(User $user)
    {
        $this->userRepository->addUser($user);
    }

    public function login(string $username)
    {
        $check = $this->userRepository->getUser($username);
        //return $check;
        if ($check == null) {
            return false;
        } else {
            return $check;
        }
    }

    public function logout()
    {

    }

    public function getAuthenticatedUser()
    {
        return $_SESSION['user'];
    }
}