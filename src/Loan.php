<?php
namespace Cheatze\Library;
use DateTimeImmutable;

class Loan
{
    private int $id;
    private string $item;
    private string $user;
    private int $term;
    private DateTimeImmutable $loanDate;
    private string $returnDate;

    public function __construct(string $item, string $user, string $returnDate, int $term = 21, DateTimeImmutable $loanDate = new DateTimeImmutable(), int $id = 1)
    {
        $this->item = $item;
        $this->user = $user;
        $this->term = $term;
        $this->loanDate = $loanDate ?? new DateTimeImmutable();
        $this->returnDate = $returnDate;
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getItem(): string
    {
        return $this->item;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getTerm(): int
    {
        return $this->term;
    }

    public function getLoanDate(): DateTimeImmutable
    {
        return $this->loanDate;
    }

    public function getLoanDateAsString(): string
    {
        return $this->loanDate->format(DATE_ATOM);
    }

    public function getReturnDate(): string
    {
        return $this->returnDate;
    }

    public function toArray(): array
    {
        return [
            'item' => $this->getItem(),
            'user' => $this->getUser(),
            'returnDate' => $this->getReturnDate(),
            'term' => $this->getTerm(),
            'loanDate' => $this->getLoanDateAsString(),
        ];
    }

    /**
     * Makes and returns a new Loan object from the data of a given array
     * @param mixed $data
     * @return Loan
     */
    public static function fromArray($data): Loan
    {
        $data['LoanDate'] = new DateTimeImmutable($data['LoanDate']);

        return new Loan(
            $data['Item'],
            $data['User'],
            $data['ReturnDate'],
            $data['Term'],
            $data['LoanDate'],
            $data['Id']
        );
    }

}
