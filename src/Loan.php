<?php
namespace Cheatze\Library;
use Cheatze\Library\Item;
use DateTimeImmutable;

class Loan
{
    private int $id;
    //private Borrowable $item; //Does this have to be an object? I haven't seen where it is used as such.
    private string $item; 
    private string $user;
    private int $term; //How long you can loan something
    private DateTimeImmutable $loanDate;
    private DateTimeImmutable $returnDate;

    public function __construct(string $item, string $user, int $term, DateTimeImmutable $loanDate, DateTimeImmutable $returnDate, $int = 1)
    {
        $this->item = $item;
        $this->user = $user;
        $this->term = $term;
        $this->loanDate = $loanDate;
        $this->returnDate = $returnDate;
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
            'returnDate' => $this->getReturnDateAsString()
        ];
    }

    public static function fromArray($data)
    {
        $data['loanDate'] = new DateTimeImmutable($data['loanDate']);
        $data['returnDate'] = new DateTimeImmutable($data['returnDate']);
        //How can I use the data to give a borrowable to the new loan?
        //fromArray is used in the querybuilder to turn the array of info from the database into an object
        //
    }

}