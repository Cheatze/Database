<?php
namespace Cheatze\Library;
//use Cheatze\Library\BurrowService;

trait Borrow
{

    public BorrowService $burrowService;
    public BorrowStatus $status;

    /**
     * Removes a loan from the loans database table using the data of the current object
     * @return void
     */
    public function returnItem()
    {
        $this->burrowService->returnItem($this);
    }

    /**
     * Calls the borrowItem method on the borrowService and passes this object as an argument
     * @return void
     */
    public function borrowItem()
    {
        //borrowService->borrow($this);
        $this->burrowService->borrowItem($this);
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

        $this->status = $this->burrowService->getAvailability($typeId, $item);
        return $this->status->name;
    }


    public function canCustomerBorrow()
    {

    }

}