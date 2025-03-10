<?php
namespace Cheatze\Library;

use DateTimeImmutable;

class Loan
{
    private int $id;
    //private item Borrowable? what is this?
    private string $user;
    private int $term;
    private DateTimeImmutable $loanDate;
    private DateTimeImmutable $returnDate;

    public function __construct()
    {

    }

}