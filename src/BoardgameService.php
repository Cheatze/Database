<?php
namespace Cheatze\Library;

class BoardgameService
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
     * Searches the boardgame database table on the Title Publisher and Designer fields
     * Returns all that match with the search term
     * @param string $search
     * @return array
     */
    public function searchBoardgames(string $search)
    {
        $boardgames = [];
        $titles = $this->queryBuilder->select(['*'])->where(['Title' => $search])->get();
        $publishers = $this->queryBuilder->select(['*'])->where(['publisher' => $search])->get();
        $designers = $this->queryBuilder->select(['*'])->where(['Designer' => $search])->get();
        $boardgames = array_merge($boardgames, $titles, $publishers, $designers);
        return $boardgames;
    }
}