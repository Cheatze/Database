<?php
namespace Cheatze\Library;
//use Cheatze\Library\BurrowService;

trait Borrow
{

    public BorrowService $burrowService;
    public BorrowStatus $status;

    public function __construct()
    {
        $this->burrowService = new BorrowService;
    }

    public function returnItem()
    {
        $this->status = BorrowStatus::Available; //if it is loaned by the current user
    }

    public function borrowItem()
    {

    }

    //uses BorrowStatus enum
    public function getAvailability()
    {

    }

    public function canCustomerBorrow()
    {

    }


    //Uses BorrowStatus somehow
}