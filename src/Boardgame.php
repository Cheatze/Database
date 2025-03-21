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

    public function getDesigner(): string
    {
        return $this->designer;
    }

    public function getEan(): int
    {
        return $this->ean;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function getReleaseDate(): DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function getReleaseDateAsString(): string
    {
        return $this->releaseDate->format(DATE_ATOM);
    }

    public function getMinPlayers(): int
    {
        return $this->minPlayers;
    }

    public function getMaxPlayers(): int
    {
        return $this->maxPlayers;
    }

    /**
     * Returns an array from the data of the Boardgame object
     * @return array{Designer: string, Ean: int, MaxPlayers: int, MinPlayers: int, Publisher: string, ReleaseDate: string, Title: string}
     */
    public function toArray(): array
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

    /**
     * Creates a new Boardgame object from the data of a given array
     * @param mixed $data
     * @return Boardgame
     */
    public static function fromArray($data): Boardgame
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

    public function getOverviewText(): string
    {
        return sprintf(
            "Title: %s, published by: %s, designed by: %s",
            $this->getTitle(),
            $this->getPublisher(),
            $this->getDesigner()
        );
    }

    /**
     * returns the get value for the links in the item index list
     * @return string
     */
    public function getUrl(): string
    {
        return "boardgame/id=" . $this->getId();
    }
}
