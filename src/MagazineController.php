<?php
namespace Cheatze\Library;
//use Cheatze\Library\MainController;
use \DateTimeImmutable;

class MagazineController
{

    public $repository;

    public function __construct()
    {
        $this->repository = new MagazineRepository();
    }

    public function magazineIndex()
    {
        $magazines = $this->repository->getAllMagazines();
        include_once 'html/magazineindex.html';
    }

    public function showMagazine(int $id)
    {
        $magazine = $this->repository->returnMagazineById($id);
        include_once 'html/Magazine.html';
    }

    public function deleteMagazine(array $id)
    {
        $id = intval($id['id']);

        $this->repository->removeMagazineById($id);
        MagazineController::magazineIndex();
    }

    public function magazineForm()
    {
        include_once 'html/magazineform.html';
    }

    public function addMagazine($data)
    {
        $title = $data['title'];
        $editor = $data['editor'];
        $issn = $data['issn'];
        $publisher = $data['publisher'];
        $publicationDate = new DateTimeImmutable($data['publicationDate']);
        $occurrence = $data['occurrence'];

        $newMagazine = new Magazine($title, $editor, $issn, $publisher, $publicationDate, $occurrence);

        $this->repository->addMagazine($newMagazine);
        $this->magazineIndex();
    }

}