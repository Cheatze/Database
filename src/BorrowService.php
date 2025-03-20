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

    /**
     * Takes the clasname and id from the item and calls the getLoan on the loanRepository
     * Takes the id of the returned loan and calls the removeLoan method using that id
     * @param \Cheatze\Library\Borrowable $item
     * @return void
     */
    public function returnItem(Borrowable $item)
    {
        $class = get_class($item);
        $type = basename($class);
        $id = $item->getId();
        $loan = $this->loanRepository->getLoan($id, $type);
        $remId = $loan->getId();
        //Make an updateLoan method
        $this->loanRepository->updateLoan($remId);
    }

    /**
     * From the given borrowable item gets the classname and Id and session username from authenticationService
     * Concatinates the classname and id and uses those and user to make a new loan and calls the addLoan on the loanRepository
     * @param \Cheatze\Library\Borrowable $item
     * @return void
     */
    public function borrowItem(Borrowable $item)
    {
        $user = $this->authenticationService->getAuthenticatedUser();
        $class = get_class($item);
        $thing = basename($class);
        $key = $thing . $item->getId();

        $loan = new Loan($key, $user, '');
        $this->loanRepository->addLoan($loan);
    }

    /**
     * Searches the loan table for a certain loan and geturns the right borrow status
     * To be adjusted for showing the 'late' borrow status
     * @param string $typeId
     * @param string $item
     * @return BorrowStatus
     */
    public function getAvailability(string $typeId, string $item): BorrowStatus
    {
        $loan = $this->loanRepository->getLoan($typeId, $item);

        //or isset $loan['ReturnDate']? neen getLoan moet aangepast worden
        if ($loan == null) {
            return BorrowStatus::Available;
        } else {
            return BorrowStatus::OnLoan;
        }
        //compare two date time values to see if item is late
    }

    public function getCompareUsers(string $typeId, string $item)
    {
        $user = $this->authenticationService->getAuthenticatedUser();
        $loan = $this->loanRepository->getLoanOfUser($typeId, $item, $user);
        if ($loan == null) {
            return "No";
        } else {
            return "Yes";
        }
    }
}
