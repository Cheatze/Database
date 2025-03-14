<?php
namespace Cheatze\Library;

class LoanController
{

    //public LoanRepository $loanRepository;

    public BookRepository $bookRepository;
    public MagazineRepository $magazineRepository;

    public BorrowService $borrowService;

    //public AuthenticationService $authenticationService;

    public function __construct()
    {
        //$this->loanRepository = new LoanRepository();
        $this->borrowService = new BorrowService();
        $this->bookRepository = new BookRepository();
        $this->magazineRepository = new MagazineRepository();
        //$this->authenticationService = new AuthenticationService();
    }

    //Haal item uit repository en roep borrow methode aan aan op item
    public function borrowItem($data)
    {
        $id = $data['id'];
        $id = intval($id);
        $type = $data['type'];
        $type = basename($type);
        // $item = $type . $id; //in borrow service stoppen
        echo "Type" . $type;
        // $user = $this->authenticationService->getAuthenticatedUser();
        // $loan = new Loan($item, $user);
        if ($type == "Book") {
            $borrowItem = $this->bookRepository->returnById($id);
        } elseif ($type == "Magazine") {
            $borrowItem = $this->magazineRepository->returnMagazineById($id);
        }
        $borrowItem->borrowItem();
        include_once "html/menu.html";
        //$this->borrowService->borrowItem($loan); call borrowItem on the item which calls the service which calls the repository?
    }


}