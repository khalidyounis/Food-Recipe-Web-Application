<?php
include('include/config.php');

if (isset($_POST["recipe_id"]) && isset($_POST["userID"])) {
    $sql = "INSERT INTO favorite_recipes(user_id, recipe_id) VALUES (?,?)";
    $recipe_id = $_POST["recipe_id"];
    $userID = $_POST["userID"];
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $recipe_id]);
}
