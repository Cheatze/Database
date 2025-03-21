<?php
namespace Cheatze\Library;
use \DateTimeImmutable;
class Author
{
    private static int $count = 0;
    private int $id;
    private string $firstName;
    private string $lastName;
    private DateTimeImmutable $birthDate;

    public function __construct(string $firstName, string $lastName, DateTimeImmutable $birthDate)
    {
        $this->id = ++static::$count;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }
    public function getName(): string
    {
        $fName = $this->firstName;
        $lName = $this->lastName;
        return "$fName $lName";
    }
    public function getDateOfBirth(): DateTimeImmutable
    {
        return $this->birthDate;
    }
    public function getDateOfBirthAsString(): string
    {
        return $this->birthDate->format("Y-m-d");
    }

    /**
     * Returns an array from the data of the author object
     * @return array{Birthdate: string, Firstname: string, Lastname: string}
     */
    public function toArray(): array
    {
        return [
            'Firstname' => $this->getFirstName(),
            'Lastname' => $this->getLastName(),
            'Birthdate' => $this->getDateOfBirthAsString()
        ];
    }
}
