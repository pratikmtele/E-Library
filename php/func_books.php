<?php

# function to get all books 
function getAllBooks($conn)
{
    $sql = "select * from books order by id desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $books = $stmt->fetchAll();
    } else {
        $books = 0;
    }

    return $books;
}

# get book by ID
function get_book($conn, $book_id)
{
    $sql = "select * from books where id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$book_id]);

    if ($stmt->rowCount() == 1) {
        $book = $stmt->fetch();
    } else {
        $book = 0;
    }

    return $book;
}

# search books function
function search_books($conn, $key)
{
    # creating simple search algorithm
    $key = "%{$key}%";
    $sql = "SELECT * FROM books WHERE title LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key, $key]);

    if ($stmt->rowCount() > 0) {
        $books = $stmt->fetchAll();
    } else {
        $books = 0;
    }

    return $books;
}

# get books by category id
function getBookByCategoryId($conn, $category_id)
{
    $sql = "SELECT * FROM books WHERE category_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id]);

    if ($stmt->rowCount() > 0) {
        $books = $stmt->fetchAll();
    } else {
        $books = 0;
    }

    return $books;
}

function getBookByAuthorId($conn, $author_id)
{
    $sql = "SELECT * FROM books WHERE author_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$author_id]);

    if ($stmt->rowCount() > 0) {
        $books = $stmt->fetchAll();
    } else {
        $books = 0;
    }

    return $books;
}

?>