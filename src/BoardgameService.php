<?php
namespace Cheatze\Library;

class BoardgameService
{
    private BoardgameRepository $boardgameRepository;

    /**
     * Instantiates the querybuilder with the boardgame class and table
     */
    public function __construct()
    {
        $this->boardgameRepository = new BoardgameRepository();
    }

    /**
     * Gets all boardgames from the database
     * @return array|null
     */
    public function getAllBoardgames()
    {
        return $boardgames = $this->boardgameRepository->getAllBoardgames();
    }

    /**
     * Searches the boardgame database table on the Title Publisher and Designer fields
     * Returns all that match with the search term
     * @param string $search
     * @return array
     */
    public function searchBoardgames(string $search)
    {
        $boardgames = $this->boardgameRepository->searchBoardgames($search);
        return $boardgames;
    }
}