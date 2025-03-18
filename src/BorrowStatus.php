<?php
namespace Cheatze\Library;

enum BorrowStatus
{
    case Available;
    case OnLoan;
    //case Maintenance;
    case Reserved;
    case Late;
}
