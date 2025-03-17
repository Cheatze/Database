<?php
namespace Cheatze\Library;
//use Cheatze\Library\BurrowService;

trait Borrow
{

    public BorrowService $burrowService;
    public BorrowStatus $status;

    // public function __construct()
    // {
    //     $this->burrowService = new BorrowService();
    // }

    public function returnItem()
    {//string $type, int $id
        //$this->status = BorrowStatus::Available; //if it is loaned by the current user
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
        //$item = $this->getTitle();
        //So instead of asigning to a variable I'm thinking setting the BorrowStatus
        $this->status = $this->burrowService->getAvailability($typeId, $item);
        //$loan = $this->burrowService->getAvailability($type, $item);
        //$loanAr = $loan->toArray();
        // if ($this->status->name == "Available") {
        //     $this->status = BorrowStatus::Available;
        // }
        return $this->status->name;
    }


    public function canCustomerBorrow()
    {

    }

}