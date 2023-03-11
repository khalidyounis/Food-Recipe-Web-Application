<?php
// Call the the header.php file
include('include/header.php');

#Getting the Recipe ID from the link
$id = $_REQUEST['id'];

//Get the user ID from the session variables
$user_id = $_SESSION['user_id'];

$stmt = $pdo->query("select * from recipes where recipe_id=$id");

while ($recipe_res = $stmt->fetch()) {

    $recipe_id = $recipe_res['recipe_id'];
    $recipe_title = $recipe_res['recipe_name'];
    $recipe_description = $recipe_res['recipe_description'];
    $recipe_type = $recipe_res['recipe_type'];
    $prep_time = $recipe_res['preparation_time'];
    $cook_time = $recipe_res['cooking_time'];
    $serving = $recipe_res['serving'];
    $recipe_image = $recipe_res['image_path'];
    $author = $recipe_res['author'];
}

$rating_stmt = $pdo->query("select AVG(rating) from recipes_rating where recipe_id=$id");

if ($rating_res = $rating_stmt->fetch()) {
    $db_rating = (int)$rating_res['AVG(rating)'];
} else {
    $db_rating = 0;
}
?>

<section class="single-page-recipe spad">
    <div class="recipe-top">
        <div class="container-fluid">
            <div class="section-title">
                <h2><?php _e($recipe_title); ?></h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="ingredients-item">
                    <div class="intro-item">
                        <img src="images/<?php _e($recipe_image); ?>" alt="">
                        <h2><?php _e($recipe_title); ?></h2>
                        <div class="reviews"><?php _e($recipe_type); ?></div>
                        <div class="star-rating">

                            <!-- Check if the user is logged in -->
                            <?php if (isset($_SESSION['user_logged_in'])) {
                                for ($i = 1; $i < 6; $i++) {

                            ?>
                                    <i class="fa fa-star-o rating-item <?php if ($db_rating != 0) {
                                                                            _e("no-click");
                                                                        } ?>" data-rating="<?php _e($i); ?>" onclick="<?php _e("rateRecipe(" . $recipe_id . ", " . $i . ")"); ?>"></i>
                                <?php
                                }
                            } else {
                                ?>
                                <i class="fa fa-star-o rating-item no-click" data-rating="1"></i>
                                <i class=" fa fa-star-o rating-item no-click" data-rating="2"></i>
                                <i class="fa fa-star-o rating-item no-click" data-rating="3"></i>
                                <i class="fa fa-star-o rating-item no-click" data-rating="4"></i>
                                <i class="fa fa-star-o rating-item no-click" data-rating="5"></i>
                            <?php } ?>
                            <input type="hidden" id="rating_value" name="rating_value" class="rating-value" value="<?php _e($db_rating); ?>">
                        </div>

                        <div class="reviews" id="recipe_rating"><?php

                                                                if ($db_rating === 0) {
                                                                    _e('Not rated');
                                                                } else {
                                                                    _e($db_rating);
                                                                }
                                                                ?></div>
                        <div class="recipe-time">
                            <ul>
                                <li>Prep time: <span><?php _e($prep_time); ?></span></li>
                                <li>Cook time: <span><?php _e($cook_time); ?></span></li>
                                <li>Serving: <span><?php _e($serving); ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ingredient-list">
                        <div class="list-item">
                            <div class="ingredients">
                                <span class="ingredient-title">Ingredients</span>

                                <?php

                                // Get the list of ingridients
                                $ingredients_stmt = $pdo->query("select ingredients_id, ingredient from ingredients where recipe_id=$id");
                                while ($ingredients_res = $ingredients_stmt->fetch()) {
                                ?>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck<?php _e($ingredients_res['ingredients_id']); ?>">
                                        <label class="custom-control-label" for="customCheck<?php _e($ingredients_res['ingredients_id']); ?>"><?php _e($ingredients_res['ingredient']); ?></label>
                                    </div>
                                <?php

                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="recipe-right">
                    <div class="recipe-desc">
                        <h3>Description</h3>
                        <p><?php _e($recipe_description); ?>.</p>
                    </div>
                    <div class="notes">
                        <h3>Methods & Instructions</h3>
                        <div class="input-group right">
                            <span class="left vertical-align">Author: <?php _e($author); ?></span>
                            <span class="input-group-btn my-2">
                                <button id="decreaseFont" name="decreaseFont" aria-label="Decrease font size" value="decrease" class="btn btn-default font-button" type="button"><i class="fa fa-font" aria-hidden="true"></i>-</button>
                                <button id="restoreSize" name="restoreSize" aria-label="Restore font size" value="restore" class="btn btn-default font-button" type="button"><i class="fa fa-font" aria-hidden="true"></i></button>
                                <button id="increaseFont" name="increaseFont" aria-label="Increase font size" value="increase" class="btn btn-default font-button" type="button"><i class="fa fa-font" aria-hidden="true"></i>+</button>
                            </span>
                        </div>

                        <?php

                        //Get the list of methods with steps
                        $methods_stmt = $pdo->query("select step, description from method where recipe_id=$id ");
                        while ($methods_res = $methods_stmt->fetch()) {
                        ?>
                            <div class="notes-item">
                                <span><?php _e($methods_res['step']); ?></span>
                                <p class="method-data" style="font-size: 16px;"><?php _e($methods_res['description']); ?></p>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Single Recipe Section End -->

<?php

// Call the the footer.php file
include('include/footer.php');

?>

<script>
    //This function was developed to rate the recipes
    function rateRecipe(recipeID, ratingVal) {

        $.ajax({
            url: "rate-recipe.php",
            method: "POST",
            data: {
                rating: ratingVal,
                recipeID: <?php _e($recipe_id); ?>,
                userID: <?php _e($user_id); ?>
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    text: 'The recipe has been rated',
                })
                $('#recipe_rating').text(ratingVal);
            }

        });
    };
</script>