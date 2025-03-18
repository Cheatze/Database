<?php
namespace Cheatze\Library;

class LoanRepository
{

    private QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder(Loan::class, 'loans');
    }

    /**
     * Adds a new loan entry in the loans db table from the given loan object
     * @param \Cheatze\Library\Loan $loan
     * @return void
     */
    public function addLoan(Loan $loan)
    {
        $this->queryBuilder->insert($loan->toArray());
    }

    /**
     * Retrieves a loan from the loans table if there is on or null
     * @param string $item
     */
    public function getLoan(string $typeId, string $item)
    {
        $itemAndId = $item . $typeId;
        //Change to also check if returnDate is set
        //Now it is only looking for if $itemAndId exists but it also needs to check if ReturnDate is empty
        $check = $this->queryBuilder->select(['*'])->where(['Item' => $itemAndId, 'ReturnDate' => ''])->get();
        if (empty($check)) {
            return null;
        } else {
            return $check[0];
        }

    }

    /**
     * Removes a loan with a given id
     * @param int $id
     * @return void
     */
    public function removeLoan(int $id)
    {
        $this->queryBuilder->remove($id);

    }

    //update the loans table entry with the given id to set the returnDate to the current date
    public function updateLoan(int $id)
    {

        //$this->queryBuilder->select(['*'])->where(['Item' => $itemAndId])->get();
        $currentDate = date('Y-m-d');
        $keyValuePairs = ['ReturnDate' => $currentDate];

        $this->queryBuilder->select(['*'])->where(['Id' => $id])->update($keyValuePairs);
    }


}
