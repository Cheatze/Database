<?php
namespace Cheatze\Library;

class MagazineRepository
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
     * Adds the given magazine to the database
     * @param \Cheatze\Library\Magazine $newMagazine
     * @return void
     */
    public function addMagazine(Magazine $newMagazine)
    {
        $keyValuePairs = $newMagazine->toArray();
        $this->queryBuilder->insert($keyValuePairs);
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
     * Removes a magazine from the database with the given id
     * @param int $id
     * @return void
     */
    public function removeMagazineById(int $id)
    {
        $this->queryBuilder->remove($id);
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