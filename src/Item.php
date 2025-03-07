<?php
namespace Cheatze\Library;
abstract class Item
{
    protected int $id;
    protected string $title;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    abstract public function toArray();
    abstract public function getOverviewText();
    abstract public function getUrl();
}