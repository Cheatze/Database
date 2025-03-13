<?php
namespace Cheatze\Library;

interface Borrowable
{
    //I think using this returns the item
    public function returnItem();
    //And using this borrows the item
    public function borrowItem();
    //And this retuns if the item is available
    //Something that should be seen in the details page
    public function getAvailability(string $type);

    public function getTitle();
}