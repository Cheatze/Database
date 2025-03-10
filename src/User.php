<?php
namespace Cheatze\Library;

class User
{
    private int $id;
    private string $username;
    private string $password;
    private string $email;

    public function __construct(string $username, string $password, string $email = "No@gono.nl", int $id = 1)
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

    public function toArray()
    {
        return [
            'Username' => $this->getUsername(),
            'Password' => $this->getPassword(),
            'Email' => $this->getEmail()
        ];
    }

    public static function fromArray($data)
    {
        return new User(
            $data['Username'],
            $data['Password'],
            $data['Email']
        );
    }
}