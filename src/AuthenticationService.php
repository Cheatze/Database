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

    public function login(string $username, string $password)
    {
        $check = $this->userRepository->getUser($username, $password);
        if ($check == null) {
            return false;
        } else {
            return true;
        }
    }

    public function logout()
    {

    }

    public function getAuthenticatedUser()
    {

    }
}