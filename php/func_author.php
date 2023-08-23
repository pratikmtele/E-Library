<?php

#get all author function
function getAllAuthor($conn){
    $sql = "select * from author";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()>0){
        $authors = $stmt->fetchAll();
    }else{
        $authors =0;
    }
    return $authors;
}

#get author by ID
function get_author($author_id, $conn){
    $sql = "select * from author where id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$author_id]);

    if($stmt->rowCount() == 1){
        $author = $stmt->fetch();
    }else{
        $author =0;
    }
    return $author;
}