<?php
namespace Cheatze\Library;
use \DateTimeImmutable;
use Cheatze\Library\Item;
class Book extends Item implements Borrowable
{
    use Borrow;

    //private static int $count = 0;
    // private int $id; //in item
    //private string $title; //in item
    private Author $author;
    private string $isbn;
    private string $publisher;

    private DateTimeImmutable $publicationDate; //add type
    private int $pageCount;

    public function __construct(string $title, Author $author, string $isbn, string $publsiher, DateTimeImmutable $publicationDate, int $pageCount, int $id)
    {
        //$this->id = ++static::$count;
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->publisher = $publsiher;
        $this->publicationDate = $publicationDate;
        $this->pageCount = $pageCount;
    }

    // //to remove, is in item
    // public function getId()
    // {
    //     return $this->id;
    // }

    //to remeove, is in item
    // public function getTitle()
    // {
    //     return $this->title;
    // }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getAuthorName()
    {
        $name = $this->author->getName();
        return $name;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function getPublisher()
    {
        return $this->publisher;
    }

    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    public function getPublicationDateAsString()
    {
        return $this->publicationDate->format(DATE_ATOM);
    }

    public function getPagecount()
    {
        return $this->pageCount;
    }

    //Returns the type of thing that's being loaned, I think
    // public function returnItem()
    // {
    //     return "Book";
    // }

    // //What does this have to return? A new property?
    // public function borrowItem()
    // {

    // }

    // //Availability? I thought that that wasn't kept track of in this place?
    // public function getAvailability()
    // {

    // }

    //Add a toarray function that returns a associative array
    public function toArray()
    {
        return [
            'Title' => $this->getTitle(),
            'Author' => $this->author->getName(),
            'ISBN' => $this->getIsbn(),
            'Publisher' => $this->getPublisher(),
            'PublicationDate' => $this->getPublicationDateAsString(),
            'PageCount' => $this->getPagecount()
        ];
    }


    /**
     * Creates a new Book object based on $data
     * To be changed when the list of authors is stored somewhere else
     * @param mixed $data
     * @return Book
     */
    public static function fromArray($data)
    {
        foreach ($_SESSION['authors'] as $author) {
            if ($author->getName() == $data['Author']) {
                $data['Author'] = $author;
                break;
            }
        }
        $data['PublicationDate'] = new DateTimeImmutable($data['PublicationDate']);
        return new Book(
            $data['Title'],
            $data['Author'],
            $data['ISBN'],
            $data['Publisher'],
            $data['PublicationDate'],
            $data['PageCount'],
            $data['Id']
        );
    }

    public function getOverviewText()
    {
        return sprintf(
            "Title: %s, published by: %s, written by: %s",
            $this->getTitle(),
            $this->getPublisher(),
            $this->getAuthorName()
        );
    }

    public function getUrl()
    {
        return "book/id=" . $this->getId();
    }

}