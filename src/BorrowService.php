<?php
namespace Cheatze\Library;

class BorrowService
{

    public LoanRepository $loanRepository;

    public function __construct()
    {
        $this->loanRepository = new LoanRepository();
    }

    public function returnItem()
    {

    }

    public function borrowItem()
    {

    }

    public function getAvailability():BorrowStatus
    {
        
    }

    public function canCustomerBorrow()
    {

    }

}