<?php
namespace Cheatze\Library;
use \DateTimeImmutable;

class LoanRepository
{

    private QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder(Loan::class, 'loans');
    }

    public function addLoan()
    {

    }

    /**
     * Retrieves a loan from the loans table if there is on or null
     * @param string $item
     */
    public function getLoan(string $type, string $item)
    {
        //If I also do it like this in the addLoan method there shouldn't be any overlap with other items
        $thing = $type . $item;
        $check = $this->queryBuilder->select(['*'])->where(['Item' => $thing])->get();
        if (empty($check)) {
            return null;
        } else {
            return $check[0];
        }

    }

    public function removeLoan()
    {

    }


}