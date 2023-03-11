<?php
// Call the the config.php file
include('include/config.php');

if (isset($_POST["recipe_id"]) && isset($_POST["userID"])) {
    $recipe_id = $_POST["recipe_id"];
    $userID = $_POST["userID"];
    $stmt = $pdo->query("delete from favorite_recipes where recipe_id=$recipe_id AND user_id=$userID");
}
