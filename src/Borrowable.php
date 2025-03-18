<?php
namespace Cheatze\Library;

/**
 * Methods that are used where a borroable object is used
 */
interface Borrowable
{
    public function getId();

    public function returnItem();

    public function borrowItem();

    public function getAvailability();

    public function getTitle();
}
