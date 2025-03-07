<?php
namespace Cheatze\Library;
use \DateTimeImmutable;

class BoardgameController
{
    public BoardgameRepository $repository;
    public BoardgameService $service;

    /**
     * Initialises the boardgame repository
     */
    public function __construct()
    {
        $this->repository = new BoardgameRepository();
        $this->service = new BoardgameService();
    }

    /**
     * Retrieves all boardgames from the database and includes the boardgame list html
     * @return void
     */
    public function boardgameIndex()
    {
        $boardgames = $this->service->getAllBoardgames();
        include_once 'html/boardgameindex.html';
    }

    /**
     * Retrieves one boardgame from the database and includes the boardgame details html
     * @param int $id
     * @return void
     */
    public function showBoardgame(int $id)
    {
        $boardgame = $this->service->getBoardgameById($id);
        include_once 'html/Boardgame.html';
    }

    /**
     * Deletes a boardgame from the database with a certain id and calls the boardgameIndex method
     * @param array $id
     * @return void
     */
    public function deleteBoardgame(array $id)
    {
        $id = intval($id['id']);

        $this->repository->removeBoardgameById($id);
        BoardgameController::boardgameIndex();
    }

    /**
     * Includes the boardgame form html
     * @return void
     */
    public function boardgameForm()
    {
        include_once 'html/boardgameform.html';
    }

    /**
     * Adds a boardgame to the database and calls the boardgame index method
     * @param mixed $data
     * @return void
     */
    public function addBoardgame($data)
    {
        $title = $data['title'];
        $designer = $data['Designer'];
        $ean = $data["ean"];
        $publisher = $data['publisher'];
        $releaseDate = new DateTimeImmutable($data['releaseDate']);
        $minPlayers = $data['minplayers'];
        $maxPlayers = $data['maxplayers'];

        $newBoardgame = new Boardgame($title, $designer, $ean, $publisher, $releaseDate, $minPlayers, $maxPlayers);

        $this->repository->addBoardgame($newBoardgame);
        $this->boardgameIndex();
    }
}