<?php
namespace Cheatze\Library;

trait Borrow
{

    public BorrowService $borrowService;
    public BorrowStatus $status;

    /**
     * Removes a loan from the loans database table using the data of the current object
     * @return void
     */
    public function returnItem()
    {
        $this->borrowService->returnItem($this);
    }

    /**
     * Calls the borrowItem method on the borrowService and passes this object as an argument
     * @return void
     */
    public function borrowItem()
    {
        $this->borrowService->borrowItem($this);
    }

    /**
     * Checks for the existence of a loan on the current object and returns the availability status
     * @param string $typeId
     * @return string
     */
    public function getAvailability()
    {
        $typeId = $this->getId();
        $class = get_class($this);
        $item = basename($class);

        $this->status = $this->borrowService->getAvailability($typeId, $item);
        return $this->status->name;
    }

    /**
     * Gets the id and class name of the current item
     * Calls the borrowService with those variables to check if the item is borrowed by the current user
     * @return string
     */
    public function getCanReturn()
    {
        $typeId = $this->getId();
        $class = get_class($this);
        $item = basename($class);

        return $this->borrowService->getCompareUsers($typeId, $item);

    }

}
