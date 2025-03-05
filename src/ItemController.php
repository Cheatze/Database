<?php
namespace Cheatze\Library;

class ItemController
{
    public ItemService $itemService;

    public function __construct()
    {
        $this->itemService = new ItemService();
    }

    public function showAllItems()
    {
        $items = $this->itemService->getAllItems();
        include_once 'html/itemindex.html';
    }

    public function showItem(int $id){
        
    }
}