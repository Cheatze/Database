<?php
namespace Cheatze\Library;
use Cheatze\Library\Item;
use DateTimeImmutable;

class Loan
{
    private int $id;
    //private Borrowable $item; //Does this have to be an object? I haven't seen where it is used as such.
    private string $item;
    private string $user; //also an object in the diagram
    private int $term; //How long you can loan something
    private DateTimeImmutable $loanDate;
    private DateTimeImmutable $returnDate;

    public function __construct(string $item, string $user, int $term = 21, DateTimeImmutable $loanDate = new DateTimeImmutable(), DateTimeImmutable $returnDate = new DateTimeImmutable(), int $id = 1)
    {
        $this->item = $item;
        $this->user = $user;
        $this->term = $term;
        $this->loanDate = $loanDate ?? new DateTimeImmutable();
        $this->returnDate = $returnDate ?? new DateTimeImmutable();
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTerm()
    {
        return $this->term;
    }

    public function getLoanDate()
    {
        return $this->loanDate;
    }

    public function getLoanDateAsString()
    {
        return $this->loanDate->format(DATE_ATOM);
    }

    public function getReturnDate()
    {
        return $this->returnDate;
    }

    public function getReturnDateAsString()
    {
        return $this->returnDate->format(DATE_ATOM);
    }

    public function toArray()
    {
        return [
            'item' => $this->getItem(),
            'user' => $this->getUser(),
            'term' => $this->getTerm(),
            'loanDate' => $this->getLoanDateAsString(),
            'returnDate' => $this->getReturnDateAsString(),
        ];
    }

    /**
     * Makes and returns a new Loan object from the data of a given array
     * @param mixed $data
     * @return Loan
     */
    public static function fromArray($data)
    {
        $data['LoanDate'] = new DateTimeImmutable($data['LoanDate']);
        $data['ReturnDate'] = new DateTimeImmutable($data['ReturnDate']);

        return new Loan(
            $data['Item'],
            $data['User'],
            $data['Term'],
            $data['LoanDate'],
            $data['ReturnDate'],
            $data['Id']
        );
    }

}