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
    {
        $this->status = BorrowStatus::Available; //if it is loaned by the current user
    }

    public function borrowItem()
    {

    }

    //uses BorrowStatus enum, somehow?
    public function getAvailability(string $type)
    {
        $item = $this->getTitle();
        //So instead of asigning to a variable I'm thinking setting the BorrowStatus
        $this->status = $this->burrowService->getAvailability($type, $item);
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