<?php
namespace Cheatze\Library;
use \DateTimeImmutable;
use Cheatze\Library\Item;
class Magazine extends Item
{


    private string $editor;
    private string $issn;
    private string $publisher;
    private DateTimeImmutable $publicationDate;
    private string $occurrence; //Weekelijks maandelijks etc

    /**
     * Constructor, moet $id hier ook bij?
     * @param string $title
     * @param string $editor
     * @param string $issn
     * @param string $publisher
     * @param \DateTimeImmutable $publicationDate
     * @param string $occurrence
     */
    public function __construct(string $title, string $editor, string $issn, string $publisher, DateTimeImmutable $publicationDate, string $occurrence, int $id = 1)
    {
        $this->title = $title;
        $this->editor = $editor;
        $this->issn = $issn;
        $this->publisher = $publisher;
        $this->publicationDate = $publicationDate;
        $this->occurrence = $occurrence;
        $this->id = $id;

    }

    public function getEditor()
    {
        return $this->editor;
    }

    public function getIssn()
    {
        return $this->issn;
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

    public function getOccurrence()
    {
        return $this->occurrence;
    }

    public function toArray()
    {
        return [
            'Title' => $this->getTitle(),
            'Editor' => $this->getEditor(),
            'ISSN' => $this->getIssn(),
            'Publisher' => $this->getPublisher(),
            'PublicationDate' => $this->getPublicationDateAsString(),
            'Occurrence' => $this->getOccurrence()
        ];
    }

    public static function fromArray($data)
    {
        $data['PublicationDate'] = new DateTimeImmutable($data['PublicationDate']);
        return new Magazine(
            $data['Title'],
            $data['Editor'],
            $data['Issn'],
            $data['Publisher'],
            $data['PublicationDate'],
            $data['Occurrence'],
            $data['Id']
        );
    }

    public function getOverviewText()
    {
        return sprintf(
            "Title: %s, published by: %s, edited by: %s",
            $this->getTitle(),
            $this->getPublisher(),
            $this->getEditor()
        );
    }

    public function getUrl()
    {
        return 'magazine/id=' . $this->getId();
    }
}