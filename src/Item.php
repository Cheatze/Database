<?php
namespace Cheatze\Library;
abstract class Item
{
    protected int $id;
    protected string $title;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    //Methods that every object that inherits from Item must have but where the bodies differ
    abstract public function toArray();
    abstract public function getOverviewText();
    abstract public function getUrl();
}
