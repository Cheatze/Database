<?php
namespace Cheatze\Library;
use \DateTimeImmutable;

class BoardgameController
{
    public BoardgameRepository $repository;

    public function __construct()
    {
        $this->repository = new BoardgameRepository();
    }

    public function boardgameIndex()
    {
        $boardgames = $this->repository->getAllBoardgames();
        include_once 'html/boardgameindex.html';
    }

    public function showBoardgame(int $id)
    {
        $boardgame = $this->repository->getBoardgameById($id);
        include_once 'html/Boardgame.html';
    }

    public function deleteBoardgame(int $id)
    {
        $id = intval($id['id']);

        $this->repository->removeBoardgameById($id);
        BoardgameController::boardgameIndex();
    }

    public function boardgameForm()
    {
        include_once 'html/boardgameform.html';
    }

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