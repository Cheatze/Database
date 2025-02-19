<?php
declare(strict_types=1);
namespace Tests;

use PHPUnit\Framework\TestCase;
use Cheatze\Library\Book;
use Cheatze\Library\Author;
use Cheatze\Library\Router;
use Cheatze\Library\BookRepository;
use Cheatze\Library\BookController;
use Cheatze\Library\MainController;
use Cheatze\Library\DatabaseCon;
use Cheatze\Library\QueryBuilder;

use \DateTimeImmutable;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertSame;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;

#[RunTestsInSeparateProcesses]
class BookRepositoryTest extends TestCase
{
    //Change use of static
    public function testAuthorMethods()
    {
        $author = new Author('Bobby', 'Bobson', new DateTimeImmutable('1970-01-01'));
        //Author tests
        $this->assertEquals(1, $author->getId(), "Author id didn't start at 1");
        $this->assertEquals("Bobby Bobson", $author->getName(), 'Wrong author name');
        $this->assertEquals('1970-01-01', $author->getDateOfBirthAsString(), 'Wrong date of birth');


    }

    //Change use of static
    public function testBookMothods()
    {
        $author = new Author('Bobby', 'Bobson', new DateTimeImmutable('1970-01-01'));
        $publicationDate = new DateTimeImmutable('2023-01-01');
        $book = new Book("The Story", $author, "12345", "Pinguin", $publicationDate, 99, 1);

        //Book tests
        $this->assertEquals(1, $book->getId(), "Book id didn't start at 1");
        $this->assertEquals('The Story', $book->getTitle(), 'Wrong title');
        $this->assertEquals('12345', $book->getIsbn(), 'Wrong isbn');
        $this->assertEquals('Pinguin', $book->getPublisher(), 'Wrong publisher');
        $this->assertEquals($author, $book->getAuthor(), 'Wrong author');
        $this->assertEquals("Bobby Bobson", $book->getAuthorName(), "Wrong author name");
        $this->assertEquals('12345', $book->getIsbn(), 'Wrong ISBN');
        $this->assertEquals(99, $book->getPagecount(), 'Wrong pagecount');
    }

    //Change use of static
    public function testRepositoryMethods()
    {
        $author = new Author('Bobby', 'Bobson', new DateTimeImmutable('1970-01-01'));
        $publicationDate = new DateTimeImmutable('2023-01-01');
        $book = new Book("The Story", $author, "12345", "Pinguin", $publicationDate, 99, 1);

        $repo = new BookRepository();
        $repo->add($book);

        //Repository testss
        $return = $repo->returnById(1);
        $this->assertNotNull($return, "Book not found"); //deze gaat fout?
        $this->assertEquals($book, $return, "Wrong book?");
        $returnAll = $repo->getAll();
        $this->assertTrue(is_array($returnAll), 'getAll did not return an array');
        $filterById = $repo->filterById(1);
        $this->assertTrue(is_array($filterById), 'Filter by id did not return an array');
        $this->assertEquals($book, $repo->returnById(1), 'Book not returned by Id');
        $repo->removeById(1);
        $removeCheck = $repo->checkForId(1);
        assertEquals($removeCheck, false, 'Book not removed');

    }

    //Change use of static 
    public function testBookControllerMethods()
    {
        $author = new Author('Bobby', 'Bobson', new DateTimeImmutable('1970-01-01'));
        $_SESSION['authors'][] = $author;
        $bookRep = new BookRepository();
        $bookCon = new BookController();
        //$publicationDate = new DateTimeImmutable('2023-01-01');
        $publicationDate = '2023-01-01';
        //$book = new Book("The Story", $author, "12345", "Pinguin", $publicationDate, 99, 1);
        $_SESSION['id'] = 1;
        $book = ['title' => "The Story", 'author' => '1', 'isbn' => "12345", 'publisher' => "Pinguin", 'publicationDate' => $publicationDate, 'pageCount' => 99];

        //Bookcontroller::add($book);
        // $this->bookCon->add($book);
        // //BookController::delete(1);
        // $this->bookCon->delete(1);

        // $booly = BookRepository::checkForId(1);
        // $booly = $this->bookRep->checkForId(1);
        // assertEquals(false, $booly, 'Book with id 1 still exists');
    }

    public function testDatabaseConMethods()
    {
        $db = DatabaseCon::getInstance();
        $sql = 'INSERT INTO books(Title,Author,ISBN,Publisher,PublicationDate,PageCount) VALUES(?,?,?,?,?,?)';
        $values = array_values(['Title' => 'The Shining', 'Author' => 'Stephen King', 'ISBN' => 9780307743657, 'Publisher' => 'Doubleday', 'PublicationDate' => '1977-01-28', 'PageCount' => 447]);

        //$db->insert($sql, $values);
        //assertEquals(2, $db->insert($sql, $values), 'Different id returned than expected.');

        //$sql = "DELETE FROM books WHERE id='1'";
        //$where = ['id' => '3'];
        //$db->delete($sql);
    }

}