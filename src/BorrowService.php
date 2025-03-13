<?php
namespace Cheatze\Library;

class BorrowService
{

    public LoanRepository $loanRepository;

    public AuthenticationService $authenticationService;

    public function __construct()
    {
        $this->loanRepository = new LoanRepository();
        $this->authenticationService = new AuthenticationService();
    }

    public function returnItem()
    {

    }

    public function borrowItem()
    {
        $user = $this->authenticationService->getAuthenticatedUser();
    }

    //how can this return BorrowStatus?
    public function getAvailability(string $type, string $item): BorrowStatus
    {
        $loan = $this->loanRepository->getLoan($type, $item);
        //$loanAr = $loan->toArray();
        if ($loan == null) {
            return BorrowStatus::Available;
        } else {
            return BorrowStatus::OnLoan;
        }
        //compare two date time values to see if item is late
    }

    public function canCustomerBorrow()
    {

    }

}