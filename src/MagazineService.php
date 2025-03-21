<?php
namespace Cheatze\Library;

class MagazineService
{
    private MagazineRepository $magazineRepository;

    /**
     * Instantiates the querybuilder with the magazine class and table
     */
    public function __construct()
    {
        $this->magazineRepository = new MagazineRepository();
    }

    /**
     * Retrieves all magazines from the database
     * @return array|null
     */
    public function getAllMagazines(): array|null
    {
        return $this->magazineRepository->getAllMagazines();
    }

    /**
     * Searches the magazines database table on title publisher and editor and returns an array of results
     * @param string $search
     * @return array
     */
    public function searchMagazines(string $search): array
    {
        return $this->magazineRepository->searchMagazines($search);
    }
}
