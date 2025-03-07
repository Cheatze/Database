<?php
namespace Cheatze\Library;

class MagazineService
{
    private QueryBuilder $queryBuilder;

    /**
     * Instantiates the querybuilder with the magazine class and table
     */
    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder(Magazine::class, 'magazines');
    }

    /**
     * Retrieves all magazines from the database
     * @return array|null
     */
    public function getAllMagazines()
    {
        return $magazines = $this->queryBuilder->select(['*'])->get();

    }

    /**
     * Gets one magazine from the database with the given id
     * @param int $id
     */
    public function returnMagazineById(int $id)
    {
        $magazine = $this->queryBuilder->select(['*'])->where(['Id' => $id])->get();

        return $magazine[0];
    }

    /**
     * Searches the magazines database table on title publisher and editor and returns an array of results
     * @param string $search
     * @return array
     */
    public function searchMagazines(string $search)
    {
        $magazines = [];
        $titles = $this->queryBuilder->select(['*'])->where(['Title' => $search])->get();
        $publishers = $this->queryBuilder->select(['*'])->where(['Publisher' => $search])->get();
        $editors = $this->queryBuilder->select(['*'])->where(['Publisher' => $search])->get();
        $magazines = array_merge($magazines, $titles, $publishers, $editors);
        return $magazines;
    }
}