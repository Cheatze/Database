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
        $check = $this->queryBuilder->select(['*'])->where(['Item' => $itemAndId, 'ReturnDate' => ''])->get();
        if (empty($check)) {
            return null;
        } else {
            return $check[0];
        }

    }

    /**
     * Checks for a loan in the database where the current user is the same as who loaned the item
     * Returns a loan if one is found or null
     * @param string $typeId
     * @param string $item
     * @param string $user
     */
    public function getLoanOfUser(string $typeId, string $item, string $user)
    {
        $itemAndId = $item . $typeId;
        $check = $this->queryBuilder->select(['*'])->where(['Item' => $itemAndId, 'ReturnDate' => '', 'User' => $user])->get();
        if (empty($check)) {
            return null;
        } else {
            return $check[0];
        }
    }

    /**Now unused
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
        $currentDate = date('Y-m-d');
        $keyValuePairs = ['ReturnDate' => $currentDate];

        $this->queryBuilder->select(['*'])->where(['Id' => $id])->update($keyValuePairs);
    }


}
