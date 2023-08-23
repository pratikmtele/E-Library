<?php

#get all categories function
function getAllCategories($conn){
    $sql = "select * from categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()>0){
        $categories = $stmt->fetchAll();
    }else{
        $categories =0;
    }
    return $categories;
}

# get category by ID
function get_Category($category_id, $conn){
    $sql = "select * from categories where id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id]);

    if($stmt->rowCount() == 1){
        $categories = $stmt->fetch();
    }else{
        $categories =0;
    }
    return $categories;
}