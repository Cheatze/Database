<?php
namespace Cheatze\Library;

class ItemController
{
    public ItemService $itemService;

    /**
     * Initialises the item service
     */
    public function __construct()
    {
        $this->itemService = new ItemService();
    }

    /**
     * Gets all items from the three database tables and includes the item list html
     * @return void
     */
    public function showAllItems()
    {
        $items = $this->itemService->getAllItems();
        include_once 'html/itemindex.html';
    }

    //How?
    public function showItem(int $id)
    {

    }

    /**
     * Includes the item search html
     * @return void
     */
    public function itemSearchForm()
    {
        include_once 'html/ItemSearch.html';
    }

    /**
     * Searches the books/magazines/boardgames database tables on the search term submitted
     * @param mixed $data
     * @return void
     */
    public function itemSearch($data)
    {
        $items = $this->itemService->searchAllItems($data);
        include_once 'html/itemindex.html';
    }
}