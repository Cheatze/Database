<?php
namespace Cheatze\Library;

class User
{
    private int $id;
    private string $username;
    private string $password;
    private string $email;

    public function __construct(string $username, string $password, string $email, int $id)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns an array with user data
     * @return array{Email: string, Password: string, Username: string}
     */
    public function toArray()
    {
        return [
            'Username' => $this->getUsername(),
            'Password' => $this->getPassword(),
            'Email' => $this->getEmail()
        ];
    }

    /**
     * Creates a new user from array data and returns that user
     * @param mixed $data
     * @return User
     */
    public static function fromArray($data)
    {
        return new User(
            $data['Username'],
            $data['Password'],
            $data['Email'],
            $data['Id']
        );
    }
}
