<?php
// Load the XML file
$xml = simplexml_load_file('7.xml');

var_dump($xml->book);
// Iterating through each book element
foreach ($xml->book as $book) {
    echo "Title: " . $book->title . "<br>";
    echo "Author: " . $book->author . "<br>";
    echo "Year: " . $book->year . "<br><br>";
}
?>

<?php
// Create a new DOMDocument object
$dom = new DOMDocument();
$dom->load('7.xml');

// Get all 'book' elements
$books = $dom->getElementsByTagName('book');

// Iterate through each book element
foreach ($books as $book) {
    $title = $book->getElementsByTagName('title')->item(0)->nodeValue;
    $author = $book->getElementsByTagName('author')->item(0)->nodeValue;
    $year = $book->getElementsByTagName('year')->item(0)->nodeValue;
    
    echo "Title: " . $title . "<br>";
    echo "Author: " . $author . "<br>";
    echo "Year: " . $year . "<br><br>";
}
?>

<?php
// Create a new DOMDocument object
$dom = new DOMDocument('1.0', 'UTF-8');

// Create the root element
$library = $dom->createElement('library');
$dom->appendChild($library);

// Create a book element
$book = $dom->createElement('book');
$library->appendChild($book);

// Create child elements for book
$title = $dom->createElement('title', 'PHP for Beginners');
$book->appendChild($title);
$author = $dom->createElement('author', 'Alice Brown');
$book->appendChild($author);
$year = $dom->createElement('year', '2021');
$book->appendChild($year);

// Save the XML to a file
$dom->save('new_books.xml');
?>
