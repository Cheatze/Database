<?php
namespace Cheatze\Library;
use \DateTimeImmutable;

// Create new Author instances
$authors[] = new Author('J.K.', 'Rowling', new DateTimeImmutable('1965-07-31'));
$authors[] = new Author('Stephen', 'King', new DateTimeImmutable('1947-09-21'));
$authors[] = new Author('Dan', 'Brown', new DateTimeImmutable('1964-06-22'));
$authors[] = new Author('Bobby', '', new DateTimeImmutable('1970-01-01'));

$_SESSION['authors'] = $authors;

