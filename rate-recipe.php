<?php

// PHP Scrips Detail: This PHP lines is to rate the

// PHP Scrips Detail: This PHP lines is to rate the recipe
include('include/config.php');

if (isset($_POST["rating"]) && isset($_POST["recipeID"]) && isset($_POST["userID"])) {

    $recipeID = $_POST["recipeID"];
    $userID = $_POST["userID"];
    $rating = $_POST["rating"];

    $select_stmt = $pdo->query("select rating from recipes_rating where recipe_id=$recipeID AND user_id=$userID");
    $row = $select_stmt->fetch();
    if (!$row) {
        $sql = "INSERT INTO recipes_rating(user_id, recipe_id, rating) VALUES (?,?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userID, $recipeID, $rating]);
    }
}
