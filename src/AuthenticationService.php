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

    /**
     *
     * Adds a user to the users table with the data of the given User object
     * @param \Cheatze\Library\User $user
     * @return void
     */
    public function register(User $user)
    {
        $this->userRepository->addUser($user);
    }

    /**
     * Returns the user from the username table with the given username
     * Returns false if there is no return value from getUser
     * @param string $username
     */
    public function login(string $username)
    {
        $check = $this->userRepository->getUser($username);

        if ($check == null) {
            return false;
        } else {
            return $check;
        }
    }

    /**
     * Returns the username value of the user session variable
     */
    public function getAuthenticatedUser()
    {
        return $_SESSION['user'];
    }
}
