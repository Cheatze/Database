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

    public function borrowItem(Borrowable $item)
    {
        $user = $this->authenticationService->getAuthenticatedUser();
        $class = get_class($item);
        $thing = basename($class);
        $key = $thing . $item->getId();
        //$key = intval($key);
        $loan = new Loan($key, $user, 21);
        $this->loanRepository->addLoan($loan);
    }

    //how can this return BorrowStatus?
    public function getAvailability(string $typeId, string $item): BorrowStatus
    {
        $loan = $this->loanRepository->getLoan($typeId, $item);
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