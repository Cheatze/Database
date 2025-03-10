<?php
namespace Cheatze\Library;

interface Borrowable
{
    public function returnItem();
    public function borrowItem();
    public function getAvailability();
}