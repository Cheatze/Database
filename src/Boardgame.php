<?php
namespace Cheatze\Library;
use \DateTimeImmutable;
use Cheatze\Library\Item;
class Boardgame extends Item
{

    private string $designer;
    private int $ean;
    private string $publisher;
    private DateTimeImmutable $releaseDate;
    private int $minPlayers;
    private int $maxPlayers;

    public function __construct(string $title, string $designer, int $ean, string $publisher, DateTimeImmutable $releaseDate, int $minPlayers, int $maxPlayers, int $id = 1)
    {
        $this->id = $id;
        $this->title = $title;
        $this->designer = $designer;
        $this->ean = $ean;
        $this->publisher = $publisher;
        $this->releaseDate = $releaseDate;
        $this->minPlayers = $minPlayers;
        $this->maxPlayers = $maxPlayers;
    }

    public function getDesigner()
    {
        return $this->designer;
    }

    public function getEan()
    {
        return $this->ean;
    }

    public function getPublisher()
    {
        return $this->publisher;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function getReleaseDateAsString()
    {
        return $this->releaseDate->format(DATE_ATOM);
    }

    public function getMinPlayers()
    {
        return $this->minPlayers;
    }

    public function getMaxPlayers()
    {
        return $this->maxPlayers;
    }

    public function toArray()
    {
        return [
            'Title' => $this->getTitle(),
            'Designer' => $this->getDesigner(),
            'Ean' => $this->getEan(),
            'Publisher' => $this->getPublisher(),
            'ReleaseDate' => $this->getReleaseDateAsString(),
            'MinPlayers' => $this->getMinPlayers(),
            'MaxPlayers' => $this->getMaxPlayers()
        ];
    }

    public static function fromArray($data)
    {
        $data['ReleaseDate'] = new DateTimeImmutable($data['ReleaseDate']);
        return new Boardgame(
            $data['Title'],
            $data['Designer'],
            $data['Ean'],
            $data['Publisher'],
            $data['ReleaseDate'],
            $data['MinPlayers'],
            $data['MaxPlayers'],
            $data['Id']
        );
    }

    public function getOverviewText()
    {
        return sprintf(
            "Title: %s, published by: %s, designed by: %s",
            $this->getTitle(),
            $this->getPublisher(),
            $this->getDesigner()
        );
    }
}