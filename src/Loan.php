<?php
namespace Cheatze\Library;
use Cheatze\Library\Item;
use DateTimeImmutable;

class Loan
{
    private int $id;
    private Borrowable $item;
    private string $user;
    private int $term; //How long you can loan something
    private DateTimeImmutable $loanDate;
    private DateTimeImmutable $returnDate;

    public function __construct(Borrowable $item, string $user, int $term, DateTimeImmutable $loanDate, DateTimeImmutable $returnDate, $int = 1)
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
            'item' => $this->item->getTitle(),
            ''

        ];
    }

}