<?php
namespace Cheatze\Library;
use \DateTimeImmutable;
class Book
{
    private static int $count = 0;
    private int $id;
    private string $title;
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

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

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

}