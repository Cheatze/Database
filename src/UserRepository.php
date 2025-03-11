<?php
namespace Cheatze\Library;

class UserRepository
{

    private QueryBuilder $queryBuilder;

    /**
     * Instantiates the querybuilder with the user class and table
     */
    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder(User::class, 'users');
    }

    public function addUser(user $newUser)
    {
        $keyValuePairs = $newUser->toArray();
        $this->queryBuilder->insert($keyValuePairs);
    }

    public function getUser(string $username)
    {
        $check = $this->queryBuilder->select(['*'])->where(['Username' => $username])->get();
        return $check[0];
    }

    public function getAll()
    {

    }

    public function removeUser()
    {

    }

    public function getByCredentials()
    {

    }
}