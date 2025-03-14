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

    public function addLoan(Loan $loan)
    {
        $keyValuePairs = $loan->toArray();
        $this->queryBuilder->insert($keyValuePairs);
    }

    /**
     * Retrieves a loan from the loans table if there is on or null
     * @param string $item
     */
    public function getLoan(string $typeId, string $item)
    {
        //If I also do it like this in the addLoan method there shouldn't be any overlap with other items
        //$typeId = (string) $typeId;
        $thing = $item . $typeId;
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