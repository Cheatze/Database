<?php
namespace Cheatze\Library;

class BoardgameRepository
{
    private QueryBuilder $queryBuilder;

    /**
     * Instantiates the querybuilder with the boardgame class and table
     */
    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder(Boardgame::class, 'boardgames');
    }

    /**
     * Adds the given boardgame to the database
     * @param \Cheatze\Library\Boardgame $newboardgame
     * @return void
     */
    public function addBoardgame(Boardgame $newboardgame)
    {
        $keyValuePairs = $newboardgame->toArray();
        $this->queryBuilder->insert($keyValuePairs);
    }

    /**
     * Gets all boardgames from the database
     * @return array|null
     */
    public function getAllBoardgames()
    {
        return $boardgames = $this->queryBuilder->select(['*'])->get();
    }

    /**
     * Gets one boardgame from the database with a certain id
     * @param int $id
     */
    public function getBoardgameById(int $id)
    {
        $boardgame = $this->queryBuilder->select(['*'])->where(['Id' => $id])->get();

        return $boardgame[0];
    }

    /**
     * Removes one boardgame from the database with a certain id
     * @param int $id
     * @return void
     */
    public function removeBoardgameById(int $id)
    {
        $this->queryBuilder->remove($id);
    }

}