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

    /**
     * Adds a user to the database
     * @param \Cheatze\Library\user $newUser
     * @return void
     */
    public function addUser(User $newUser)
    {
        $keyValuePairs = $newUser->toArray();
        $this->queryBuilder->insert($keyValuePairs);
    }

    /**
     * Returns a user from the database by username
     * @param string $username
     */
    public function getUser(string $username)
    {
        return $this->queryBuilder->select(['*'])->where(['Username' => $username])->get()[0];
    }
}
