<?php
namespace Cheatze\Library;
use \DateTimeImmutable;

class MagazineController
{

    public MagazineRepository $repository;

    public MagazineService $service;

    /**
     * Initialises the magazine repository
     */
    public function __construct()
    {
        $this->repository = new MagazineRepository();
        $this->service = new MagazineService();
    }

    /**
     * Gets all magazines from the database and includes the magazine index html
     * @return void
     */
    public function magazineIndex()
    {
        $magazines = $this->service->getAllMagazines();
        include_once 'html/magazineindex.html';
    }

    /**
     * Gets one magazine with a certain id from the database and includes the magazine details html
     * @param int $id
     * @return void
     */
    public function showMagazine(int $id)
    {
        $magazine = $this->service->returnMagazineById($id);
        include_once 'html/Magazine.html';
    }

    /**
     * Deletes a magazine with a certain id from the database and calls the magazine index method
     * @param array $id
     * @return void
     */
    public function deleteMagazine(array $id)
    {
        $id = intval($id['id']);

        $this->repository->removeMagazineById($id);
        MagazineController::magazineIndex();
    }

    /**
     * Includes the magazine html form
     * @return void
     */
    public function magazineForm()
    {
        include_once 'html/magazineform.html';
    }

    /**
     * Adds a magazine to the database
     * @param mixed $data
     * @return void
     */
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